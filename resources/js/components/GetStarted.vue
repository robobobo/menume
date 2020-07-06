<template>
  <section>
    <b-steps
      v-model="activeStep"
      :animated="isAnimated"
      :rounded="isRounded"
      :has-navigation="hasNavigation"
      :label-position="labelPosition"
      :mobile-mode="mobileMode"
      :class="'pt-5'"
    >
      <b-step-item step="1" label="Details" :clickable="isStepsClickable">
        <h1 class="title has-text-centered">Your Details</h1>
        <h5
          class="is-size-5 has-text-centered"
        >We just need some basic details from you to get started</h5>
        <div class="columns">
          <div class="column"></div>
          <div class="column is-three-fifths">
            <section>

              <b-field label="What's the name of your establishment?">
                <b-input placeholder="eg. Fine Oak Cafe" v-model="establishment.name"></b-input>
              </b-field>

              <b-field label="Contact email address" message="Make sure you have access to this inbox">
                <b-input type="email" v-model="establishment.email_address" placeholder="info@fineoakcafe.com"></b-input>
              </b-field>

              <b-field label="Contact Person"  message="Could be the owner,manager, probably you!">
                <b-input v-model="establishment.contact_name"></b-input>
              </b-field>
              <b-field label="Currency">
                <b-select placeholder="Select a currency" v-model="establishment.currency">
                  <option value="EUR">Euro</option>
                  <option value="GBP">Pound Sterling</option>
                </b-select>
              </b-field>
                <b-field grouped>
                    <b-field label="Address 1">
                        <b-input v-model="establishment.address_1"></b-input>
                    </b-field>
                    <b-field label="Address 2">
                        <b-input v-model="establishment.address_2"></b-input>
                    </b-field>
                </b-field>
                 <b-field grouped>
                    <b-field label="Town/City">
                        <b-input v-model="establishment.town_city"></b-input>
                    </b-field>
                    <b-field label="Eircode">
                        <b-input v-model="establishment.postcode"></b-input>
                    </b-field>
                </b-field>
                <b-field grouped>
                    <b-field label="County">
                        <b-input v-model="establishment.county"></b-input>
                    </b-field>
                    <b-field label="Country">
                        <b-input v-model="establishment.country"></b-input>
                    </b-field>
                </b-field>
            </section>
          </div>
          <div class="column"></div>
        </div>
      </b-step-item>

      <b-step-item
        step="2"
        label="Menus"
        :clickable="isStepsClickable"
        :type="{'is-success': isProfileSuccess}"
      >
        <h1 class="title has-text-centered">Your Menus</h1>
        <h5 class="is-size-5 has-text-centered">You can have multiple menus or just one!</h5>
      </b-step-item>

      <b-step-item :step="3" label="Wrapping Up" :clickable="isStepsClickable">
        <h1 class="title has-text-centered">Your QR Codes</h1>
        <h5 class="is-size-5 has-text-centered">Bet you didn't think it would be that easy did you?</h5>
      </b-step-item>

      <template slot="navigation" slot-scope="{previous, next}">
        <b-button
          outlined
          icon-pack="fa"
          icon-left="angle-left"
          :disabled="previous.disabled"
          @click.prevent="previous.action"
        >Previous</b-button>
        <b-button
          outlined
          type="is-success"
          icon-pack="fa"
          icon-right="angle-right"
          :disabled="next.disabled"
          @click.prevent="next.action"
        >Next</b-button>
      </template>
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
      },
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
  }
};
</script>