<template>
  <div>
    <form
      v-on:submit.prevent="handleSubmitAddTransaction"
      v-on:keyup="form.errors.clear($event.target.name)"
    >
      <div class="form-group">
        <label for="status">Transaction</label>
        <multiselect
          v-model="transaction"
          :options="transactions"
          :allow-empty="false"
          label="memo"
          track-by="id"
          @select="onSelectTransaction"
        ></multiselect>

        <span
          class="text-danger"
          v-if="form.errors.any('transaction_id')"
          v-text="form.errors.get('transaction_id')"
        ></span>
      </div>

      <div class="form-group">
        <label for="status">Amount</label>
        <input type="text" class="form-control" v-model="form.amount">

        <span
          class="text-danger"
          v-if="form.errors.any('amount')"
          v-text="form.errors.get('amount')"
        ></span>
      </div>

      <button type="submit" class="btn btn-primary">Save changes</button>
    </form>
  </div>
</template>

<script>
import Form from "../../core/Form.js";
import Multiselect from "vue-multiselect";

export default {
  props: ["reservation"],
  components: {
    Multiselect
  },
  data() {
    return {
      form: new Form({
        reservation_id: "",
        transaction_id: "",
        amount: ""
      }),
      localReservation: "",
      transaction: "",
      transactions: [],
    };
  },
  methods: {
    handleSubmitAddTransaction() {
      this.form
        .submit("post", "/guest/transaction/create")
        .then(response => {
          alert("Guest Transaction has been created!");
        })
        .catch(errors => {
          console.log(errors.errors);
          alert(errors.message);
        });
    },
    fetchTransactions() {
      window.axios
        .get("/api/transactions")
        .then(response => {
          this.transactions = response.data;
        })
        .catch(errors => {
          console.log(errors);
        });
    },
    onSelectTransaction(selectedItem) {
      this.form.transaction_id = selectedItem.id;
      this.form.reservation_id = this.reservation.id;
    }
  },
  created(){
    this.localReservation = this.reservation;
    this.fetchTransactions();
  },
  computed: {
    // compRes() {
    //   return (this.localReservations = this.reservations);
    // }
  }
};
</script>
