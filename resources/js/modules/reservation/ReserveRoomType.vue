<template>
  <form
    v-on:submit.prevent="handleSubmit"
    v-on:keyup="form.errors.clear($event.target.name)"
  >
    <div class="form-group">
      <label for="name">Reservation ID</label>
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
      <label for="room_id">Room Category</label>

    <div class="row">
      <div class="col-lg-4 col-sm-4">
            <button type="button" class="btn mr-2 w-100" :class="makePrimary(1)" @click="selectRoomType(1)">Standard</button>
      </div>

      <div class="col-lg-4 col-sm-4">
            <button type="button" class="btn mr-2 w-100" :class="makePrimary(2)" @click="selectRoomType(2)">Premium</button>
      </div>

      <div class="col-lg-4 col-sm-4">
          <button type="button" class="btn mr-2 w-100" :class="makePrimary(3)" @click="selectRoomType(3)">Suite</button>
      </div>
    </div>

      <!-- <multiselect
        v-model="room"
        :options="rooms"
        :allow-empty="false"
        label="no"
        track-by="id"
        @select="onSelectRoom"
      ></multiselect> -->

      <span
        class="text-danger"
        v-if="form.errors.any('room_id')"
        v-text="form.errors.get('room_id')"
      ></span>
    </div>

    <div class="form-group">
      <label for="amount">Rack Rate</label>
      <select class="form-control">
        <option value="BAR">Rack Rate</option>
        <option value="BB">Room With Breakfast</option>
        <option value="COR">Corporate</option>
        <option value="TA">Travel Agency</option>
      </select>
      <span
        class="text-danger"
        v-if="form.errors.any('amount')"
        v-text="form.errors.get('amount')"
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

    <button type="submit" :disabled="isDisabled" class="btn btn-primary">
      Reserve
    </button>
  </form>
</template>

<script>
import Multiselect from "vue-multiselect";
import Form from "../../core/Form.js";
import VueCtkDateTimePicker from "vue-ctk-date-time-picker";
import "vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css";
export default {
  props: ["reservationId"],
  data() {
    return {
      form: new Form({
        reservation_id: this.reservationId,
        room_type_id: "",
        room_type_description: "",
        amount: "",
        total_amount: 0,
        reset: false
      }),
      buttonToggle: true,
      room: "",
      rooms: [],
      selectedRoomType: 1,
    };
  },
  components: {
    Multiselect,
    VueCtkDateTimePicker
  },
  methods: {
    makePrimary(key){
      if(this.selectedRoomType == key){
        return 'btn-danger';
      }else{
        return 'btn-secondary';
      }
    },
    handleSubmit() {
      this.form
        .submit("post", "/reservation/room/create")
        .then(response => {
          console.log(response);
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
      this.form.amount = selectedItem.default_amount;
    },
    selectRoomType(key){
      this.selectedRoomType = key
      this.form.room_type = key;
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
