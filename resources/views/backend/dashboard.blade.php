@extends('layouts.app')

@section('content')

<div class="row h-100">
    <div class="col-auto px-0">
        <!-- Sidebar -->
        <div class="sidenav">

            <a href="/places">Places</a>
            <a href="/festivals">Festivals</a>
            <a href="/emotions">Emotions</a>
            <a href="/activities">Activities</a>
            <button class="dropdown-btn">Admin
              <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
              <a href="/users">Users</a>
              <a href="/clients">Clients</a>
              <a href="/bookings">Booking</a>
            </div>
        </div>
        <!-- End of Sidebar -->
    </div>
    <div class="col col-md-8 mx-auto px-0 mt-4 mb-6">
        <div id="vue_app">
            <router-view> </router-view>
        </div>
    </div>
</div>

@endsection
