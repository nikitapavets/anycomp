<div class="admin-panel__popup database hidden">
    <div class="admin-panel__popup--shadow">
        <div class="admin-panel__popup--inner">
            <div class="title">
                Удаление категории
            </div>
            <div class="content">
                <div class="text">
                    Вы уверены, что хотите удалить?
                </div>
                <div class="form create">
                    {{ Form::open(array('url' => '', 'id' => 'createItemForm')) }}
                    <input type="text" name="itemName" id="createItem">
                    {{ Form::close() }}
                </div>
                <div class="form delete">
                    {{ Form::open(array('url' => '', 'id' => 'deleteItemsForm')) }}
                    <input type="hidden" name="deleteItems" id="deleteItems">
                    {{ Form::close() }}
                </div>
                <div class="form edit">
                    {{ Form::open(array('url' => '', 'id' => 'editItemsForm')) }}
                    <input type="text" name="itemName" id="editItemName">
                    <input type="hidden" name="itemId" id="editItemId">
                    {{ Form::close() }}
                </div>
            </div>
            <div class="buttons">
                <div class="admin-panel__buttons delete">
                    <button class="admin-panel__button" type="submit" form="deleteItemsForm">Да</button>
                    <button class="admin-panel__button grey" id="popupNo" form="">Нет</button>
                </div>
                <div class="admin-panel__buttons create">
                    <button class="admin-panel__button" type="submit" form="createItemForm">Ок</button>
                </div>
                <div class="admin-panel__buttons edit">
                    <button class="admin-panel__button" type="submit" form="editItemsForm">Ок</button>
                </div>
            </div>
        </div>
    </div>
</div>