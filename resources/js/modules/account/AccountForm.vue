<template>
  <div>
    <form
      v-on:submit.prevent="handleSubmit"
      v-on:keyup="form.errors.clear($event.target.name)"
    >
      <div class="form-group">
        <label for="title">Title</label>
        <select
          name="title"
          id="title"
          v-model="form.title"
          class="form-control"
        >
          <option value="">--Select--</option>
          <option value="Mr.">Mr.</option>
          <option value="Mrs.">Mrs.</option>
          <option value="Mrs.">Dr.</option>
          <option value="Mrs.">Engr.</option>
          <option value="Mrs.">Atty.</option>
        </select>

        <span
          class="text-danger"
          v-if="form.errors.any('title')"
          v-text="form.errors.get('title')"
        ></span>
      </div>
      <div class="form-group">
        <label for="last_name">Last Name</label>
        <input
          type="text"
          class="form-control"
          name="last_name"
          id="last_name"
          v-model="form.last_name"
          :keyup="setAccountName()"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('last_name')"
          v-text="form.errors.get('last_name')"
        ></span>
      </div>
      <div class="form-group">
        <label for="first_name">First Name</label>
        <input
          type="text"
          class="form-control"
          name="first_name"
          id="first_name"
          v-model="form.first_name"
          :keydown="setAccountName()"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('first_name')"
          v-text="form.errors.get('first_name')"
        ></span>
      </div>
      <div class="form-group">
        <label for="middle_name">Middle Name</label>
        <input
          type="text"
          class="form-control"
          name="middle_name"
          id="middle_name"
          v-model="form.middle_name"
          :keydown="setAccountName()"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('middle_name')"
          v-text="form.errors.get('middle_name')"
        ></span>
      </div>
      <div class="form-group">
        <label for="account_name">Guest Name</label>
        <input
          type="text"
          class="form-control"
          name="account_name"
          id="account_name"
          v-model="form.account_name"
          readonly
        />
        <span
          class="text-danger"
          v-if="form.errors.any('account_name')"
          v-text="form.errors.get('account_name')"
        ></span>
      </div>
      <div class="form-group">
        <label for="gender">Gender</label>
        <select
          name="gender"
          id="gender"
          class="form-control"
          v-model="form.gender"
        >
          <option value="">--Select--</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
        <span
          class="text-danger"
          v-if="form.errors.any('gender')"
          v-text="form.errors.get('gender')"
        ></span>
      </div>
      <div class="form-group">
        <label for="citizenship">Citizenship</label>
        <input
          type="text"
          class="form-control"
          name="citizenship"
          id="citizenship"
          v-model="form.citizenship"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('citizenship')"
          v-text="form.errors.get('citizenship')"
        ></span>
      </div>
      <div class="form-group">
        <label for="passport_id">Passport Id</label>
        <input
          type="text"
          class="form-control"
          name="passport_id"
          id="passport_id"
          v-model="form.passport_id"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('passport_id')"
          v-text="form.errors.get('passport_id')"
        ></span>
      </div>
      <div class="form-group">
        <label for="birth_date">Birth date</label>
        <input
          type="date"
          class="form-control"
          name="birth_date"
          id="birth_date"
          v-model="form.birth_date"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('birth_date')"
          v-text="form.errors.get('birth_date')"
        ></span>
      </div>
      <div class="form-group">
        <label for="threshold_amount">Threshold Amount</label>
        <input
          type="number"
          class="form-control"
          name="threshold_amount"
          id="threshold_amount"
          v-model="form.threshold_amount"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('threshold_amount')"
          v-text="form.errors.get('threshold_amount')"
        ></span>
      </div>
      <div class="form-group">
        <label for="account_type">Account Type</label>
        <select
          id="account_type"
          class="form-control"
          v-model="form.account_type"
        >
          <option value="">--Select--</option>
          <option value="INDIVIDUAL">INDIVIDUAL</option>
          <option value="GROUP">GROUP</option>
        </select>
        <span
          class="text-danger"
          v-if="form.errors.any('account_type')"
          v-text="form.errors.get('account_type')"
        ></span>
      </div>
      <div class="form-group">
        <label for="telephone">Telephone</label>
        <input
          type="text"
          class="form-control"
          name="telephone"
          id="telephone"
          v-model="form.telephone"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('telephone')"
          v-text="form.errors.get('telephone')"
        ></span>
      </div>
      <div class="form-group">
        <label for="mobile">Mobile</label>
        <input
          type="text"
          class="form-control"
          name="mobile"
          id="mobile"
          v-model="form.mobile"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('mobile')"
          v-text="form.errors.get('mobile')"
        ></span>
      </div>
      <div class="form-group">
        <label for="address_street">Address Street</label>
        <input
          type="text"
          class="form-control"
          name="address_street"
          id="address_street"
          v-model="form.address_street"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('address_street')"
          v-text="form.errors.get('address_street')"
        ></span>
      </div>
      <div class="form-group">
        <label for="address_city">Address City</label>
        <input
          type="text"
          class="form-control"
          name="address_city"
          id="address_city"
          v-model="form.address_city"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('address_city')"
          v-text="form.errors.get('address_city')"
        ></span>
      </div>
      <div class="form-group">
        <label for="country">Country</label>
        <input
          type="text"
          class="form-control"
          name="country"
          id="country"
          v-model="form.country"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('country')"
          v-text="form.errors.get('country')"
        ></span>
      </div>
      <div class="form-group">
        <label for="zip">Zip</label>
        <input
          type="text"
          class="form-control"
          name="zip"
          id="zip"
          v-model="form.zip"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('zip')"
          v-text="form.errors.get('zip')"
        ></span>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input
          type="text"
          class="form-control"
          name="email"
          id="email"
          v-model="form.email"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('email')"
          v-text="form.errors.get('email')"
        ></span>
      </div>
      <div class="form-group">
        <label for="credit_card_type">Credit Card Type</label>
        <input
          type="text"
          class="form-control"
          name="credit_card_type"
          id="credit_card_type"
          v-model="form.credit_card_type"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('credit_card_type')"
          v-text="form.errors.get('credit_card_type')"
        ></span>
      </div>
      <div class="form-group">
        <label for="credit_card_no">Credit Card No</label>
        <input
          type="text"
          class="form-control"
          name="credit_card_no"
          id="credit_card_no"
          v-model="form.credit_card_no"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('credit_card_no')"
          v-text="form.errors.get('credit_card_no')"
        ></span>
      </div>
      <div class="form-group">
        <label for="credit_card_exp_date">Credit Card Expiration Date</label>
        <input
          type="text"
          class="form-control"
          name="credit_card_exp_date"
          id="credit_card_exp_date"
          v-model="form.credit_card_exp_date"
        />
        <span
          class="text-danger"
          v-if="form.errors.any('credit_card_exp_date')"
          v-text="form.errors.get('credit_card_exp_date')"
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
  props: ["account"],
  data() {
    return {
      form: new Form({
        title: "",
        account_name: "",
        last_name: "",
        first_name: "",
        middle_name: "",
        gender: "",
        citizenship: "",
        passport_id: "",
        birth_date: "",
        threshold_amount: "",
        account_type: "",
        telephone: "",
        mobile: "",
        address_street: "",
        address_city: "",
        country: "",
        zip: "",
        email: "",
        credit_card_type: "",
        credit_card_no: "",
        credit_card_exp_date: ""
      })
    };
  },
  methods: {
    handleSubmit() {
      this.form
        .submit("post", "/account/create")
        .then(response => this.$emit("dateIn", response))
        .catch(errors => {
          console.log(errors);
          alert(errors.message);
        });
    },
    setAccountName() {
      this.form.account_name = this.form.last_name + " " + this.form.first_name + " " + this.form.middle_name;
    }
  },
};
</script>
