<template>
    <div>
        <div class="">

            <div class="row ">
                <div class="col-md-11 mx-auto">

                    <div class="card ">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-sm-flex">
                                <h2 class="h3 mb-0 text-gray-800">Create Festival</h2>
                            </div>
                            <router-link :to="{name: 'FestivalsIndex'}" class="btn btn-primary w-10">Back</router-link>
                        </div>

                        <div class="card-body table-wrap">
                            <form @submit.prevent="storeFestival">

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

                                <div class="row mb-3">
                                    <label for="image" class="col-md-4 col-form-label text-md-end">Image</label>
                                    <div class="col-md-6">
                                        <input id="image" ref="image" @change="setImage($event)" type="file" class="col form-control " name="image" >
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Create
                                        </button>
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
                locations: [],
                form: {
                    name: "",
                    description: "",
                    location_id: "",
                    price: 0,
                    people: 0,
                    image: null
                }
            }
        },
        created(){
            this.getLocations();
        },
        methods: {
            getLocations() {
                axios.get("/api/locations")
                .then(res => {
                    this.locations = res.data;
                }).catch(error => {
                    console.log(console.error);
                });
            },
            setImage(event){
                console.log(event)
                this.form.image = event.target.files[0]
            },
            storeFestival(){
                const from = new FormData();

                from.set('name', this.form.name)
                from.set('description', this.form.description)
                from.set('location_id', this.form.location_id)
                from.set('people', this.form.people)
                from.set('price', this.form.price)
                from.set('image', this.form.image, this.form.image.name)
                axios.post("/api/festivals", from)
                .then(res => {
                    this.$router.push({name: "FestivalsIndex" }, { params :{
                    showMessage: true,
                    message: "Festival Created Successfully"
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

