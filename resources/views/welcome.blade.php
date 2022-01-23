@extends('master-layout')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <router-link to="/customers" class="nav-link active">Home</router-link>
                    <router-link to="/customer/create" class="nav-link active">Create Customer</router-link>
                </div>
            </div>
        </div>
    </nav>

    <div class="ui container">
        <router-view></router-view>
    </div>
@endsection
