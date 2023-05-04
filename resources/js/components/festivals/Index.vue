<template>
    <div class="col-md-12 mx-auto">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Festivals</h1>
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
                                    <div @click="getFestivals()" class="btn btn-primary mb-2" >Search</div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <router-link
                            :to="{name: 'FestivalsCreate'}"
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
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">People</th>
                        <th scope="col">Location</th>
                        <th scope="col">Activities</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="festival in festivals" :key="festival.id">
                        <th scope="row"> #{{ festival.id }} </th>
                        <td> {{ festival.name }} </td>
                        <td class="h-25 overflow-hidden" style="height: 80px;text-overflow: ellipsis;"> <p style="height: 80px;text-overflow: ellipsis;" class="p-2">   {{ festival.description }} </p> </td>
                        <td> &#8358{{ festival.price }} </td>
                        <td> {{ festival.people }} </td>
                        <td> {{ festival.location.name }} </td>
                        <td> {{ festival.activities.length }} </td>
                        <td>
                            <router-link
                                :to="{name: 'FestivalsEdit', params: {id: festival.id}}"
                                class="btn btn-primary float-right">
                                Edit
                            </router-link>
                        </td>
                        <td>
                            <button class="btn btn-danger" @click="deleteFestival(festival.id)" > Delete </button>
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
                festivals: [],
                showMessage: false,
                message: "",
                search: null,
            }
        },
        created() {
            this.getFestivals();
        },
        // watch: {
        //     search(){
        //         this.getFestivals();
        //     },
        // },
        methods: {

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

            deleteFestival(id) {
                axios.delete("api/festivals/"+id).then(res => {
                    this.showMessage = true;
                    this.message = res.data;
                    this.getFestivals();
                });
            }
        }
    };
</script>

<style lang="scss" scoped>

</style>
