<template>
  <div class="table-responsive">
    <table class="table table-stripped">
      <thead>
        <tr>
          <th>Amount</th>
          <th>Posted At</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, key) in comRm" :key="key">
          <td>{{ item.amount }}</td>
          <td>{{ item.created_at }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: ["payments", "total"],
  data() {
    return {
      localPayments: "",
      payment: {},
      totalPayment: 0,
    };
  },
  methods: {

  },
  created() {
    this.localPayments = this.payments;
    this.totalPayment = this.total;
  },
  computed: {
    comRm() {
      return (this.localPayments = this.payments);
    },
    comTotal() {
      return (this.totalPayment = this.total);
    }
  }
};
</script>
