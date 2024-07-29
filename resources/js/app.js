import './bootstrap';

import AirDatepicker from 'air-datepicker';
import 'air-datepicker/air-datepicker.css';
import localeId from 'air-datepicker/locale/id';


new AirDatepicker('.date-picker', {
   locale: localeId,
   autoClose: true
})
