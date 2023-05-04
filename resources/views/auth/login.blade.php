@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-header" style="background-color: #5d69b3">
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <h2>Login</h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class=" col col-md-8 mx-auto " >
                            <!-- Email input -->
                            <div class="form-outline mt-4">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <label class="form-label" for="email">Email address</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                <label class="form-label" for="password">Password</label>
                            </div>

                            <!-- Submit button -->
                            <div class="row">
                                <button type="submit" class="btn btn-block mb-4 w-75 mx-auto" style="background-color: #5d69b3; color:rgb(255, 255, 255)" >Sign in</button>
                            </div>

                            <!-- Register buttons -->
                            <div class="text-center">
                              <p>Not a member? <a href="{{route('register.view')}}">Register</a></p>
                              <p>or continue with:</p>
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
