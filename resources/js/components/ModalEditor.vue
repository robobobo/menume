<script>
  export default {
    name: 'modal-editor',
    props: ['section'],
    data: function() {
        return {
            
        }
    },
    methods: {
      close() {
        this.$emit('close');
      },
      cancel() {
          this.$emit('cancel');
      }
    },

  };
</script>
<template>
<transition name="slide-fade">
<div class="modal is-active" role="dialog">
  <div class="modal-background"></div>
  <div class="modal-content">
    <!-- Any other Bulma elements you want -->
    <slot name="body" v-if="section">
      <div class="card">
        <header class="card-header">
          <p class="card-header-title">
          Edit Menu Item

          </p>
          </header>
        <div class="card-content">
          <div class="field">
            <label for="" class="label">Name</label>
            <div class="control">
              <input type="text" class="input" v-model="section.name">
            </div>
          </div>
          <div class="field">
            <label for="" class="label">Description</label>
            <div class="control">
              <textarea v-model="section.description" id="" rows="3" class="textarea">
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
              <input type="number" class="input" v-model="section.price">
              <span class="icon is-left">
                <i class="fas fa-euro-sign"></i>
              </span>
            </div>
          </div>
          <div class="field is-grouped">
            <div class="control">
              <button class="button is-link" @click="close">Save</button>
            </div>
            <div class="control">
              <button class="button is-link is-light" @click="cancel">Cancel</button>
            </div>
        </div>


        </div>
</div>
    </slot>
  </div>
  <button class="modal-close is-large" @click="close" aria-label="close"></button>
</div>
</transition>
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