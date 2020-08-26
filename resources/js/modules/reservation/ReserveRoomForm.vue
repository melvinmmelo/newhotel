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
      <label for="room_id">Room No.</label>

    <div class="row">
      <div class="col-lg-12">
            <button type="button" class="btn mr-2" :class="makePrimary(key)" v-for="(item, key) in rooms" :key="key" v-text="item.no" @click="setClassBtnRoom(item, key)"></button>
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

    <div class="form-group">
      <label for="amount">Rate Type</label>
      <select name="" id="" class="form-control" v-model="form.rate_type">
          <option value="Corporate">Corporate</option>
          <option value="Rack">Rack</option>
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
      />

      <span
        class="text-danger"
        v-if="form.errors.any('total_amount')"
        v-text="form.errors.get('total_amount')"
      ></span>
    </div>

    <button type="submit" :disabled="isDisabled" class="btn btn-primary">
      Add room
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
        room_id: "",
        amount: "",
        rate_type: "",
        total_amount: 0,
        reset: false
      }),
      buttonToggle: true,
      room: "",
      rooms: [],
      selectedRoomKey: 0,
    };
  },
  components: {
    Multiselect,
    VueCtkDateTimePicker
  },
  methods: {
    makePrimary(key){
      if(this.selectedRoomKey == key){
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
    setClassBtnRoom(item, key){
      this.selectedRoomKey = key;
      this.form.room_id = item.id;
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


<style>
/* Hiding the checkbox, but allowing it to be focused */
.badgebox
{
    opacity: 0;
}

.badgebox + .badge
{
    /* Move the check mark away when unchecked */
    text-indent: -999999px;
    /* Makes the badge's width stay the same checked and unchecked */
	width: 27px;
}

.badgebox:focus + .badge
{
    /* Set something to make the badge looks focused */
    /* This really depends on the application, in my case it was: */

    /* Adding a light border */
    box-shadow: inset 0px 0px 5px;
    /* Taking the difference out of the padding */
}

.badgebox:checked + .badge
{
    /* Move the check mark back when checked */
	text-indent: 0;
}
</style>
