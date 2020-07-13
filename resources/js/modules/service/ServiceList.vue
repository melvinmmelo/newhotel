<template>
  <div class="table-responsive">
    <table class="table table-stripped">
      <thead>
        <tr>
          <th>Description</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, key) in services" :key="key">
          <td>{{ item.description }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: ["services"]
};
</script>
