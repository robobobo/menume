<template>
  <div class="container">
    <div class="field is-grouped pb-2">
      <p class="control">
        <button
          class="button is-success"
          :class="{'is-loading': isSaving}"
          :disabled=isSaving
          v-on:click="updateMenuData()"
        >Save changes</button>
      </p>
      <p class="control">
        <button class="button" v-on:click="toggleMenuSections()">
          <span v-if="showMenuSections">Hide Menu Items</span>
          <span v-else>Show Menu Items</span>
        </button>
      </p>
      <!-- <p class="control">
        <button class="button is-danger">Cancel</button>
      </p> -->
      <p class="control">
        <button class="button is-primary" v-on:click="addNewItem()">Add New Item</button>
      </p>
       <p class="control">
        <button class="button is-primary" v-on:click="addNewSection()">Add New Section</button>
      </p>
      <p class="control">
        <a :href="'/menu/'+menu_id" target="_blank" class="button is-secondary"><span>View Menu</span> <b-icon
                pack="fa"
                icon="external-link-alt"
                size="is-small">
            </b-icon>
            </a>
      </p>
    </div>
    <div id="menuEditor" :class="{'hide-menu-items' : !showMenuSections}">
      <b-modal
        :active.sync="isAddNewItemModalVisible"
        has-modal-card
        trap-focus
        :destroy-on-hide="true"
        animation="slide-fade"
        aria-role="dialog"
        aria-modal
      >
        <new-item-form
          @close="closeEditModal"
          @addNewItem="updateMenu"
          :menu="menu"
          :menu-details="menuDetails"
          :current-section="currentSection"
        ></new-item-form>
      </b-modal>
      <b-modal
        :active.sync="isAddNewSectionModalVisible"
        has-modal-card
        trap-focus
        :destroy-on-hide="true"
        animation="slide-fade"
        aria-role="dialog"
        aria-modal
      >
        <new-section-form
          @close="closeEditModal"
          @addNewItem="updateMenu"
          :menu="menuDetails"
        ></new-section-form>
      </b-modal>
      <b-modal
        :active.sync="isEditItemModalVisible"
        has-modal-card
        trap-focus
        :destroy-on-hide="false"
        animation="slide-fade"
        aria-role="dialog"
        aria-modal
      >
        <edit-item-form @close="closeEditModal" @cancel="cancelEditModal" :section="modalData"></edit-item-form>
      </b-modal>
       <div v-if="menu.length < 1 " class="notification is-info">
          Add a menu section to get started
                  <button class="button is-primary" v-on:click="addNewSection()">Add New Section</button>

      </div>
      <nested-draggable
        :menu="menu"
        :open-edit-modal="openEditItemModal"
        :remove-item="removeItem"
        :remove-section="removeSection"
        :add-new-item="addNewItem"
        :v-if="menuLoaded"
      />
       
    </div>
      <b-loading :is-full-page="true" :active.sync="isLoading" :can-cancel="false"></b-loading>

  </div>
</template>

<script>
import nestedDraggable from "./NestedDraggable";

export default {
  components: {
    nestedDraggable
  },
  props: ["menu_id"],
  name: "edit-menu",
  data: function() {
    return {
      menu: [],
      menuDetails: [],
      sortableMenu: null,
      menuItemsSerialized: [],
      menuSectionsSerialized: [],
      showMenuSections: true,
      menuLoaded: false,
      isModalVisible: false,
      isSaving: false,
      isLoading: true,
      modalData: null,
      modalDataClone: null, //used if we need to revert changes
      isAddNewItemModalVisible: false,
      isAddNewSectionModalVisible: false,
      isEditItemModalVisible: false,
      currentSection: [], //use for deterimining which section we are adding an item to
      isComponentModalActive: false
    };
  },
  computed: {
    menuSections() {
      let sections = [];
      let position = 1;
      this.menu.forEach(element => {
        sections.push({
          id: element.id,
          name: element.name,
          position: position
        });
        position++;
      });
      return sections;
    },
    menuItems() {
      let items = [];
      this.menu.forEach(section => {
        for (var i in section.menu_items) {
          if (section.menu_items[i].type == "menu_item") {
            items.push({
              id: section.menu_items[i].id,
              position: parseInt(i) + 1,
              menu_section_id: section.id,
              name: section.menu_items[i].name,
              description: section.menu_items[i].description,
              price: section.menu_items[i].price
            });
          }
        }
      });
      return items;
    }
  },
  mounted: function() {
    this.loadMenu(this.menu_id);
  },

  methods: {
    loadMenu: function(id) {
      axios
        .get("/api/v1/menu/" + id)
        .then(response => {
          /*draggable needs an array to be passed to it*/
          this.menu = response.data.data.menu_sections;
          this.menuDetails = {
            establishment_id: response.data.data.establishment_id,
            establishment_name: response.data.data.establishment_name,
            menu_id: response.data.data.id,
            name: response.data.data.name
          };
        })
        .catch(error => {
          console.log(error);
        })
        .finally(() => {
          this.menuLoaded = true;
          this.isLoading = false;
          });
    },
    updateMenuData: function() {
      this.isSaving = true;
      this.isLoading = true;
      this.updateSectionOrder(this.menuSections).then(
        response => {
          console.log("response", response);
          this.updateMenuItemOrder(this.menuItems).then(
            response => {
              console.log("response 2", response);
              this.$buefy.toast.open({
                message: "Your menu has been updated!",
                type: "is-success"
              });
              this.isSaving = false;
              this.isLoading = false;
            },
            error => {
              console.log("error 2", error);
              this.$buefy.toast.open({
                message: "There was a problem updating your menu :(",
                type: "is-warning"
              });
              this.isSaving = false;
              this.isLoading = false;
            }
          );
        },
        error => {
          console.log("error", error);
        }
      );
    },
    updateSectionOrder: function(menuSections) {
      var updatePromise = new Promise(function(resolve, reject) {
        axios
          .post("/api/v1/menu-sections", {
            sections: menuSections
          })
          .then(function(response) {
            resolve(response);
            // console.log(response);
          })
          .catch(function(error) {
            // console.log(error);
            reject(error);
          });
      });
      return updatePromise;
    },
    updateMenuItemOrder: function(menuItems) {
      // console.log(menuItems);
      var updatePromise = new Promise(function(resolve, reject) {
        axios
          .post("/api/v1/menu-items", {
            items: menuItems
          })
          .then(response => {
            resolve(response);
          })
          .catch(error => {
            reject(error);
          });
      });
      return updatePromise;
    },

    updateMenu: function(item) {
      console.log("add this to the menu", item);
      if(item.type == 'menu_section')
      {
        this.menu.unshift(item);
      }else{
        /*this gives us the index of the menu section so we know where to add it*/
        let index = this.menu.findIndex(x => x.id == item.menu_section_id);
        item.type = "menu_item";
        /*add it to the beginning of the list so we can see it!*/
        this.menu[index].menu_items.unshift(item);
      }
    },

    toggleMenuSections: function() {
      if (this.showMenuSections) {
        this.showMenuSections = false;
      } else {
        this.showMenuSections = true;
      }
    },
    showModal(el) {
      this.modalData = el;
      /*clone it in the event we need to revert on cancel*/
      this.modalDataClone = Object.assign({}, el);
      this.isModalVisible = true;
    },
    // closeModal() {
    //     this.isModalVisible = false;
    // },
    addNewItem(section) {
      // console.log(section);
      this.currentSection = section;
      // this.$refs.newItemModal.setSectionId(section);
      this.isAddNewItemModalVisible = true;
    },
    addNewSection() {
      this.isAddNewSectionModalVisible = true;
    },
    openEditItemModal(section) {
      this.modalData = section;
      /*clone it in the event we need to revert on cancel*/
      this.modalDataClone = Object.assign({}, section);
      this.isEditItemModalVisible = true;
    },
    openAddNewItemModal() {
      this.$buefy.modal.open({
        parent: this,
        component: newItemForm
      });
    },
    removeItem(item) {
      console.log("remove the item", item);
      /*find the section index*/
      let index = this.menu.findIndex(x => x.id == item.menu_section_id);
      /*now find the index of the menu item*/
      let menuIndex = this.menu[index].menu_items.findIndex(
        y => y.id == item.id
      );
      /*and now lets remove it from the array*/
      if(index > -1){
        this.menu[index].menu_items.splice(menuIndex, 1);
      }
    },
    removeSection(section)
    {
      console.log("remove section", section);
      let index = this.menu.findIndex(x => x.id == section.id);
      if(index > -1){
        this.menu.splice(index,1);
      }
    },
    cancelEditModal() {
      // revert back to the original cloned data
      this.isEditItemModalVisible = false;
      this.modalData.name = this.modalDataClone.name;
      this.modalData.description = this.modalDataClone.description;
      this.modalData.price = this.modalDataClone.price;
    },
    closeEditModal() {
      this.isAddNewItemModalVisible = false;
      this.isEditItemModalVisible = false;
      this.isAddNewSectionModalVisible = false;
    }
  }
};
</script>