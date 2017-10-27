import FlexibleTableFlex from './admin/FlexibleTableFlex';
import FlexibleTableSearch from './admin/FlexibleTableSearch';
import Sender from './admin/Sender';
import Statistics from './admin/Statistics';
import flatpickr from 'flatpickr';
import flatpickrRussianLocale from 'flatpickr/dist/l10n/ru.js';
import 'flatpickr/dist/themes/airbnb.css';
// modules
import RepairPage from './admin/modules/RepairPage';

let flexibleTablesFlex = [].slice.call(
    document.querySelectorAll('.flexibleTable.flex'),
);
flexibleTablesFlex.map(table => {
  new FlexibleTableFlex(table);

});

let flexibleTablesSearch = [].slice.call(
    document.querySelectorAll('.flexibleTable.search'),
);
flexibleTablesSearch.map(table => {
  new FlexibleTableSearch(table, {
    searcher: {
      id: 'searchSpare',
      title: 'Поиск деталей для ремонта',
      link: '/api/spares/search',
    },
  });
});

let senders = [].slice.call(document.querySelectorAll('.sender'));
senders.map(senderContainer => {
  new Sender(senderContainer);
});

const repairsChart = document.querySelector('#repairsChart');
if(repairsChart) {
  const statistics = new Statistics();
  statistics.repairs(repairsChart);
}

/**
 * Set a DatePicker
 *
 * @link https://chmln.github.io/flatpickr
 */
flatpickr('.widget__DatePicker', {
  'locale': flatpickrRussianLocale.ru,
  altInput: true,
});

// modules
const repairPageContainer = document.querySelector('#repairPage');
if(repairPageContainer) {
  new RepairPage(repairPageContainer.dataset.repairId);
}
