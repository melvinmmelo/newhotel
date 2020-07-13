<template>
  <div>
    <form
      class="form-horizontal"
      v-on:submit.prevent="handleSubmit"
      v-on:keyup="form.errors.clear($event.target.name)"
    >
      <div class="form-group">
        <label for="title">Title</label>
        <input
          type="text"
          name="title"
          id="title"
          class="form-control"
          v-model="form.title"
        />

        <span
          class="text-danger"
          v-if="form.errors.any('title')"
          v-text="form.errors.get('title')"
        ></span>
      </div>
      <div class="form-group">
        <label for="discount">Discount</label>
        <input
          type="text"
          name="discount"
          id="discount"
          class="form-control"
          v-model="form.discount"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('discount')"
          v-text="form.errors.get('discount')"
        ></span>
      </div>
      <div class="form-group">
        <label for="conditions">Conditions</label>
        <textarea
          id="conditions"
          cols="5"
          rows="5"
          class="form-control"
          v-model="form.conditions"
        ></textarea>
        <span
          class="text-danger"
          v-if="form.errors.any('conditions')"
          v-text="form.errors.get('conditions')"
        ></span>
      </div>

      <div class="form-group">
        <label for="starts_at">Starts at</label>
        <vue-ctk-date-time-picker
          v-model="form.starts_at"
          format="YYYY-MM-DD HH:mm"
        ></vue-ctk-date-time-picker>
        <span
          class="text-danger"
          v-if="form.errors.any('starts_at')"
          v-text="form.errors.get('starts_at')"
        ></span>
      </div>

      <div class="form-group">
        <label for="ends_at">Ends at</label>
        <vue-ctk-date-time-picker
          v-model="form.ends_at"
          format="YYYY-MM-DD HH:mm"
        ></vue-ctk-date-time-picker>
        <span
          class="text-danger"
          v-if="form.errors.any('ends_at')"
          v-text="form.errors.get('ends_at')"
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
import VueCtkDateTimePicker from "vue-ctk-date-time-picker";
import "vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css";
export default {
  components: {
    VueCtkDateTimePicker
  },
  data() {
    return {
      form: new Form({
        title: "",
        discount: "",
        conditions: "",
        starts_at: "",
        ends_at: ""
      })
    };
  },
  methods: {
    handleSubmit() {
      this.form
        .submit("post", "/promo/create")
        .then(response => {
          this.$emit("dateIn", response);
        })
        .catch(error => console.log(error.message));
    }
  },
  created() {}
};
</script>
