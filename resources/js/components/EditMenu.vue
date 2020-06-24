<template>
         <div class="field is-grouped">
            <p class="control">
              <button class="button is-link" v-on:click="updateSectionOrder()">
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
</template>

<script>
export default {
    data: function() {
        return {
            menuSections: [],
            menuItems: [],
            menuSectionsSerialized: [],
            showMenuSections: true,
        }
    },

    mounted: function() {
        this.menuSectionsSerialized = this.serializeMenuOrder();
        this.updateSectionOrder();
    },

    methods: {
        serializeMenuOrder: function() {
            const nestedQuery = '.nested-sortable';
            const identifier = 'sortableId';
            const root = document.getElementById('sortableMenu');
            const sortable = root;
            var serialized = [];
            var children = [].slice.call(sortable.children);
            for (var i in children) {
                var nested = children[i].querySelector(nestedQuery);
                serialized.push({
                id: children[i].dataset[identifier],
                position: parseInt(i)+1,
                type : children[i].dataset['sortableType'],
                // children: nested ? serialize(nested) : []
                });
            }
            console.log("called")
            return serialized
        },

        updateSectionOrder: function() {
            console.log("update order");
            this.menuSectionsSerialized = this.serializeMenuOrder();
            axios.post('/api/v1/menu-sections',{
                "sections": this.menuSectionsSerialized
            })
            .then(function(response){
                console.log(response);
            })
            .catch(function(error){
                console.log(error);
            });
        },

        toggleMenuSections: function() {
            let visible = this.showMenuSections;
            [].forEach.call(document.querySelectorAll('.menu-items'), function (el) {
                if(visible){
                    el.style.display = 'none';
                }else{
                    el.style.display = 'block'
                }
             });
             if(visible){
                 this.showMenuSections = false;
             }else{
                 this.showMenuSections = true;
             }
        }
    }
}
</script>