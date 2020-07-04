<script>
export default {
  name: "edit-item-form",
  props: ["section"],
  data: function() {
    return {};
  },
  methods: {
    close() {
      this.$emit("close");
    },
    cancel() {
      this.$emit("cancel");
    }
  }
};
</script>
<template>
  <div class="modal-card">
      <div class="card">
        <header class="card-header">
          <p class="card-header-title">Edit Menu Item</p>
        </header>
        <div class="card-content">
          <div class="field">
            <label for class="label">Name</label>
            <div class="control">
              <input type="text" class="input" v-model="section.name" />
            </div>
          </div>
          <div class="field"  v-if="section.type == 'menu_item'">
            <label for class="label">Description</label>
            <div class="control">
              <textarea v-model="section.description" id rows="3" class="textarea"></textarea>
            </div>
          </div>
          <div class="field is-grouped" v-if="section.type == 'menu_item'">
            <label class="checkbox pr-2">
              <input type="checkbox" />
              Gluten Free
            </label>
            <label class="checkbox pr-2">
              <input type="checkbox" />
              Vegetarian
            </label>
            <label class="checkbox pr-2">
              <input type="checkbox" />
              Vegan
            </label>
            <label class="checkbox pr-2">
              <input type="checkbox" />
              Lactose
            </label>
          </div>
          <div class="field" v-if="section.type == 'menu_item'">
            <label for class="label">Price</label>
            <div class="control has-icons-left">
              <input type="number" class="input" v-model="section.price" />
              <span class="icon is-left">
                <i class="fas fa-euro-sign"></i>
              </span>
            </div>
          </div>
          <div class="field is-grouped">
            <div class="control">
              <button class="button is-primary" @click="close">Done</button>
            </div>
            <div class="control">
              <button class="button is-link is-light" @click="cancel">Cancel</button>
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
  transition: all 0.3s ease;
}
.slide-fade-leave-active {
  transition: all 0.3s ease;
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active below version 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}
</style>