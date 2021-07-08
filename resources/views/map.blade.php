@extends('layouts.app')
@section('content')
    <router-view></router-view>
    <div class="geocoder">
        <div id="geocoder"></div>
    </div>
    <div id="instructions">
        <div id="calculated-line"></div>
    </div>
@endsection
