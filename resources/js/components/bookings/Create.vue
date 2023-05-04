<template>
    <div>
        <div class="">

            <div class="row ">
                <div class="col-md-11 mx-auto">

                    <div class="card ">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-sm-flex">
                                <h2 class="h3 mb-0 text-gray-800">Create Booking</h2>
                            </div>
                            <router-link :to="{name: 'BookingsIndex'}" class="btn btn-primary w-10">Back</router-link>
                        </div>

                        <div class="card-body table-wrap">
                            <form @submit.prevent="storeBooking" class="row">
                                <div class="col col-md-6">

                                    <!-- Choose Activity Section-->
                                    <div class="row">
                                        <label class="col-md-12 col-form-label text-md-start">Activities</label>
                                    </div>
                                    <div class="row">
                                        <div v-for="activity in form.activities" class="col-md-auto mt-2">
                                            <img v-bind:src="'../images/'+activity.img" width="50px" height="50px" alt="" class="img-fluid">
                                            <div @click="removeActivity(activity)" v-if="editingActivities" class="col-md-auto">
                                                <p style="margin-bottom: 0%;"> {{ activity.name }} </p>
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
                                            {{ this.editingActivities? 'Close' : 'Edit' }}
                                        </v-icon>

                                    </div>

                                    <!-- Choose Festival Section-->
                                    <div class="row mt-4">
                                        <label class="col-md-12 col-form-label text-md-start">Festivals</label>
                                    </div>
                                    <div class="row">
                                        <div v-for="festival in form.festivals" class="col-md-auto mt-1">
                                            <img v-bind:src="'../images/'+festival.img" width="50px" height="50px" alt="" class="img-fluid">
                                            <div @click="removeFestival(festival)" v-if="editingFestivals" class="col-md-auto">
                                                <p style="margin-bottom: 0%;"> {{ festival.name }} </p>
                                                <button type="button" style="background: none; border: none;" class="close p-0" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-if="editingFestivals" class="row">
                                        <label for="festival" class="col col-form-label text-md-start">Add Festival</label>
                                    </div>
                                    <div v-if="editingFestivals" class="row">
                                        <div class="col-md-12">

                                            <select @change="addFestival" v-model="selectedFestival" name="festival" class="form-select form-control">
                                                <option v-for="festival in festivals" :key="festival.id" :value="festival" > {{ festival.name }} </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div @click="editFestivals"  class="btn btn-success mt-2">
                                        <v-icon>
                                            {{ this.editingFestivals? 'Close' : 'Edit' }}
                                        </v-icon>

                                    </div>

                                    <!-- Choose Place Section-->
                                    <div class="row mt-4">
                                        <label class="col-md-12 col-form-label text-md-start">Places</label>
                                    </div>
                                    <div class="row">
                                        <div v-for="place in form.places" class="col-md-auto mt-2">
                                            <img v-bind:src="'../images/'+place.img" width="50px" alt="" class="img-fluid">
                                            <div @click="removePlace(place)" v-if="editingPlaces" class="col-md-auto">
                                                <p style="margin-bottom: 0%;"> {{ place.name }} </p>
                                                <button type="button" style="background: none; border: none;" class="close p-0" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-if="editingPlaces" class="row">
                                        <label for="place" class="col col-form-label text-md-start">Add Place</label>
                                    </div>
                                    <div v-if="editingPlaces" class="row">
                                        <div class="col-md-12">
                                            <select @change="addPlace" v-model="selectedPlace" name="place" class="form-select form-control">
                                                <option v-for="place in places" :key="place.id" :value="place" > {{ place.name }} </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div @click="editPlaces"  class="btn btn-success mt-2">
                                        <v-icon>
                                            {{ this.editingPlaces? 'Close' : 'Edit' }}
                                        </v-icon>
                                    </div>


                                </div>

                                <div class="col col-md-6">
                                    <label for="client" class="col-md-12 col-form-label text-md-start">Client</label>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <select name="client" v-model="form.client_id" class="form-select form-control" aria-label="Default select example">
                                                <option v-for="client in clients" :key="client.id" :value="client.id" > {{ client.first_name + " " + client.last_name }} </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                Create
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
                clients: [],
                editingActivities: false,
                selectedActivity: null,
                editingFestivals: false,
                selectedFestival: null,
                editingPlaces: false,
                selectedPlace: null,
                activities: [],
                festivals: [],
                places: [],
                form: {
                    client_id: "",
                    festivals: [],
                    places: [],
                    activities: []
                }
            }
        },
        created() {
            this.getPlaces();
            this.getFestivals();
            this.getActivities();
            this.getClients();
        },
        methods: {
            editActivities() {
                this.editingActivities = !this.editingActivities;
            },
            addActivity() {
                let result  = !this.form.activities.some(e => e.id === this.selectedActivity.id);
                console.log(result);
                if( result ){
                    this.form.activities.push(this.selectedActivity);
                }

            },
            removeActivity(activity) {
                let index = this.form.activities.indexOf(activity);
                this.form.activities.splice(index, 1);
            },

            editFestivals() {
                this.editingFestivals = !this.editingFestivals;
            },
            addFestival() {
                let result  = !this.form.festivals.some(e => e.id === this.selectedFestival.id);
                if( result ) {
                    this.form.festivals.push(this.selectedFestival);
                }
            },
            removeFestival(festival) {
                let index = this.form.festivals.indexOf(festival);
                this.form.festivals.splice(index, 1);
            },

            editPlaces() {
                this.editingPlaces = !this.editingPlaces;
            },
            addPlace() {
                let result  = !this.form.places.some(e => e.id === this.selectedPlace.id);
                if( result ) {
                    this.form.places.push(this.selectedPlace);
                }
            },
            removePlace(place) {
                let index = this.form.places.indexOf(place);
                this.form.places.splice(index, 1);
            },

            getClients() {
                axios.get("/api/clients", { params :{
                    search: this.search,
                }})
                .then(res => {
                    this.clients = res.data.data;
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
            storeBooking(){
                const from = new FormData();

                axios.post("/api/bookings", {
                    "client_id" : this.form.client_id,
                    "festivals": this.form.festivals,
                    "places": this.form.places,
                    "activities": this.form.activities

                })
                .then(res => {
                    this.$router.push({name: "BookingsIndex" }, { params :{
                    showMessage: true,
                    message: "Bookings Created Successfully"
                }} );

                }).catch(error => {
                    console.log(console.error);
                });
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>

