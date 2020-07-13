<template>
  <div class="table-responsive">
    <table class="table table-stripped">
      <thead>
        <tr>
          <th>Account Name</th>
          <th>Title</th>
          <th>Last Name</th>
          <th>First Name</th>
          <th>Registered At</th>
          <th>#</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, key) in accounts" :key="key">
          <td>{{ item.account_name.toUpperCase() }}</td>
          <td>{{ item.title }}</td>
          <td>{{ item.last_name }}</td>
          <td>{{ item.first_name }}</td>
          <td>{{ item.created_at }}</td>
          <td><a>View</a></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: ["accounts"],
  data() {
    return {
      localAccounts: []
    };
  },
  methods: {
    fetchAccounts() {
      axios
        .get("/api/accounts")
        .then(res => {
          console.log(res);
          this.localAccounts = res.data;
        })
        .catch(err => console.log(err));
    }
  },
  created() {
    this.localAccounts = this.accounts;
    console.log(this.accounts);
  }
};
</script>
