import FlexibleTable from './FlexibleTable';

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

export default class FlexibleTableFlex extends FlexibleTable {

    constructor(table) {
        super(table);
    }

    setEventListeners() {
        super.setEventListeners();

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

        let addButton = this.table.parentNode.querySelector(classes.addButton);
        if(addButton) {
            addButton.onclick = (event) => {
                const cellDefaultValues = JSON.parse(this.table.dataset.defaultValues);
                let row = this.makeNewRow(this.cellsNames, cellDefaultValues);
                let tbody = this.table.querySelector('tbody');
                if(tbody) {
                    tbody.append(row);
                    this.mainChecker.querySelector(classes.checker).classList.remove('checked');
                    this.setEventListeners();
                }
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
        return fetch(this.link, {
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
