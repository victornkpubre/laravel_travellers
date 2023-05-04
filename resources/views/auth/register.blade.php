@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-4">
                    <div class="card-header" style="background-color: #5d69b3"> <h2>Register</h2> </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class=" col col-md-8 mx-auto " >
                                <!-- Name input -->
                                <div class="form-outline mt-4">
                                    <label class="form-label" for="name">Username</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <!-- Email input -->
                                <div class="form-outline">
                                    <label class="form-label" for="email">Email Address</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <!-- Phone input -->
                                <div class="form-outline">
                                    <label class="form-label" for="phone">Phone #</label>
                                    <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>

                                <!-- Password input -->
                                <div class="form-outline">
                                    <label class="form-label" for="password">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="current-password">

                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>

                                <!-- Submit button -->
                                <div class="row mt-4">
                                    <button type="submit"  class="btn btn-block mb-4 w-75 mx-auto" style="background-color: #5d69b3; color:rgb(255, 255, 255)">Register</button>
                                </div>

                                <!-- Register buttons -->
                                <div class="text-center">
                                <p>Not a member? <a href="{{route('login.view')}}">Login</a></p>
                                <p>or sign up with:</p>
                                <div class="w-full ml-4 mr-4">

                                </div>
                                </div>
                                <a href="{{route('login.google')}}">
                                    <div class="row">
                                        <div class="btn btn-block mb-4 w-75 mx-auto" style="background-color: #5d69b3;">

                                                <button type="button" class="btn" style= "color:rgb(255, 255, 255)" >
                                                    Google
                                                </button>

                                        </div>
                                    </div>
                                </a>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
