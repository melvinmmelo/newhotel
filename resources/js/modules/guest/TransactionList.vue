<template>
  <div class="table-responsive">
    <table class="table table-stripped table-sm">
      <thead>
        <tr class="table-primary">
          <th>Transaction Code</th>
          <th>Desc</th>
          <th>Amount</th>
          <th>Created At</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, key) in comRm" :key="key">
          <td>{{ item.transaction.code }}</td>
          <td>{{ item.transaction.memo }}</td>
          <td>{{ item.amount }}</td>
          <td>{{ item.created_at }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: ["guestTransactions"],
  data() {
    return {
      localGuestTransactions: ""
    };
  },
  computed: {
    comRm() {
      return (this.localGuestTransactions = this.guestTransactions);
    }
  }
};
</script>
