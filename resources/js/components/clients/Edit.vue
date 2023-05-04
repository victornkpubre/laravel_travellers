<template>
    <div>
        <div class="">

            <div class="row ">
                <div class="col-md-11 mx-auto">

                    <div class="card ">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-sm-flex">
                                <h2 class="h3 mb-0 text-gray-800">Edit Client</h2>
                            </div>
                            <router-link :to="{name: 'ClientsIndex'}" class="btn btn-primary w-10">Back</router-link>
                        </div>

                        <div class="card-body table-wrap">
                            <form @submit.prevent="updateClient" class="row">
                                <div class="col">

                                    <!-- First Name Input -->
                                    <div class="row mb-3">
                                        <label for="first_name" class="col-md-4 col-form-label text-md-end">First Name</label>
                                        <div class="col-md-6">
                                            <input id="first_name" v-model="form.first_name" type="text" class="form-control" name="first_name" required autocomplete="new-first_name">
                                                <span class="invalid-feedback" role="alert">
                                                </span>
                                        </div>
                                    </div>

                                    <!-- Last Name Input -->
                                    <div class="row mb-3">
                                        <label for="last_name" class="col-md-4 col-form-label text-md-end">Last Name</label>
                                        <div class="col-md-6">
                                            <input id="last_name" v-model="form.last_name" type="text" class="form-control" name="last_name" required autocomplete="new-last_name">
                                                <span class="invalid-feedback" role="alert">
                                                </span>
                                        </div>
                                    </div>

                                    <!-- Email Name Input -->
                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                                        <div class="col-md-6">
                                            <input id="email" v-model="form.email" type="text" class="form-control" name="email" required autocomplete="new-email">
                                                <span class="invalid-feedback" role="alert">
                                                </span>
                                        </div>
                                    </div>

                                    <!-- Phone Input -->
                                    <div class="row mb-3">
                                        <label for="phone" class="col-md-4 col-form-label text-md-end">Phone</label>
                                        <div class="col-md-6">
                                            <input id="phone" v-model="form.phone" type="text" class="form-control" name="phone" required autocomplete="new-phone">
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
                    email: "",
                    phone: 0,
                    role: 0
                }
            }
        },
        created(){
            this.getClient();
        },
        methods: {
            getClient() {
                axios.get("/api/clients/"+  this.$route.params.id)
                .then(res => {
                   this.form = res.data.data;

                }).catch(error => {
                    console.log(console.error);
                });
            },
            updateClient() {
                axios.put("/api/clients/" +this.$route.params.id, {
                    'first_name' : this.form.first_name,
                    'last_name' : this.form.last_name,
                    'email' : this.form.email,
                    'phone' : this.form.phone,
                })
                .then(res => {
                    this.$router.push({name: "ClientsIndex" });
                }).catch(error => {
                    console.log(console.error);
                });
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>

