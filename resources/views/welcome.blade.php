@extends('components.template')

@section('title', 'Welcome')

@section('content')
    <div class="text-center">
        <h1>Welcome to the best scrap page ever</h1>
        <p>This project is for you practice more about SOLID skills with Laravel and learn about a lot</p>
    </div>

    <div class="card border-primary">
        <div class="card-body ">
            <div class="row">
                <div class="col-6" style="border-right: 2px solid #333;">
                    <h2>Project Specs</h2>
                    <ol>
                        <li>User can login with many providers as possible (Github, Twitch, Spotify, Google etc)</li>
                        <li>User can send a global message or to a specific person that not necessarily needs to be registered yet</li>
                        <li>Messages have to emphasis in global/private on the front-end with a timeline.</li>
                    </ol>
                </div>
                <div class="col-6" >
                    <h2>Expected results</h2>
                    <ol>
                        <li>Apply the <a href="https://github.com/danielhe4rt/solid4noobs">SOLID principles</a> into the back-end code (and the front-end with you want).</li>
                        <li>User can send a global message or to a specific person that not necessarily needs to be registered yet</li>
                        <li>Messages have to emphasis in global/private on the front-end with a timeline.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div><br>

    <hr>
    <h2 class="text-center">Random Intel</h2>
    <div class="row justify-content-center">
        <div class="col-6 text-center mt-4 mb-5">
            <div class="row">
                <div class="col-6">
                    <h3> <i class="fas fa-users"></i> Users registered</h3>
                    <span class="badge bg-primary text-center">10</span>
                </div>
                <div class="col-6">
                    <h3> <i class="fas fa-envelope"></i>Messages sent</h3>
                    <span class="badge bg-primary text-center">10</span>
                </div>
            </div>
        </div>
    </div>
    <div style="border: 1px solid" class="border-primary mb-5"></div>

    <h3 class="text-center mb-3">Last users</h3>
    <div class="row">
        @foreach(range(0, 3) as $idk)
        <div class="col-3">
            <p class="text-center">
                <img class="img-thumbnail" width="150" src="https://placehold.it/300x300" alt=""> <br>
                danielhe4rt <br>
                <i class="fab fa-twitch"></i>
                <i class="fab fa-github"></i>
            </p>
        </div>
        @endforeach
    </div>
@endsection
