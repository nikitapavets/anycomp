export default class Dom {

    static outerClick = (elClass, callback) => {
        $('body').click(function (e) {
            if (!$(e.target).closest(`.${elClass}`).length) {
                callback(e);
            }
        });
    };

    static formItems = (formId) => {
        let formItems = decodeURIComponent($(`#${formId}`).serialize());
        return `{"${formItems.replace(/&/g, "\",\"").replace(/=/g, "\":\"")}"}`;
    };
}
