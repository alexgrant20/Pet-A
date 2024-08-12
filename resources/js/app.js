import "./bootstrap";

import AirDatepicker from "air-datepicker";
import "air-datepicker/air-datepicker.css";
import localeEn from "air-datepicker/locale/en";

document.querySelectorAll(".date-picker").forEach(function (el) {
   new AirDatepicker(el, {
      locale: localeEn,
      autoClose: true,
      onSelect({ formattedDate, date, inst }) {
         const event = new Event("change", { bubbles: true });
         el.dispatchEvent(event);
      },
      dateFormat: 'dd-MM-yyyy',
   });
});
