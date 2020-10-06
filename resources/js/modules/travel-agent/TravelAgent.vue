<template>
  <div>
    <div class="row">
      <div class="col-md-4 mb-2">
        <card>
          <template slot="header">Add Here</template>
          <template slot="body">
            <travel-agent-form v-on:dateIn="applied"></travel-agent-form>
          </template>
        </card>
      </div>
      <div class="col-md-8">
        <card>
          <template slot="header">Travel Agent List</template>
          <template slot="body">
            <travel-agent-list
              :travelAgents="localTravelAgents"
            ></travel-agent-list>
          </template>
        </card>
      </div>


    </div>
  </div>
</template>

<script>
import TravelAgentForm from "./TravelAgentForm.vue";
import TravelAgentList from "./TravelAgentList.vue";
export default {
  props: ["items"],
  components: { TravelAgentForm, TravelAgentList },
  data() {
    return {
      localTravelAgents: ""
    };
  },
  methods: {
    applied(data) {
      this.localTravelAgents.unshift(data);
    }
  },
  created() {
    this.localTravelAgents = this.items;
  }
};
</script>
