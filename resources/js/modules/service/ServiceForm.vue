<template>
  <div>
    <form
      class="form-horizontal"
      v-on:submit.prevent="handleSubmit"
      v-on:keyup="form.errors.clear($event.target.name)"
    >
      <div class="form-group">
        <label for="description">Description</label>
        <input
          type="text"
          name="description"
          id="description"
          class="form-control"
          v-model="form.description"
        />

        <span
          class="text-danger"
          v-if="form.errors.any('description')"
          v-text="form.errors.get('description')"
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
        description: ""
      })
    };
  },
  methods: {
    handleSubmit() {
      this.form
        .submit("post", "/service/create")
        .then(response => {
          this.form.reset;
          this.$emit("dateIn", response);
        })
        .catch(error => console.log(error.message));
    }
  },
  created() {}
};
</script>
