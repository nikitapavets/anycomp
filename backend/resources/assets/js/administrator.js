import FlexibleTableFlex from './admin/FlexibleTableFlex';
import FlexibleTableSearch from './admin/FlexibleTableSearch';
import Sender from './admin/Sender';
import Checker from './admin/Checker';
import flatpickr from 'flatpickr';
import flatpickrRussianLocale from 'flatpickr/dist/l10n/ru';
import 'flatpickr/dist/themes/airbnb.css';

(() => {

    let flexibleTablesFlex = [].slice.call(document.querySelectorAll('.flexibleTable.flex'));
    flexibleTablesFlex.map(table => {
        new FlexibleTableFlex(table);

    });

    let flexibleTablesSearch = [].slice.call(document.querySelectorAll('.flexibleTable.search'));
    flexibleTablesSearch.map(table => {
        new FlexibleTableSearch(table, {
            searcher: {
                id: 'searchSpare',
                title: 'Поиск деталей для ремонта',
                link: '/api/spares/search',
            }
        });
    });

    let senders = [].slice.call(document.querySelectorAll('.sender'));
    senders.map(senderContainer => {
        new Sender(senderContainer);
    });

    let checkers = [].slice.call(document.querySelectorAll('.checker'));
    checkers.map(checkerContainer => {
        new Checker(checkerContainer);
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

})();

