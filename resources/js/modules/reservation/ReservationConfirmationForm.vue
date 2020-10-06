<template>
  <div>
    <div class="row">
      <card>
        <template slot="header">Add Here</template>
      </card>
    </div>
  </div>
</template>

<script>
export default {
  props: ["reservation"],
  data() {
    return {};
  },
  components: {},
  methods: {
    // fetchReservation() {
    //   window.axios
    //     .get("/api/reservation")
    //     .then(response => {
    //       this.accounts = response.data;
    //     })
    //     .catch(errors => {
    //       console.log(errors.response.data.errors);
    //     });
    // },
  },
  created() {
    //this.fetchAccounts();
  },
  computed: {}
};
</script>
