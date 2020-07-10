<template>
  <section>
    <b-steps
      v-model="activeStep"
      :animated="isAnimated"
      :rounded="isRounded"
      :has-navigation="false"
      :label-position="labelPosition"
      :mobile-mode="mobileMode"
      :class="'pt-5'"
      :change="stepChange()"
    >
      <b-step-item step="1" label="Details" :clickable="isStepsClickable">
        <h1 class="title has-text-centered">Your Details</h1>
        <h5
          class="is-size-5 has-text-centered"
        >We just need some basic details from you to get started</h5>
        <section class="section">
          <div class="columns">
            <div class="column"></div>
            <div class="column is-two-fifths">
              <section>
                <validation-observer v-slot="{ invalid }" ref="step1">
                  <validation-provider rules="required" v-slot="{errors, valid}">
                    <b-field
                      label="What's the name of your establishment?"
                      :type="{ 'is-danger': errors[0], 'is-success': valid }"
                      :message="errors"
                    >
                      <b-input
                        icon="home"
                        placeholder="eg. Fine Oak Cafe"
                        v-model="establishment.name"
                      ></b-input>
                    </b-field>
                  </validation-provider>

                  <validation-provider rules="required|email" v-slot="{errors, valid}">
                    <b-field
                      label="Contact email address (make sure you have access to this inbox)"
                      :type="{ 'is-danger': errors[0], 'is-success': valid }"
                      :message="errors"
                    >
                      <b-input
                        type="email"
                        v-model="establishment.email_address"
                        icon="envelope"
                        placeholder="info@fineoakcafe.com"
                      ></b-input>
                    </b-field>
                  </validation-provider>

                  <validation-provider rules="required" v-slot="{errors, valid}">
                    <b-field
                      label="Contact Person"
                      :type="{ 'is-danger': errors[0], 'is-success': valid }"
                      :message="errors"
                    >
                      <b-input icon="user" v-model="establishment.contact_person"></b-input>
                    </b-field>
                  </validation-provider>
                  <validation-provider rules="required|numeric|min:6" v-slot="{errors, valid}">
                    <b-field
                      label="Contact Number"
                      :type="{ 'is-danger': errors[0], 'is-success': valid }"
                      :message="errors"
                    >
                      <b-input icon="phone-alt" v-model="establishment.contact_number"></b-input>
                    </b-field>
                  </validation-provider>
                  <!-- <b-field label="Currency">
                  <b-select placeholder="Select a currency" v-model="establishment.currency">
                    <option value="EUR">Euro</option>
                    <option value="GBP">Pound Sterling</option>
                  </b-select>
                  </b-field>-->
                  <!-- <button type="submit" :disabled="invalid">Submit</button> -->
                  <div class="columns mt-5">
                    <div class="column">
                      <b-button
                        type="is-primary"
                        icon-pack="fa"
                        icon-right="angle-right"
                        :disabled="invalid"
                        @click="goToNextStep()"
                      >Next Step</b-button>
                    </div>
                  </div>
                </validation-observer>
              </section>
            </div>
            <div class="column"></div>
          </div>
        </section>
      </b-step-item>

      <b-step-item step="2" label="Address" :clickable="isStepsClickable">
        <h1 class="title has-text-centered">Address</h1>
        <h5
          class="is-size-5 has-text-centered"
        >Let us know where you are so we can improve our service to you</h5>
        <section class="section">
          <div class="columns">
            <div class="column"></div>
            <div class="column is-two-fifths">
              <validation-observer v-slot="{ invalid }" ref="step2">
                <validation-provider rules="required" v-slot="{errors, valid}">
                  <b-field
                    label="Address 1"
                    :type="{ 'is-danger': errors[0], 'is-success': valid }"
                    :message="errors"
                  >
                    <b-input v-model="establishment.address_1"></b-input>
                  </b-field>
                </validation-provider>

                <b-field label="Address 2">
                  <b-input v-model="establishment.address_2"></b-input>
                </b-field>
                <validation-provider rules="required" v-slot="{errors, valid}">
                  <b-field
                    label="Town/City"
                    :type="{ 'is-danger': errors[0], 'is-success': valid }"
                    :message="errors"
                  >
                    <b-input v-model="establishment.town_city"></b-input>
                  </b-field>
                </validation-provider>

                <div class="columns">
                  <div class="column">
                    <b-field label="Eircode">
                      <b-input v-model="establishment.postcode"></b-input>
                    </b-field>
                  </div>
                  <div class="column">
                    <validation-provider rules="required" v-slot="{errors, valid}">
                      <b-field
                        label="County"
                        :type="{ 'is-danger': errors[0], 'is-success': valid }"
                        :message="errors"
                      >
                        <b-select placeholder="Select County" v-model="establishment.county">
                          <option value></option>
                          <option value="Wicklow">Wicklow</option>
                          <option value="Dublin">Dublin</option>
                        </b-select>
                      </b-field>
                    </validation-provider>
                  </div>
                  <!-- <div class="column">
                  <b-field label="Country" expanded>
                    <b-input v-model="establishment.country"></b-input>
                  </b-field>
                  </div>-->
                </div>
                <div class="columns mt-5">
                  <div class="column">
                    <b-button
                      type="is-secondary"
                      icon-pack="fa"
                      icon-left="angle-left"
                      @click="goToPreviousStep()"
                    >Previous Step</b-button>
                  </div>
                  <div class="column">
                    <b-button
                      type="is-primary"
                      icon-pack="fa"
                      icon-right="angle-right"
                      :disabled="invalid"
                      @click="goToNextStep()"
                    >Next Step</b-button>
                  </div>
                </div>
              </validation-observer>
            </div>
            <div class="column"></div>
          </div>
        </section>
      </b-step-item>

      <b-step-item
        step="3"
        label="Menus"
        :clickable="isStepsClickable"
        :type="{'is-success': isProfileSuccess}"
      >
        <h1 class="title has-text-centered">Your Menus</h1>
        <h5 class="is-size-5 has-text-centered">You can have multiple menus or just one!</h5>
        <section class="section">
          <div class="columns">
            <div class="column"></div>
            <div class="column is-three-fifths">
              <p
                class="has-text-centered"
              >Depending on the time of day, we'll automatically show the correct menu to your customers. Choose the setup that suits you below.</p>

              <div class="tile is-ancestory">
                <div
                  class="menu-select-tile tile is-parent cursor-pointer"
                  :class="{'active': menuMode == 'single'}"
                  @click="setMenuMode('single')"
                >
                  <div class="outlined box has-text-centered">
                    <h1 class="title">Just One Menu</h1>
                    <h2 class="subtitle is-6">
                      We have one all day menu
                      <i>(optional kids menu)</i>
                    </h2>
                  </div>
                </div>
                <div
                  class="menu-select-tile tile is-parent cursor-pointer"
                  :class="{'active': menuMode == 'multiple'}"
                  @click="setMenuMode('multiple')"
                >
                  <div class="outlined box has-text-centered">
                    <h1 class="title">Multiple Menus</h1>
                    <h2 class="subtitle is-6">Our menu is different on certain days or times</h2>
                  </div>
                </div>
              </div>
              <validation-observer v-slot="{ invalid }" ref="step3">
                <div class="columns">
                  <div class="column is-full" v-if="menuMode != null">
                    <h1
                      class="title has-text-centered pt-3"
                      v-if="menuMode == 'single'"
                    >Lets give your menu a name</h1>
                    <h1
                      class="title has-text-centered pt-3"
                      v-if="menuMode == 'multiple'"
                    >Lets setup your menus</h1>
                    <div
                      v-for="(menu,counter) in menus"
                      v-bind:key="counter"
                      class="has-background-light my-3 px-3 py-3"
                    >
                      <validation-provider rules="required" v-slot="{errors, valid}">
                        <b-field
                          class="is-relative"
                          :type="{ 'is-danger': errors[0], 'is-success': valid }"
                          :message="errors"
                        >
                          <b-input
                            placeholder="Enter menu name"
                            v-model="menu.name"
                            size="is-large"
                            custom-class="has-text-centered mb-4"
                            expanded
                          ></b-input>
                          <b-button
                            v-if="menus.length > 1 && menuMode == 'multiple'"
                            type="is-text"
                            class="is-absolute delete-menu-icon is-danger"
                            inverted
                            icon-right="trash"
                            @click="removeMenu(counter)"
                          ></b-button>
                        </b-field>
                      </validation-provider>
                      <div class="columns" v-if="menuMode == 'multiple'">
                        <div class="column">
                          <p>When is this menu available?</p>
                        </div>
                      </div>
                      <div class="columns mb-3" v-if="menuMode == 'multiple'">
                        <div class="column">
                          <b-field>
                            <b-switch v-model="menu.allDay">All Day</b-switch>
                          </b-field>
                        </div>
                        <div class="column">
                          <validation-provider
                            rules="required"
                            v-slot="{errors, valid}"
                            v-if="menu.allDay == false"
                          >
                            <b-field
                              label="Starts"
                              :type="{ 'is-danger': errors[0], 'is-success': valid }"
                              :message="errors"
                            >
                              <b-clockpicker v-model="menu.startTime" hour-format="24"></b-clockpicker>
                            </b-field>
                          </validation-provider>
                        </div>
                        <div class="column">
                          <validation-provider
                            rules="required"
                            v-slot="{errors, valid}"
                            v-if="menu.allDay == false"
                          >
                            <b-field
                              label="End"
                              :type="{ 'is-danger': errors[0], 'is-success': valid }"
                              :message="errors"
                            >
                              <b-clockpicker v-model="menu.endTime" hour-format="24"></b-clockpicker>
                            </b-field>
                          </validation-provider>
                        </div>
                      </div>
                      <div class="divider my-5"></div>
                    </div>
                    <b-button
                      v-if="menuMode == 'multiple'"
                      type="is-light"
                      expanded
                      icon-right="plus"
                      class="mt-4"
                      @click="addNewMenu()"
                    >Add Another</b-button>
                  </div>
                </div>
                <div class="columns mt-5" v-if="menuMode != null">
                  <div class="column">
                    <b-button
                      type="is-secondary"
                      icon-pack="fa"
                      icon-left="angle-left"
                      @click="goToPreviousStep()"
                    >Previous Step</b-button>
                  </div>
                  <div class="column">
                    <b-button
                      type="is-primary"
                      icon-pack="fa"
                      icon-right="angle-right"
                      :disabled="invalid"
                      @click="goToNextStep()"
                    >All Done!</b-button>
                  </div>
                </div>
              </validation-observer>
            </div>
            <div class="column"></div>
          </div>
        </section>
      </b-step-item>

      <b-step-item :step="4" label="Wrapping Up" :clickable="isStepsClickable">
        <h1 class="title has-text-centered">Your QR Codes</h1>
        <h5 class="is-size-5 has-text-centered">Bet you didn't think it would be that easy did you?</h5>
      </b-step-item>
    </b-steps>
  </section>
</template>

<script>
export default {
  name: "get-started",
  data() {
    return {
      establishment: {
        name: "",
        currency: "EUR",
        contact_person: "",
        email_address: "",
        contact_number: "",
        address_1: "",
        address_2: "",
        town_city: "",
        postcode: "",
        county: "",
        country: "",
        saved: false
      },
      menus: [
        {
          name: "",
          startTime: null,
          endTime: null,
          allDay: true
        }
      ],
      menuMode: null,
      activeStep: 0,

      showSocial: false,
      isAnimated: true,
      isRounded: true,
      isStepsClickable: false,

      hasNavigation: true,
      customNavigation: false,
      isProfileSuccess: false,

      prevIcon: "chevron-left",
      nextIcon: "chevron-right",
      labelPosition: "bottom",
      mobileMode: "minimalist"
    };
  },
  methods: {
    addNewMenu: function() {
      this.menus.push({
        name: "",
        allDay: false
      });
    },
    removeMenu: function(index) {
      this.menus.splice(index, 1);
    },
    setMenuMode: function(mode) {
      this.menuMode = mode;
    },
    stepChange: function() {
      console.log("step changing");
    },
    goToNextStep: function() {
      if (this.activeStep == 0) {
        this.saveEstablishment(this.establishment).then(
          response => {
            console.log(response);
            this.establishment.id = response.data.data.id;
            this.establishment.saved = true;
            this.activeStep++;
          },
          error => {
            console.log(error);
            this.$buefy.toast.open({
              message:
                "Whoops! Something has gone wrong, please check your details and try again",
              type: "is-error"
            });
          }
        );
      }
    },
    goToPreviousStep: function() {
      this.activeStep--;
    },
    saveEstablishment: function(establishment) {
      console.log("here")
      
      var savePromise = new Promise(function(resolve, reject) {
        console.log("boo")
        axios
          .post("/api/v1/establishment/", establishment)
          .then(response => {
            console.log(response);
            resolve(response);
           
          })
          .catch(error => {
            console.log(error);
            reject(error)
          })
      });
      return savePromise;
    }
  }
};
</script>

<style lang="scss">
.delete-menu-icon {
  right: -50px;
  top: 5px;
}
</style>