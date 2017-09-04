import FlexibleTable from './FlexibleTable';
import Searcher from '../admin/Searcher';

export default class FlexibleTableSearch extends FlexibleTable {

    constructor(table, config = {}) {
        super(table, config);

        this.searcher = new Searcher(config.searcher.id, {
            title: config.searcher.title,
            link: config.searcher.link,
            callback: (model) => {
                this.attachRow(this.makeRow(model));
                this.store({
                    repair_id: this.modelId,
                    spare_id: model.id
                }).then(id => console.log(id));
            }
        })
    }

    setEventListeners() {
        super.setEventListeners();
        if(this.buttons.add) {
            this.buttons.add.onclick = (event) => {
                this.searcher.open();
                event.preventDefault();
            };
        }
        if(this.buttons.remove) {
            this.buttons.remove.onclick = (event) => {
                [].slice.call(this.table.querySelectorAll(`${this.classes.checker}.checked`)).map(checker => {
                    if(!checker.closest(this.classes.mainChecker)) {
                        let rowId = checker.closest('tr').dataset.id;
                        checker.closest('tr').remove();
                        this.destroy({
                            repair_id: this.modelId,
                            spare_id: rowId
                        });
                    }
                });
                this.mainChecker.querySelector(this.classes.checker).classList.remove('checked');

                event.preventDefault();
            };
        }
    }

    makeRow(model) {
        let row = super.makeRow();
        row.dataset.id = model.id;
        this.cellsNames.map(_ => row.appendChild(this.makeCell(model[_])));
        return row;
    }

    destroy(data) {
        return fetch(this.link, {
            method: "delete",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        })
            .then(response => response.json())
            .then(json => json.id);
    }
}
