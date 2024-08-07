import "./bootstrap";

import AirDatepicker from "air-datepicker";
import "air-datepicker/air-datepicker.css";
import localeId from "air-datepicker/locale/id";

document.querySelectorAll(".date-picker").forEach(function (el) {
   new AirDatepicker(el, {
      locale: localeId,
      autoClose: true,
   });
});
