<template>
  <div>
    <div class="row">
      <div class="col-md-8">
        <card>
          <template slot="header">Promo List</template>
          <template slot="body">
            <promo-list :promos="localCompanies"></promo-list>
          </template>
        </card>
      </div>

      <div class="col-md-4">
        <card>
          <template slot="header">Add Here</template>
          <template slot="body">
            <promo-form v-on:dateIn="applied"></promo-form>
          </template>
        </card>
      </div>
    </div>
  </div>
</template>

<script>
import PromoForm from "./PromoForm.vue";
import PromoList from "./PromoList.vue";
export default {
  props: ["items"],
  components: { PromoForm, PromoList },
  data() {
    return {
      localCompanies: ""
    };
  },
  methods: {
    applied(data) {
      this.localCompanies.unshift(data);
    }
  },
  created() {
    this.localCompanies = this.items;
  }
};
</script>
