<template>
  <div>
    <div class="row">
       <div class="col-md-4">
        <card>
          <template slot="header">Add Here</template>
          <template slot="body">
            <company-form v-on:dateIn="applied"></company-form>
          </template>
        </card>
      </div>

      <div class="col-md-8">
        <card>
          <template slot="header">Company List</template>
          <template slot="body">
            <company-list :companies="localCompanies"></company-list>
          </template>
        </card>
      </div>


    </div>
  </div>
</template>

<script>
import CompanyForm from "./CompanyForm.vue";
import CompanyList from "./CompanyList.vue";
export default {
  props: ["items"],
  components: { CompanyForm, CompanyList },
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
