require("./bootstrap");
require("vue-multiselect/dist/vue-multiselect.min.css");

window.Vue = require("vue");

var Turbolinks = require("turbolinks");
import TurbolinksAdapter from "vue-turbolinks";

Turbolinks.start();

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component("card", require("./components/Card.vue").default);

Vue.component(
  "account-list",
  require("./modules/account/AccountList.vue").default
);

Vue.component(
  "account-form",
  require("./modules/account/AccountForm.vue").default
);

Vue.component("room-component", require("./modules/room/Room.vue").default);

Vue.component(
  "company-component",
  require("./modules/company/Company.vue").default
);
Vue.component(
  "travel-agent-component",
  require("./modules/travel-agent/TravelAgent.vue").default
);
Vue.component(
  "reservation-component",
  require("./modules/reservation/Reservation.vue").default
);
Vue.component(
  "reservation-list-component",
  require("./modules/reservation/ReservationList.vue").default
);

Vue.component(
  "transaction-component",
  require("./modules/transaction/Transaction.vue").default
);

Vue.component("promo-component", require("./modules/promo/Promo.vue").default);

Vue.component(
  "service-component",
  require("./modules/service/Service.vue").default
);

document.addEventListener("turbolinks:load", () => {
  var element = document.getElementById("app");
  if (element != null) {
    const app = new Vue({
      el: element
    });
  }
});
