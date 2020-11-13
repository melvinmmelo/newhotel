<template>
  <div>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <div><a href="/accounts">New guest? Click to add.</a></div>
      <div><a href="/companies">New company? Click to add.</a></div>
      <div><a href="/travel-agents">New travel agent? Click to add.</a></div>
      <button
        type="button"
        class="close"
        data-dismiss="alert"
        aria-label="Close"
      >
        <span aria-hidden="true">&times;</span>
      </button>
      <hr />
      <h4 class="alert-heading">
        <strong class="text-danger">!!!</strong> Add the details first to the
        master record, before reservation.
      </h4>
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
          id="arrival_date"
          v-model="form.arrival_date"
          format="YYYY-MM-DD HH:mm"
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
          id="departure_date"
          v-model="form.departure_date"
          format="YYYY-MM-DD HH:mm"
        ></vue-ctk-date-time-picker>
        <span
          class="text-danger"
          v-if="form.errors.any('departure_date')"
          v-text="form.errors.get('departure_date')"
        ></span>
      </div>

      <div class="form-group">
        <label for="nights">Number of Night</label>
        <input
          type="number"
          class="form-control"
          id="nights"
          v-model="form.nights"
          @focus="getNightsNo()"
          readonly
        />
        <span
          class="text-danger"
          v-if="form.errors.any('nights_no')"
          v-text="form.errors.get('nights_no')"
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
          @focus="getNightsNo()"
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
        <label for="child_no">Guarantee Type</label>
        <select
          id="status"
          class="form-control"
          v-model="form.guarantee_type"
          @change="toggleGuarantee"
        >
          <option value="GCO">Guaranteed by Company (GCO)</option>
          <option value="GTA">Guaranteed by Travel Agency (GTA)</option>
          <option value="GCC">Guaranteed by Credit Card (GCC)</option>
          <option value="GDP"
            >Guaranteed by Cash/Cheque/Bank Deposit (GDP)</option
          >
          <option value="NON">Non-guaranteed Booking (NON)</option>
        </select>
        <span
          class="text-danger"
          v-if="form.errors.any('guarantee_type')"
          v-text="form.errors.get('guarantee_type')"
        ></span>
      </div>

      <div
        class="form-group"
        v-if="form.guarantee_type == 'GCO' || form.guarantee_type == 'GTA'"
      >
        <label for="order_number">LPO Number</label>
        <input
          type="text"
          id="order_number"
          class="form-control"
          v-model="form.order_number"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('order_number')"
          v-text="form.errors.get('order_number')"
        ></span>
      </div>

      <div class="form-group">
        <label for="payment_mode">Payment Mode</label>
        <select
          name="payment_mode"
          id="payment_mode"
          class="form-control"
          v-model="form.payment_mode"
          @change="togglePaymentMode"
        >
          <option value="">--Select--</option>
          <option value="Cash">Cash</option>
          <option value="Debit">Debit Card</option>
          <option value="Credit Card">Credit Card</option>
          <option value="Cheque">Cheque</option>
        </select>

        <span
          class="text-danger"
          v-if="form.errors.any('payment_mode')"
          v-text="form.errors.get('payment_mode')"
        ></span>
      </div>

      <div class="form-group">
        <label for="billing_instruction">Billing Instruction</label>
        <input
          type="text"
          class="form-control"
          v-model="form.billing_instruction"
        />

        <span
          class="text-danger"
          v-if="form.errors.any('billing_instruction')"
          v-text="form.errors.get('billing_instruction')"
        ></span>
      </div>

      <div id="creditCard" v-show="showCreditCardForm">
        <img v-if="amexCard" src="/images/amex.png" width="8%" alt="Amex" />
        <img
          v-if="masterCard"
          src="/images/mastercard.png"
          width="8%"
          alt="Mastercard"
        />
        <img v-if="visaCard" src="/images/visa.png" width="8%" alt="Visa" />
        <img
          v-if="discoverCard"
          src="/images/discover.png"
          width="8%"
          alt="Discover"
        />
        <div class="form-group">
          <label for="cc_no">Card No.</label>
          <input
            type="text"
            class="form-control"
            v-model="form.cc_no"
            maxlength="16"
            @keyup="ccTypeLogToggle"
          />

          <span
            class="text-danger"
            v-if="form.errors.any('cc_no')"
            v-text="form.errors.get('cc_no')"
          ></span>
        </div>

        <div class="form-group">
          <label for="cc_exp_date">Expiry Date</label>
          <input type="text" class="form-control" v-model="form.cc_exp_date" />

          <span
            class="text-danger"
            v-if="form.errors.any('cc_exp_date')"
            v-text="form.errors.get('cc_exp_date')"
          ></span>

          <label for="cvv">CVV</label>
          <input
            type="password"
            class="form-control"
            v-model="form.cvv"
            maxlength="3"
          />

          <span
            class="text-danger"
            v-if="form.errors.any('cvv')"
            v-text="form.errors.get('cvv')"
          ></span>
        </div>
      </div>

      <div id="cheque" v-show="showChequeForm">
        <div class="form-group">
          <label for="amount">Amount</label>
          <input type="text" class="form-control" v-model="form.amount" />

          <span
            class="text-danger"
            v-if="form.errors.any('amount')"
            v-text="form.errors.get('amount')"
          ></span>
        </div>
      </div>

      <div class="form-group">
        <label for="purpose">Purpose</label>

        <select id="purpose" class="form-control" v-model="form.purpose">
          <option value="">--Select--</option>
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
        <label for="request">Request</label>
        <input
          type="text"
          name="request"
          id="request"
          class="form-control"
          v-model="form.request"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('request')"
          v-text="form.errors.get('request')"
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

      <div class="form-group">
        <label for="room_id">Room Category</label>

        <div class="row">
          <div class="col-lg-4 col-sm-4">
            <button
              type="button"
              class="btn mr-2 w-100"
              :class="makePrimary('STANDARD')"
              @click="
                selectRoomType('STANDARD');
                fetchRoomReservePrice();
              "
            >
              Standard
            </button>
          </div>

          <div class="col-lg-4 col-sm-4">
            <button
              type="button"
              class="btn mr-2 w-100"
              :class="makePrimary('PREMIUM')"
              @click="
                selectRoomType('PREMIUM');
                fetchRoomReservePrice();
              "
            >
              Premium
            </button>
          </div>

          <div class="col-lg-4 col-sm-4">
            <button
              type="button"
              class="btn mr-2 w-100"
              :class="makePrimary('SUITE')"
              @click="
                selectRoomType('SUITE');
                fetchRoomReservePrice();
              "
            >
              Suite
            </button>
          </div>
        </div>
        <span
          class="text-danger"
          v-if="form.errors.any('room_category_code')"
          v-text="form.errors.get('room_category_code')"
        ></span>
      </div>

      <div class="form-group">
        <label for="rack_rate_code">Rate Type</label>
        <select
          class="form-control"
          v-model="form.rack_rate_code"
          @change="fetchRoomReservePrice()"
        >
          <option value="BAR">Rack Rate</option>
          <option value="BB">Room With Breakfast</option>
          <option value="COR">Corporate</option>
          <option value="TA">Travel Agency</option>
        </select>
        <span
          class="text-danger"
          v-if="form.errors.any('rack_rate_code')"
          v-text="form.errors.get('rack_rate_code')"
        ></span>
      </div>

      <div class="form-group">
        <label for="total_amount">Total Amount</label>
        <input
          type="text"
          id="total_amount"
          class="form-control"
          v-model="form.total_amount"
          readonly
        />

        <span
          class="text-danger"
          v-if="form.errors.any('total_amount')"
          v-text="form.errors.get('total_amount')"
        ></span>
      </div>

      <button type="submit" class="btn btn-primary">
        Reserve
      </button>
    </form>

    <modal
      v-show="reservationConfirmationModal"
      title="Notification"
      @close="reservationConfirmationModal = false"
    >
      Your Confirmation Id is {{ confirmationId }}
      <div>
        <a href="/reservations" class="btn btn-sm btn-primary">Reservations</a>
      </div>
    </modal>
  </div>
</template>

<script>
import Modal from "../../components/Modal";
import Multiselect from "vue-multiselect";
import Form from "../../core/Form.js";
import VueCtkDateTimePicker from "vue-ctk-date-time-picker";
import "vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css";

import moment from "moment";

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
        cc_type: "",
        cc_no: "",
        cc_exp_date: "",
        cvv: "",
        amount: "",
        nights: 0,
        request: "",
        status: "",
        billing_instruction: "",
        room_category_code: "",
        rack_rate_code: "BAR",
        total_amount: 0,
        order_number: "",
        guarantee_type: "GCO"
      }),
      account: [],
      company: [],
      travelAgent: [],
      accounts: [],
      travelAgents: [],
      companies: [],
      showCreditCardForm: false,
      showChequeForm: false,
      selectedRoomType: "STANDARD",
      confirmationId: "",
      reservationConfirmationModal: false,
      amexCard: false,
      masterCard: false,
      visaCard: false,
      discoverCard: false
    };
  },
  components: {
    Modal,
    Multiselect,
    VueCtkDateTimePicker
  },
  methods: {
    handleSubmit() {
      this.form
        .submit("post", "/reservation/create")
        .then(response => {
          //this.$emit("submitReservation", response);
          //console.log(response)
          this.confirmationId = response.confirmation_id;
          this.reservationConfirmationModal = true;
          console.log(response);
          //alert("Reservation added successfully!");
        })
        .catch(errors => {
          console.log(errors);
          alert(errors.message);
        });
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
    fetchRoomReservePrice() {
      window.axios
        .get(
          "/api/reservation-price/" +
            this.form.room_category_code +
            "/" +
            this.form.rack_rate_code
        )
        .then(response => {
          //console.log(response)
          this.form.total_amount = response.data.amount;
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
    toggleGuarantee() {
      if (this.form.guarantee_type == "GCC") {
        this.showCreditCardForm = true;
        this.form.payment_mode = "Credit Card";
      } else {
        this.showCreditCardForm = false;
      }
      if (this.form.guarantee_type == "GDP") {
        this.showChequeForm = true;
        this.form.payment_mode = "Cheque";
      } else {
        this.showChequeForm = false;
      }
    },
    togglePaymentMode() {
      if (this.form.payment_mode == "Credit Card") {
        this.showCreditCardForm = true;
      } else {
        this.showCreditCardForm = false;
      }
      if (this.form.payment_mode == "Cheque") {
        this.showChequeForm = true;
      } else {
        this.showChequeForm = false;
      }
    },
    getNightsNo() {
      var date1 = new Date(this.form.arrival_date);
      var date2 = new Date(this.form.departure_date);
      var timeDiff = Math.abs(date2.getTime() - date1.getTime());
      var numberOfNights = Math.ceil(timeDiff / (1000 * 3600 * 24));

      this.form.nights = numberOfNights;
    },
    makePrimary(key) {
      if (this.selectedRoomType == key) {
        this.form.room_category_code = key;
        return "btn-danger";
      } else {
        return "btn-secondary";
      }
    },
    selectRoomType(key) {
      this.selectedRoomType = key;
      this.form.room_category_code = key;
    },
    ccTypeLogToggle() {
      if (this.form.cc_no.charAt(0) == 3) {
        this.amexCard = true;
        this.masterCard = false;
        this.visaCard = false;
        this.discoverCard = false;
      } else if (this.form.cc_no.charAt(0) == 4) {
        this.visaCard = true;
        this.amexCard = false;
        this.masterCard = false;
        this.discoverCard = false;
      } else if (this.form.cc_no.charAt(0) == 5) {
        this.visaCard = false;
        this.amexCard = false;
        this.masterCard = true;
        this.discoverCard = false;
      } else if (this.form.cc_no.charAt(0) == 6) {
        this.visaCard = false;
        this.amexCard = false;
        this.masterCard = false;
        this.discoverCard = true;
      } else {
        this.visaCard = false;
        this.amexCard = false;
        this.masterCard = false;
        this.discoverCard = false;
      }
    }
  },
  created() {
    this.fetchAccounts();
    this.fetchCompanies();
    this.fetchTravelAgents();
  },
  computed: {}
};
</script>
