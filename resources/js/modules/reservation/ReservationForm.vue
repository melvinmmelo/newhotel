<template>
  <div>
    <form
      v-on:submit.prevent="handleSubmit"
      v-on:keyup="form.errors.clear($event.target.name)"
    >
      <div class="form-group">
        <label for="name">Account</label>
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
        <label for="adult_no">No. of adults</label>
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
        >
          <option value="">--Select--</option>
          <option value="Cash">Cash</option>
          <option value="Credit Card">Credit Card</option>
          <option value="Deposit">Bank Deposit</option>
        </select>

        <span
          class="text-danger"
          v-if="form.errors.any('payment_mode')"
          v-text="form.errors.get('payment_mode')"
        ></span>
      </div>
      <div class="form-group">
        <label for="purpose">Purpose</label>
        <input
          type="text"
          name="purpose"
          id="purpose"
          class="form-control"
          v-model="form.purpose"
        />
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
        Submit
      </button>
    </form>
  </div>
</template>

<script>
import Multiselect from "vue-multiselect";
import Form from "../../core/Form.js";

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
        reset: false
      }),
      account: [],
      company: [],
      travelAgent: [],
      accounts: [],
      travelAgents: [],
      companies: []
    };
  },
  components: {
    Multiselect
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
    }
  },
  created() {
    this.fetchAccounts();
    this.fetchCompanies();
    this.fetchTravelAgents();
  }
};
</script>
