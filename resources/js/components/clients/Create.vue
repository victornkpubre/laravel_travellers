<template>
    <div>
        <div class="">

            <div class="row ">
                <div class="col-md-11 mx-auto">

                    <div class="card ">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-sm-flex">
                                <h2 class="h3 mb-0 text-gray-800">Create Client</h2>
                            </div>
                            <router-link :to="{name: 'ClientsIndex'}" class="btn btn-primary w-10">Back</router-link>
                        </div>

                        <div class="card-body table-wrap">
                            <form @submit.prevent="storeClient">

                                <!-- First Name input -->
                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">First Name</label>
                                    <div class="col-md-6">
                                        <input id="first_name" v-model="form.first_name" type="text" class="form-control" name="first_name" required >
                                            <span class="invalid-feedback" role="alert">

                                            </span>
                                    </div>
                                </div>

                                <!-- Last Name input -->
                                <div class="row mb-3">
                                    <label for="last_name" class="col-md-4 col-form-label text-md-end">Last Name</label>
                                    <div class="col-md-6">
                                        <input id="last_name" v-model="form.last_name" type="text" class="form-control" name="last_name" >
                                            <span class="invalid-feedback" role="alert">

                                            </span>
                                    </div>
                                </div>

                                <!-- Email input -->
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                                    <div class="col-md-6">
                                        <input id="email" v-model="form.email" type="text" class="form-control" name="email" >
                                            <span class="invalid-feedback" role="alert">

                                            </span>
                                    </div>
                                </div>

                                <!-- Phone input -->
                                <div class="row mb-3">
                                    <label for="phone" class="col-md-4 col-form-label text-md-end">Phone</label>
                                    <div class="col-md-6">
                                        <input id="phone" v-model="form.phone" type="text" class="form-control" name="phone" >
                                            <span class="invalid-feedback" role="alert">

                                            </span>
                                    </div>
                                </div>

                                <!-- Password input -->
                                <div class="row mb-3">
                                    <label class="col-md-4 col-form-label text-md-end" for="password">Password</label>
                                    <div class="col-md-6">
                                        <input v-model="form.password" id="password" type="password" class="form-control" name="password" >
                                            <span class="invalid-feedback" role="alert">

                                            </span>
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
                    first_name: "",
                    last_name: "",
                    email: "",
                    phone: "",
                    password: ""
                }
            }
        },
        methods: {

            storeClient(){
                const from = new FormData();
                from.set('first_name', this.form.first_name)
                from.set('last_name', this.form.last_name)
                from.set('email', this.form.email)
                from.set('phone', this.form.phone)
                from.set('password', this.form.password)
                axios.post("/api/clients", from)
                .then(res => {
                    this.$router.push({name: "ClientsIndex" }, { params: {
                    showMessage: true,
                    message: "Client Created Successfully"
                }});

                }).catch(error => {
                    console.log(console.error);
                });
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>

