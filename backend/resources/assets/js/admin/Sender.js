import Api from './Api';

const defaultConfig = {
    'link': '/'
};

const defaultClasses = {
    'pusher': '.sender__push'
};

export default class Sender {
    constructor(container) {
        this.container = container;
        this.link = container.dataset.link || defaultConfig.link;
        this.pushers = [].slice.call(container.querySelectorAll(defaultClasses.pusher));
        this.setEventListeners();
    }

    setEventListeners() {
        this.pushers.map(pusher => {
            pusher.addEventListener('click', (event) => {
                Api.post(this.link, pusher.dataset);
                this.pushers.map(_ => _.classList.remove('active'));
                pusher.classList.add('active');
                event.preventDefault();
            })
        });
    }
}
