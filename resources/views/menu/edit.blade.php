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
<script src="https://sortablejs.github.io/Sortable/Sortable.js"></script>
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function(event) {

var nestedSortables = [].slice.call(document.querySelectorAll('.nested-sortable'));

// Loop through each nested sortable element
for (var i = 0; i < nestedSortables.length; i++) {
    new Sortable(nestedSortables[i], {
		group: 'nested',
		animation: 150,
		fallbackOnBody: true,
		swapThreshold: 0.65,
        dataIdAttr: 'data-id',
        // onEnd: function (/**Event*/evt) {
        //     var itemEl = evt.item;  // dragged HTMLElement
        //     evt.to;    // target list
        //     evt.from;  // previous list
        //     evt.oldIndex;  // element's old index within old parent
        //     evt.newIndex;  // element's new index within new parent
        //     evt.oldDraggableIndex; // element's old index within old parent, only counting draggable elements
        //     evt.newDraggableIndex; // element's new index within new parent, only counting draggable elements
        //     evt.clone // the clone element
        //     evt.pullMode;  // when item is in another sortable: `"clone"` if cloning, `true` if moving
        //     // console.log(evt);
        // },
        // store: {
        //     set: function (sortable) {
        //         // console.log(sortable.toArray())
        //         console.log(serialize(root))
        //     }
        // }
	});
}



const nestedQuery = '.nested-sortable';
const identifier = 'sortableId';
const root = document.getElementById('sortableMenu');
function serialize(sortable) {
  var serialized = [];
  var children = [].slice.call(sortable.children);
  for (var i in children) {
    var nested = children[i].querySelector(nestedQuery);
    serialized.push({
      id: children[i].dataset[identifier],
      type : children[i].dataset['sortableType'],
      children: nested ? serialize(nested) : []
    });
  }
  return serialized
}
// console.log(serialize(root))

});


</script>