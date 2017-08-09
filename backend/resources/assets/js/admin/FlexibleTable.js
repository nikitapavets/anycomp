import Elements from '../base/Elements';

const classes = {
    'editButton': '.flexibleTable__editBtn',
    'editInput': '.flexibleTable__editInput',
    'currentValue': '.flexibleTable__currentValue'
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
        this.setEventListeners();
    }

    setEventListeners() {
        Array.prototype.slice.call(this.table.querySelectorAll('td')).map(td => {
            let editBtn = td.querySelector(classes.editButton);
            let editInput = td.querySelector(classes.editInput);
            let currentValue = td.querySelector(classes.currentValue);
            if(editBtn) {
                td.addEventListener('mouseenter', () => {
                    this.showElement(editBtn);
                });
                td.addEventListener('mouseleave', () => {
                    this.hideElement(editBtn)
                });
                editBtn.addEventListener('click', (event) => {
                    if(editInput) {
                        let actionType = editBtn.dataset.type || actionTypes.editField;
                        if(actionType === actionTypes.editField) {
                            this.openForEdit(editBtn, editInput, currentValue);
                        } else if(actionType === actionTypes.saveField) {
                            this.saveFromEdit(editBtn, editInput, currentValue);
                        }
                    }
                    event.preventDefault();
                });
                editInput.addEventListener('keyup', (event) => {
                    if(event.keyCode === 13){
                        this.saveFromEdit(editBtn, editInput, currentValue);
                        event.preventDefault();
                    }
                });
            }
        })
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
        this.hideElement(editInput)
    }
}
