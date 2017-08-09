import FlexibleTable from './admin/FlexibleTable';

let flexibleTables = Array.prototype.slice.call(document.querySelectorAll('.flexibleTable'));
flexibleTables.map(table => {
    new FlexibleTable(table);

});

