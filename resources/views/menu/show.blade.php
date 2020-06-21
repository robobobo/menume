@extends('layouts.master')
@section('title','Menu for '.$menu->name)

@section('content')

<section class="section py-1 has-background-dark">
  <div class="container has-text-centered">
    <h3 class="title py-1 has-text-light">{{$menu->establishment->name}}</h3>
  </div>
</section>
<section class="section py-4">
  <div class="container">
    <h5 class="subtitle has-text-centered is-italic">{{$menu->name}}</h5>
  </div>
</section>

<section class="section py-4 has-background-light">
  <div class="container">
    @foreach($menu->menuSections as $section)
      <h3 class="is-size-3 pb-5">{{$section->name}}</h3>
      @foreach($section->items as $item)
      <div class="columns is-mobile menu-item is-vcentered has-background-white">
        <div class="column is-four-fifths">
          <strong>{{$item->name}}</strong><br>
          {{$item->description}}
        </div>
        <div class="column is-one-fifth">
          &euro;{{number_format($item->price,2)}}
        </div>
      </div>
      @endforeach
    @endforeach
  </div>
</section>
@stop