<template>
  <div class="table-responsive">
    <table class="table table-stripped">
      <thead>
        <tr>
          <th>Code</th>
          <th>Accounting</th>
          <th>Memo</th>
          <th>Local Tax</th>
          <th>Government Tax</th>
          <th>Service Charge</th>
          <th>Warning Amount</th>
          <th>Default Amount</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, key) in transactions" :key="key">
          <td>{{ item.code }}</td>
          <td>{{ item.accounting_side }}</td>
          <td>{{ item.memo }}</td>
          <td>{{ item.local_tax }}</td>
          <td>{{ item.govt_tax }}</td>
          <td>{{ item.service_charge }}</td>
          <td>{{ item.warning_amount }}</td>
          <td>{{ item.default_amount }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: ["transactions"]
};
</script>
