import Elements from '../base/Elements';

const classes = {
    'container': 'searcher__container',
    'searcher': 'searcher',
    'searcherTitle': 'searcher__title',
    'searcherField': 'searcher__field',
    'searcherResults': 'searcher__results',
    'searcherFieldInput': 'admin-form-input',
    'searcherFieldBtn': 'admin-form-button',
    'searcherAddBtn': 'searcher__addBtn',
    'searcherGag': 'searcher__gag'
};

const defaultConfig = {
    'title': 'Поиск',
    'sendButtonTitle': 'Поиск',
    'searchGag': 'Ничего не найдено'
};

const icons = {
    'save': '#admin_plus_595959'
};

export default class Searcher extends Elements {
    constructor(id, config = defaultConfig) {
        super();

        this.config = config;
        this.container = this.make(id);
        document.body.appendChild(this.container);
    }

    make(id) {
        let container = document.createElement('div');
        container.id = id;
        container.className = classes.container;
        this.hideElement(container);

        document.body.onclick = (event) => {
            if(event.target === container) {
                this.hideElement(container);
            }
        };

        let searcher = document.createElement('div');
        searcher.className = classes.searcher;
        container.appendChild(searcher);

        let searcherTitle = document.createElement('div');
        searcherTitle.className = classes.searcherTitle;
        searcherTitle.innerText = this.config.title || defaultConfig.title;
        searcher.appendChild(searcherTitle);

        let searcherField = document.createElement('div');
        searcherField.className = classes.searcherField;
        searcher.appendChild(searcherField);

        searcherField.appendChild(this.makeInput());
        searcherField.appendChild(this.makeButton());

        let searcherResults = document.createElement('div');
        searcherResults.className = classes.searcherResults;
        searcher.appendChild(searcherResults);
        this.results = searcherResults;

        return container;
    }

    makeInput() {
        let searcherFieldInput = document.createElement('input');
        searcherFieldInput.className = classes.searcherFieldInput;
        this.input = searcherFieldInput;

        searcherFieldInput.onkeyup =  (event) => {
            if(event.keyCode === 13){
                if(this.config.link) {
                    this.send(this.config.link, this.input.value);
                }
            }
        };

        return searcherFieldInput;
    }

    makeButton() {
        let searcherFieldBtn = document.createElement('button');
        searcherFieldBtn.className = classes.searcherFieldBtn;
        searcherFieldBtn.innerText = this.config.sendButtonTitle || defaultConfig.sendButtonTitle;

        searcherFieldBtn.onclick = (event) => {
            if(this.config.link) {
                this.send(this.config.link, this.input.value);
            }
            event.preventDefault();
        };

        return searcherFieldBtn;
    }

    makeResultRow(result) {
        let row = document.createElement('div');
        row.innerText = result.full_name || result.name;
        row.dataset.id = result.id;

        let addBtn = document.createElement('a');
        addBtn.href = '#';
        addBtn.className = `${classes.searcherAddBtn} hidden`;
        addBtn.innerHTML = `
                <svg>
                    <use xlink:href='${icons.save}'/>
                </svg>
            `;
        addBtn.onclick = (event) => {
            this.hideElement(this.container);
            this.config.callback(result);
            event.preventDefault();
        };
        row.appendChild(addBtn);
        row.onmouseenter =  () => {
            this.showElement(addBtn);
        };
        row.onmouseleave =  () => {
            this.hideElement(addBtn)
        };

        return row;
    }

    makeGag()
    {
        let gag = document.createElement('span');
        gag.className = classes.searcherGag;
        gag.innerText = this.config.searchGag || defaultConfig.searchGag;
        return gag;
    }

    fillResults(results) {
        this.results.innerHTML = '';

        if(!results.length) {
            this.results.appendChild(this.makeGag());
        }

        results.map(result => {
            this.results.appendChild(this.makeResultRow(result));
        });

    }

    send(link, data) {
        return fetch(`${link}?search=${data}`, {
            method: 'get',
        })
            .then(response => response.json())
            .then(json => this.fillResults(json))
    }

    open() {
        this.showElement(this.container);
    }
}
