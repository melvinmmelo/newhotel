<template>
  <div class="table-responsive">
    <a class="btn btn-primary mb-2" @click="showUpdateReservationModal = true"
      >Update Status</a
    >
    <a class="btn btn-danger mb-2" @click="showAddTransactionModal = true"
      >Add Transaction</a
    >

    <a class="btn btn-danger mb-2" @click="fetchTransactionAndShowModal()"
      >Add Service</a
    >
    <div class="row">
      <table class="table table-hover">
        <thead class="thead-dark">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Company</th>
            <th>Adult | Child</th>
            <th>Travel Agent</th>
            <th>Dates</th>
            <th>Payment Mode</th>
            <th>Status</th>
            <th>Reserved At | Updated At</th>
            <th>#</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, key) in localReservations" :key="key">
            <td>{{ item.id }}</td>
            <td>
              {{ item.account.last_name + " " + item.account.first_name }}
            </td>
            <td v-if="item.company">{{ item.company.name }}</td>
            <td>{{ item.adult_no + " | " + item.child_no }}</td>
            <td v-if="item.travel_agent">{{ item.travel_agent.name }}</td>
            <td>{{ item.arrival_date + " | " + item.departure_date }}</td>
            <td>{{ item.payment_mode }}</td>
            <td>{{ item.status }}</td>
            <td>{{ item.created_at + " | " + item.updated_at }}</td>
            <td>
              <div class="btn-group">
                <button class="btn btn-secondary btn-sm" type="button">
                  Action
                </button>
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
                    href="#"
                    class="dropdown-item"
                    @click="
                      showRoomModal = true;
                      fetchReservedRooms(item.id);
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
            <option value="Checked In">Checked In</option>
            <option value="Confirmed">Confirmed</option>
            <option value="Wait List">Wait List</option>
            <option value="Checked Out">Checked out</option>
            <option value="No show">No show</option>
            <option value="Cancelled">Cancelled</option>
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
      <guest-room :rooms="rooms"></guest-room>
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

export default {
  props: ["reservations"],
  components: {
    Modal,
    Multiselect,
    VueCtkDateTimePicker,
    GuestTransactionForm,
    RoomList,
    GuestRoom
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
      rooms: []
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
    fetchReservedRooms(id) {
      window.axios
        .get("/api/reserved-rooms/" + id)
        .then(response => {
          this.rooms = response.data;
        })
        .catch(errors => {
          console.log(errors);
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
    }
  }
};
</script>
