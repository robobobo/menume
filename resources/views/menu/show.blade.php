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
  <div class="container has-background-light">
    <ul class="horizontal-menu-nav" id="menu-horizontal-nav">
      @foreach($menu->menuSections as $section)
        <li class="px-2 py-3"><a data-sticky-nav__item href="#section_{{$section->id}}">{{$section->name}}</a></li>
      @endforeach
    </ul>
    @foreach($menu->menuSections as $section)
      <h3 id="section_{{$section->id}}" class="is-size-3 pb-5 px-3 anchor-header" data-sticky-nav__content-area>{{$section->name}}</h3>
      @foreach($section->items as $item)
      <div class="columns is-mobile menu-item is-vcentered has-background-white mx-0">
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

@stop

<script type="text/javascript">

document.addEventListener("DOMContentLoaded", function(event) {
   let mainNav = document.getElementById("menu-horizontal-nav");
   let mainNavLinks = document.querySelectorAll("[data-sticky-nav__item");
   let mainSections = document.querySelectorAll("[data-sticky-nav__content-area]");

   for(const navLink of mainNavLinks) {
      navLink.addEventListener("click", function(event){
          //scrolls the nav bar to be in the right place
          mainNav.scrollLeft += (navLink.getBoundingClientRect().left - 20);     
      });
   }
   
   let lastId;
   let cur = [];
   
   // Options to be passed to the observer
   const options = {
     root: document.getElementById('body'), // The "box" we are going to observe, the scroll area
     rootMargin: '0% 0% -80% 0%', // We can modify the margins to only watch some area, in this case: 20% of the top of the box 
     threshold: 0
   }
   // The observer
   const observer = new IntersectionObserver((entries, observer) => {
     
     // Entries are all the items observed which have entered to the scroll area
     entries.forEach(entry => {
       // We only want the ones intersecting wuth our threshold
       if (entry.isIntersecting) {
         // Some magic to map to the link
         let link = document.querySelector('[href="#'+entry.target.id+'"]');
         if (link) {
           // Remove current class from all links
           mainNavLinks.forEach(item => {
             item.classList.remove("active");
           });
           // Add current to new target
           link.classList.add("active");              
         }
       }
     })  
   }, options);
   
   // foreach section we send to the observer
   mainSections.forEach(target => {
     observer.observe(target);  
   });
});


</script>