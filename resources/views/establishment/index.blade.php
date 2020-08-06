@extends('layouts.master')

@section('title','Establishment Menus')

@section('content')
<section class="section">
<h1 class="is-size-1 has-text-centered">All Establishments</h1>
<h3 class="is-size-3 has-text-centered">Choose an establishment to see their menus or scan the QR code</h3>
<div class="columns">
    <div class="column is-half is-offset-one-quarter">
        @foreach ($establishments as $establishment)
        <a href="{{route('establishment.show',$establishment)}}">
            <div class="card has-background-primary mb-3">
                <div class="card-content">
                    <div class="is-size-3 has-text-white has-text-centered">
                        <img src="{!!$establishment->qrCodeURL()!!}" alt="">
                        <hr>
                        {{$establishment->name}}
                    </div>
                </div>
            </div>
        </a>
        @endforeach

    </div>
</div>
</section>
@stop