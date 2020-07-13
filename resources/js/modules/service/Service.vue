<template>
  <div>
    <div class="row">
      <div class="col-md-8">
        <card>
          <template slot="header">Service List</template>
          <template slot="body">
            <service-list :services="localServices"></service-list>
          </template>
        </card>
      </div>

      <div class="col-md-4">
        <card>
          <template slot="header">Add Here</template>
          <template slot="body">
            <service-form v-on:dateIn="applied"></service-form>
          </template>
        </card>
      </div>
    </div>
  </div>
</template>

<script>
import ServiceForm from "./ServiceForm.vue";
import ServiceList from "./ServiceList.vue";
export default {
  props: ["items"],
  components: { ServiceForm, ServiceList },
  data() {
    return {
      localServices: ""
    };
  },
  methods: {
    applied(data) {
      this.localServices.unshift(data);
    }
  },
  created() {
    this.localServices = this.items;
  }
};
</script>
