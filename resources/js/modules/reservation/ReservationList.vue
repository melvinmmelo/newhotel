<template>
  <div class="">
    <div class="row">
      <div class="col-lg-4 col-sm-4 mb-2">
        <div class="card mb-2">
          <div class="card-body">
            <h5 class="card-title">Tools</h5>
            <h6 class="card-subtitle mb-2 text-muted">
              You can add or update reservations here.
            </h6>

            <!-- <button class="btn btn-secondary mb-2" @click="showAddServiceModal = true"
      >Add Service</button
    > -->
            <div class="form-group">
              <label for="">Search by status</label>
              <select name="" id="" class="form-control" v-model="status">
                <option value="TENTATIVE">TENTATIVE</option>
                <option value="CONFIRMED">CONFIRMED</option>
                <option value="CHECKED IN">CHECKED IN</option>
                <option value="CHECKED OUT">CHECKED OUT</option>
                <option value="NO SHOW">NO SHOW</option>
                <option value="CANCELLED">CANCELLED</option>
              </select>
            </div>

            <div class="form-group">
              <label for=""
                >Search by Confirmation Id/Last Name/Guest Name</label
              >
              <input
                type="text"
                class="form-control"
                v-model="keyGuestName"
                :keydown="filteredByStatusReservations"
              />
              <small class="badge badge-default" @click="keyGuestName = ''"
                >Clear</small
              >
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8 col-sm-8 mb-2">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{ status }}</h5>
            <div class="table-responsive">
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th>Confirmation ID</th>
                    <th>Name</th>
                    <th>Reserved At | Updated At</th>
                    <th>#</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="(item, key) in filteredByStatusReservations"
                    :key="key"
                  >
                    <td>{{ item.confirmation_id }}</td>
                    <td>
                      {{ item.account.account_name }}
                    </td>
                    <td>{{ item.created_at + " | " + item.updated_at }}</td>
                    <td>
                      <div class="btn-group">
                        <a
                          @click="
                            viewReservation(item);
                            fetchRoomsPerType(item.room_category_code);
                            showViewReservationModal = true;
                          "
                          ><button
                            class="btn btn-secondary btn-sm"
                            type="button"
                          >
                            View
                          </button></a
                        >
                        <button
                          type="button"
                          class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split"
                          data-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item">#</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <modal
      v-show="showViewReservationModal"
      :title="modalTitleViewReservation"
      @close="showViewReservationModal = false"
    >
      <div class="responsiveModal" v-if="reservation">
        <div class="form-group">
          Guest name:
          <h4>
            {{ reservation.account.account_name }}
            <span class="badge badge-danger">{{ reservation.status }}</span>
          </h4>
        </div>

        <table class="w-100">
          <tr v-if="reservation.company">
            <td>Company</td>
            <td>{{ reservation.company.name }}</td>
          </tr>
          <tr v-if="reservation.travel_agent">
            <td>Travel Agent</td>
            <td>{{ reservation.travel_agent.name }}</td>
          </tr>
          <tr>
            <td>Arrival Date</td>
            <td>{{ reservation.arrival_date }}</td>
          </tr>
          <tr>
            <td>Departure Date</td>
            <td>{{ reservation.departure_date }}</td>
          </tr>
          <tr>
            <td>Nights</td>
            <td>{{ reservation.nights }}</td>
          </tr>
          <tr>
            <td>Adult | Child</td>
            <td>{{ reservation.adult_no + " | " + reservation.child_no }}</td>
          </tr>
          <tr>
            <td>Payment Mode</td>
            <td>{{ reservation.payment_mode }}</td>
          </tr>
          <tr v-if="reservation.payment_mode == 'Credit Card'">
            <td>Card Type</td>
            <td>{{ reservation.cc_type }}</td>
          </tr>
          <tr v-if="reservation.payment_mode == 'Credit Card'">
            <td>Card No</td>
            <td>{{ reservation.cc_no }}</td>
          </tr>
          <tr v-if="reservation.payment_mode == 'Cheque'">
            <td>Bank</td>
            <td>{{ reservation.bank }}</td>
          </tr>
          <tr v-if="reservation.payment_mode == 'Cheque'">
            <td>Cheque/Acct No.</td>
            <td>{{ reservation.cheque_acct_no }}</td>
          </tr>
          <tr v-if="reservation.amount">
            <td>Amount</td>
            <td>{{ reservation.amount }}</td>
          </tr>
          <tr>
            <td>Guarantee</td>
            <td>{{ reservation.guarantee_type }}</td>
          </tr>
          <tr v-if="reservation.order_number">
            <td>LPO Number</td>
            <td>{{ reservation.order_number }}</td>
          </tr>
          <tr>
            <td>Billing Instruction</td>
            <td>{{ reservation.billing_instruction }}</td>
          </tr>
          <tr>
            <td>Purpose</td>
            <td>{{ reservation.purpose }}</td>
          </tr>
          <tr>
            <td>Request</td>
            <td>{{ reservation.request }}</td>
          </tr>
          <tr v-if="reservation.remarks">
            <td>Remarks</td>
            <td>{{ reservation.remarks }}</td>
          </tr>
          <tr>
            <td>R. Category & Rate</td>
            <td>
              {{
                reservation.room_category_code +
                  " " +
                  reservation.rack_rate_code
              }}
            </td>
          </tr>

          <tr v-if="reservation.confirmed_at">
            <td>Confirmed at</td>
            <td>{{ reservation.confirmed_at }}</td>
          </tr>

          <tr v-if="reservation.checkedout_at">
            <td>Checked Out Date</td>
            <td>{{ reservation.checkedout_at }}</td>
          </tr>

          <tr>
            <td v-if="reservation.room_no">Room No.</td>
            <td>{{ reservation.room_no }}</td>
          </tr>

          <tr>
            <td>Total Amount</td>
            <td>{{ reservation.total_amount }}</td>
          </tr>

          <tr>
            <td>Last Modified</td>
            <td>{{ reservation.updated_at }}</td>
          </tr>

          <a
            class="badge badge-primary"
            v-if="status == 'CHECKED IN'"
            @click="
              showGuestTransactionListModal = true;
              getTransactions();
            "
            >Transaction List</a
          >
        </table>

        <hr />
        <div class="d-flex justify-content-center">
          <button
            class="btn btn-sm btn-primary mr-2"
            v-if="reservation.status != 'CHECKED OUT'"
            @click="showUpdateReservationModal = true"
          >
            <span
              v-if="
                reservation.status == 'CANCELLED' ||
                  reservation.status == 'NO SHOW'
              "
              >Reinstate</span
            >

            <span v-else>Update Status</span>
          </button>

          <button
            type="button"
            class="btn btn-sm btn-dark mr-2"
            v-if="
              reservation.status != 'TENTATIVE' &&
                reservation.status != 'CHECKED OUT' &&
                reservation.status != 'NO SHOW' &&
                reservation.status != 'CANCELLED' &&
                reservation.status != 'CONFIRMED'
            "
            @click="showECModal = true"
          >
            Extra Charges
          </button>

          <button
            type="button"
            class="btn btn-sm btn-success mr-2"
            v-if="
              reservation.status != 'TENTATIVE' &&
                reservation.status != 'CHECKED OUT' &&
                reservation.status != 'NO SHOW' &&
                reservation.status != 'CANCELLED' &&
                reservation.status != 'CONFIRMED'
            "
            @click="showRouTransModal = true"
          >
            Routed Transaction
          </button>

          <a :href="printConfirmation" target="_blank">
            <button
              type="button"
              class="btn btn-sm btn-danger mr-2"
              v-if="
                reservation.status == 'CONFIRMED' ||
                  reservation.status == 'CHECKED IN'
              "
            >
              PRINT
            </button>
          </a>
        </div>
      </div>
    </modal>

    <!-- UpdateReservationModal -->
    <modal
      v-show="showUpdateReservationModal"
      title="Update Reservation Status"
      @close="
        showUpdateReservationModal = false;
        form.status = 'TENTATIVE';
      "
    >
      <form
        v-on:submit.prevent="handleSubmit"
        v-on:keyup="form.errors.clear($event.target.name)"
      >
        <div class="form-group">
          <input
            type="hidden"
            class="form-control"
            v-if="reservation"
            v-model="reservation.id"
            required
            readonly
          />
          <input
            type="hidden"
            class="form-control"
            v-if="reservation"
            v-model="reservation.account.account_name"
            readonly
          />
        </div>
        <div class="form-group">
          <label for="status">Status</label>
          <select id="status" class="form-control" v-model="form.status">
            <option
              value="CONFIRMED"
              v-if="status != 'CONFIRMED' && status != 'CHECKED IN'"
              >Confirmed</option
            >
            <option value="CHECKED IN" v-if="status != 'CHECKED IN'"
              >Checked In</option
            >
            <option
              value="CHECKED OUT"
              v-if="
                status != 'NO SHOW' &&
                  status != 'CANCELLED' &&
                  status != 'CHECKED OUT' &&
                  status != 'TENTATIVE' &&
                  reservation.status != 'CONFIRMED'
              "
              >Checked out</option
            >
            <option
              value="NO SHOW"
              v-if="
                status != 'CANCELLED' &&
                  status != 'CHECKED IN' &&
                  status != 'TENTATIVE' &&
                  status != 'CHECKED OUT'
              "
              >No show</option
            >
            <option
              value="CANCELLED"
              v-if="status != 'CANCELLED' && status != 'CHECKED IN'"
              >Cancelled</option
            >
          </select>
          <span
            class="text-danger"
            v-if="form.errors.any('status')"
            v-text="form.errors.get('status')"
          ></span>
        </div>

        <div v-if="form.status == 'CHECKED IN'">
          <div class="form-group">
            <label for="date_from">Reserved Arrival Date</label>
            <input
              class="form-control"
              v-if="reservation"
              v-model="form.arrival_date"
              readonly
            />

            <span
              class="text-danger"
              v-if="form.errors.any('arrival_date')"
              v-text="form.errors.get('arrival_date')"
            ></span>
          </div>

          <div class="form-group">
            <label for="date_from">Actual Arrival Date</label>
            <vue-ctk-date-time-picker
              v-model="form.actual_arrival_date"
              format="YYYY-MM-DD HH:mm"
            ></vue-ctk-date-time-picker>

            <span
              class="text-danger"
              v-if="form.errors.any('actual_arrival_date')"
              v-text="form.errors.get('actual_arrival_date')"
            ></span>
          </div>
          <!-- ROOMS DEPENDS ON ROOM TYPE RESERVE -->
          <div class="form-group">
            <label for="account_id"
              >Rooms
              <span class="badge badge-danger" v-if="noRooms">{{
                noRooms
              }}</span></label
            >
            <select class="form-control" v-model="form.room_no">
              <option
                v-for="(item, key) in roomsPerType"
                :key="key"
                :value="item.no"
                v-text="item.no"
              ></option>
            </select>
            <span
              class="text-danger"
              v-if="form.errors.any('room_no')"
              v-text="form.errors.get('room_no')"
            ></span>
          </div>
          <!-- END ROOMS DEPENDS ON ROOM TYPE RESERVE -->
        </div>

        <div class="form-group" v-if="form.status == 'CHECKED OUT'">
          <label for="date_from">Actual Departure Date</label>
          <vue-ctk-date-time-picker
            v-model="form.actual_departure_date"
            format="YYYY-MM-DD HH:mm"
          ></vue-ctk-date-time-picker>
        </div>

        <button type="submit" class="btn btn-primary">Save changes</button>
      </form>
    </modal>

    <!-- End UpdateReservationModal -->

    <!-- RecurringChargesModal -->
    <modal
      v-show="showECModal"
      title="Extra Charges"
      @close="showECModal = false"
    >
      <guest-transaction-form
        :reservation="reservation"
      ></guest-transaction-form>
    </modal>
    <!-- End RecurringChargesModal -->

    <!-- RoutedTransactionModal -->
    <modal
      v-show="showRouTransModal"
      title="Routed Transaction"
      @close="closeModalRoute"
    >
      <route-transaction
        :prReservation="reservation"
        :prTransactions="reservation.transactions"
      ></route-transaction>
    </modal>
    <!-- End RoutedTransactionModal -->

    <!-- GUESTTRANSACTIONS -->
    <modal
      v-show="showGuestTransactionListModal"
      title="Guest Transaction List"
      @close="showGuestTransactionListModal = false"
    >
      <transaction-list
        :guestTransactions="guestTransactions"
      ></transaction-list>
    </modal>
    <!-- End GUESTTRANSACTIONS -->
  </div>
</template>

<script>
import Modal from "../../components/Modal";
import Multiselect from "vue-multiselect";
import Form from "../../core/Form";
import VueCtkDateTimePicker from "vue-ctk-date-time-picker";
import "vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css";

import GuestTransactionForm from "../transaction/GuestTransactionForm";
import RoomList from "../room/RoomList";
import GuestRoom from "../room/GuestRoom";

import GuestServiceForm from "../service/GuestServiceForm";

import TransactionList from "../guest/TransactionList";
import RouteTransaction from "../transaction/RouteTransaction";

export default {
  props: ["reservations"],
  components: {
    Modal,
    Multiselect,
    VueCtkDateTimePicker,
    GuestTransactionForm,
    RoomList,
    GuestRoom,
    GuestServiceForm,
    TransactionList,
    RouteTransaction
  },
  data() {
    return {
      noRooms: "",
      showGuestTransactionListModal: false,
      showViewReservationModal: false,
      showUpdateReservationModal: false,
      showAddServiceModal: false,
      localReservations: {},
      reservation: "",
      form: new Form({
        reservation_id: "",
        status: "",
        arrival_date: "",
        actual_departure_date: "",
        actual_arrival_date: "",
        room_no: "",
        remarks: ""
      }),
      reservedRooms: [],
      status: "CHECKED IN",
      keyGuestName: "",
      showECModal: false,
      showRouTransModal: false,
      roomsPerType: [],
      guestTransactions: []
    };
  },
  methods: {
    closeModalRoute() {
      this.showRouTransModal = false;
      window.location.reload();
    },
    handleSubmit() {
      this.form
        .submit("put", "/reservation/update")
        .then(response => {
          this.showUpdateReservationModal = false;
          this.showViewReservationModal = false;
          this.form.status = "";
          this.status = "TENTATIVE";
          this.fetchReservations();
          alert("Reservation has been successfully updated!");
        })
        .catch(errors => {
          console.log(errors.errors);
          alert(errors.message);
        });
    },
    fetchReservations() {
      window.axios
        .get("/api/reservations")
        .then(response => {
          this.localReservations = response.data;
        })
        .catch(errors => {
          console.log(errors);
        });
    },
    reservationName({ id, account }) {
      return `${account.last_name}, ${account.first_name} - ${id}`;
    },
    viewReservation(reservation) {
      this.reservation = reservation;
      this.form.reservation_id = reservation.id;
      this.form.arrival_date = this.reservation.arrival_date;
    },
    fetchRoomsPerType($type) {
      window.axios
        .get("/api/rooms-per-type/" + $type)
        .then(response => {
          //console.log(response.data.length);
          if (response.data.length) {
            this.noRooms = "";
            this.roomsPerType = response.data;
          } else {
            this.noRooms = "No rooms available!";
          }
        })
        .catch(errors => {
          console.log(errors);
        });
    },
    getTransactions() {
      window.axios
        .get("/api/reservation/" + this.reservation.id)
        .then(response => {
          this.guestTransactions = response.data.transactions;
        })
        .catch(errors => {
          console.log(errors);
        });
    }
  },
  created() {
    this.localReservations = this.reservations;
  },
  computed: {
    filteredReservations() {
      return this.localReservations.filter(
        reservation => reservation.status == "CHECKED IN"
      );
    },
    filteredByStatusReservations() {
      if (this.keyGuestName != "") {
        return this.localReservations.filter(
          reservation =>
            reservation.account.account_name.includes(this.keyGuestName) ||
            reservation.account.last_name == this.keyGuestName ||
            reservation.account.first_name == this.keyGuestNamee ||
            reservation.confirmation_id == this.keyGuestName
        );
      } else {
        return this.localReservations.filter(
          reservation => reservation.status == this.status
        );
      }
    },
    passReservationDetails() {
      return this.reservation;
    },
    modalTitleViewReservation() {
      return "Confirmation Id: " + this.reservation.confirmation_id;
    },
    printConfirmation() {
      return "/print/confirmation/" + this.reservation.id;
    }
  }
};
</script>
<style scoped>
.responsiveModal {
  overflow-x: hidden;
}
.drag-wrapper {
  display: flex;
  justify-content: center;
}

ul {
  display: flex;
  flex-direction: column;
  padding: 3px !important;
  min-height: 70vh;
  width: 100px;
  float: left;
  list-style-type: none;
  overflow-y: auto;
  border: 2px solid #888;
  border-radius: 0.2em;
  background: #8adccc;
  color: #555;
  margin-right: 5px;
}

/* drop target state */
ul[aria-dropeffect="move"] {
  border-color: #68b;
  background: #fff;
}

/* drop target focus and dragover state */
ul[aria-dropeffect="move"]:focus,
ul[aria-dropeffect="move"].dragover {
  outline: none;
  box-shadow: 0 0 0 1px #fff, 0 0 0 3px #68b;
}

/* draggable items */
li {
  display: block;
  list-style-type: none;
  margin: 0 0 2px 0;
  padding: 0.2em 0.4em;
  border-radius: 0.2em;
  line-height: 1.3;
}

li:hover {
  box-shadow: 0 0 0 2px #68b, inset 0 0 0 1px #ddd;
}

/* items focus state */
li:focus {
  outline: none;
  box-shadow: 0 0 0 2px #68b, inset 0 0 0 1px #ddd;
}

/* items grabbed state */
li[aria-grabbed="true"] {
  background: #5cc1a6;
  color: #fff;
}

@keyframes nodeInserted {
  from {
    opacity: 0.2;
  }
  to {
    opacity: 0.8;
  }
}

.item-dropzone-area {
  height: 2rem;
  background: #888;
  opacity: 0.8;
  animation-duration: 0.5s;
  animation-name: nodeInserted;
}
</style>
