<template>
  <div>
    <div class="row">
      <div class="col-lg-4 mb-2">
        <card>
          <template slot="header">Add Here</template>
          <template slot="body">
            <account-form v-on:dateIn="applied"></account-form>
          </template>
        </card>
      </div>

      <div class="col-lg-8">
        <card>
          <template slot="header">Guest List</template>
          <template slot="body">
            <account-list :accounts="localAccounts"></account-list>
          </template>
        </card>
      </div>
    </div>
  </div>
</template>

<script>
import AccountForm from "./AccountForm.vue";
import AccountList from "./AccountList.vue";
export default {
  props: ["items"],
  components: { AccountForm, AccountList },
  data() {
    return {
      localAccounts: ""
    };
  },
  methods: {
    applied(data) {
      this.localAccounts.unshift(data);
    }
  },
  created() {
    this.localAccounts = this.items;
  }
};
</script>
