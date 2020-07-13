<template>
  <div>
    <form
      v-on:submit.prevent="handleSubmit"
      v-on:keyup="form.errors.clear($event.target.name)"
    >
      <div class="form-group">
        <label for="accounting_side">Accounting Side</label>
        <select
          name=""
          id="accounting_side"
          class="form-control"
          v-model="form.accounting_side"
        >
          <option value="DEBIT">DEBIT</option>
          <option value="CREDIT">CREDIT</option>
        </select>
        <span
          class="text-danger"
          v-if="form.errors.any('accounting_side')"
          v-text="form.errors.get('accounting_side')"
        ></span>
      </div>

      <div class="form-group">
        <label for="memo">Memo</label>
        <input type="text" id="memo" class="form-control" v-model="form.memo" />
        <span
          class="text-danger"
          v-if="form.errors.any('memo')"
          v-text="form.errors.get('memo')"
        ></span>
      </div>

      <div class="form-group">
        <label for="local_tax">Local Tax</label>
        <input
          type="text"
          id="local_tax"
          class="form-control"
          v-model="form.local_tax"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('local_tax')"
          v-text="form.errors.get('local_tax')"
        ></span>
      </div>

      <div class="form-check">
        <input
          type="checkbox"
          class="form-check-input"
          id="local_tax_inclusive"
          v-model="form.local_tax_inclusive"
        />
        <label class="form-check-label" for="local_tax_inclusive"
          >Inclusive</label
        >
      </div>

      <div class="form-group">
        <label for="govt_tax">Government Tax</label>
        <input
          type="text"
          id="govt_tax"
          class="form-control"
          v-model="form.govt_tax"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('govt_tax')"
          v-text="form.errors.get('govt_tax')"
        ></span>
      </div>

      <div class="form-check">
        <input
          type="checkbox"
          class="form-check-input"
          id="govt_tax_inclusive"
          v-model="form.govt_tax_inclusive"
        />
        <label class="form-check-label" for="govt_tax_inclusive"
          >Inclusive</label
        >
      </div>

      <div class="form-group">
        <label for="">Service Charge</label>
        <input
          type="text"
          id="service_charge"
          class="form-control"
          v-model="form.service_charge"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('service_charge')"
          v-text="form.errors.get('service_charge')"
        ></span>
      </div>

      <div class="form-check">
        <input
          type="checkbox"
          class="form-check-input"
          id="service_charge_inclusive"
          v-model="form.service_charge_inclusive"
        />
        <label class="form-check-label" for="service_charge_inclusive"
          >Inclusive</label
        >
      </div>

      <div class="form-group">
        <label for="warning_amount">Warning Amount</label>
        <input
          type="text"
          id="warning_amount"
          class="form-control"
          v-model="form.warning_amount"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('warning_amount')"
          v-text="form.errors.get('warning_amount')"
        ></span>
      </div>

      <div class="form-group">
        <label for="default_amount">Default Amount</label>
        <input
          type="text"
          id="default_amount"
          class="form-control"
          v-model="form.default_amount"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('default_amount')"
          v-text="form.errors.get('default_amount')"
        ></span>
      </div>

      <button type="submit" class="btn btn-primary">
        Submit
      </button>
    </form>
  </div>
</template>

<script>
import Form from "../../core/Form.js";
export default {
  data() {
    return {
      form: new Form({
        accounting_side: "DEBIT",
        memo: "",
        local_tax: "",
        local_tax_inclusive: false,
        warning_amount: "",
        default_amount: "",
        govt_tax: "",
        govt_tax_inclusive: false,
        service_charge: "",
        service_charge_inclusive: false
      })
    };
  },
  methods: {
    handleSubmit() {
      this.form
        .submit("post", "/transaction/create")
        .then(response => this.$emit("dateIn", response))
        .catch(errors => console.log(errors));
    }
  }
};
</script>
