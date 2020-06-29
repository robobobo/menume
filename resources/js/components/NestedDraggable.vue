<template>
  <draggable class="dragArea" 
    :list="menu" 
    :showMenuSections="showMenuSections" 
    :group="{name:'g1'}" 
    :class="{'menu_items': sectionType == 'menu_items'}"
    v-bind="dragOptions"
    @start="drag = true"
    @end="drag = false"
    :move="checkMove"
    handle=".drag-handle"
    >
    <transition-group type="transition" >

    <div v-for="section in menu" :key="section.id" class="menu-section mx-2 my-2 pb-5 has-background-info has-icons-left">
        
        <template v-if="section.type == 'menu_section'">
          <div class="columns px-3">
            <div class="column is-1 drag-handle">
                    <i class="fa fa-arrows-alt"></i>
            </div>
            <div class="columm is-8">
              <h3 class="is-size-3">{{section.name}}</h3>
            </div>
             <div class="column is-1 has-text-centered has-text-primary" @click="openEditModal(section)">
                    <i class="fa fa-edit"></i>
              </div>
              <div class="column is-1 has-text-centered has-text-danger">
                <i class="fa fa-trash"></i>
              </div>
          </div>
            <nested-draggable :showMenuSections="showMenuSections" :menu="section.menu_items" :open-edit-modal="openEditModal" :sectionType="'menu_items'" />
        </template>
        <template v-else>
            <div class="columns is-mobile menu-item is-vcentered has-background-white mx-0">
                <div class="drag-handle column is-1 has-text-centered">
                    <i class="fa fa-arrows-alt"></i>
                </div>
                <div class="column is-8">
                    <strong>{{section.name}}</strong><br>
                    {{section.description}}
                  </div>
                  <div class="column is-1">
                    &euro;{{section.price}}
                  </div>
                  <div class="column is-1 has-text-centered has-text-primary" @click="openEditModal(section)">
                    <i class="fa fa-edit"></i>
                  </div>
                  <div class="column is-1 has-text-centered has-text-danger">
                    <i class="fa fa-trash"></i>
                  </div>
            </div>
        </template>
    </div>
    </transition-group>
  </draggable>
</template>
<script>
import draggable from "vuedraggable";
export default {
  props: {
    menu: {
      type: Array
    },
    showMenuSections: {
        type: Boolean
    },
    sectionType: {
        type: String
    },
    openEditModal: {
        type: Function
    }
  },
  components: {
    draggable
  },
  name: "nested-draggable",
  computed: {
    dragOptions() {
        return {
            animation: 200,
            group: "description",
            disabled: false,
            ghostClass: "ghost"
        };
    }
},
methods: {
    checkMove: function(evt) {
        /* makes sure we are only dragging the correct elements to the correct areas 
            ie. menu items to menu item sections, menu sections to menu section sections
        */
        return (evt.draggedContext.element.type === evt.relatedContext.element.type);
    },
}
};
</script>
<style>
.flip-list-move {
  transition: transform 0.5s;
}
.no-move {
  transition: transform 0s;
}
.ghost {
  opacity: 0.5;
  background: #c8ebfb;
}
.drag-handle {
  /* float: left; */
  cursor: pointer;
}


h3 .drag-handle{
    font-size: 20px !important;
}
</style>