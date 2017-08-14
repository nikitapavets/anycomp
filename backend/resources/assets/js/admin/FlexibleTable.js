import Elements from '../base/Elements';

const classes = {
    'editButton': '.flexibleTable__editBtn',
    'addButton': '.flexibleTable__addBtn',
    'removeButton': '.flexibleTable__removeBtn',
    'editInput': '.flexibleTable__editInput',
    'currentValue': '.flexibleTable__currentValue',
    'checker': '.checkers__subChecker',
    'mainChecker': '.checkers_main',
};

const icons = {
    'edit': '#admin_edit_595959',
    'save': '#admin_accept_595959'
};

const actionTypes = {
    'saveField': 'saveField',
    'editField': 'editField'
};

export default class FlexibleTable extends Elements{

    constructor(table, config = {}) {
        super();

        this.config = config;
        this.table = table;
        this.modelId = table.dataset.modelId;
        this.link = table.dataset.link;
        this.cellsNames = JSON.parse(table.dataset.cellsNames);
        this.buttons = {
            add: table.parentNode.querySelector(classes.addButton),
            remove: table.parentNode.querySelector(classes.removeButton)
        };
        this.setEventListeners();
    }

    setEventListeners() {
        this.checkers = [].slice.call(this.table.querySelectorAll(classes.checker));
        this.checkers.map(checker => {
            checker.querySelector('input').onclick = () => {
                checker.classList.toggle('checked');
                let checkedCheckers = this.checkers.filter(checker =>
                    ~checker.className.indexOf('checked') !== 0
                );
                if(!~checker.className.indexOf('checked')) {
                    mainChecker.querySelector(classes.checker).classList.remove('checked');
                } else if(this.checkers.length - 1 === checkedCheckers.length) {
                    mainChecker.querySelector(classes.checker).classList.add('checked');
                }
            };
        });

        this.mainChecker = this.table.querySelector(classes.mainChecker);
        this.mainChecker.querySelector('input').onchange = () => {
            [].slice.call(this.table.querySelectorAll(classes.checker)).map(checker => {
                if(~this.mainChecker.querySelector('span').className.indexOf('checked')) {
                    checker.classList.add('checked');
                } else {
                    checker.classList.remove('checked');
                }
            });
        };

        let removeButton = this.table.parentNode.querySelector(classes.removeButton);
        if(removeButton) {
            removeButton.onclick = (event) => {
                [].slice.call(this.table.querySelectorAll(`${classes.checker}.checked`)).map(checker => {
                    if(!checker.closest(classes.mainChecker)) {
                        let rowId = checker.closest('tr').dataset.id;
                        checker.closest('tr').remove();
                        this.destroy(rowId);
                    }
                });
                this.mainChecker.querySelector(classes.checker).classList.remove('checked');

                event.preventDefault();
            };
        }
    }

    makeCell(innerHtml = '') {
        let cell = document.createElement('td');
        cell.innerHTML = innerHtml;
        return cell;
    }

    makeCheckerCell() {
        let checkersHtml = `
            <div class="checkers">
                <div class="checkers__checker">
                    <span class="checkers__subChecker">
                        <input type="checkbox">
                    </span>
                </div>
            </div>
        `;
        let cell = this.makeCell(checkersHtml);
        cell.className = 'flexibleTable__checker';
        return cell;
    }

    makeRow() {
        let row = document.createElement('tr');
        row.appendChild(this.makeCheckerCell());
        return row;
    }

    attachRow(row) {
        let tbody = this.table.querySelector('tbody');
        if(tbody) {
            tbody.append(row);
            this.mainChecker.querySelector(classes.checker).classList.remove('checked');
            this.setEventListeners();
        }
    }

    store(data) {
        return fetch(this.link, {
            method: "post",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        })
            .then(response => response.json())
            .then(json => json.id);
    }

    update(id, newValues) {
        return fetch(`${this.link}/${id}`, {
            method: "put",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                repair_id: this.modelId,
                ...newValues
            }),
        })
            .then(response => response.json())
    }

    destroy(id) {
        return fetch(`${this.link}/${id}`, {
            method: "delete"
        })
            .then(response => response.json())
    }
}
