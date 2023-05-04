<template>
    <div>
        <div class="">

            <div class="row ">
                <div class="col-md-11 mx-auto">

                    <div class="card ">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-sm-flex">
                                <h2 class="h3 mb-0 text-gray-800">Edit Emotion</h2>
                            </div>
                            <router-link :to="{name: 'EmotionsIndex'}" class="btn btn-primary w-10">Back</router-link>
                        </div>

                        <div class="card-body table-wrap">
                            <form @submit.prevent="updateEmotion" class="row">
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

                                </div>
                                <div class="col">

                                    <!-- Update Activity Section-->
                                    <div class="row mt-4">
                                        <label class="col-md-7 col-form-label text-md-start">
                                             <p v-if="form.activity">Activity: {{ form.activity.name }} </p>
                                             <p v-else>Activity: None </p>
                                        </label>
                                        <button @click="removeRelation('activity', form.activity.id)" v-if="form.activity" class="btn btn-warning col col-md-5 h-75" >
                                            Remove
                                        </button>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <select name="activity" v-model="form.activity_id" class="form-select form-control" aria-label="Default select example">
                                                <option v-for="activity in activities" :key="activity.id" :value="activity.id" > {{ activity.name }} </option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Update Festival Section-->
                                    <div class="row mt-4">
                                        <label class="col-md-7 col-form-label text-md-start">
                                            <p v-if="form.festival">Festival: {{ form.festival.name }} </p>
                                            <p v-else>Festival: None </p>
                                        </label>
                                        <button @click="removeRelation('festival', form.festival.id)" v-if="form.festival" class="btn btn-warning col col-md-5 h-75" >
                                            Remove
                                        </button>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <select name="festival" v-model="form.festival_id" class="form-select form-control" aria-label="Default select example">
                                                <option v-for="festival in festivals" :key="festival.id" :value="festival.id" > {{ festival.name }} </option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Update Place Section-->
                                    <div class="row mt-4">
                                        <label class="col-md-7 col-form-label text-md-start">
                                            <p v-if="form.place">Place: {{ form.place.name }} </p>
                                            <p v-else>Place: None </p>
                                        </label>
                                        <button @click="removeRelation('place', form.place.id )" v-if="form.place" class="btn btn-warning col col-md-5 h-75" >
                                            Remove
                                        </button>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <select name="place" v-model="form.place_id" class="form-select form-control" aria-label="Default select example">
                                                <option v-for="place in places" :key="place.id" :value="place.id" > {{ place.name }} </option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div v-if="editingActivities" class="row">
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

                                    </div> -->

                                    <div class="row mb-0 mt-4">
                                        <div class="col-md-6 ">
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
                activities: [],
                festivals: [],
                places: [],
                form: {
                    id: 0,
                    img: "",
                    image: null,
                    activity_id: 0,
                    festival_id: 0,
                    place_id: 0,
                }
            }
        },
        created(){
            this.getEmotion();
            this.getActivities();
            this.getFestivals();
            this.getPlaces();
        },
        methods: {
            removeRelation(relation, id) {
                axios.post("/api/emotions/remove/relation/", {
                    'relation' : relation,
                    'id': id,
                    'emotion_id': this.$route.params.id,
                })
                .then(res => {
                    console.log(res);
                }).catch(error => {
                    console.log(console.error);
                });
            },
            getEmotion() {
                axios.get("/api/emotions/"+  this.$route.params.id)
                .then(res => {
                    console.log(res);
                    this.form = res.data.data;
                    console.log(this.form.activity !== null);
                    if(this.form.activity !== null){
                        this.form.activity_id = this.form.activity.id;
                    }
                    if(this.form.festival !== null){
                        this.form.festival_id = this.form.festival.id
                    }
                    if(this.form.place !== null){
                        this.form.place_id = this.form.place.id;
                    }

                }).catch(error => {
                    console.log(console.error);
                });
            },
            getPlaces() {
                axios.get("/api/places", { params :{
                    search: this.search,
                }})
                .then(res => {
                    this.places = res.data.data;
                    console.log(res);
                }).catch(error => {
                    console.log(console.error);
                });
            },
            getActivities() {
                axios.get("/api/activities", { params :{
                    search: this.search,
                }})
                .then(res => {
                    this.activities = res.data.data;
                    console.log(res);
                }).catch(error => {
                    console.log(console.error);
                });
            },
            getFestivals() {
                axios.get("/api/festivals", { params :{
                    search: this.search,
                }})
                .then(res => {
                    this.festivals = res.data.data;
                    console.log(res);
                }).catch(error => {
                    console.log(console.error);
                });
            },
            setImage(event){
                this.form.image = event.target.files[0];
            },
            updateEmotion() {
                if(this.form.image == null){
                    axios.put("/api/emotions/" +this.$route.params.id, {
                        'image' : this.form.image,
                        'festival_id': this.form.festival_id,
                        'place_id': this.form.place_id,
                        'activity_id': this.form.activity_id
                    })
                    .then(res => {
                        this.$router.push({name: "EmotionsIndex" });
                    }).catch(error => {
                        console.log(console.error);
                    });
                }
                else {
                    const from = new FormData();
                    from.set('image', this.form.image, this.form.image.name);
                    from.set('festival_id', this.form.festival_id);
                    from.set('place_id', this.form.place_id);
                    from.set('activity_id', this.form.activity_id);
                    from.append('_method', 'PUT');
                    console.log(from);

                    axios.post("/api/emotions/" +this.$route.params.id, from)
                    .then(res => {
                        this.$router.push({name: "EmotionsIndex" });
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

