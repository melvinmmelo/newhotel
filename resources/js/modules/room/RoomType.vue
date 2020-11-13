<template>
  <div>
    <div class="row">
      <div class="col-md-4 mb-2">
        <card>
          <template slot="header">Add Here</template>
          <template slot="body">
            <room-type-form v-on:dateIn="applied"></room-type-form>
          </template>
        </card>
      </div>

      <div class="col-md-8">
        <card>
          <template slot="header">Rooms Types</template>
          <template slot="body">
            <room-types-list :roomTypes="localRoomTypes"></room-types-list>
          </template>
        </card>
      </div>
    </div>
  </div>
</template>

<script>
import RoomTypeForm from "./RoomTypeForm.vue";
import RoomTypesList from "./RoomTypesList.vue";
export default {
  props: ["items"],
  components: { RoomTypeForm, RoomTypesList },
  data() {
    return {
      localRoomTypes: ""
    };
  },
  methods: {
    applied(data) {
      this.localRoomTypes.unshift(data);
    }
  },
  created() {
    this.localRoomTypes = this.items;
  }
};
</script>
