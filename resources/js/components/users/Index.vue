<template>
    <div class="col-md-12 mx-auto">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Users</h1>
        </div>
        <div class="card mx-auto" style="margin-bottom: 100px;">
            <div v-if="showMessage" class="alert alert-success">
                {{ message }}
            </div>
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <form action="">
                            <div class="row form-row ">
                                <div class="col">
                                    <input type="search" v-model="search" name="search" id="inLineFormInput" class="form-control mb-2">
                                </div>
                                <div class="col">
                                    <div @click="getUsers()" class="btn btn-primary mb-2" >Search</div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <router-link
                            :to="{name: 'UsersCreate'}"
                            class="btn btn-primary align-self-center">
                                Create
                        </router-link>
                    </div>
                </div>

            </div>
            <div class="card-body table-wrap">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Role</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in users" :key="user.id">
                        <th scope="row"> #{{ user.id }} </th>
                        <td> {{ user.name }} </td>
                        <td> {{ user.email }} </td>
                        <td> {{ user.phone }} </td>
                        <td> {{ user.role }} </td>
                        <td>
                            <router-link
                                :to="{name: 'UsersEdit', params: {id: user.id}}"
                                class="btn btn-primary float-right">
                                Edit
                            </router-link>
                        </td>
                        <td>
                            <button class="btn btn-danger" @click="deleteUser(user.id)" > Delete </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                users: [],
                showMessage: false,
                message: "",
                search: null,
            }
        },
        created() {
            this.getUsers();
        },
        // watch: {
        //     search(){
        //         this.getUsers();
        //     },
        // },
        methods: {

            getUsers() {
                axios.get("/api/users", { params :{
                    search: this.search,
                }})
                .then(res => {
                    this.users = res.data.data;
                    console.log(res);
                }).catch(error => {
                    console.log(console.error);
                });
            },

            deleteUser(id) {
                axios.delete("api/users/"+id).then(res => {
                    this.showMessage = true;
                    this.message = res.data;
                    this.getUsers();
                });
            }
        }
    };
</script>

<style lang="scss" scoped>

</style>
