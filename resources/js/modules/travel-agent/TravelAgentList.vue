<template>
  <div class="table-responsive">
    <table class="table table-stripped">
      <thead>
        <tr>
          <th>Name</th>
          <th>Contact Person</th>
          <th>Address</th>
          <th>Contact No</th>
          <th>Commission</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, key) in travelAgents" :key="key">
          <td>{{ item.name }}</td>
          <td>{{ item.contact_person }}</td>
          <td>{{ item.address }}</td>
          <td>{{ item.contact_no }}</td>
          <td>{{ item.commission }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: ["travelAgents"]
};
</script>
