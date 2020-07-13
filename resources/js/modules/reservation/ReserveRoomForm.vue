<template>
  <form
    v-on:submit.prevent="handleSubmit"
    v-on:keyup="form.errors.clear($event.target.name)"
  >
    <div class="form-group">
      <label for="name">Reservation</label>
      <input
        type="text"
        id="reservation_id"
        class="form-control"
        v-model="comResId"
        readonly
      />

      <span
        class="text-danger"
        v-if="form.errors.any('reservation_id')"
        v-text="form.errors.get('reservation_id')"
      ></span>
    </div>

    <div class="form-group">
      <label for="room_id">Room No.</label>
      <multiselect
        v-model="room"
        :options="rooms"
        :allow-empty="false"
        label="no"
        track-by="id"
        @select="onSelectRoom"
      ></multiselect>

      <span
        class="text-danger"
        v-if="form.errors.any('room_no')"
        v-text="form.errors.get('room_no')"
      ></span>
    </div>

    <div class="form-group">
      <label for="amount">Amount</label>
      <input
        type="text"
        id="amount"
        class="form-control"
        v-model="form.amount"
      />

      <span
        class="text-danger"
        v-if="form.errors.any('amount')"
        v-text="form.errors.get('amount')"
      ></span>
    </div>

    <button type="submit" :disabled="isDisabled" class="btn btn-primary">
      Submit
    </button>
  </form>
</template>

<script>
import Multiselect from "vue-multiselect";
import Form from "../../core/Form.js";

export default {
  props: ["reservationId"],
  data() {
    return {
      form: new Form({
        reservation_id: this.reservationId,
        room_id: "",
        amount: "",
        reset: false
      }),
      buttonToggle: true,
      room: "",
      rooms: []
    };
  },
  components: {
    Multiselect
  },
  methods: {
    handleSubmit() {
      this.form
        .submit("post", "/reservation/room/create")
        .then(response => {
          this.rooms = this.rooms.filter(function(e) {
            return e.id != response.room_id;
          });
          alert("Room has been successfully reserved!");
        })
        .catch(errors => console.log(errors));
    },
    fetchRooms() {
      window.axios
        .get("/api/rooms")
        .then(response => {
          this.rooms = response.data;
        })
        .catch(errors => {
          console.log(errors.response.data.errors);
        });
    },
    onSelectRoom(selectedItem) {
      this.form.room_id = selectedItem.id;
    }
  },
  created() {
    this.fetchRooms();
  },
  computed: {
    comResId() {
      return (this.form.reservation_id = this.reservationId);
    },
    isDisabled() {
      // you can  check your form is filled or not here.
      return this.reservationId == "";
    }
  }
};
</script>
