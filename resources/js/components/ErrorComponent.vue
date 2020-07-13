<template>
  <div>
    <ul>
      <li v-for="(error, key) in errors" v-text="error[0]" :key="key"></li>
    </ul>
  </div>
</template>

<script>
export default {
  props: ["errors"]
};
</script>
