<script>
  export default {
    name: 'new-item-form',
    props: ['menu','menuDetails','currentSection','modalOpen'],
    data: function() {
        return {
            item: {
                name: '',
                description: '',
                price: null,
                type: '',
                menu_section_id: null,
                menu_id:null,
            },
            formLoading: false,
        }
    },
    mounted: function() {
      this.item.menu_id = this.menuDetails.menu_id;
      if(this.currentSection != undefined){
        this.item.menu_section_id = this.currentSection.id;
      }
    },
    methods: {
      setSectionId: function(section) {
        this.item.menu_section_id = section.id;
      },
      close() {
        this.$emit('close');
      },
      save() {
          console.log(this.item);
          axios.post("/api/v1/menu-item",this.item)
          .then( result =>{
              console.log(result);
             this.$buefy.toast.open({
              message: "Item has been added!",
              type: "is-success"
            });
           this.$emit('addNewItem',result.data);
              this.close();
          })
          .catch( error => {
              console.log(error.response.data.errors);
          });
      }
    },

  };
</script>
<template>
  <div class="modal-card">
      <div class="card">
        <header class="card-header">
          <p class="card-header-title">
          Add New Menu Item

          </p>
          </header>
        <div class="card-content">
          <div class="field">
            <label for="" class="label">Select Section</label>
            <div class="control">
              <div class="select">
              <select v-model="item.menu_section_id">
                  <option disabled value="">Please select one</option>
                <option v-for="section in menu" v-bind:key="section.id" v-bind:value="section.id">
                  {{section.name}}
                </option>
              </select>
            </div>
            </div>
          </div>
          <div class="field">
            <label for="" class="label">Name</label>
            <div class="control">
              <input type="text" class="input" v-model="item.name" placeholder="Avocado poached eggs">
            </div>
          </div>
          <div class="field">
            <label for="" class="label">Description</label>
            <div class="control">
              <textarea v-model="item.description" placeholder="Two free range golden yolk eggs, perfectly poached on fresh sourdough bread" id="" rows="3" class="textarea">
              </textarea>
            </div>
          </div>
          <div class="field is-grouped">
            <label class="checkbox pr-2">
              <input type="checkbox">
              Gluten Free
            </label>
            <label class="checkbox pr-2">
              <input type="checkbox">
              Vegetarian
            </label>
            <label class="checkbox pr-2">
              <input type="checkbox">
              Vegan
            </label>
            <label class="checkbox pr-2">
              <input type="checkbox">
              Lactose
            </label>
          </div>
          <div class="field">
            <label for="" class="label">Price</label>
            <div class="control has-icons-left">
              <input type="number" class="input" v-model="item.price">
              <span class="icon is-left">
                <i class="fas fa-euro-sign"></i>
              </span>
            </div>
          </div>
          <div class="field is-grouped">
            <div class="control">
              <button class="button is-primary" @click="save">Save</button>
            </div>
            <div class="control">
              <button class="button is-link is-light" @click="close">Cancel</button>
            </div>
        </div>
        </div>
    </div>
  </div>
</template>
<style>
/* Enter and leave animations can use different */
/* durations and timing functions.              */
.slide-fade-enter-active {
  transition: all .3s ease;
}
.slide-fade-leave-active {
  transition: all .3s ease;
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active below version 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}
</style>