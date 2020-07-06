<template>
  <draggable
    class="dragArea"
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
    <transition-group type="transition">
      <div
        v-for="section in menu"
        :key="section.id"
        class="section menu-section mx-2 my-2 has-background-light has-icons-left"
      >
        <template v-if="section.type == 'menu_section'">
          <div class="columns is-mobile menu-header is-vcentered">
            <div class="column is-1 drag-handle py-1 has-text-centered">
              <b-icon pack="fa" icon="arrows-alt"></b-icon>
            </div>
            <div class="column is-8 py-1">
              <h3 class="is-size-3">{{section.name}}</h3>
            </div>
            <div
              class="column is-1 has-text-centered has-text-primary py-1 cursor-pointer"
              @click="openEditModal(section)"
            >
              <b-icon pack="fa" icon="edit"></b-icon>
            </div>
            <div
              class="column is-1 has-text-centered has-text-danger py-1"
              @click="deleteSection(section)"
            >
              <b-icon pack="fa" icon="trash"></b-icon>
            </div>
            <div
              class="column is-1 has-text-centered py-1 cursor-pointer"
              @click="addNewItem(section)"
            >
              <b-icon pack="fa" icon="plus"></b-icon>
            </div>
          </div>

          <nested-draggable
            :showMenuSections="showMenuSections"
            :menu="section.menu_items"
            :open-edit-modal="openEditModal"
            :remove-item="removeItem"
            :sectionType="'menu_items'"
          />
        </template>
        <template v-else>
          <div class="columns is-mobile menu-item is-vcentered has-background-white mx-0">
            <div class="drag-handle column is-1 has-text-centered">
              <b-icon pack="fa" icon="arrows-alt"></b-icon>
            </div>
            <div class="column is-8">
              <strong>{{section.name}}</strong>
              <br />
              {{section.description}}
            </div>
            <div class="column is-1">&euro;{{section.price}}</div>
            <div
              class="column is-1 has-text-centered has-text-primary cursor-pointer"
              @click="openEditModal(section)"
            >
              <b-icon pack="fa" icon="edit"></b-icon>
            </div>
            <div
              class="column is-1 has-text-centered has-text-danger cursor-pointer"
              @click="deleteItem(section)"
            >
              <b-icon pack="fa" icon="trash"></b-icon>
            </div>
          </div>
        </template>
      </div>
      <!-- needs a key for animation effects -->
      <div
        class="section menu-section mx-2 my-2 drop-zone"
        :key="Math.floor(Math.random() * (99999 - 88888 + 1)) + 88888" 
        v-if="menu.length < 1"
      >
        <div class="columns is-mobile menu-item is-vcentered has-text-centered mx-0">
          <div class="column">
            <h1 class="has-text-centered">Drag a menu item here</h1>
          </div>
        </div>
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
    removeSection: {
      type: Function
    },
    addNewItem: {
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
      // if we are dragging to a drop zone we assume that's allowed...
      if (evt.related.className.includes("drop-zone") && evt.draggedContext.element.type == 'menu_item') {
        return true;
      } else if (
        evt.draggedContext.element.type === evt.relatedContext.element.type
      ) {
        return true;
      }
      return false;
    },
    deleteItem: function(section) {
      this.$buefy.dialog.confirm({
        title: "Deleting Item",
        message:
          "Are you sure you want to <b>delete</b> this item? This action cannot be undone.",
        confirmText: "Delete Item",
        type: "is-danger",
        hasIcon: true,
        onConfirm: () =>
          axios
            .delete("/api/v1/menu-item/" + section.id)
            .then(response => {
              console.log("item deleted");
              this.removeItem(section);
              this.$buefy.toast.open("Item was deleted!");
            })
            .catch(error => {
              console.log(error);
            })
      });
    },
    deleteSection: function(section) {
      this.$buefy.dialog.confirm({
        title: "Deleting Section",
        message:
          "Are you sure you want to <b>delete</b> this entire section? This will also delete all the items in this section as well. This action <b>cannot</b> be undone.",
        confirmText: "Delete Item",
        type: "is-danger",
        hasIcon: true,
        onConfirm: () => {
          axios
            .delete("/api/v1/menu-section/" + section.id)
            .then(response => {
              console.log("section deleted");
              this.removeSection(section);
              this.$buefy.toast.open("Section was deleted!");
            })
            .catch(error => {
              console.log(error);
            });
        }
      });
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
.drop-zone{
  border:2px dashed #000;
  background:rgba(255, 255, 255, 0.68)
}

h3 .drag-handle {
  font-size: 20px !important;
}
</style>