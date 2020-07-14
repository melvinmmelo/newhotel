<template>
  <div>
    <form
      v-on:submit.prevent="handleSubmitAddService"
      v-on:keyup="form.errors.clear($event.target.name)"
    >
      <div class="form-group">
        <label for="account_id">Account</label>
        <multiselect
          v-model="reservation"
          :options="compRes"
          :allow-empty="false"
          label="name"
          track-by="id"
          :custom-label="reservationName"
          @select="onSelectReservation"
        ></multiselect>
      </div>
      <div class="form-group">
        <label for="status">Service</label>
        <multiselect
          v-model="service"
          :options="services"
          :allow-empty="false"
          label="description"
          track-by="id"
          @select="onSelectService"
        ></multiselect>
      </div>

      <button type="submit" class="btn btn-primary">Save changes</button>
    </form>
  </div>
</template>

<script>
import Form from "../../core/Form";
import Multiselect from "vue-multiselect";

export default {
  props: ["reservations"],
  components: {
    Multiselect
  },
  data() {
    return {
      form: new Form({
        reservation_id: "",
        service_id: ""
      }),
      service: "",
      services: [],
      reservation: "",
      localReservations: ""
    };
  },
  methods: {
    handleSubmitAddService() {
      this.form
        .submit("post", "/guest/service/create")
        .then(response => {
          alert("Guest Service has been created!");
        })
        .catch(errors => {
          console.log(errors.errors);
          alert(errors.message);
        });
    },
    fetchServices() {
      window.axios
        .get("/api/services")
        .then(response => {
          this.services = response.data;
        })
        .catch(errors => {
          console.log(errors);
        });
    },
    onSelectReservation(selectedItem) {
      if (this.services.count == undefined) {
        this.fetchServices();
      }

      this.form.reservation_id = selectedItem.id;
    },
    onSelectService(selectedItem) {
      this.form.service_id = selectedItem.id;
    },
    reservationName({ id, account }) {
      return `${account.last_name}, ${account.first_name} - ${id}`;
    }
  },
  computed: {
    compRes() {
      return (this.localReservations = this.reservations);
    }
  }
};
</script>
