@extends('layouts.master')
@section('title','Menu for '.$menu->name)

@section('content')
<div class="notification is-warning has-text-centered">
    Heads up! You are now in edit mode. Drag and drop the sections to re-arrange your menu.
  </div>
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
<div id="app">
  
  <edit-menu :menu_id='{{$menu->id}}'></edit-menu>
</div>

{{-- <div id="sortableMenu" class="container has-background-light nested-sortable">
    @foreach($menu->menuSections as $section)
        <div data-sortable-id="{{$section->id}}" data-sortable-type="section" class="menu-section mx-2 my-2 pb-5 has-background-info">
            <h3 id="section_{{$section->id}}" class="is-size-3 pb-5 px-3">{{$section->name}}</h3>
            <div class="nested-sortable menu-items px-2 py-2">
                @foreach($section->items as $item)
                <div data-sortable-id="{{$item->id}}" data-sortable-type="item" class="columns is-mobile menu-item is-vcentered has-background-white mx-0">
                  <div class="column is-four-fifths">
                    <strong>{{$item->name}}</strong><br>
                    {{$item->description}}
                  </div>
                  <div class="column is-one-fifth">
                    &euro;{{number_format($item->price,2)}}
                  </div>
                </div>
                @endforeach
            </div>
        </div>     
    @endforeach
  </div> --}}

@stop

