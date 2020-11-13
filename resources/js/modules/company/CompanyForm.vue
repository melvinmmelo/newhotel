<template>
  <div>
    <form
      class="form-horizontal"
      v-on:submit.prevent="handleSubmit"
      v-on:keyup="form.errors.clear($event.target.name)"
    >
      <div class="form-group">
        <label for="name">Company Name</label>
        <input
          type="text"
          name="name"
          id="name"
          class="form-control"
          v-model="form.name"
        />

        <span
          class="text-danger"
          v-if="form.errors.any('name')"
          v-text="form.errors.get('name')"
        ></span>
      </div>
      <div class="form-group">
        <label for="address">Address</label>
        <textarea
          name="address"
          id="address"
          cols="5"
          rows="5"
          class="form-control"
          v-model="form.address"
        ></textarea>
        <span
          class="text-danger"
          v-if="form.errors.any('address')"
          v-text="form.errors.get('address')"
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
        name: "",
        address: ""
      })
    };
  },
  methods: {
    handleSubmit() {
      this.form
        .submit("post", "/company/create")
        .then(response => {
          this.$emit("dateIn", response);
          console.log(response)
        })
        .catch(error => console.log(error.message));
    }
  },
  created() {}
};
</script>
