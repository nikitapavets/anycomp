import Elements from '../base/Elements';

const defaultClasses = {
    'wrapper': 'admin-form-checker',
    'gag': 'admin-form-checker__gag',
    'real': 'admin-form-checker__real',
    'checked': 'checked'
};

export default class Checker extends Elements{
    constructor(input) {
        super();

        this.input = input;
        this.container = input.parentNode;
        this.makeGag();
        this.setEventListeners();
    }

    makeGag() {
        let wrapper = document.createElement('div');
        wrapper.className = defaultClasses.wrapper;
        this.container.replaceChild(wrapper, this.input);

        this.gag = document.createElement('span');
        this.gag.className = defaultClasses.gag;
        if(this.input.checked) {
            this.gag.classList.add(defaultClasses.checked);
        }
        this.input.classList.add(defaultClasses.real);
        this.gag.appendChild(this.input);

        wrapper.appendChild(this.gag);
    }

    setEventListeners() {
        this.input.addEventListener('click', (event) => {
            this.gag.classList.toggle(defaultClasses.checked);
        });
    }
}
