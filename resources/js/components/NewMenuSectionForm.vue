<script>
export default {
  name: "new-section-form",
  props: ["menu"],
  data: function() {
    return {
      section: {
        name: "",
        description: "",
        type: "menu_section",
        menu_id: null
      },
      formLoading: false
    };
  },
  mounted: function() {
    this.section.menu_id = this.menu.menu_id;
  },
  methods: {
    close() {
      this.$emit("close");
    },
    save() {
      console.log(this.section);
      axios
        .post("/api/v1/menu-section", this.section)
        .then(result => {
          console.log(result);
          this.$buefy.toast.open({
            message: "Section has been added!",
            type: "is-success"
          });
          this.$emit("addNewItem", result.data.data);
          this.$emit("close");
        })
        .catch(error => {
          console.log(error.response.data.errors);
        });
    }
  }
};
</script>
<template>
  <div class="modal-card">
    <div class="card">
      <header class="card-header">
        <p class="card-header-title">Add New Menu Section</p>
      </header>
      <div class="card-content">
        <div class="field">
          <label for class="label">Section Name</label>
          <div class="control">
            <input
              type="text"
              class="input"
              v-model="section.name"
              placeholder="eg. Starters and Appetizers"
            />
          </div>
        </div>
        <!-- <div class="field">
            <label for="" class="label">Description</label>
            <div class="control">
              <textarea v-model="section.description" placeholder="Two free range golden yolk eggs, perfectly poached on fresh sourdough bread" id="" rows="3" class="textarea">
              </textarea>
            </div>
        </div>-->
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