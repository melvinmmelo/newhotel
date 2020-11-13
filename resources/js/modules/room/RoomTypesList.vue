<template>
  <div class="table-responsive">
    <table class="table table-stripped">
      <thead>
        <tr>
          <th>Type</th>
          <th>Rate Type</th>
          <th>Amount</th>
          <th>Modified at</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, key) in comRm" :key="key">
          <td>{{ item.room_type }}</td>
          <td>{{ item.rate_type }}</td>
          <td>{{ item.amount }}</td>
          <td>{{ item.updated_at }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: ["roomTypes"],
  data() {
    return {
      localRoomTypes: ""
    };
  },
  created() {
    this.localRoomTypes = this.roomTypes;
  },
  computed: {
    comRm() {
      return (this.localRoomTypes = this.roomTypes);
    }
  }
};
</script>
