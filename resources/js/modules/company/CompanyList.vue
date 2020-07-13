<template>
  <div class="table-responsive">
    <table class="table table-stripped">
      <thead>
        <tr>
          <th>Name</th>
          <th>Address</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, key) in companies" :key="key">
          <td>{{ item.name }}</td>
          <td>{{ item.address }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: ["companies"]
};
</script>
