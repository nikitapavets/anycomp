import FlexibleTableFlex from './admin/FlexibleTableFlex';
import FlexibleTableSearch from './admin/FlexibleTableSearch';
import Searcher from './admin/Searcher';
import flatpickr from 'flatpickr';
import flatpickrRussianLocale from "flatpickr/dist/l10n/ru.js";
import 'flatpickr/dist/themes/airbnb.css';

let flexibleTablesFlex = Array.prototype.slice.call(document.querySelectorAll('.flexibleTable.flex'));
flexibleTablesFlex.map(table => {
    new FlexibleTableFlex(table);

});

let flexibleTablesSearch = Array.prototype.slice.call(document.querySelectorAll('.flexibleTable.search'));
flexibleTablesSearch.map(table => {
    new FlexibleTableSearch(table, {
        searcher: {
            id: 'searchSpare',
            title: 'Поиск деталей для ремонта',
            link: '/api/spares/search',
        }
    });

});

// new Searcher('searchSpare', {
//     title: 'Поиск деталей для ремонта',
//     link: '/api/spares/search',
//     callback: (result) => {
//         console.log(result, 'result');
//     }
// });


/**
 * Set a DatePicker
 *
 * @link https://chmln.github.io/flatpickr
 */
flatpickr('.widget__DatePicker', {
    'locale': flatpickrRussianLocale.ru,
    altInput: true
});

