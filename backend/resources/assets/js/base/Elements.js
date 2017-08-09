export default class Elements {
    hideElement(element) {
        element.classList.add('hidden');
    }

    showElement(element) {
        element.classList.remove('hidden');
    }
}
