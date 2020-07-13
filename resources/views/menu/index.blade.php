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
  <div class="column is-one-quarter">
     <a href="/menu/32/edit" target="_blank" class="">
        <div class="card">
           <div class="card-image px-1 py-1">
              <figure class="is-square image"><img src="https://ithe.s3.eu-west-1.amazonaws.com/qrcodes/32x200.svg" alt="QR code formenu a"></figure>
           </div>
           <div class="card-content">
              <p class="title is-5">menu a</p>
            <a href="/menu/32/edit" class="button is-primary"></a>
            </div>
        </div>
      </a>
  </div>
  <div class="column is-one-quarter">
     <a href="/menu/33/edit" target="_blank" class="">
        <div class="card">
           <div class="card-image px-1 py-1">
              <figure class="is-square image">
                <img src="https://ithe.s3.eu-west-1.amazonaws.com/qrcodes/33x200.svg" alt="QR code formenu b">
              </figure>
           </div>
           <div class="card-content">
              <p class="title is-5">menu b</p>
     <a href="/menu/33/edit" class="button is-primary">wepfmwef</a></div></div></a>
  </div>
</div>
<div class="columns is-multiline">
    @foreach ($menus as $menu)
    <div class="column is-one-quarter">
        <a href="{{route('menu.show',$menu)}}">
            <div class="card">
                <div class="card-image px-1 py-1">
                <figure class="image is-square">
                    <img src="{{$menu->qrCodeURL()}}" alt="QR Code for {{$menu->establishment->name}}">
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