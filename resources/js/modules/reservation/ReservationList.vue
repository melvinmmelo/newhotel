<template>
  <div class="">
    <div class="row">
      <div class="col-lg-4 col-sm-4 mb-2">
   <div class="card">
  <div class="card-body">
    <h5 class="card-title">Tools</h5>
    <h6 class="card-subtitle mb-2 text-muted">You can add or update reservations here.</h6>
    <button class="btn btn-primary mb-2" @click="showUpdateReservationModal = true"
      >Update Status</button
    >
    <button type="button" class="btn btn-secondary mb-2" @click="showBIModal = true"
      >Billing Instruction</button
    >

    <button type="button" class="btn btn-secondary mb-2" @click="showRCModal = true"
      >Recurring Charges</button
    >

    <button type="button" class="btn btn-secondary mb-2" @click="showPrModal = true"
      >Promos</button
    >

    <button type="button" class="btn btn-secondary mb-2" @click="showIncModal = true"
      >Inclusions</button
    >

    <button type="button" class="btn btn-secondary mb-2" @click="showExtPerModal = true"
      >Extra Person</button
    >

    <button type="button" class="btn btn-secondary mb-2" @click="showRouTransModal = true"
      >Routed Transaction</button
    >

    <!-- <button class="btn btn-secondary mb-2" @click="showAddServiceModal = true"
      >Add Service</button
    > -->
        <div class="form-group">
          <label for="">Filter by status</label>
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
          <label for="">Search By Guest Last Name</label>
          <input type="text" class="form-control" v-model="keyGuestName" :keydown="filteredByStatusReservations">
        </div>
  </div>
</div>
      </div>
      <div class="col-lg-8 col-sm-8">
        <div class="card">
  <div class="card-body">
        <div class="table-responsive">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>Reserved At | Updated At</th>
            <th>#</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, key) in filteredByStatusReservations" :key="key">
            <td>{{ item.id }}</td>
            <td>
              {{ item.account.last_name + " " + item.account.first_name }}
            </td>
            <td>{{ item.status }}</td>
            <td>{{ item.created_at + " | " + item.updated_at }}</td>
            <td>
              <div class="btn-group">
                <a @click="viewReservation(item);"><button class="btn btn-secondary btn-sm" type="button">
                  View
                </button></a>
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
                  <a
                    class="dropdown-item"
                    @click="
                      showRoomModal = true;
                      fetchReservedRooms(item.reserved_rooms);
                    "
                    >Rooms</a
                  >
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

    <div class="row">

      <div class="col-lg-8 col-sm-8">
        <div class="card mb-2">
  <div class="card-header">
    Reservation Details
  </div>
  <div class="card-body" v-if="reservation">
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          Guest Name:
          {{ reservation.account.account_name }}
        </div>
      </div>

      <div class="col-lg-6">
        <div class="form-group">
          Status:
          <span for="" class="badge badge-danger">{{ reservation.status }}</span>
        </div>
      </div>
    </div>

    <div class="form-group">
      Arrival and Departure Date: {{ reservation.arrival_date + "-" + reservation.departure_date  }}
    </div>

    <div class="form-group">
      Adult | Child: {{ reservation.adult_no + " | " + reservation.child_no  }}
    </div>

    <div class="form-group">
      Payment Mode: {{ reservation.payment_mode }}
    </div>

    <div class="form-group">
      Rooms
      <ul>
        <li v-for="(room, key) in reservedRooms" :key="key" v-text="room.no"></li>
      </ul>

    <div class="form-group">
      Purpose: {{ reservation.purpose }}
    </div>

    <div class="form-group">
      Remarks: {{ reservation.remarks }}
    </div>

    <div class="form-group">
      Confirmed at: {{ reservation.confirmed_at }}
    </div>

    <div class="form-group">
      Last Modified: {{ reservation.updated_at }}
    </div>
    </div>


    <button type="button" class="btn btn-primary mb-2"
      >Update</button>

    <button type="button" class="btn btn-secondary mb-2"
      >History</button
    >
  </div>
  </div>
      </div>
      <div class="col-lg-4 col-sm-4 mb-2">
        <div class="card">
          <div class="card-header">
            Current Bill Amount and Charges
          </div>
        </div>
      </div>
    </div>

    <modal
      v-show="showUpdateReservationModal"
      title="Update Reservation Status"
      @close="showUpdateReservationModal = false"
    >
      <form
        v-on:submit.prevent="handleSubmit"
        v-on:keyup="form.errors.clear($event.target.name)"
      >
        <div class="form-group">
          <label for="account_id">Account</label>
          <multiselect
            v-model="reservation"
            :options="localReservations"
            :allow-empty="false"
            label="name"
            track-by="id"
            :custom-label="reservationName"
            @select="onSelectReservation"
          ></multiselect>
        </div>
        <div class="form-group">
          <label for="status">Status</label>
          <select id="status" class="form-control" v-model="form.status">
            <option value="CONFIRMED">Confirmed</option>
            <option value="CHECKED IN">Checked In</option>
            <option value="WAIT LIST">Wait List</option>
            <option value="CHECKED OUT">Checked out</option>
            <option value="NO SHOW">No show</option>
            <option value="CANCELLED">Cancelled</option>
          </select>
          <span
            class="text-danger"
            v-if="form.errors.any('status')"
            v-text="form.errors.get('status')"
          ></span>
        </div>
        <div class="form-group" v-if="form.status == 'Checked In'">
          <label for="date_from">Actual Arrival Date</label>
          <vue-ctk-date-time-picker
            v-model="form.actual_arrival_date"
            format="YYYY-MM-DD HH:mm"
          ></vue-ctk-date-time-picker>
        </div>

        <div class="form-group" v-if="form.status == 'Checked Out'">
          <label for="date_from">Actual Departure Date</label>
          <vue-ctk-date-time-picker
            v-model="form.actual_departure_date"
            format="YYYY-MM-DD HH:mm"
          ></vue-ctk-date-time-picker>
        </div>

        <div class="form-group">
          <label for="remarks">Remarks</label>
          <textarea
            name="remarks"
            id="remarks"
            cols="5"
            rows="5"
            class="form-control"
            v-model="form.remarks"
          ></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save changes</button>
      </form>
    </modal>

    <modal
      v-show="showRoomModal"
      title="Room(s) Reserved"
      @close="showRoomModal = false"
    >
      <guest-room :rooms="reservedRooms"></guest-room>
    </modal>

    <modal
      v-show="showAddTransactionModal"
      title="Add Transaction"
      @close="showAddTransactionModal = false"
    >
      <guest-transaction-form
        :reservations="filteredReservations"
      ></guest-transaction-form>
    </modal>

    <modal
      v-show="showAddServiceModal"
      title="Add Service"
      @close="showAddServiceModal = false"
    >
      <guest-service-form
        :reservations="filteredReservations"
      ></guest-service-form>
    </modal>

    <!-- BillingInstructionModal -->
    <modal
      v-show="showBIModal"
      title="Billing Instruction"
      @close="showBIModal = false"
    >
      <form class="form-horizontal">
        <div class="form-group">
          <label for="">Guest Name</label>
          <input type="text" class="form-control">
        </div>
        <div class="form-group">
          <label for="">Company Percentage</label>
          <input type="number" class="form-control">
        </div>
        <div class="pull-right">
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </form>
    </modal>
    <!-- End BillingInstructionModal -->

    <!-- RecurringChargesModal -->
    <modal
      v-show="showRCModal"
      title="Recurring Charges"
      @close="showRCModal = false"
    >
      <form class="form-horizontal">
        <div class="form-group">
          <label for="">Guest Name</label>
          <input type="text" class="form-control">
        </div>
        <div class="form-group">
          <label for="recCharSelId">Recurring Charge</label>
          <select name="" id="recCharSelId" class="form-control">
            <option value="">--Select--</option>
          </select>
        </div>
        <div class="pull-right">
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </form>
    </modal>
    <!-- End RecurringChargesModal -->

    <!-- PromosModal -->
    <modal
      v-show="showPrModal"
      title="Promo"
      @close="showPrModal = false"
    >
      <form class="form-horizontal">
        <div class="form-group">
          <label for="">Guest Name</label>
          <input type="text" class="form-control">
        </div>
        <div class="form-group">
          <label for="">Promo</label>
          <select name="" id="promoSelId" class="form-control">
            <option value="">--Select--</option>
          </select>
        </div>
        <div class="pull-right">
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </form>
    </modal>
    <!-- End PromosModal -->

    <!-- Inclusions -->
    <modal
      v-show="showIncModal"
      title="Inclusions"
      @close="showIncModal = false"
    >
      <form class="form-horizontal">
        <div class="form-group">
          <label for="">Guest Name</label>
          <input type="text" class="form-control">
        </div>
        <div class="form-group">
          <label for="inclusionsSelId">Inclusions</label>
          <select name="" id="inclusionsSelId" class="form-control">
            <option value="">--Select--</option>
          </select>
        </div>
        <div class="pull-right">
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </form>
    </modal>
    <!-- End Inclusions -->

    <!-- ExtraPersonModal -->
    <modal
      v-show="showExtPerModal"
      title="Extra Person"
      @close="showExtPerModal = false"
    >
      <form class="form-horizontal">
        <div class="form-group">
          <label for="">Guest Name</label>
          <input type="text" class="form-control">
        </div>
        <div class="form-group">
          <label for="">Name</label>
          <input type="text" class="form-control">
        </div>
        <div class="form-group">
          <label for="">Amount</label>
          <input type="number" class="form-control">
        </div>
        <div class="pull-right">
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </form>
    </modal>
    <!-- End ExtraPersonModal -->

    <!-- RoutedTransactionModal -->
    <modal
      v-show="showRouTransModal"
      title="Routed Transaction"
      @close="showRouTransModal = false"
    >
      <form class="form-horizontal">
        <div class="form-group">
          <label for="">From</label>
          <input type="text" class="form-control">
        </div>
        <div class="form-group">
          <label for="">To</label>
          <input type="text" class="form-control">
        </div>
        <div class="form-group">
          <label for="rouTransRecCharId">Recurring Charge</label>
          <select name="" id="rouTransRecCharId" class="form-control">
            <option value="">--Select--</option>
          </select>
        </div>
        <div class="pull-right">
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </form>
    </modal>
    <!-- End RoutedTransactionModal -->

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

export default {
  props: ["reservations"],
  components: {
    Modal,
    Multiselect,
    VueCtkDateTimePicker,
    GuestTransactionForm,
    RoomList,
    GuestRoom,
    GuestServiceForm
  },
  data() {
    return {
      showUpdateReservationModal: false,
      showRoomModal: false,
      showAddServiceModal: false,
      showAddTransactionModal: false,
      localReservations: {},
      reservation: "",
      form: new Form({
        reservation_id: "",
        status: "",
        actual_departure_date: "",
        actual_arrival_date: "",
        remarks: ""
      }),
      reservedRooms: [],
      status: 'TENTATIVE',
      keyGuestName: "",
      showBIModal: false,
      showRCModal: false,
      showPrModal: false,
      showIncModal: false,
      showExtPerModal: false,
      showRouTransModal: false,
    };
  },
  methods: {
    handleSubmit() {
      this.form
        .submit("put", "/reservation/update")
        .then(response => {
          this.showUpdateReservationModal = false;
          this.fetchReservations();
          alert("Reservation has been successfully updated!");
        })
        .catch(errors => {
          console.log(errors.errors);
          alert(errors.message);
        });
    },
    onSelectReservation(selectedItem) {
      this.form.reservation_id = selectedItem.id;
    },
    fetchReservedRooms(rooms) {
      this.reservedRooms = rooms;
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
    viewReservation(reservation){
      this.reservation = reservation;
    }
  },
  created() {
    this.localReservations = this.reservations;
  },
  computed: {
    filteredReservations() {
      return this.localReservations.filter(
        reservation => reservation.status == "Checked In"
      );
    },
    filteredByStatusReservations() {
      if(this.keyGuestName != ""){
        return this.localReservations.filter(
          reservation => reservation.account.last_name == this.keyGuestName
        );
      }else{
        return this.localReservations.filter(
          reservation => reservation.status == this.status
        );
      }
    }
  }
};
</script>
