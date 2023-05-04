<template>
    <div class="col-md-12 mx-auto">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Emotions</h1>
        </div>
        <div class="card mx-auto" style="margin-bottom: 100px;">
            <div v-if="showMessage" class="alert alert-success">
                {{ message }}
            </div>
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <form action="">
                            <div class="row form-row">
                                <div class="col">
                                    <input type="search" v-model="search" name="search" id="inLineFormInput" class="form-control mb-2">
                                </div>
                                <div class="col">
                                    <div @click="getEmotions()" class="btn btn-primary mb-2" >Search</div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <router-link
                            :to="{name: 'EmotionsCreate'}"
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
                        <th scope="col">Url</th>
                        <th scope="col">Activity</th>
                        <th scope="col">Festival</th>
                        <th scope="col">Place</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="emotion in emotions" :key="emotion.id">
                        <th scope="row"> #{{ emotion.id }} </th>
                        <td> {{ emotion.img }} </td>
                        <td v-if="emotion.activity"> {{ emotion.activity.name }} </td>
                        <td v-else> None </td>
                        <td v-if="emotion.festival"> {{ emotion.festival.name }} </td>
                        <td v-else> None </td>
                        <td v-if="emotion.place"> {{ emotion.place.name }} </td>
                        <td v-else> None </td>
                        <td>
                            <router-link
                                :to="{name: 'EmotionsEdit', params: {id: emotion.id}}"
                                class="btn btn-primary float-right">
                                Edit
                            </router-link>
                        </td>
                        <td>
                            <button class="btn btn-danger" @click="deleteEmotion(emotion.id)" > Delete </button>
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
                emotions: [],
                showMessage: false,
                message: "",
                search: null,
            }
        },
        created() {
            this.getEmotions();
        },
        methods: {
            getEmotions() {
                axios.get("/api/emotions", { params :{
                    search: this.search,
                }})
                .then(res => {
                    this.emotions = res.data.data;
                    console.log(res);
                }).catch(error => {
                    console.log(console.error);
                });
            },

            deleteEmotion(id) {
                axios.delete("api/emotions/"+id).then(res => {
                    this.showMessage = true;
                    this.message = res.data;
                    this.getEmotions();
                });
            }
        }
    };
</script>

<style lang="scss" scoped>

</style>
