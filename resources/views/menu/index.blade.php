@extends('layouts.master')
@section('title','All Menus')

<section class="hero is-primary mb-2">
    <div class="hero-body">
      <div class="container">
        <h1 class="title">
          Here's a collection of menus
        </h1>
        <h2 class="subtitle">
          Scan a QR code to be amazed!
        </h2>
      </div>
    </div>
  </section>
@section('content')
<div class="columns is-multiline">
    @foreach ($menus as $menu)
    <div class="column is-one-quarter">
        <a href="{{route('menu.show',$menu)}}">
            <div class="card">
                <div class="card-image px-1 py-1">
                <figure class="image is-square">
                  {{ QrCode::size(200)->generate(route('menu.show',$menu),"../public/qrcodes/code_{$menu->id}.svg") }}
                    <img src="/qrcodes/code_{{$menu->id}}.svg" alt="QR Code for {{$menu->establishment->name}}">
                </figure>
                </div>
                <div class="card-content">
                        <p class="title is-5">{{$menu->establishment->name}}</p>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>
@stop