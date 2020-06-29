<template>
          <div class="container">
            <div class="field is-grouped pb-2">
                <p class="control">
                <button class="button is-link" v-on:click="updateMenuData()">
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
            </div>
            <transition name="slide-fade">
            <div class="notification is-success" v-show="updateSuccess">
                <button class="delete"></button>
                Your menu has been updated successfully! 
            </div>
            </transition>
                <div id="menuEditor" :class="{'hide-menu-items' : !showMenuSections}">
              
                     <modal-editor v-show="isModalVisible" @close="closeModal" @cancel="cancelModal" :section="modalData"/>
                    <nested-draggable :menu="menu" :open-edit-modal="showModal" v-if="menuLoaded"/>
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
        cancelModal(){
            // revert back to the original cloned data
            this.modalData.name = this.modalDataClone.name;
            this.modalData.description = this.modalDataClone.description
            this.modalData.price = this.modalDataClone.price
            this.isModalVisible = false;
        }
    }
}
</script>