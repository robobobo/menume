<template>
          <div class="container">
            <div class="field is-grouped">
                <p class="control">
                <button class="button is-link" v-on:click="updateMenuData()">
                    Save changes
                </button>
                </p>
                <p class="control">
                <button class="button" v-on:click="toggleMenuSections()">Hide Menu Items</button>
                </p>
                <p class="control">
                <button class="button is-danger">
                    Cancel
                </button>
                </p>
            </div>
                 <nested-draggable :menu="menu" v-if="menuLoaded"/>
          </div>
</template>

<script>
// import draggable from 'vuedraggable'
import nestedDraggable from "./NestedDraggable";


export default {
    components: {
            nestedDraggable,
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
        console.log(this.menu);
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
        }
    }
}
</script>