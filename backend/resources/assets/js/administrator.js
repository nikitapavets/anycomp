import FlexibleTable from './admin/FlexibleTable';
import flatpickr from 'flatpickr';
import flatpickrRussianLocale from "flatpickr/dist/l10n/ru.js";
import 'flatpickr/dist/themes/airbnb.css';

let flexibleTables = Array.prototype.slice.call(document.querySelectorAll('.flexibleTable'));
flexibleTables.map(table => {
    new FlexibleTable(table);

});

/**
 * Set a DatePicker
 *
 * @link https://chmln.github.io/flatpickr
 */
flatpickr('.widget__DatePicker', {
    'locale': flatpickrRussianLocale.ru,
    altInput: true
});

