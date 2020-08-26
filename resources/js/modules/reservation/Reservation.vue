<template>
  <div>

    <div class="row mb-2 justify-content-center">

      <!-- <div class="asf">Test</div> -->
      <div class="col-lg-6 col-sm-12">
         <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="/reservations">Reservations</a></li>
          <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
      </nav>
        <card>
          <template slot="body">
            <reservation-form
              v-on:submitReservation="handleSubmitReservation"
            ></reservation-form>
          </template>
        </card>
      </div>
    </div>
    <div class="row mb-2 justify-content-center">
      <!-- <div class="asf">Test</div> -->
      <div class="col-lg-6 col-sm-12">
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
