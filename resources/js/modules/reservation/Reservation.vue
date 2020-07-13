<template>
  <div>
    <div class="row">
      <div class="col">
        <card>
          <template slot="header">Add Reservation General Details</template>
          <template slot="body">
            <reservation-form
              v-on:submitReservation="handleSubmitReservation"
            ></reservation-form>
          </template>
        </card>
      </div>
      <div class="col">
        <card>
          <template slot="header">Add Room</template>
          <template slot="body">
            <reserve-room-form
              :reservationId="reservationId"
            ></reserve-room-form>
          </template>
        </card>
      </div>
    </div>
  </div>
</template>

<script>
import ReservationForm from "./ReservationForm.vue";
import ReserveRoomForm from "./ReserveRoomForm.vue";

export default {
  components: { ReservationForm, ReserveRoomForm },
  data() {
    return {
      localReservations: "",
      reservationId: ""
    };
  },
  methods: {
    // applied(data) {
    //   this.localReservations.unshift(data);
    // }
    handleSubmitReservation(data) {
      this.reservationId = data.id;
    }
  },
  created() {
    //this.localReservations = this.items;
  }
};
</script>
