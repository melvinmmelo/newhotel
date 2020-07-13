<template>
  <div>
    <form
      v-on:submit.prevent="handleSubmit"
      v-on:keyup="form.errors.clear($event.target.name)"
    >
      <div class="form-group">
        <label for="name">Name</label>
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
        <label for="contact_person">Contact Person</label>
        <input
          type="text"
          name="contact_person"
          id="contact_person"
          class="form-control"
          v-model="form.contact_person"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('contact_person')"
          v-text="form.errors.get('contact_person')"
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
      <div class="form-group">
        <label for="contact_no">Contact No</label>
        <input
          type="text"
          name="contact_no"
          id="contact_no"
          class="form-control"
          v-model="form.contact_no"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('contact_no')"
          v-text="form.errors.get('contact_no')"
        ></span>
      </div>
      <div class="form-group">
        <label for="commission">Commission</label>
        <input
          type="text"
          name="commission"
          id="commission"
          class="form-control"
          v-model="form.commission"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('commission')"
          v-text="form.errors.get('commission')"
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
        contact_person: "",
        address: "",
        contact_no: "",
        commission: ""
      })
    };
  },
  methods: {
    handleSubmit() {
      this.form
        .submit("post", "/travel-agent/create")
        .then(response => this.$emit("dateIn", response))
        .catch(errors => console.log(errors));
    }
  }
};
</script>
