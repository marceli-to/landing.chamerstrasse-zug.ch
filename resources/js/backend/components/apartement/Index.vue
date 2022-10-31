<template>
  <div>
    <page-header/>
    <notifications classes="notification"/>
    <div class="container">
      <main class="content" role="main">
        <div>
          <h1>Objekte</h1>
          <router-link :to="{ name: 'apartement-create' }" class="btn-add">
            <span>Erfassen</span>
          </router-link>
          <div class="list-items" v-if="apartements.length">
            <div class="list-item" data-icons="2">
              <div class="list-item-body">
                <div>
                  <div class="list-item-grid">
                    <div>Haus</div>
                    <div>Geschoss</div>
                    <div>Nummer</div>
                    <div>Zimmer</div>
                    <div>Fläche</div>
                    <div>Miete</div>
                    <div>Status</div>
                  </div>
                </div>
              </div>
            </div>
            <div v-for="apartement in apartements" :key="apartement.id">
              <div :class="[apartement.publish == 0 ? 'is-disabled' : '', 'list-item']" data-icons="2">
                <div class="list-item-body">
                  <div>
                    <div class="list-item-grid">
                      <div>{{ buildings[apartement.building] }}</div>
                      <div>{{ floors[apartement.floor] }}</div>
                      <div>{{ apartement.number }}</div>
                      <div>{{ apartement.rooms }}</div>
                      <div>{{ apartement.square_footage }} m<sup>2</sup></div>
                      <div>{{ apartement.rent_gross }}</div>
                      <div>{{ states[apartement.state]}}</div>
                    </div>
                  </div>
                </div>
                <div class="list-item-action" data-icons="3">
                  <router-link
                    :to="{name: 'apartement-edit', params: { id: apartement.id }}"
                    class="icon-edit icon-mini"
                  ></router-link>
                  <a
                    href="javascript:;"
                    class="icon-trash icon-mini"
                    @click.prevent="destroy(apartement.id,$event)"
                  ></a>
                </div>
              </div>
            </div>
          </div>
          <div v-else>
            <p>Keine Objekte verfügbar...</p>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>
<script>
import PageHeader from "@/layout/PageHeader.vue";
import Progress from "@/mixins/progress";
import Utils from "@/mixins/utils";

export default {
  components: {
    PageHeader: PageHeader
  },

  mixins: [Progress, Utils],

  data() {
    return {
      apartements: [],

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

  mounted() {
    this.fetch();
  },

  methods: {
    fetch() {
      let uri = "/api/apartements/get";
      this.axios.get(uri).then(response => {
        this.apartements = response.data.data;
      });
    },

    destroy(id, event) {
      if (confirm("Please confirm!")) {
        let uri = `/api/apartement/destroy/${id}`;
        let el = this.progress(event.target);
        this.axios.delete(uri).then(response => {
          this.fetch();
          this.$notify({ type: "success", text: "Objekt gelöscht" });
          this.progress(el);
        });
      }
    }
  }
};
</script>
<style>
sup {
  font-size: 11px;
}

.list-item-grid {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
}

</style>
