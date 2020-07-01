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

    <div v-for="section in menu" :key="section.id" class="section menu-section mx-2 my-2 has-background-light has-icons-left">
        
        <template v-if="section.type == 'menu_section'">
          <div class="columns is-mobile menu-header is-vcentered">
            <div class="column is-1 drag-handle py-1 has-text-centered">
                    <i class="fa fa-arrows-alt"></i>
            </div>
            <div class="column is-8 py-1">
              <h3 class="is-size-3">{{section.name}}</h3>
            </div>
             <div class="column is-1 has-text-centered has-text-primary py-1" @click="openEditModal(section)">
                    <i class="fa fa-edit"></i>
              </div>
              <div class="column is-1 has-text-centered has-text-danger py-1">
                <i class="fa fa-trash"></i>
              </div>
          </div>
            <nested-draggable :showMenuSections="showMenuSections" :menu="section.menu_items" :open-edit-modal="openEditModal" :remove-item="removeItem" :sectionType="'menu_items'" />
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
                  <div class="column is-1 has-text-centered has-text-danger" @click="deleteItem(section)">
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
    },
    removeItem: {
      type: Function
    },
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
      console.log("checking move",evt.draggedContext.element.type,evt.relatedContext.element.type);
        /* makes sure we are only dragging the correct elements to the correct areas 
            ie. menu items to menu item sections, menu sections to menu section sections
        */
        return (evt.draggedContext.element.type === evt.relatedContext.element.type);
    },
    deleteItem: function(section) {
      if(confirm("Are you sure you want to delete this?")){
        console.log("delete",section);
        axios.delete("/api/v1/menu-item/"+section.id)
        .then(response =>{
          console.log("item deleted");
          this.removeItem(section);
          Vue.notify({
            title: 'Deleted!',
            text: 'The menu item was deleted!'
          })
        })
        .catch(error =>{
          console.log(error);
        });

      }
    }
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