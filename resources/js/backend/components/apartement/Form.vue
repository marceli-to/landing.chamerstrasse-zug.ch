<template>
  <div class="container">
    <notifications classes="notification"/>
    <main class="content" role="main">
      <div>
        <h1>{{title}}</h1>
        <form @submit.prevent="submit">
          <div>
            <div class="form-row" :class="errors.building ? 'has-error': ''">
              <label>Haus</label>
              <div class="select-wrapper is-wide">
                <select
                  v-model="apartement.building"
                  name="state"
                  @focus="removeError('building')"
                >
                  <option selected="selected">Bitte wählen...</option>
                  <option v-for="(building, index) in buildings" :key="building.key" :value="index">{{ building }}</option>
                </select>
              </div>
              <div class="is-required">Pflichtfeld</div>
            </div>
            <div class="form-row" :class="errors.floor ? 'has-error': ''">
              <label>Geschoss</label>
              <div class="select-wrapper is-wide">
                <select
                  v-model="apartement.floor"
                  name="state"
                  @focus="removeError('floor')"
                >
                  <option selected="selected">Bitte wählen...</option>
                  <option v-for="(floor, index) in floors" :key="floor.key" :value="index">{{ floor }}</option>
                </select>
              </div>
              <div class="is-required">Pflichtfeld</div>
            </div>
            <div class="form-row" :class="errors.number ? 'has-error': ''">
              <label>Nummer</label>
              <input
                type="text"
                @focus="removeError('number')"
                name="name"
                v-model="apartement.number"
              >
              <div class="is-required">Pflichtfeld</div>
            </div>
            <div class="form-row" :class="errors.rooms ? 'has-error': ''">
              <label>Zimmer</label>
              <input
                type="text"
                @focus="removeError('rooms')"
                name="name"
                v-model="apartement.rooms"
              >
              <div class="is-required">Pflichtfeld</div>
            </div>
            <div class="form-row" :class="errors.square_footage ? 'has-error': ''">
              <label>Nettowohnfläche (m2)</label>
              <input
                type="text"
                @focus="removeError('square_footage')"
                name="square_footage"
                v-model="apartement.square_footage"
              >
              <div class="is-required">Pflichtfeld</div>
            </div>
            <div class="form-row" :class="errors.rent_net ? 'has-error': ''">
              <label>Nettomiete</label>
              <input
                type="text"
                @focus="removeError('rent_net')"
                name="rent_net"
                v-model="apartement.rent_net"
              >
              <div class="is-required">Pflichtfeld</div>
            </div>
            <div class="form-row" :class="errors.additional_cost ? 'has-error': ''">
              <label>Nebenkosten</label>
              <input
                type="text"
                @focus="removeError('additional_cost')"
                name="additional_cost"
                v-model="apartement.additional_cost"
              >
              <div class="is-required">Pflichtfeld</div>
            </div>
            <div class="form-row" :class="errors.rent_gross ? 'has-error': ''">
              <label>Bruttomiete</label>
              <input
                type="text"
                @focus="removeError('rent_gross')"
                name="rent_gross"
                v-model="apartement.rent_gross"
              >
              <div class="is-required">Pflichtfeld</div>
            </div>
            <div class="form-row" :class="errors.state ? 'has-error': ''">
              <label>Status</label>
              <div class="select-wrapper is-wide">
                <select
                  v-model="apartement.state"
                  name="state"
                  @focus="removeError('state')"
                >
                  <option selected="selected">Bitte wählen...</option>
                  <option v-for="(state, index) in states" :key="state.key" :value="index">{{ state }}</option>
                </select>
              </div>
              <div class="is-required">Pflichtfeld</div>
            </div>
          </div>
          <form-buttons :route="'apartements'"></form-buttons>
        </form>
      </div>
    </main>
  </div>
</template>
<script>
import PageHeader from "@/layout/PageHeader.vue";
import FormButtons from "@/components/global/buttons/FormButtons.vue";
import Utils from "@/mixins/utils";
import Progress from "@/mixins/progress";

export default {
  components: {
    FormButtons: FormButtons
  },

  props: {
    type: String
  },

  mixins: [Utils, Progress],

  data() {
    return {
      // validation
      errors: {
        building: false,
        number: false,
        floor: false,
        square_footage: false,
        rent_net: false,
        rent_gross: false,
        additional_cost: false,
        state: false
      },

      // object
      apartement: {
        building: null,
        number: null,
        floor: null,
        square_footage: null,
        rent_net: null,
        rent_gross: null,
        additional_cost: null,
        state: null
      },

      floors: {
        1: 'EG',
        2: '1. OG',
        3: '2. OG',
        4: '3. OG',
        5: '4. OG',
        6: '5. OG',
      },

      states: {
        1: 'frei',
        2: 'reserviert',
        3: 'vermietet',
      },
      
      buildings: {
        22: '22',
        24: '24',
      },
    };
  },

  created() {
    // Get record while in edit mode
    if (this.$props.type == "edit") {
      let uri = `/api/apartement/edit/${this.$route.params.id}`;
      this.axios.get(uri).then(response => {
        this.apartement = response.data;
      });
    }
  },

  methods: {
    // Validation methods
    validate() {
      if (
        this.apartement.building &&
        this.apartement.number &&
        this.apartement.floor &&
        this.apartement.rent_net &&
        this.apartement.rent_gross &&
        this.apartement.additional_cost &&
        this.apartement.square_footage &&
        this.apartement.state
      ) {
        return true;
      }

      if (!this.apartement.building) {
        this.errors.building = true;
      }

      if (!this.apartement.number) {
        this.errors.number = true;
      }
      
      if (!this.apartement.floor) {
        this.errors.floor = true;
      }

      if (!this.apartement.rent_net) {
        this.errors.rent_net = true;
      }

      if (!this.apartement.rent_gross) {
        this.errors.rent_gross = true;
      }

      if (!this.apartement.additional_cost) {
        this.errors.additional_cost = true;
      }

      if (!this.apartement.square_footage) {
        this.errors.square_footage = true;
      }

      if (!this.apartement.state) {
        this.errors.state = true;
      }

      return false;
    },

    // Submit method
    submit() {
      if (!this.validate()) {
        this.validationError();
        return;
      }

      if (this.$props.type == "edit") {
        this.update();
      }

      if (this.$props.type == "create") {
        this.store();
      }
    },

    // Store the data
    store() {
      let uri = "/api/apartement/create";
      this.axios.post(uri, this.apartement).then(response => {
        this.$router.push({ name: "apartements" });
      });
    },

    // Update the data
    update() {
      let uri = `/api/apartement/update/${this.$route.params.id}`;
      this.axios.post(uri, this.apartement).then(response => {
        this.$router.push({ name: "apartements" });
      });
    }
  },

  computed: {
    title: function() {
      return this.$props.type == "edit"
        ? "Objekt bearbeiten"
        : "Objekt erstellen";
    },
  }
};
</script>