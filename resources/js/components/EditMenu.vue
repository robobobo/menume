<template>
          <div class="container">
              <notifications position="top left" />
            <div class="field is-grouped pb-2">
                <p class="control">
                <button class="button is-success" v-on:click="updateMenuData()">
                    Save changes
                </button>
                </p>
                <p class="control">
                <button class="button" v-on:click="toggleMenuSections()"><span v-if="showMenuSections">Hide Menu Items</span><span v-else>Show Menu Items </span></button>
                </p>
                <p class="control">
                <button class="button is-danger">
                    Cancel
                </button>
                </p>
                <p class="control">
                <button class="button is-primary" v-on:click="addNewItem()">
                    Add New Item
                </button>
                </p>
            </div>
            <transition name="slide-fade">
            <div class="notification is-success" v-show="updateSuccess">
                <button class="delete"></button>
                Your menu has been updated successfully! 
            </div>
            </transition>
                <div id="menuEditor" :class="{'hide-menu-items' : !showMenuSections}">
                    <new-item-modal ref="newItemModal" v-show="isAddNewItemModalVisible" v-if="menuLoaded" @close="closeEditModal" @addNewItem="updateMenu" :menu="menu" :menu-details="menuDetails" :current-section="currentSection" :modal-open="isAddNewItemModalVisible"/>
                     <modal-editor v-show="isModalVisible" @close="closeModal" @cancel="cancelModal" :section="modalData"/>
                    <nested-draggable :menu="menu" :open-edit-modal="showModal" :remove-item="removeItem" :add-new-item="addNewItem" :v-if="menuLoaded"/>
                </div>
          </div>
</template>

<script>
// import draggable from 'vuedraggable'
import nestedDraggable from "./NestedDraggable";
import modalEditor from './ModalEditor';


export default {
    components: {
            nestedDraggable,
            modalEditor,
    },
    props: ['menu_id'],
    name: "edit-menu",
    data: function() {
        return {
            menu: [],
            menuDetails: [],
            sortableMenu: null,
            // menuItems: [],
            // menuSerialized: [],
            menuItemsSerialized: [],
            menuSectionsSerialized: [],
            showMenuSections: true,
            menuLoaded: false,
            isModalVisible: false,
            modalData: null,
            modalDataClone: null,//used if we need to revert changes
            updateSuccess: false,
            isAddNewItemModalVisible: false,
            currentSection: [],//use for deterimining which section we are adding an item to
        }
    },
    computed: {
        menuSections() {
            let sections = [];
            let position = 1;
            this.menu.forEach(element => {
                sections.push({
                    'id' : element.id,
                    'name' : element.name,
                    'position' : position,
                });
                position++;
            });
            return sections;
        },
        menuItems() {
            let items = [];
            this.menu.forEach(section => {
                 for(var i in section.menu_items) {
                    if(section.menu_items[i].type == 'menu_item') {
                        items.push({
                            id: section.menu_items[i].id,
                            position:parseInt(i)+1,
                            menu_section_id:section.id,
                            name: section.menu_items[i].name,
                            description: section.menu_items[i].description,
                            price: section.menu_items[i].price,
                        });
                    }
                }
            });
            return items;
        }
    },
    mounted: function() {
        // this.sortableMenu = document.getElementById('sortableMenu');
        // this.menuSerialized = this.serializeMenu(sortableMenu);
        // this.serializeMenuSectionsAndItems();
        this.loadMenu(this.menu_id);
    },

    methods: {
        loadMenu: function(id) {
            axios.get('/api/v1/menu/'+id)
             .then( response => {
                /*draggable needs an array to be passed to it*/
                 this.menu = response.data.data.menu_sections;
                 this.menuDetails = {
                     'establishment_id' : response.data.data.establishment_id,
                     'establishment_name' : response.data.data.establishment_name,
                     'menu_id' : response.data.data.id,
                     'name' : response.data.data.name,
                 }
             })
            .catch( error => {
                 console.log(error);
             })
             .finally( () => this.menuLoaded = true);
         },
        updateMenuData: function() {
            this.updateSectionOrder(this.menuSections);
            this.updateMenuItemOrder(this.menuItems);
            this.updateSuccess = true;
            setTimeout(() => this.updateSuccess = false, 2000);

        },
        updateSectionOrder: function(menuSections) {
            console.log("update section order");
            axios.post('/api/v1/menu-sections',{
                "sections": menuSections
            })
            .then(function(response){
                console.log(response);
            })
            .catch(function(error){
                console.log(error);
            });
        },
        updateMenuItemOrder: function (menuItems) {
            console.log(menuItems);
            axios.post('/api/v1/menu-items',{
                "items": menuItems 
            })

        },

        updateMenu: function(item)
        {
            console.log("add this to the menu",item);
            /*this gives us the index of the menu section so we know where to add it*/
            let index = this.menu.findIndex(x => x.id == item.menu_section_id)
            item.type="menu_item";
            /*add it to the beginning of the list so we can see it!*/
            this.menu[index].menu_items.unshift(item);
            console.log(index);
        },

        toggleMenuSections: function() {
             if(this.showMenuSections){
                 this.showMenuSections = false;
             }else{
                 this.showMenuSections = true;
             }
        },
         showModal(el) {
            this.modalData = el;
            /*clone it in the event we need to revert on cancel*/
            this.modalDataClone = Object.assign({},el);
            this.isModalVisible = true;
        },
        closeModal() {
            this.isModalVisible = false;
        },
        addNewItem(section) {
            // console.log(section);
            this.currentSection = section;
            this.$refs.newItemModal.setSectionId(section);
            this.isAddNewItemModalVisible = true;
        },
        openAddNewItemModal()
        {

        },
        removeItem(item) {
            console.log("remove the item",item)
            /*find the section index*/
            let index = this.menu.findIndex(x => x.id == item.menu_section_id)
            /*now find the index of the menu item*/
            let menuIndex = this.menu[index].menu_items.findIndex(y => y.id == item.id)
            /*and now lets remove it from the array*/
            this.menu[index].menu_items.splice(menuIndex,1);

        },
        cancelModal(){
            // revert back to the original cloned data
            this.modalData.name = this.modalDataClone.name;
            this.modalData.description = this.modalDataClone.description
            this.modalData.price = this.modalDataClone.price
            this.isModalVisible = false;
        },
        closeEditModal() {
            this.isAddNewItemModalVisible = false;
        }
    }
}
</script>