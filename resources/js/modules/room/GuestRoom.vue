<template>
  <div class="table-responsive">
    <table class="table table-stripped">
      <thead>
        <tr>
          <th>No</th>
          <th>Floor</th>
          <th>Type</th>
          <th>Status</th>
          <th>Amount</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, key) in comRm" :key="key">
          <td>{{ item.room.no }}</td>
          <td>{{ item.room.floor }}</td>
          <td>{{ item.room.type }}</td>
          <td>{{ item.room.status }}</td>
          <td>{{ item.amount }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: ["rooms"],
  data() {
    return {
      localRooms: ""
    };
  },
  created() {
    this.localRooms = this.rooms;
  },
  computed: {
    comRm() {
      return (this.localRooms = this.rooms);
    }
  }
};
</script>
