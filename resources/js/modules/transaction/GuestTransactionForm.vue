<template>
  <div>
    <form
      v-on:submit.prevent="handleSubmitAddTransaction"
      v-on:keyup="form.errors.clear($event.target.name)"
    >
      <div class="form-group">
        <label for="account_id">Account</label>
        <multiselect
          v-model="reservation"
          :options="compRes"
          :allow-empty="false"
          label="name"
          track-by="id"
          :custom-label="reservationName"
          @select="onSelectReservation"
        ></multiselect>
      </div>
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
      </div>

      <button type="submit" class="btn btn-primary">Save changes</button>
    </form>
  </div>
</template>

<script>
import Form from "../../core/Form";
import Multiselect from "vue-multiselect";

export default {
  props: ["reservations"],
  components: {
    Multiselect
  },
  data() {
    return {
      formAddTransaction: new Form({
        reservation_id: "",
        transaction_id: ""
      }),
      transaction: "",
      transactions: [],
      reservation: "",
      localReservations: ""
    };
  },
  methods: {
    handleSubmitAddTransaction() {
      this.formAddTransaction
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
    onSelectReservation(selectedItem) {
      if (this.transactions.count == undefined) {
        this.fetchTransactions();
      }

      this.formAddTransaction.reservation_id = selectedItem.id;
    },
    onSelectTransaction(selectedItem) {
      this.formAddTransaction.transaction_id = selectedItem.id;
    },
    reservationName({ id, account }) {
      return `${account.last_name}, ${account.first_name} - ${id}`;
    }
  },
  computed: {
    compRes() {
      return (this.localReservations = this.reservations);
    }
  }
};
</script>
