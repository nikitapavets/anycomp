<?php

namespace App\Http\Controllers;

use App\Classes\Page\FormPage;
use App\Classes\Page\TablePage;
use App\Classes\Table\Table;
use App\Classes\Table\TableAction;
use App\Classes\Table\TableField;
use App\Classes\Table\TablePagination;
use App\Classes\Table\TableTab;
use App\Classes\Widget\WidgetInput;
use App\Classes\Widget\WidgetSelect;
use App\Collections\TableActionCollection;
use App\Collections\TableFieldCollection;
use App\Collections\TableTabCollection;
use App\Collections\WidgetCollection;
use App\Models\Admin;
use App\Models\AdminMenu;
use App\Models\Database\Organization;
use App\Models\Spare;
use App\Repositories\DeliveryRepository;
use App\Repositories\SpareRepository;
use Illuminate\Http\Request;
use App\Http\Requests\SpareRequest;

class SpareController extends Controller
{
    public function index(Request $request)
    {
        $table = new Table('Список деталей на складе');

        $tableFields = new TableFieldCollection();

        $tableField = new TableField('', '50px', TableField::SORT_TYPE_NO_SORTABLE, TableField::CLASS_CHECKER);
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Название');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Поставщик');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Приход');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Колличество');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Цена');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('', '115px', TableField::SORT_TYPE_NO_SORTABLE);
        $tableFields->pushTableField($tableField);

        $table->setTableFields($tableFields);

        // Table tabs
        $tableTabs = new TableTabCollection();

        $tableTab = new TableTab('Все', !$request->input('tab') ? TableTab::STATUS_ACTIVE : TableTab::STATUS_INACTIVE);
        $spares = SpareRepository::get(15);
        $tableTab->setRows(SpareRepository::toTableRows($spares));
        $tableTapPagination = new TablePagination($spares);
        $tableTab->setPagination($tableTapPagination);
        $tableTabs->pushTableTab($tableTab);

        $table->setTableTabs($tableTabs);

        // Table actions
        $tableActions = new TableActionCollection();

        $tableAction = new TableAction(
            TableAction::TYPE_DELETE,
            TableAction::FORM_INLINE,
            sprintf('%s/delete', SpareRepository::getLink())
        );
        $tableActions->pushTableAction($tableAction);

        $tableAction = new TableAction(
            TableAction::TYPE_CREATE,
            TableAction::FORM_EXTERNAL,
            sprintf('%s/create', SpareRepository::getLink())
        );
        $tableActions->pushTableAction($tableAction);

        $table->setTableActions($tableActions);

        $userAdmin = Admin::getAuthAdmin();
        $menu = AdminMenu::getAdminMenu();
        $page = new TablePage('Привоз деталей');

        return view($page->getViewName(),
            [
                'admin' => $userAdmin,
                'adminMenu' => $menu,
                'page' => $page,
                'table' => $table->toArray(),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        /**
         * @var Spare $spare
         */
        $spare = Spare::firstOrNew(['id' => $request->id ?? 0]);

        $widgets = [];

        $widgetCollection = new WidgetCollection('Информация о детали');

        $widget = new WidgetInput('', 'id');
        $widget->setValue($spare->getId());
        $widget->setValueType('hidden');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Поставщик', 'organization_id', true);
        $widget->setValue($spare ? $spare->getOrganization() : false);
        $widget->setSelectItems(Organization::getAll());
        $widget->setAllowAddName('new_organization');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Название детали', 'name', true);
        $widget->setValue($spare ? $spare->getName() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Серийный номер', 'serial_number');
        $widget->setValue($spare ? $spare->getSerialNumber() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Дата привоза', 'delivery_id', true);
        $widget->setValue($spare ? $spare->getDelivery() : false);
        $widget->setSelectItems(DeliveryRepository::get());
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Колличество (шт)', 'quantity', true);
        $widget->setValue($spare ? $spare->getQuantity() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Цена', 'price', true);
        $widget->setValue($spare ? $spare->getPrice() : false);
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        $form = [
            'widgets' => $widgets,
            'url' => sprintf('%s/%s', SpareRepository::getLink(), $request->id ? $request->id : ''),
            'method' => $request->id ? 'put' : 'post'
        ];

        $userAdmin = Admin::getAuthAdmin();
        $menu = AdminMenu::getAdminMenu();
        $page = new FormPage('Привоз деталей');

        return view($page->getViewName(),
            [
                'admin' => $userAdmin,
                'adminMenu' => $menu,
                'page' => $page,
                'form' => $form,
            ]
        );
    }

    /**
     * @param SpareRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SpareRequest $request)
    {
        $spare = new Spare($request->except(['new_organization']));
        $spare->setOrganization($request->organization_id, $request->new_organization);
        $spare->save();

        return redirect()->action('SpareController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
