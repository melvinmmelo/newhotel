<template>
  <div>
    <div class="row">
      <div class="col-md-8 mb-2">
        <card>
          <template slot="header">Transaction List</template>
          <template slot="body">
            <transaction-list
              :transactions="localTransactions"
            ></transaction-list>
          </template>
        </card>
      </div>

      <div class="col-md-4">
        <card>
          <template slot="header">Add Here</template>
          <template slot="body">
            <transaction-form v-on:dateIn="applied"></transaction-form>
          </template>
        </card>
      </div>
    </div>
  </div>
</template>

<script>
import TransactionForm from "./TransactionForm.vue";
import TransactionList from "./TransactionList.vue";
export default {
  props: ["items"],
  components: { TransactionForm, TransactionList },
  data() {
    return {
      localTransactions: ""
    };
  },
  methods: {
    applied(data) {
      this.localTransactions.unshift(data);
    }
  },
  created() {
    this.localTransactions = this.items;
  }
};
</script>
