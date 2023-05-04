<template>
    <div>
        <div class="">

            <div class="row ">
                <div class="col-md-11 mx-auto">

                    <div class="card ">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-sm-flex">
                                <h2 class="h3 mb-0 text-gray-800">Edit User</h2>
                            </div>
                            <router-link :to="{name: 'UsersIndex'}" class="btn btn-primary w-10">Back</router-link>
                        </div>

                        <div class="card-body table-wrap">
                            <form @submit.prevent="updateUser" class="row">
                                <div class="col">

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

                                    <!-- Role input -->
                                    <div class="row mb-3">
                                        <label for="role" class="col-md-4 col-form-label text-md-end">Role</label>
                                        <div class="col-md-6">
                                            <input id="role" v-model="form.role" type="number" min="0" max="1" step="1"   class="form-control" name="role" required autocomplete="new-role">
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
            this.getUser();
        },
        methods: {
            getUser() {
                axios.get("/api/users/"+  this.$route.params.id)
                .then(res => {
                   this.form = res.data.data;

                }).catch(error => {
                    console.log(console.error);
                });
            },
            updateUser() {
                axios.put("/api/users/" +this.$route.params.id, {
                    'name' : this.form.name,
                    'email' : this.form.email,
                    'phone' : this.form.phone,
                    'role' : this.form.role
                })
                .then(res => {
                    this.$router.push({name: "UsersIndex" });
                }).catch(error => {
                    console.log(console.error);
                });
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>

