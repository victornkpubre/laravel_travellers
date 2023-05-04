<template>
    <div>
        <div class="">

            <div class="row ">
                <div class="col-md-11 mx-auto">

                    <div class="card ">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-sm-flex">
                                <h2 class="h3 mb-0 text-gray-800">Edit Activity</h2>
                            </div>
                            <router-link :to="{name: 'ActivitiesIndex'}" class="btn btn-primary w-10">Back</router-link>
                        </div>

                        <div class="card-body table-wrap">
                            <form @submit.prevent="updateActivity" class="row">
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
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                                        <div class="col-md-6">
                                            <input id="name" v-model="form.name" type="text" class="form-control" name="name" required autocomplete="new-name">
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
                form: {
                    id: 0,
                    name: "",
                    img: "",
                    image: null
                }
            }
        },
        created(){
            this.getActivity();
        },
        methods: {
            getActivity() {
                axios.get("/api/activities/"+  this.$route.params.id)
                .then(res => {
                   this.form = res.data.data;
                   this.form.location_id = this.form.location.id;

                }).catch(error => {
                    console.log(console.error);
                });
            },
            setImage(event){
                this.form.image = event.target.files[0]
            },
            updateActivity() {
                if(this.form.image == null){
                    axios.put("/api/activities/" +this.$route.params.id, {
                        'name' : this.form.name,
                        'image' : this.form.image,
                    })
                    .then(res => {
                        this.$router.push({name: "ActivitiesIndex" });
                    }).catch(error => {
                        console.log(console.error);
                    });
                }
                else {
                    const from = new FormData();
                    from.set('name', this.form.name);
                    from.set('image', this.form.image, this.form.image.name);
                    from.append('_method', 'PUT');

                    axios.post("/api/activities/" +this.$route.params.id, from)
                    .then(res => {
                        this.$router.push({name: "ActivitiesIndex" });
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

