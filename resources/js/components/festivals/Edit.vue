<template>
    <div>
        <div class="">

            <div class="row ">
                <div class="col-md-11 mx-auto">

                    <div class="card ">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-sm-flex">
                                <h2 class="h3 mb-0 text-gray-800">Edit Festival</h2>
                            </div>
                            <router-link :to="{name: 'FestivalsIndex'}" class="btn btn-primary w-10">Back</router-link>
                        </div>

                        <div class="card-body table-wrap">
                            <form @submit.prevent="updateFestival" class="row">
                                <div class="col col-md-4">

                                    <!-- Update Image Section -->
                                    <div class="row">
                                        <img v-bind:src="'../images/'+form.img" width="200px" alt="" class="img-fluid">
                                    </div>
                                    <div class="row">
                                        <label for="image" class="col-md-12 col-form-label text-md-start">Change Image</label>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <input id="image" ref="image" @change="setImage($event)" type="file" class="col form-control " name="image" >
                                        </div>
                                    </div>

                                    <!-- Update Activty Section-->
                                    <div class="row mt-4">
                                        <label class="col-md-12 col-form-label text-md-start">Activities</label>
                                    </div>
                                    <div class="row">
                                        <div v-for="activity in form.activities" class="col-md-auto mt-2">
                                            <img v-bind:src="'../images/'+activity.img" width="50px" alt="" class="img-fluid">
                                            <div @click="removeActivity(activity)" v-if="editingActivities" class="col-md-auto">
                                                <button type="button" style="background: none; border: none;" class="close p-0" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-if="editingActivities" class="row">
                                        <label for="activities" class="col col-form-label text-md-start">Add Activity</label>
                                    </div>
                                    <div v-if="editingActivities" class="row">
                                        <div class="col-md-12">

                                            <select @change="addActivity" v-model="selectedActivity" name="activity" class="form-select form-control">
                                                <option v-for="activity in activities" :key="activity.id" :value="activity" > {{ activity.name }} </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div @click="editActivities"  class="btn btn-success mt-2">
                                        <v-icon>
                                            {{ this.editingActivities? 'Cancel' : 'Edit' }}
                                        </v-icon>

                                    </div>


                                </div>
                                <div class="col">
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                                        <div class="col-md-6">
                                            <input id="name" v-model="form.name" type="text" class="form-control" name="name" required autocomplete="new-name">
                                                <span class="invalid-feedback" role="alert">

                                                </span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="people" class="col-md-4 col-form-label text-md-end">People</label>
                                        <div class="col-md-6">
                                            <input id="people" v-model="form.people" type="number" min="1" max="20" step="1"  class="form-control" name="people" required autocomplete="new-people">
                                                <span class="invalid-feedback" role="alert">

                                                </span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="price" class="col-md-4 col-form-label text-md-end">Price</label>
                                        <div class="col-md-6">
                                            <input id="price" v-model="form.price" type="number" min="1000" max="50000" step="1000" class="form-control" name="price" required autocomplete="new-price">
                                                <span class="invalid-feedback" role="alert">

                                                </span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="location" class="col-md-4 col-form-label text-md-end">Location</label>
                                        <div class="col-md-6">
                                            <select name="location" v-model="form.location_id" class="form-select form-control" aria-label="Default select example">
                                                <option v-for="location in locations" :key="location.id" :value="location.id" > {{ location.name }} </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="description" class="col-md-4 col-form-label text-md-end">Description</label>
                                        <div class="col-md-6">
                                            <textarea id="description" v-model="form.description" type="text" class="form-control" name="description" required autocomplete="new-description"> </textarea>
                                                <span class="invalid-feedback" role="alert">

                                                </span>
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                editingActivities: false,
                selectedActivity: null,
                locations: [],
                activities: [],
                form: {
                    id: 0,
                    name: "",
                    description: "",
                    price: 0,
                    people: 0,
                    stars: 0,
                    img: "",
                    location_id: 0,
                    location: {},
                    image: null,
                    activities: []
                }
            }
        },
        created(){
            this.getFestival();
            this.getLocations();
            this.getActivities();
        },
        methods: {
            editActivities() {
                this.editingActivities = !this.editingActivities;
            },
            addActivity() {
                let result  = !this.form.activities.some(e => e.id === this.selectedActivity.id);
                console.log(result);
                if( result ) {
                    this.form.activities.push(this.selectedActivity);
                    axios.post("/api/festivals/add/activity/", {
                        'activity_id' : this.selectedActivity.id,
                        'festival_id': +this.$route.params.id,
                    })
                    .then(res => {
                        console.log(res);
                    }).catch(error => {
                        console.log(console.error);
                    });
                }

            },
            removeActivity(activity) {
                let index = this.form.activities.indexOf(activity);
                this.form.activities.splice(index, 1);

                axios.post("/api/festivals/remove/activity/", {
                    'activity_id' : activity.id,
                    'festival_id': +this.$route.params.id,
                })
                .then(res => {
                    console.log(res);
                }).catch(error => {
                    console.log(console.error);
                });
            },
            getActivities() {
                axios.get("/api/activities")
                .then(res => {
                    console.log(res.data.data);
                    this.activities = res.data.data;
                }).catch(error => {
                    console.log(console.error);
                });
            },
            getFestival() {
                axios.get("/api/festivals/"+  this.$route.params.id)
                .then(res => {
                   this.form = res.data.data;
                   this.form.location_id = this.form.location.id;

                }).catch(error => {
                    console.log(console.error);
                });
            },
            getLocations() {
                axios.get("/api/locations")
                .then(res => {
                    this.locations = res.data;
                }).catch(error => {
                    console.log(console.error);
                });
            },
            setImage(event){
                this.form.image = event.target.files[0]
            },
            updateFestival() {

                if(this.form.image == null){
                    axios.put("/api/festivals/" +this.$route.params.id, {
                        'name' : this.form.name,
                        'description' : this.form.description,
                        'price' : this.form.price,
                        'people' : this.form.people,
                        'image' : this.form.image,
                        'location_id' : this.form.location_id
                    })
                    .then(res => {
                        this.$router.push({name: "FestivalsIndex" });
                    }).catch(error => {
                        console.log(console.error);
                    });
                }
                else {
                    const from = new FormData();
                    from.set('name', this.form.name);
                    from.set('description', this.form.description);
                    from.set('location_id', this.form.location_id);
                    from.set('people', this.form.people);
                    from.set('price', this.form.price);
                    from.set('image', this.form.image, this.form.image.name);
                    from.append('_method', 'PUT')

                    axios.post("/api/festivals/" +this.$route.params.id, from)
                    .then(res => {
                        this.$router.push({name: "FestivalsIndex" });
                    }).catch(error => {
                        console.log(console.error);
                    });
                }
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>

