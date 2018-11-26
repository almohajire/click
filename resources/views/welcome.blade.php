@extends('layouts.app')
@section('content')

<div class="bgimg w3-display-container w3-animate-opacity w3-text-white">
  <div class="w3-display-topleft w3-padding-large w3-xlarge">
    @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}" style="text-decoration: none">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" style="text-decoration: none">Login</a>
                        <a href="{{ route('register') }}" style="text-decoration: none">Register</a>
                    @endauth
                </div>
            @endif
  </div>
  <div class="w3-display-middle">
    <h1 class="w3-jumbo w3-animate-top">COMING SOON</h1>
    <hr class="w3-border-grey" style="margin:auto;width:40%">
    <p class="w3-large w3-center">35 days left</p>
  </div>
  
</div>
@endsection