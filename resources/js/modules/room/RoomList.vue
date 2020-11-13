<template>
  <div class="table-responsive">
    <table class="table table-stripped">
      <thead>
        <tr>
          <th>No</th>
          <th>Floor</th>
          <th>Type</th>
          <th>Status</th>
          <th>Capacity</th>
          <th>Created At</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, key) in comRm" :key="key">
          <td>{{ item.no }}</td>
          <td>{{ item.floor }}</td>
          <td>{{ item.type }}</td>
          <td>{{ item.status }}</td>
          <td>{{ item.capacity }}</td>
          <td>{{ item.created_at }}</td>
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
      localRooms: "",
      room: {}
    };
  },
  methods: {
    setToUpdate(room) {
      this.room = room;
      alert(this.room);
    }
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
