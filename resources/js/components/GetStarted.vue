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
                <div class="field">
                  <label class="label">Select Your Country</label>
                  <div class="control has-icons-left">
                    <div class="select is-fullwidth">
                      <country-select
                        v-model="establishment.country"
                        :country="establishment.country"
                        :white-list="countryWhitelist"
                      />
                    </div>
                    <span class="icon is-left">
                      <i class="fas fa-globe"></i>
                    </span>
                  </div>
                </div>
                <div v-show="establishment.country != ''">
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
                    <div class="column is-half">
                      <b-field :label="postcodeLabel">
                        <b-input v-model="establishment.postcode"></b-input>
                      </b-field>
                    </div>
                    <div class="column is-half">
                      <validation-provider rules="required" v-slot="{errors, valid}">
                        <div class="field">
                          <label class="label">{{countyLabel}}</label>
                          <div class="control">
                            <div
                              class="select"
                              :class="{ 'is-danger': errors[0], 'is-success': valid }"
                            >
                              <region-select
                                v-model="establishment.county"
                                :country="establishment.country"
                                :region="establishment.county"
                              />
                            </div>
                          </div>
                          <p class="help is-danger">{{errors[0]}}</p>
                        </div>
                        <!-- <b-field
                        label="County"
                        :type="{ 'is-danger': errors[0], 'is-success': valid }"
                        :message="errors"
                      >
                        <b-select placeholder="Select County" v-model="establishment.county">
                          <option value></option>
                          <option value="Wicklow">Wicklow</option>
                          <option value="Dublin">Dublin</option>
                        </b-select>
                        </b-field>-->
                      </validation-provider>
                    </div>
                  </div>
                  <!-- <div class="column">
                  <b-field label="Country" expanded>
                    <b-input v-model="establishment.country"></b-input>
                  </b-field>
                  </div>-->
                </div>
                <div class="columns mt-5">
                  <!-- <div class="column">
                    <b-button
                      type="is-secondary"
                      icon-pack="fa"
                      icon-left="angle-left"
                      @click="goToPreviousStep()"
                    >Previous Step</b-button>
                  </div>-->
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
        <!-- <h5 class="is-size-5 has-text-centered">You can setup as many menus as you need!</h5> -->
        <section class="section">
          <div class="columns">
            <div class="column"></div>
            <div class="column is-three-fifths">
              <p
                class="has-text-centered"
              >We've started by adding some default menus, but feel free to add or remove any. (You can always change this in the future too)</p>
              <!-- <div class="tile is-ancestory">
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
              </div>-->
              <validation-observer v-slot="{ invalid }" ref="step3">
                <div class="columns">
                  <div class="column is-full">
                    <h1 class="title has-text-centered pt-3">Lets setup your menus</h1>
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
                            placeholder="eg. Drinks Menu"
                            v-model="menu.name"
                            size="is-large"
                            custom-class="has-text-centered mb-4"
                            expanded
                          ></b-input>
                          <b-button
                            v-if="menus.length > 1"
                            type="is-text"
                            class="is-absolute delete-menu-icon is-danger"
                            inverted
                            icon-right="trash"
                            @click="removeMenu(counter)"
                          ></b-button>
                        </b-field>
                      </validation-provider>
                      <div class="columns">
                        <div class="column">
                          <p>When is this menu available?</p>
                        </div>
                      </div>
                      <div class="columns mb-3">
                        <div class="column">
                          <b-field>
                            <b-switch v-model="menu.all_day">All Day</b-switch>
                          </b-field>
                        </div>
                        <div class="column">
                          <validation-provider
                            rules="required"
                            v-slot="{errors, valid}"
                            v-if="menu.all_day == false"
                          >
                            <b-field
                              label="Starts"
                              :type="{ 'is-danger': errors[0], 'is-success': valid }"
                              :message="errors"
                            >
                              <b-timepicker
                                inline
                                v-model="menu.start_time_full"
                                :incrementMinutes="15"
                                hour-format="24"
                                :defaultMinutes="0"
                              ></b-timepicker>
                            </b-field>
                          </validation-provider>
                        </div>
                        <div class="column">
                          <validation-provider
                            rules="required"
                            v-slot="{errors, valid}"
                            v-if="menu.all_day == false"
                          >
                            <b-field
                              label="End"
                              :type="{ 'is-danger': errors[0], 'is-success': valid }"
                              :message="errors"
                            >
                              <b-timepicker
                                inline
                                v-model="menu.end_time_full"
                                :incrementMinutes="15"
                                hour-format="24"
                                :defaultMinutes="0"
                              ></b-timepicker>
                            </b-field>
                          </validation-provider>
                        </div>
                      </div>
                      <div class="divider my-5"></div>
                    </div>
                    <b-button
                      type="is-light"
                      expanded
                      icon-right="plus"
                      class="mt-4"
                      @click="addNewMenu()"
                    >Add Another</b-button>
                  </div>
                </div>
                <div class="columns mt-5">
                  <!-- <div class="column">
                    <b-button
                      type="is-secondary"
                      icon-pack="fa"
                      icon-left="angle-left"
                      @click="goToPreviousStep()"
                    >Previous Step</b-button>
                  </div>-->
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
        <div class="columns">
          <div class="column is-three-fifths is-offset-one-fifth">
            <p class="has-text-centered mt-2">
              One more thing though, you now need to add sections and items to your menu.
              <br />But dont worry, we made a really nice drag and drop tool for you to do that
            </p>
            <p
              class="has-text-centered mt-2"
            >Just select the edit button by your menu below and you can get started!</p>
            <div class="columns is-multiline">
              <div
                class="column is-one-half has-text-centered mt-2"
                v-for="menu in menus"
                :key="menu.id"
              >
                <a :href="'/menu/' + menu.id +'/edit'" target="_blank">
                  <div class="card">
                    <div class="card-image px-1 py-1">
                      <figure class="is-square image">
                        <img :src="menu.qr_code_url" :alt="'QR code for' + menu.name" />
                      </figure>
                    </div>
                    <div class="card-content">
                      <p class="title is-5">{{menu.name}}</p>
                      <a
                        :href="'/menu/' + menu.id +'/edit'"
                        class="button is-primary"
                        target="_blank"
                      >Edit Menu</a>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </b-step-item>
    </b-steps>
    <b-loading :is-full-page="true" :active.sync="isLoading" :can-cancel="false"></b-loading>
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
          name: "Drinks Menu",
          all_day: true,
          start_time_full: null,
          end_time_full: null,
          start_time: "", //H:i format
          end_time: "", //H:i format
        },
        {
          name: "Breakfast Menu",
          all_day: false,
          start_time_full: this.defaultTime(true),
          end_time_full: this.defaultTime(),
          start_time: "", //H:i format
          end_time: "", //H:i format
        },
        {
          name: "Kids Menu",
          all_day: true,
          start_time_full: null,
          end_time_full: null,
          start_time: "", //H:i format
          end_time: "", //H:i format
        }
      ],
      countryWhitelist: ["US", "GB", "IE"],
      menuMode: null,
      activeStep: 0,

      showSocial: false,
      isAnimated: true,
      isRounded: true,
      isStepsClickable: false,

      hasNavigation: true,
      customNavigation: false,
      isProfileSuccess: false,

      isLoading: false,

      prevIcon: "chevron-left",
      nextIcon: "chevron-right",
      labelPosition: "bottom",
      mobileMode: "minimalist"
    };
  },
  computed: {
    postcodeLabel() {
      if (this.establishment.country == "IE") {
        return "Eircode";
      } else if (this.establishment.country == "UK") {
        return "Postcode";
      } else if (this.establishment.country == "US") {
        return "ZIP";
      } else {
        return "Postcode";
      }
    },
    countyLabel() {
      if (this.establishment.country == "US") {
        return "State";
      } else {
        return "County";
      }
    }
  },
  methods: {
    addNewMenu: function() {
      this.menus.push({
        name: "",
        all_day: false,
        start_time_full: null,
        end_time_full: null
      });
    },
    setDefaultMenus: function() {
      this.menus.push(
        {
          name: "Drinks Menu",
          all_day: true,
          start_time_full: null,
          end_time_full: null
        },
        {
          name: "Breakfast Menu",
          all_day: false,
          start_time_full: null,
          end_time_full: null
        },
        {
          name: "Kids Menu",
          all_day: true,
          start_time_full: null,
          end_time_full: null
        }
      );
    },
    removeMenu: function(index) {
      this.menus.splice(index, 1);
    },
    setMenuMode: function(mode) {
      this.menuMode = mode;
    },
    goToNextStep: function() {
      this.isLoading = true;
      if (this.activeStep == 0) {
        this.saveEstablishment(this.establishment).then(
          response => {
            console.log(response);
            this.establishment.id = response.data.data.id;
            this.establishment.saved = true;
            this.isLoading = false;
            this.activeStep++;
          },
          error => {
            console.log(error);
            this.$buefy.toast.open({
              message:
                "Whoops! Something has gone wrong, please check your details and try again",
              type: "is-error"
            });
            this.isLoading = false;
          }
        );
      } else if (this.activeStep == 1) {
        this.updateEstablishment(this.establishment).then(
          response => {
            console.log(response);
            this.isLoading = false;
            this.activeStep++;
            this.setDefaultMenus();
          },
          error => {
            console.log(error);
            this.$buefy.toast.open({
              message:
                "Whoops! Something has gone wrong, please check your details and try again",
              type: "is-error"
            });
            this.isLoading = false;
          }
        );
      } else if (this.activeStep == 2) {
        this.isLoading = true;
        const promises = [];
        this.menus.forEach(menu => {
          menu.establishment_id = this.establishment.id;
          if (menu.all_day == false) {
            // these variables wont be set otherwise
            menu.start_time =
              (menu.start_time_full.getHours() < 10 ? "0" : "") +
              menu.start_time_full.getHours() +
              ":" +
              (menu.start_time_full.getMinutes() < 10 ? "0" : "") +
              menu.start_time_full.getMinutes();
            menu.end_time =
              (menu.end_time_full.getHours() < 10 ? "0" : "") +
              menu.end_time_full.getHours() +
              ":" +
              (menu.end_time_full.getMinutes() < 10 ? "0" : "") +
              menu.end_time_full.getMinutes();
          }
          promises.push(this.saveMenu(menu));
        });
        Promise.all(promises).then(
          response => {
            console.log("promises", response);
            this.isLoading = false;
            this.activeStep++;
          },
          reject => {
            console.log("error", reject);
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
    saveMenu: function(menu) {
      var savePromise = new Promise(function(resolve, reject) {
        axios
          .post("/api/v1/menu/", menu)
          .then(response => {
            menu.id = response.data.data.id;
            menu.qr_code_url = response.data.data.qr_code_url;
            console.log(response);
            resolve(response);
          })
          .catch(error => {
            console.log(error);
            reject(error);
          });
      });
      return savePromise;
    },
    saveEstablishment: function(establishment) {
      var savePromise = new Promise(function(resolve, reject) {
        axios
          .post("/api/v1/establishment/", establishment)
          .then(response => {
            console.log(response);
            resolve(response);
          })
          .catch(error => {
            console.log(error);
            reject(error);
          });
      });
      return savePromise;
    },
    updateEstablishment: function(establishment) {
      var updatePromise = new Promise(function(resolve, reject) {
        axios
          .post(
            "/api/v1/establishment/" + establishment.id + "/update",
            establishment
          )
          .then(response => {
            console.log(response);
            resolve(response);
          })
          .catch(error => {
            console.log(error);
            reject(error);
          });
      });
      return updatePromise;
    },
    defaultTime: function(start) {
      var time = new Date();
      time.setMinutes(0);
      time.setSeconds(0);
      if(start)
      {
        time.setHours(7);
      }else{
        time.setHours(11);
      }
      return time;
    },
  }
};
</script>

<style lang="scss">
.delete-menu-icon {
  right: -55px;
  top: 7px;
}
</style>