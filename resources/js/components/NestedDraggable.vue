<template>
  <draggable class="dragArea" :list="menu" :group="{name:'g1'}">
    <div v-for="section in menu" :key="section.id" class="menu-section mx-2 my-2 pb-5 has-background-info">
        <template v-if="section.type == 'menu_section'">
            <h3 class="is-size-3 pb-5 px-3">{{ section.name }}</h3>
            <nested-draggable :menu="section.menu_items" />
        </template>
        <template v-else>
            <div class="columns is-mobile menu-item is-vcentered has-background-white mx-0">
                <div class="column is-four-fifths">
                    <strong>{{section.name}}</strong><br>
                    {{section.description}}
                  </div>
                  <div class="column is-one-fifth">
                    &euro;{{section.price}}
                  </div>
            </div>
        </template>
    </div>
  </draggable>
</template>
<script>
import draggable from "vuedraggable";
export default {
  props: {
    menu: {
      type: Array
    },
  },
  components: {
    draggable
  },
  name: "nested-draggable"
};
</script>
