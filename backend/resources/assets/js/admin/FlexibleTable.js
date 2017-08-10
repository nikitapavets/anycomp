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

    constructor(table) {
        super();

        this.table = table;
        this.modelId = table.dataset.modelId;
        this.setEventListeners();
    }

    setEventListeners() {
        Array.prototype.slice.call(this.table.querySelectorAll('td')).map(cell => {
            let row = cell.parentNode;
            let editBtn = cell.querySelector(classes.editButton);
            let editInput = cell.querySelector(classes.editInput);
            let currentValue = cell.querySelector(classes.currentValue);
            if(editBtn) {
                cell.onmouseenter =  () => {
                    this.showElement(editBtn);
                };
                cell.onmouseleave =  () => {
                    this.hideElement(editBtn)
                };
                editBtn.onclick = (event) => {
                    if(editInput) {
                        let actionType = editBtn.dataset.type || actionTypes.editField;
                        if(actionType === actionTypes.editField) {
                            this.openForEdit(editBtn, editInput, currentValue);
                        } else if(actionType === actionTypes.saveField) {
                            this.saveFromEdit(editBtn, editInput, currentValue);
                            this.save(row);
                        }
                    }
                    event.preventDefault();
                };
                editInput.onkeyup =  (event) => {
                    if(event.keyCode === 13){
                        this.saveFromEdit(editBtn, editInput, currentValue);
                        this.save(row);
                    }
                };
            }
        });

        let checkers = [].slice.call(this.table.querySelectorAll(classes.checker));
        checkers.map(checker => {
            checker.querySelector('input').onclick = () => {
                checker.classList.toggle('checked');
                let checkedCheckers = checkers.filter(checker =>
                    ~checker.className.indexOf('checked') !== 0
                );
                if(!~checker.className.indexOf('checked')) {
                    mainChecker.querySelector(classes.checker).classList.remove('checked');
                } else if(checkers.length - 1 === checkedCheckers.length) {
                    mainChecker.querySelector(classes.checker).classList.add('checked');
                }
            };
        });

        let mainChecker = this.table.querySelector(classes.mainChecker);
        mainChecker.querySelector('input').onchange = () => {
            [].slice.call(this.table.querySelectorAll(classes.checker)).map(checker => {
                if(~mainChecker.querySelector('span').className.indexOf('checked')) {
                    checker.classList.add('checked');
                } else {
                    checker.classList.remove('checked');
                }
            });
        };

        // $('.subChecker input').change(function (e) {
        //
        //     if ($('.subChecker.checked').length == $('.subChecker').length) {
        //         $('.mainChecker').addClass('checked');
        //     } else {
        //         $('.mainChecker').removeClass('checked');
        //     }
        // });

        let addButton = this.table.parentNode.querySelector(classes.addButton);
        if(addButton) {
            addButton.onclick = (event) => {
                const cellNames = JSON.parse(this.table.dataset.names);
                const cellDefaultValues = JSON.parse(this.table.dataset.defaultValues);
                let row = this.makeNewRow(cellNames, cellDefaultValues);
                let tbody = this.table.querySelector('tbody');
                if(tbody) {
                    tbody.append(row);
                    mainChecker.querySelector(classes.checker).classList.remove('checked');
                    this.setEventListeners();
                }
                event.preventDefault();
            };
        }

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
                mainChecker.querySelector(classes.checker).classList.remove('checked');

                event.preventDefault();
            };
        }
    }

    makeNewRow(cellNames, cellDefaultValues = []) {
        let row = document.createElement('tr');

        let cell = document.createElement('td');
        cell.className = 'flexibleTable__checker';
        cell.innerHTML = `
            <div class="checkers">
                <div class="checkers__checker">
                    <span class="checkers__subChecker">
                        <input type="checkbox">
                    </span>
                </div>
            </div>
        `;
        row.appendChild(cell);

        cellNames.map((cellName, position) => {
            let cell = document.createElement('td');

            let description = document.createElement('span');
            description.className = 'flexibleTable__currentValue hidden';
            description.innerText = cellDefaultValues[position] || '';
            cell.appendChild(description);

            let value = document.createElement('input');
            value.className = 'flexibleTable__editInput';
            value.value = cellDefaultValues[position] || '';
            value.setAttribute('name', cellName);
            value.setAttribute('type', 'text');
            cell.appendChild(value);

            let editBtn = document.createElement('a');
            editBtn.href = '/';
            editBtn.className = 'flexibleTable__editBtn hidden';
            editBtn.dataset.type = actionTypes.saveField;
            editBtn.innerHTML = `
                <svg class="flexibleTable__svg">
                    <use xlink:href='${icons.save}'/>
                </svg>
            `;
            cell.appendChild(editBtn);

            row.appendChild(cell);
        });

        return row;
    }

    openForEdit(editBtn, editInput, currentValue) {
        editBtn.dataset.type = actionTypes.saveField;
        editBtn.querySelector('use').setAttribute('xlink:href', icons.save);
        editInput.value = currentValue.textContent;
        this.showElement(editInput);
        this.hideElement(currentValue)
    }

    saveFromEdit(editBtn, editInput, currentValue) {
        editBtn.dataset.type = actionTypes.editField;
        editBtn.querySelector('use').setAttribute('xlink:href', icons.edit);
        currentValue.textContent = editInput.value;
        this.showElement(currentValue);
        this.hideElement(editInput);
    }

    save(row) {
        const rowId = row.dataset.id;
        let newValues = {};
        [].map.call(row.querySelectorAll('input[type="text"]'), (input) => {
            newValues[input.name] = input.value;
        });

        if(rowId) {
            this.update(rowId, newValues);
        } else {
            this.store(newValues).then(newRowId => row.dataset.id = newRowId);
        }
    }

    store(newValues) {
        return fetch('/api/repair_description', {
            method: "post",
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
            .then(json => json.id);
    }

    update(id, newValues) {
        return fetch(`/api/repair_description/${id}`, {
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
            // .then(json => console.log(json));
    }

    destroy(id) {
        return fetch(`/api/repair_description/${id}`, {
            method: "delete"
        })
            .then(response => response.json())
            // .then(json => console.log(json));
    }
}
