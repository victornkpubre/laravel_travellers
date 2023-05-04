<template>
    <div class="col-md-12 mx-auto">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Bookings</h1>
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
                                    <div @click="getBookings()" class="btn btn-primary mb-2" >Search</div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <router-link
                            :to="{name: 'BookingsCreate'}"
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
                        <th scope="col">Booking Date</th>
                        <th scope="col">Client Name</th>
                        <th scope="col">Activities</th>
                        <th scope="col">Festivals</th>
                        <th scope="col">Places</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="booking in bookings" :key="booking.id">
                        <th scope="row"> #{{ booking.id }} </th>
                        <td> {{ format_date(booking.date_created)}} </td>
                        <td> {{ booking.client.first_name+" "+booking.client.last_name }} </td>
                        <td> {{ booking.activities.length }} </td>
                        <td> {{ booking.festivals.length }} </td>
                        <td> {{ booking.places.length }} </td>
                        <td>
                            <router-link
                                :to="{name: 'BookingsEdit', params: {id: booking.id}}"
                                class="btn btn-primary float-right">
                                Edit
                            </router-link>
                        </td>
                        <td>
                            <button class="btn btn-danger" @click="deleteBooking(booking.id)" > Delete </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from "moment";
    export default {
        data() {
            return {
                bookings: [],
                showMessage: false,
                message: "",
                search: null,
            }
        },
        created() {
            this.getBookings();
        },
        methods: {
            getBookings() {
                axios.get("/api/bookings", { params :{
                    search: this.search,
                }})
                .then(res => {
                    this.bookings = res.data.data;
                    console.log(res);
                }).catch(error => {
                    console.log(console.error);
                });
            },

            deleteBooking(id) {
                axios.delete("api/bookings/"+id).then(res => {
                    this.showMessage = true;
                    this.message = res.data;
                    this.getBookings();
                });
            },

            format_date(value){
                if(value) {
                    // moment().month(number).format("MMM");
                    return moment(String(value)).format("d-MMM-Y");
                }
            }
        }
    };
</script>

<style lang="scss" scoped>

</style>
