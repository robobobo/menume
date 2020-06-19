@extends('layouts.master')
@section('title','Menu for '.$menu->name)
<section class="hero is-dark mb-2">
    <div class="hero-body">
      <div class="container">
        <h2 class="title">
            Showing menu for {{$menu->establishment->name}}
        </h2>
        <h3>
            {{$menu->name}}
        </h3>
      </div>
    </div>
  </section>
@section('content')
    @foreach ($menu->menuItems as $item)
        {{$item->name}}<br>
        {{$item->description}}<br>
        &euro;{{$item->price}}<hr>
    @endforeach
@stop