@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-2">
                <div class="card-header">{{ __('Welcome') }} </div>

                <div class="card-body">
                    @isset($message)
                        <div class="alert alert-success" role="alert">
                            {{ $message }}
                        </div>
                    @endisset

                    {{ __('You are logged in!') }}
                </div>
            </div>
            <a href="{{ route('dashboard') }}">
                <div class="row m-0">
                    <div class="btn btn-block mb-4 w-75 mx-auto mt-4" style="background-color: #5d69b3;">

                            <button type="button" class="btn" style= "color:rgb(255, 255, 255)" >
                                Dashboard
                            </button>

                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
