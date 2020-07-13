import Errors from "./Errors";
class Form {
  constructor(data) {
    this.originalData = data;

    for (let field in data) {
      this[field] = data[field];
    }

    this.errors = new Errors();
  }
  reset() {
    for (let field in this.originalData) {
      this[field] = "";
    }

    this.errors.clear();
  }
  submit(requestType, url) {
    return new Promise((resolve, reject) => {
      //console.log(this.data());
      axios[requestType](url, this.data())
        .then(response => resolve(response.data))
        .catch(error => {
          this.onFail(error.response.data);
          reject(error.response.data);
        });
    });
  }

  data() {
    let data = {};
    for (let prop in this.originalData) {
      data[prop] = this[prop];
    }
    return data;
  }

  onFail(errors) {
    this.errors.record(errors.errors);
  }
}

export default Form;
