<template>
  <div class="row">
    <div class="col-6">
      <div class="form-group">
        Guest Name (From)
        <input
          type="text"
          class="form-control"
          v-if="prReservation"
          :value="
            prReservation.account.account_name +
              ' ' +
              prReservation.confirmation_id
          "
          readonly
        />
      </div>
      <div class="boxbox">
        <draggable
          class="list-group"
          :list="transactions"
          group="grReservations"
        >
          <div
            class="list-group-item"
            v-for="element in transactions"
            :key="element.id"
          >
            {{ element.transaction.memo }} {{ element.amount }}
          </div>
        </draggable>
      </div>
    </div>

    <div class="col-6">
      <div class="form-group">
        Guest Name (To)
        <select
          name=""
          id=""
          class="form-control"
          v-if="reservations"
          @change="getTransactions"
          v-model="form.newReservation"
        >
          <option value="">--Select--</option>
          <option
            v-for="(guest, key) in filteredReservations"
            :key="key"
            :value="guest.id"
            v-text="guest.account.account_name + ' ' + guest.confirmation_id"
          ></option>
        </select>
      </div>

      <div class="boxbox">
        Drag Here

        <draggable
          class="list-group"
          :list="transactionsTo"
          group="grReservations"
          @change="log"
        >
          <div
            class="list-group-item"
            v-for="element in transactionsTo"
            :key="element.id"
          >
            {{ element.transaction.memo }} {{ element.amount }}
          </div>
        </draggable>
      </div>
    </div>
  </div>
</template>
<script>
import draggable from "vuedraggable";
import Form from "../../core/Form";
export default {
  props: ["prReservation", "prTransactions"],
  name: "two-lists",
  display: "Two Lists",
  order: 1,
  components: {
    draggable
  },
  data() {
    return {
      form: new Form({
        transaction: null,
        newReservation: null,
        action: "removed"
      }),
      reservations: [],
      transactions: null,
      transactionsTo: []
    };
  },
  methods: {
    getTransactions() {
      window.axios
        .get("/api/reservation/" + this.prReservation.id + "/transactions/debit")
        .then(response => {
          //console.log(response.data.transactions.length);
          if (response.data.length == 0) {
            alert("No transaction found!");
            return;
          }
          this.transactions = response.data;
        })
        .catch(errors => {
          console.log(errors);
        });
    },
    getReservations() {
      window.axios
        .get("/api/checked-in/reservations")
        .then(response => {
          this.reservations = response.data;
        })
        .catch(errors => {
          console.log(errors);
        });
    },

    updateTransaction() {
      this.form
        .submit("put", "/guest-transaction/update")
        .then(response => {
          alert("Transaction has been successfully updated!");
        })
        .catch(errors => {
          console.log(errors.errors);
          this.transactionsTo = [];
          alert(errors.message);
        });
    },
    log(evt) {
      console.log(evt);
      if (evt.added) {
        this.form.transaction = evt.added.element.id;
      } else {
        this.form.newReservation = this.prReservation.id;
      }
      this.updateTransaction();
    }
  },
  computed: {
    filteredReservations() {
      return this.reservations.filter(
        reservation => reservation.id != this.prReservation.id
      );
    }
  },
  created() {
    this.getReservations();
  }
};
</script>
<style scoped>
.boxbox {
  width: 100%;
  height: 300px;
  border: 1px solid grey;
  padding: 5px;
}
</style>
