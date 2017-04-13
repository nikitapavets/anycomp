export default class Dom {

    static outerClick = (elClass, callback) => {
        $('body').click(function (e) {
            if (!$(e.target).closest(`.${elClass}`).length) {
                callback(e);
            }
        });
    };

    static formItems = (formId) => {
        return $(`#${formId}`).serialize()
    };
}
