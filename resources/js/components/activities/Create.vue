<template>
    <div>
        <div class="">

            <div class="row ">
                <div class="col-md-11 mx-auto">

                    <div class="card ">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-sm-flex">
                                <h2 class="h3 mb-0 text-gray-800">Create Activity</h2>
                            </div>
                            <router-link :to="{name: 'ActivitiesIndex'}" class="btn btn-primary w-10">Back</router-link>
                        </div>

                        <div class="card-body table-wrap">
                            <form @submit.prevent="storeActivity">

                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                                    <div class="col-md-6">
                                        <input id="name" v-model="form.name" type="text" class="form-control" name="name" required autocomplete="new-name">
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
                    image: null
                }
            }
        },
        methods: {
            setImage(event){
                console.log(event)
                this.form.image = event.target.files[0]
            },
            storeActivity(){
                const from = new FormData();

                from.set('name', this.form.name)
                from.set('image', this.form.image, this.form.image.name)
                axios.post("/api/activities", from)
                .then(res => {
                    this.$router.push({name: "ActivitiesIndex" }, { params :{
                    showMessage: true,
                    message: "Activity Created Successfully"
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

