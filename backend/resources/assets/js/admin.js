$('document').ready(function () {

    var Forms = {

        'uploader': function () {

            $('.uploader input').focus(function (e) {
                $(this).parent().find('.upload-files').removeClass('hidden');

            });

            $('.uploader input').on('change', function (event, files, label) {
                var file_name = this.value.replace(/\\/g, '/').replace(/.*\//, '');
                $(this).next('.filename').text(file_name);
            });

        },

        'fileUploader': function () {

            $(document).click(function (event) {
                if ($(event.target).closest('.upload-files__area').length) return;
                if ($(event.target).closest('input').length) return;
                if ($(event.target).closest('.upload-files__area .admin-panel__buttons').length) return;
                $('.upload-files').addClass('hidden');
            });

        },

        'ajaxUploadSingleImage': function () {

            $('.uploaderSingleImage').each(function (i, item) {
                var uploader = $(item);
                var btnUpload = uploader.find('#UploadSingleImage');
                var loader = uploader.find('.loader');
                var error = uploader.find('.error');

                if (btnUpload.length) {
                    new AjaxUpload(btnUpload, {
                        action: '/upload/files',
                        name: 'uploadfile',
                        onSubmit: function (file, ext) {
                            error.text('');
                            if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext))) {
                                error.text('Поддерживаемые форматы: jpg, png, gif.');
                                return false;
                            } else if (uploader.find('.item').length >= 1) {
                                error.text('Превышено максимальное колличество файлов.');
                                return false;
                            }
                            loader.removeClass("hidden");
                        },
                        onComplete: function (file, response) {
                            var item = '' +
                                '<div class="item">' +
                                '<images src="' + response + '" data-link="' + response + '">' +
                                ' <a href="javascript:;" class="cross">' +
                                '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">' +
                                '<use xlink:href="#cross_ff491f"></use>' +
                                '</svg>' +
                                '</a>' +
                                '</div>';
                            uploader.find('.items').append(item);
                            loader.addClass("hidden");
                            Forms.updateUploadFiles(uploader);
                            Forms.deleteUploadFiles(uploader);
                        }
                    });

                    Forms.deleteUploadFiles(uploader);
                }
            });
        },

        'ajaxUploader': function () {

            $('.uploaderMultiImage').each(function (i, item) {
                var uploader = $(item);
                var btnUpload = uploader.find('#UploadFiles');
                var loader = btnUpload.find('.loader');
                var error = btnUpload.find('.error');

                if (btnUpload.length) {
                    new AjaxUpload(btnUpload, {
                        action: '/upload/files',
                        name: 'uploadfile',
                        onSubmit: function (file, ext) {
                            error.text('');
                            if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext))) {
                                error.text('Поддерживаемые форматы: jpg, png, gif.');
                                return false;
                            } else if (uploader.find('.item').length >= 12) {
                                error.text('Превышено максимальное колличество файлов.');
                                return false;
                            }
                            loader.removeClass("hidden");
                        },
                        onComplete: function (file, response) {
                            var item = '' +
                                '<div class="item">' +
                                '<images src="' + response + '" data-link="' + response + '">' +
                                ' <a href="javascript:;" class="cross">' +
                                '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">' +
                                '<use xlink:href="#cross_ff491f"></use>' +
                                '</svg>' +
                                '</a>' +
                                '</div>';
                            uploader.find('.items').append(item);
                            loader.addClass("hidden");
                            Forms.updateUploadFiles(uploader);
                            Forms.deleteUploadFiles(uploader);
                        }
                    });
                    Forms.deleteUploadFiles(uploader);
                }
            });
        },

        'updateUploadFiles': function (item) {

            var links = [];
            item.find('.item').each(function (i) {
                links.push(item.find('.item images').eq(i).data('link'));
            });
            item.find('.inp_img').val(links.join(','));
            if (item.find('.item').length == 0) {
                item.find('.filename').text('Файлы не выбраны');
            } else {
                item.find('.filename').text('Выбрано файлов: ' + item.find('.item').length);
            }
        },

        'deleteUploadFiles': function (item) {

            item.find('.cross').click(function (e) {
                $(this).parent().remove();
                Forms.updateUploadFiles(item);
                e.preventDefault();
                return false;
            });
        },

        'adminChosen': function () {

            var base = [];
            var area = [];
            var dropArea = [];
            var dropItem = [];
            var input = [];
            $('.admin-chosen').each(function (index, item) {
                base[index] = $(item);
                area[index] = base[index].find('.admin-chosen__area');
                dropArea[index] = base[index].find('.admin-chosen__drop');
                dropItem[index] = base[index].find('.admin-chosen__drop--item');
                input[index] = base[index].find('.admin-chosen__input');

                area[index].click(function () {
                    var hiddenItems = 0;
                    dropItem[index].each(function (i) {
                        if (dropItem[index].eq(i).hasClass('hidden')) {
                            hiddenItems++;
                        }
                    });
                    if (hiddenItems != dropItem[index].length) {
                        dropArea[index].removeClass('hidden');
                    }
                });

                var closeHandle = function () {
                    var closeNode = base[index].find('.close');
                    closeNode.click(function () {
                        $(this).parent().remove();
                        var nodeText = $(this).parent().find('span').text();
                        dropItem[index].each(function (i) {
                            if (dropItem[index].eq(i).text() == nodeText) {
                                dropItem[index].eq(i).removeClass('hidden');
                            }
                        });
                        updateChosen();
                    });
                };
                closeHandle();

                var updateChosen = function () {
                    var chosenItems = [];
                    dropItem[index].each(function (i) {
                        if (dropItem[index].eq(i).hasClass('hidden')) {
                            chosenItems.push(dropItem[index].eq(i).data('id'));
                        }
                    });
                    input[index].val(chosenItems.join(','));
                };
                updateChosen();

                dropItem[index].click(function () {
                    var itemText = $(this).text();
                    var itemNode = '' +
                        '<li class="admin-chosen__area--item"> ' +
                        '<span>' + itemText + '</span> ' +
                        '<a href="javascript:;" class="close"></a> ' +
                        '</li>';
                    area[index].append(itemNode);
                    dropArea[index].addClass('hidden');
                    $(this).addClass('hidden');
                    closeHandle();
                    updateChosen();
                });

                $(document).click(function (event) {
                    if ($(event.target).closest('.admin-chosen__drop').length) return;
                    if ($(event.target).closest('.admin-chosen__area').length) return;
                    dropArea[index].addClass('hidden');
                });
            });
        },

    };
    Forms.fileUploader();
    Forms.uploader();
    Forms.ajaxUploader();
    Forms.ajaxUploadSingleImage();
    Forms.adminChosen();

    $('.admin-panel__left-side--menu .menu-item').click(function (e) {
        $(this).toggleClass('active');
        $(this).next('ul.sub').slideToggle('fast');
    });

    $('.admin-panel__left-side--menu .menu-item-sub').click(function (e) {
        $('.admin-panel__left-side--menu .menu-item-sub').each(function (i) {
            $(this).parent().removeClass('active');
        });
        $(this).parent().addClass('active');
    });

    var Validator = {};
    Validator.onlyRussian = function (data) {
        var regex = /^[А-Я|ё| ]+$/i;
        if (data.search(regex) != -1) {
            return true;
        } else {
            return false;
        }
    }
    Validator.isEmpty = function (data) {
        if (isNaN(data)) {
            return data.trim() == '';
        }
        return data == 0;

    }

    $('.inp_select').change(function (e) {
        $(this).prev('span').text($(this).find('option:selected').text());
    });

    $('.admin-panel__checker input').click(function (e) {
        $(this).parent("span").toggleClass('checked');
    });

    $('.inp_plus').click(function (e) {
        $(this).parent().next().removeClass('hidden');
        $(this).addClass('hidden');
    })

    function saveStatuses() {
        var statuses = '';
        $('.dual_selects__second option').each(function (i) {
            statuses += $('.dual_selects__second option').eq(i).val() + ',';
        });
        $('#techStatuses').val(statuses);
    }

    $('.dual_selects__stof').click(function (e) {
        var selected = $('.dual_selects__second option:selected');
        $('.dual_selects__first').append(selected);

        saveStatuses();
        e.preventDefault();
    });

    $('.dual_selects__alltof').click(function (e) {
        var selected = $('.dual_selects__second option');
        selected.each(function (i) {
            $('.dual_selects__first').append(selected[i]);
        });

        saveStatuses();
        e.preventDefault();
    });

    $('.dual_selects__ftos').click(function (e) {
        var selected = $('.dual_selects__first option:selected');
        $('.dual_selects__second').append(selected);

        saveStatuses();
        e.preventDefault();
    });

    $('.dual_selects__alltos').click(function (e) {
        var selected = $('.dual_selects__first option');
        selected.each(function (i) {
            $('.dual_selects__second').append(selected[i]);
        });

        saveStatuses();
        e.preventDefault();
    });

    $('.formNextBtn').click(function (e) {

        if ($(this).hasClass('disabled')) {
            e.preventDefault();
            return false;
        }

        var blockForm = $('.blockForm');
        var pos = $(this).data('pos');
        var widget = $(blockForm).find('.admin-panel__widget').eq(parseInt(pos));
        var error = [];

        $(widget).find('.fieldForValidate').each(function (i) {
            var field = (widget).find('.fieldForValidate').eq(i);
            var field_name = $(widget).find('.fieldForValidate').eq(i).text();
            var field_valid_type = $(widget).find('.fieldForValidate').eq(i).data('type');
            var field_input = $(widget).find('.fieldForValidate').eq(i).parent().next('.widget-row__right').find('input').val();
            var field_select = parseInt($(widget).find('.fieldForValidate').eq(i).parent().next('.widget-row__right').find('select').val());
            var field_value = field_input || field_select || '';
            if (Validator.isEmpty(field_value)) {
                if ($(field).data('require') == 'require') {
                    error.push("Необходимо заполнить поле '" + field_name + "'.");
                    $(widget).find('.required').eq(i).parent().next('.widget-row__right').find('input').val('');
                }
            } else {
                switch (field_valid_type) {
                    case 'only_rus': {
                        if (!Validator.onlyRussian(field_value)) {
                            error.push("Поле '" + field_name + "' может состоять только из русских символов.");
                        }
                        break;
                    }
                }
            }
        });

        var blockError = $('#blockErrors');
        $(blockError).html('');
        if (error.length > 0) {
            for (var i = 0; i < error.length; i++) {
                var errorBlock =
                    '<div class="admin-panel__notes warning" id="addTechError">' +
                    '<p>' +
                    '<strong>Внимание:</strong>' +
                    '<span class="descr">' + error[i] + '</span>' +
                    '</p>' +
                    '</div>';
                var old_html = $(blockError).html();
                $(blockError).html(old_html + errorBlock);
            }
            e.preventDefault();
            return false;
        } else {

            if (pos == $('.formNextBtn.top').length - 1) {
                $('.formNextBtn.top').eq(pos).addClass('disabled');
                return true;
            } else {
                $(blockForm).find('.admin-panel__widget').addClass('hidden');
                $(blockForm).find('.admin-panel__widget').eq(pos + 1).removeClass('hidden');
                $('.formNextBtn.top').parent().addClass('hidden');
                $('.formNextBtn.top').eq(pos + 1).parent().removeClass('hidden');
            }

            if (pos == $('.formNextBtn.bottom').length - 1) {
                $('.formNextBtn.bottom').eq(pos).addClass('disabled');
                return true;
            } else {
                $(blockForm).find('.admin-panel__widget').addClass('hidden');
                $(blockForm).find('.admin-panel__widget').eq(pos + 1).removeClass('hidden');
                $('.formNextBtn.bottom').parent().addClass('hidden');
                $('.formNextBtn.bottom').eq(pos + 1).parent().removeClass('hidden');
            }


            e.preventDefault();
            return false;

        }
    });

    $('.formBackBtn').click(function (e) {

        var pos = $(this).data('pos');

        var blockForm = $('.blockForm');
        $(blockForm).find('.admin-panel__widget').addClass('hidden');
        $(blockForm).find('.admin-panel__widget').eq(pos - 1).removeClass('hidden');
        $('.formNextBtn.top').parent().addClass('hidden');
        $('.formNextBtn.top').eq(pos - 1).parent().removeClass('hidden');
        $('.formNextBtn.bottom').parent().addClass('hidden');
        $('.formNextBtn.bottom').eq(pos - 1).parent().removeClass('hidden');

        e.preventDefault();
        return false;

    });

    var clientInfo = $('#clientInfo');
    var techInfo = $('#techInfo');
    var statusesInfo = $('#statusesInfo');

    $('#addTechNextClientBtn').click(function (e) {

        var error = [];

        var clientLastName = $('#clientLastName').val();
        var clientFirstName = $('#clientFirstName').val();
        var clientFatherName = $('#clientFatherName').val();
        var clientPhoneNumber = $('#clientPhoneNumber').val();
        var clientCity = $('#clientCity').val();
        var clientStreet = $('#clientStreet').val();
        var clientHouseNumber = $('#clientHouseNumber').val();
        var clientFlatNumber = $('#clientFlatNumber').val();

        if (clientLastName == '') {
            error.push("Необходимо заполнить поле 'Фамилия'.");
        } else if (!Validator.onlyRussian(clientLastName)) {
            error.push("Фамилия может состоять только из русских символов.");
        }
        if (clientFirstName == '') {
            error.push("Необходимо заполнить поле 'Имя'.");
        } else if (!Validator.onlyRussian(clientFirstName)) {
            error.push("Имя может состоять только из русских символов.");
        }
        if (clientFatherName == '') {
            error.push("Необходимо заполнить поле 'Отчество'.");
        } else if (!Validator.onlyRussian(clientFatherName)) {
            error.push("Отчество может состоять только из русских символов.");
        }
        if (clientPhoneNumber == '') {
            error.push("Необходимо заполнить поле 'Номер телефона'.");
        }
        if (clientCity != '' && !Validator.onlyRussian(clientCity)) {
            error.push("Название города может состоять только из русских символов.");
        }
        if (clientStreet != '' && !Validator.onlyRussian(clientStreet)) {
            error.push("Название улицы может состоять только из русских символов.");
        }

        $('#addTechError').html('');
        if (error.length > 0) {
            for (var i = 0; i < error.length; i++) {
                var errorBlock =
                    '<div class="admin-panel__notes warning" id="addTechError">' +
                    '<p>' +
                    '<strong>Внимание:</strong>' +
                    '<span class="descr">' + error[i] + '</span>' +
                    '</p>' +
                    '</div>';
                var old_html = $('#addTechError').html();
                $('#addTechError').html(old_html + errorBlock);
            }
        } else {
            clientInfo.addClass('hidden');
            techInfo.removeClass('hidden');
        }

        e.preventDefault();
    });

    $('#addTechNextTechBtn').click(function (e) {

        var error = [];

        var techCategory = $('#techCategory').val();
        var techCategoryNew = $('#techCategoryNew').val();
        var techBrand = $('#techBrand').val();
        var techBrandNew = $('#techBrandNew').val();
        var techTitle = $('#techTitle').val();
        var techWorker = $('#techWorker').val();

        if (techCategory == 0 && techCategoryNew == '') {
            error.push("Необходимо выбрать категорию из поля 'Категория'.");
        }
        if (techBrand == 0 && techBrandNew == '') {
            error.push("Необходимо выбрать бренд из поля 'Бренд'.");
        }
        if (techTitle == '') {
            error.push("Необходимо заполнить поле 'Название'.");
        }
        if (techWorker == '') {
            error.push("Необходимо выбрать принимающего из поля 'Принял в ремонт'.");
        }

        $('#addTechError').html('');
        if (error.length > 0) {
            for (var i = 0; i < error.length; i++) {
                var errorBlock =
                    '<div class="admin-panel__notes warning" id="addTechError">' +
                    '<p>' +
                    '<strong>Внимание:</strong>' +
                    '<span class="descr">' + error[i] + '</span>' +
                    '</p>' +
                    '</div>';
                var old_html = $('#addTechError').html();
                $('#addTechError').html(old_html + errorBlock);
            }
        } else {
            techInfo.addClass('hidden');
            statusesInfo.removeClass('hidden');
            saveStatuses();
        }

        e.preventDefault();
    });

    $('#addTechPrevTechBtn').click(function (e) {

        techInfo.addClass('hidden');
        clientInfo.removeClass('hidden');

        e.preventDefault();
    });

    $('#addTechPrevStatusBtn').click(function (e) {

        statusesInfo.addClass('hidden');
        techInfo.removeClass('hidden');

        e.preventDefault();
    });

    $('.mainChecker input').change(function (e) {

        if ($(this).parent('span').hasClass('checked')) {
            $('.subChecker').each(function (i) {
                $('.subChecker').eq(i).addClass('checked');
            });
        } else {
            $('.subChecker').each(function (i) {
                $('.subChecker').eq(i).removeClass('checked');
            });
        }
    });

    $('.subChecker input').change(function (e) {

        if ($('.subChecker.checked').length == $('.subChecker').length) {
            $('.mainChecker').addClass('checked');
        } else {
            $('.mainChecker').removeClass('checked');
        }
    });

    $('.DBDeleteBtn').click(function (e) {

        var deleteItems = '';
        $('.subChecker.checked').each(function (e) {
            deleteItems += ',' + $(this).data('id');
        });
        if (deleteItems.length) {
            deleteItems = deleteItems.slice(1);
        }

        $('#deleteItems').val(deleteItems);
    });


    // close popUp
    $('#popupNo').click(function (e) {
        popup.addClass('hidden');
    });

    $('.DBDeleteBtn').click(function (e) {

        var deleteItemsCount = $('.subChecker.checked').length;
        if (deleteItemsCount > 0) {

            var popupTitle = 'Удаление элемента';
            var popupContent = 'Вы уверены, что хотите удалить элементы из списка? (' + deleteItemsCount + 'шт.)';
            var type = 'delete';
            var link = $(this).data('action');
            showPopup(popupTitle, popupContent, type, link);
            showError('');
        } else {
            var error = 'Выберите хотя бы один элемент для удаления.';
            showError(error);
        }

    });

    $('.DBAddBtn').click(function (e) {

        var popupTitle = 'Добавление элемента';
        var popupContent = 'Укажите, название нового элемента.';
        var type = 'create';
        var link = $(this).data('action');
        var types = $(this).data('types');
        showPopup(popupTitle, popupContent, type, link, types);
    });

    $('.DBEditBtn').click(function (e) {

        var popupTitle = 'Изменение элемента';
        var popupContent = 'Укажите, новое название элемента.';
        var type = 'edit';
        var text = $(this).prev('span').text();
        $('#editItemName').val(text);
        var id = $(this).data('id');
        var link = $('.DBEditBtnInline').data('action');
        var types = $(this).data('types');
        $('#editItemId').val(id);
        showPopup(popupTitle, popupContent, type, link, types);
    });

    $('.popUp__changeStatus').click(function (e) {

        var popupTitle = 'Изменение элемента';
        var popupContent = 'Выберите новое значение элемента.';
        var type = 'select';
        var link = $(this).data('action');
        var id = $(this).data('id');
        var selected = $(this).data('selected');
        $('#selectItemId').val(id);
        var types = $(this).data('types');
        showPopup(popupTitle, popupContent, type, link, types, selected);
    });

    var popup = $('.admin-panel__popup.database');

    function showPopup(title, content, type, link, types, selected) {

        $(popup).find('.title').text(title);
        $(popup).find('.content .text').text(content);

        if (type == 'create') {
            if (types != '') {
                $(popup).find('.create.' + types).removeClass('hidden');
                $(popup).find('.create').addClass('hidden');
            }
            $(popup).find('.create').removeClass('hidden');
            $(popup).find('.create form').attr('action', link);
            $(popup).find('.delete').addClass('hidden');
            $(popup).find('.edit').addClass('hidden');
            $(popup).find('.select').addClass('hidden');
        } else if (type == 'delete') {
            $(popup).find('.create').addClass('hidden');
            $(popup).find('.delete').removeClass('hidden');
            $(popup).find('.delete form').attr('action', link);
            $(popup).find('.edit').addClass('hidden');
            $(popup).find('.select').addClass('hidden');
        } else if (type == 'edit') {
            $(popup).find('.create').addClass('hidden');
            $(popup).find('.delete').addClass('hidden');
            $(popup).find('.edit').removeClass('hidden');
            $(popup).find('.edit form').attr('action', link);
            $(popup).find('.select').addClass('hidden');
        } else if (type == 'select') {
            $(popup).find('.create').addClass('hidden');
            $(popup).find('.delete').addClass('hidden');
            $(popup).find('.edit').addClass('hidden');
            $(popup).find('.select').removeClass('hidden');
            $(popup).find('.select form').attr('action', link);
            $(popup).find('.select form option').each(function (i) {

                if ($(popup).find('.select form option').eq(i).val() == selected) {
                    if ($(popup).find('.select form option').eq(i).attr('selected', 'selected'));
                    $(popup).find('.select form .selector span').text($(popup).find('.select form option').eq(i).text());
                }
            });
        }

        popup.removeClass('hidden');
    }

    function showError(error) {

        if (!error) {
            $('#addError').html('');
            return;
        }

        if (is_array(error)) {

            if (error.length > 0) {
                for (var i = 0; i < error.length; i++) {
                    var errorBlock =
                        '<div class="admin-panel__notes warning" id="addTechError">' +
                        '<p>' +
                        '<strong>Внимание:</strong>' +
                        '<span class="descr">' + error[i] + '</span>' +
                        '</p>' +
                        '</div>';
                    var old_html = $('#addError').html();
                    $('#addError').html(old_html + errorBlock);
                }
            }
        } else {
            var errorBlock =
                '<div class="admin-panel__notes warning">' +
                '<p>' +
                '<strong>Внимание:</strong>' +
                '<span class="descr">' + error + '</span>' +
                '</p>' +
                '</div>';
            $('#addError').html(errorBlock);
        }

    }

    function is_array(a) {
        return (typeof a == "object") && (a instanceof Array);
    }

    $('ul.tabs a').click(function (e) {

        tableTabs(this);
    });

    function tableTabs(el) {

        var self = el;
        self.pos = -1;

        $('ul.tabs a').each(function (i) {

            if (this == el) {
                self.pos = i;
            }
        });

        $('ul.tabs a').removeClass('active');
        $(el).addClass('active');
        $('table.tabs .tab').addClass('hidden');
        $('table.tabs .tab').eq(self.pos).removeClass('hidden');
        $('.dynamic-table__stats.tabs .tab').addClass('hidden');
        $('.dynamic-table__stats.tabs .tab').eq(self.pos).removeClass('hidden');
    }


    var Popup = {

        shopPopupWithDetailedDescription: function () {

            $('.shopPopupWithDetailedDescription').click(function (e) {

                $('.shopPopupWithDetailedDescription').next('.additional-info').addClass('hidden');
                $(this).next('.additional-info').toggleClass('hidden');

                e.preventDefault();
                return false;
            });

            $(document).click(function (event) {
                if ($(event.target).closest('.additional-info').length) return;
                $('.shopPopupWithDetailedDescription').next('.additional-info').addClass('hidden');
            });

        }

    }

    Popup.shopPopupWithDetailedDescription();

});
