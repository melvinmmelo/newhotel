<template>
  <div>
    <form
      v-on:submit.prevent="handleSubmit"
      v-on:keyup="form.errors.clear($event.target.name)"
    >
      <div class="form-group">
        <label for="no">Room Type</label>
        <select v-model="form.room_type" class="form-control">
          <option value="">--Select--</option>
          <option value="STANDARD">STANDARD</option>
          <option value="PREMIUM">PREMIUM</option>
          <option value="SUITE">SUITE</option>
        </select>
        <span
          class="text-danger"
          v-if="form.errors.any('room_type')"
          v-text="form.errors.get('room_type')"
        ></span>
      </div>
      <div class="form-group">
        <label for="floor">Rate Type</label>
        <select v-model="form.rate_type" class="form-control">
          <option value="">--Select--</option>
          <option value="BAR">RACK RATE</option>
          <option value="BB">ROOM WITH BREAKFAST</option>
          <option value="COR">CORPORATE</option>
          <option value="TA">TRAVEL AGENCY</option>
        </select>
        <span
          class="text-danger"
          v-if="form.errors.any('rate_type')"
          v-text="form.errors.get('rate_type')"
        ></span>
      </div>
      <div class="form-group">
        <label for="type">Amount</label>
        <input type="text" class="form-control" v-model="form.amount" />
        <span
          class="text-danger"
          v-if="form.errors.any('type')"
          v-text="form.errors.get('type')"
        ></span>
      </div>
      <button type="submit" class="btn btn-primary">
        Submit
      </button>
    </form>
  </div>
</template>

<script>
import Form from "../../core/Form.js";
export default {
  data() {
    return {
      form: new Form({
        room_type: "",
        rate_type: "",
        amount: ""
      })
    };
  },
  methods: {
    handleSubmit() {
      this.form
        .submit("post", "/room-type/create")
        .then(response => this.$emit("dateIn", response))
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>
