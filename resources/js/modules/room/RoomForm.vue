<template>
  <div>
    <form
      v-on:submit.prevent="handleSubmit"
      v-on:keyup="form.errors.clear($event.target.name)"
    >
      <div class="form-group">
        <label for="no">Room no.</label>
        <input
          type="text"
          name="no"
          id="no"
          class="form-control"
          v-model="form.no"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('no')"
          v-text="form.errors.get('no')"
        ></span>
      </div>
      <div class="form-group">
        <label for="floor">Floor</label>
        <select
          name="floor"
          id="floor"
          v-model="form.floor"
          class="form-control"
        >
          <option value="">--Select--</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
        <span
          class="text-danger"
          v-if="form.errors.any('floor')"
          v-text="form.errors.get('floor')"
        ></span>
      </div>
      <div class="form-group">
        <label for="type">Type</label>
        <select name="type" id="type" v-model="form.type" class="form-control">
          <option value="">--Select--</option>
          <option value="Standard">Standard</option>
          <option value="Middle Class">Middle Class</option>
          <option value="High Class">High Class</option>
          <option value="Premium">Premium</option>
        </select>
        <span
          class="text-danger"
          v-if="form.errors.any('type')"
          v-text="form.errors.get('type')"
        ></span>
      </div>
      <div class="form-group">
        <label for="capacity">Capacity</label>
        <input
          type="text"
          name="capacity"
          id="capacity"
          class="form-control"
          v-model="form.capacity"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('capacity')"
          v-text="form.errors.get('capacity')"
        ></span>
      </div>
      <div class="form-group">
        <label for="default_amount">Default Amount</label>
        <input
          type="text"
          name="default_amount"
          id="default_amount"
          class="form-control"
          v-model="form.default_amount"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('default_amount')"
          v-text="form.errors.get('default_amount')"
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
        no: "",
        floor: "",
        type: "",
        capacity: "",
        default_amount: ""
      })
    };
  },
  methods: {
    handleSubmit() {
      this.form
        .submit("post", "/room/create")
        .then(response => this.$emit("dateIn", response))
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>
