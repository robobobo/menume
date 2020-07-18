@extends('layouts.master')

@section('title','Menus for '.$establishment->name)

@section('content')
<section class="section">
<h1 class="is-size-1 has-text-centered">{{$establishment->name}}</h1>
<h3 class="is-size-3 has-text-centered">Choose the menu you'd like to see</h3>
<div class="columns">
    <div class="column is-half is-offset-one-quarter">
        @foreach ($establishment->menus as $menu)
        <a href="{{route('menu.show',$menu)}}">
            <div class="card has-background-primary mb-3">
                <div class="card-content">
                    <div class="is-size-3 has-text-white">{{$menu->name}}</div>
                </div>
            </div>
        </a>
        @endforeach

    </div>
</div>
</section>
@stop