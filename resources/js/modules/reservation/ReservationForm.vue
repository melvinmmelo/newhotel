<template>
  <div>



    <div class="alert alert-danger alert-dismissible fade show" role="alert">

  <div><a href="/accounts">New guest? Click to add.</a></div>
  <div><a href="/companies">New company? Click to add.</a></div>
  <div><a href="/travel-agents">New travel agent? Click to add.</a></div>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
<hr>
<h4 class="alert-heading"> <strong class="text-danger">!!!</strong> Add the details first to the master record, before reservation.</h4>
</div>


    <form
      v-on:submit.prevent="handleSubmit"
      v-on:keyup="form.errors.clear($event.target.name)"
    >
      <div class="form-group">
        <label for="name">Guest Name</label>
        <multiselect
          v-model="account"
          :options="accounts"
          :allow-empty="false"
          label="last_name"
          placeholder="Pick a value"
          @select="onSelectAccount"
          :custom-label="accountName"
        ></multiselect>

        <span
          class="text-danger"
          v-if="form.errors.any('account_id')"
          v-text="form.errors.get('account_id')"
        ></span>
      </div>

      <div class="form-group">
        <label for="company_id">Company</label>
        <multiselect
          v-model="company"
          :options="companies"
          :allow-empty="false"
          label="name"
          track-by="id"
          @select="onSelectCompany"
        ></multiselect>

        <span
          class="text-danger"
          v-if="form.errors.any('company_id')"
          v-text="form.errors.get('company_id')"
        ></span>
      </div>

      <div class="form-group">
        <label for="tragel_agent_id">Travel Agent</label>
        <multiselect
          v-model="travelAgent"
          :options="travelAgents"
          :allow-empty="false"
          label="name"
          track-by="id"
          @select="onSelectTA"
        ></multiselect>

        <span
          class="text-danger"
          v-if="form.errors.any('tragel_agent_id')"
          v-text="form.errors.get('tragel_agent_id')"
        ></span>
      </div>

      <div class="form-group">
      <label for="arrival_date">Arrival Date</label>
      <vue-ctk-date-time-picker
        v-model="form.arrival_date"
        format="YYYY-MM-DD HH:mm:ss"
      ></vue-ctk-date-time-picker>

      <span
        class="text-danger"
        v-if="form.errors.any('arrival_date')"
        v-text="form.errors.get('arrival_date')"
      ></span>
    </div>
    <div class="form-group">
      <label for="departure_date">Departure Date</label>
      <vue-ctk-date-time-picker
        v-model="form.departure_date"
        format="YYYY-MM-DD HH:mm:ss"
      ></vue-ctk-date-time-picker>
      <span
        class="text-danger"
        v-if="form.errors.any('departure_date')"
        v-text="form.errors.get('departure_date')"
      ></span>
    </div>

      <div class="form-group">
        <label for="adult_no">No. of adult</label>
        <input
          type="number"
          name="adult_no"
          id="adult_no"
          class="form-control"
          v-model="form.adult_no"
        />

        <span
          class="text-danger"
          v-if="form.errors.any('adult_no')"
          v-text="form.errors.get('adult_no')"
        ></span>
      </div>
      <div class="form-group">
        <label for="child_no">No. of child</label>
        <input
          type="number"
          name="child_no"
          id="child_no"
          class="form-control"
          v-model="form.child_no"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('child_no')"
          v-text="form.errors.get('child_no')"
        ></span>
      </div>

      <div class="form-group">
        <label for="payment_mode">Payment Mode</label>
        <select
          name="payment_mode"
          id="payment_mode"
          class="form-control"
          v-model="form.payment_mode"
          @change="togglePaymentForm"
        >
          <option value="">--Select--</option>
          <option value="Cash">Cash</option>
          <option value="Cash">Debit Card</option>
          <option value="Credit Card">Credit Card</option>
          <option value="Cheque">Cheque</option>
        </select>

        <span
          class="text-danger"
          v-if="form.errors.any('payment_mode')"
          v-text="form.errors.get('payment_mode')"
        ></span>
      </div>

      <div id="creditCard" v-show="showCreditCardForm">

        <div class="form-group">
          <label for="payment_mode">Card No.</label>
          <input type="text" class="form-control" v-model="form.cc_no">

          <span
            class="text-danger"
            v-if="form.errors.any('cc_no')"
            v-text="form.errors.get('cc_no')"
          ></span>
        </div>

        <div class="form-group">
          <label for="payment_mode">Expiry Date</label>
          <input type="text" class="form-control" v-model="form.cc_exp_date">

          <span
            class="text-danger"
            v-if="form.errors.any('cc_exp_date')"
            v-text="form.errors.get('cc_exp_date')"
          ></span>

          <label for="payment_mode">CCV</label>
          <input type="text" class="form-control" v-model="form.ccv">

          <span
            class="text-danger"
            v-if="form.errors.any('ccv')"
            v-text="form.errors.get('ccv')"
          ></span>

        </div>

      </div>

      <div id="cheque" v-show="showChequeForm">

        <div class="form-group">
          <label for="payment_mode">Bank</label>
          <input type="text" class="form-control" v-model="form.cheque_bank">

          <span
            class="text-danger"
            v-if="form.errors.any('cheque_bank')"
            v-text="form.errors.get('cheque_bank')"
          ></span>
        </div>

        <div class="form-group">
          <label for="payment_mode">Cheque No.</label>
          <input type="text" class="form-control" v-model="form.cheque_no">

          <span
            class="text-danger"
            v-if="form.errors.any('cheque_no')"
            v-text="form.errors.get('cheque_no')"
          ></span>

          <label for="payment_mode">Cheque Amount</label>
          <input type="text" class="form-control" v-model="form.cheque_amount">

          <span
            class="text-danger"
            v-if="form.errors.any('cheque_amount')"
            v-text="form.errors.get('cheque_amount')"
          ></span>

        </div>

      </div>

      <div class="form-group">
        <label for="purpose">Purpose</label>

        <select name="" id="" class="form-control" v-model="form.purpose">
          <option value="Corporate">Corporate</option>
          <option value="Group">Group</option>
          <option value="Travel">Travel</option>
          <option value="Business">Business</option>
          <option value="Personal">Personal</option>
          <option value="Other">Other</option>
        </select>
        <span
          class="text-danger"
          v-if="form.errors.any('purpose')"
          v-text="form.errors.get('purpose')"
        ></span>
      </div>
      <div class="form-group">
        <label for="remarks">Remarks</label>
        <input
          type="text"
          name="remarks"
          id="remarks"
          class="form-control"
          v-model="form.remarks"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('remarks')"
          v-text="form.errors.get('remarks')"
        ></span>
      </div>

      <button type="submit" class="btn btn-primary">
        Reserve
      </button>
    </form>
  </div>
</template>

<script>
import Multiselect from "vue-multiselect";
import Form from "../../core/Form.js";
import VueCtkDateTimePicker from "vue-ctk-date-time-picker";
import "vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css";

export default {
  data() {
    return {
      form: new Form({
        account_id: "",
        company_id: "",
        travel_agent_id: "",
        adult_no: "",
        child_no: "",
        payment_mode: "",
        purpose: "",
        remarks: "",
        user_id: "",
        arrival_date: "",
        departure_date: "",
        cc_no: "",
        cc_exp_date: "",
        ccv: "",
        cheque_bank: "",
        cheque_no: "",
        cheque_amount: "",
        reset: false,
      }),
      account: [],
      company: [],
      travelAgent: [],
      accounts: [],
      travelAgents: [],
      companies: [],
      showCreditCardForm: false,
      showChequeForm: false
    };
  },
  components: {
    Multiselect,
    VueCtkDateTimePicker
  },
  methods: {
    handleSubmit() {
      this.form
        .submit("post", "/reservation/create")
        .then(response => {
          this.$emit("submitReservation", response);
          alert("You may proceed in adding room(s)!");
        })
        .catch(errors => alert(errors.message));
    },
    accountName({ last_name, first_name }) {
      return `${last_name}, ${first_name}`;
    },
    fetchAccounts() {
      window.axios
        .get("/api/accounts")
        .then(response => {
          this.accounts = response.data;
        })
        .catch(errors => {
          console.log(errors.response.data.errors);
        });
    },
    fetchCompanies() {
      window.axios
        .get("/api/companies")
        .then(response => {
          this.companies = response.data;
        })
        .catch(errors => {
          console.log(errors.response.data.errors);
        });
    },
    fetchTravelAgents() {
      window.axios
        .get("/api/travel-agents")
        .then(response => {
          this.travelAgents = response.data;
        })
        .catch(errors => {
          console.log(errors.response.data.errors);
        });
    },
    onSelectAccount(selectedItem) {
      this.form.account_id = selectedItem.id;
    },
    onSelectCompany(selectedItem) {
      this.form.company_id = selectedItem.id;
    },
    onSelectTA(selectedItem) {
      this.form.travel_agent_id = selectedItem.id;
    },
    togglePaymentForm(){
      if (this.form.payment_mode == 'Credit Card'){
        this.showCreditCardForm = true;
      }else{
        this.showCreditCardForm = false;
      }
      if (this.form.payment_mode == 'Cheque'){
        this.showChequeForm = true;
      }else{
        this.showChequeForm = false;
      }
    }
  },
  created() {
    this.fetchAccounts();
    this.fetchCompanies();
    this.fetchTravelAgents();
  }
};
</script>
