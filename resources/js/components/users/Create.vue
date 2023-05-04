<template>
    <div>
        <div class="">

            <div class="row ">
                <div class="col-md-11 mx-auto">

                    <div class="card ">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-sm-flex">
                                <h2 class="h3 mb-0 text-gray-800">Create User</h2>
                            </div>
                            <router-link :to="{name: 'UsersIndex'}" class="btn btn-primary w-10">Back</router-link>
                        </div>

                        <div class="card-body table-wrap">
                            <form @submit.prevent="storeUser">

                                <!-- Name input -->
                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                                    <div class="col-md-6">
                                        <input id="name" v-model="form.name" type="text" class="form-control" name="name" required autocomplete="new-name">
                                            <span class="invalid-feedback" role="alert">

                                            </span>
                                    </div>
                                </div>

                                <!-- Email input -->
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                                    <div class="col-md-6">
                                        <input id="email" v-model="form.email" type="text" class="form-control" name="email" required autocomplete="new-stars">
                                            <span class="invalid-feedback" role="alert">

                                            </span>
                                    </div>
                                </div>

                                <!-- Phone input -->
                                <div class="row mb-3">
                                    <label for="phone" class="col-md-4 col-form-label text-md-end">Phone</label>
                                    <div class="col-md-6">
                                        <input id="phone" v-model="form.phone" type="text" class="form-control" name="phone" required autocomplete="new-phone">
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

                                <!-- Location input -->
                                <div class="row mb-3">
                                    <label for="location" class="col-md-4 col-form-label text-md-end">Location</label>
                                    <div class="col-md-6">
                                        <select name="location" v-model="form.location_id" class="form-select form-control" aria-label="Default select example">
                                            <option v-for="location in locations" :key="location.id" :value="location.id" > {{ location.name }} </option>
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
                    email: "",
                    phone: "",
                    password: ""
                }
            }
        },
        methods: {

            storeUser(){
                const from = new FormData();

                from.set('name', this.form.name)
                from.set('email', this.form.email)
                from.set('phone', this.form.phone)
                from.set('password', this.form.password)
                axios.post("/api/users", from)
                .then(res => {
                    this.$router.push({name: "UsersIndex" }, { params :{
                    showMessage: true,
                    message: "User Created Successfully"
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

