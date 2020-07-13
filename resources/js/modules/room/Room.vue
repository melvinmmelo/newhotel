<template>
  <div>
    <div class="row">
      <div class="col-md-8">
        <card>
          <template slot="header">Rooms</template>
          <template slot="body">
            <room-list :rooms="localRooms"></room-list>
          </template>
        </card>
      </div>

      <div class="col-md-4">
        <card>
          <template slot="header">Add Here</template>
          <template slot="body">
            <room-form v-on:dateIn="applied"></room-form>
          </template>
        </card>
      </div>
    </div>
  </div>
</template>

<script>
import RoomForm from "./RoomForm.vue";
import RoomList from "./RoomList.vue";
export default {
  props: ["items"],
  components: { RoomForm, RoomList },
  data() {
    return {
      localRooms: ""
    };
  },
  methods: {
    applied(data) {
      this.localRooms.unshift(data);
    }
  },
  created() {
    this.localRooms = this.items;
  }
};
</script>
