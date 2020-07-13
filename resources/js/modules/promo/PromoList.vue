<template>
  <div class="table-responsive">
    <table class="table table-stripped">
      <thead>
        <tr>
          <th>Title</th>
          <th>Discount</th>
          <th>Conditions</th>
          <th>Date Range</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, key) in promos" :key="key">
          <td>{{ item.title }}</td>
          <td>{{ item.discount }}</td>
          <td>{{ item.conditions }}</td>
          <td>{{ item.starts_at + " | " + item.ends_at }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: ["promos"]
};
</script>
