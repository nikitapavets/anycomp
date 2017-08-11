<?php

namespace App\Http\Controllers;

use App\Classes\Page\TablePage;
use App\Classes\Table\Table;
use App\Classes\Table\TableAction;
use App\Classes\Table\TableField;
use App\Classes\Table\TablePagination;
use App\Classes\Table\TableTab;
use App\Classes\Widget\WidgetDatePicker;
use App\Classes\Widget\WidgetInput;
use App\Classes\Widget\WidgetSelect;
use App\Collections\TableActionCollection;
use App\Collections\TableFieldCollection;
use App\Collections\TableTabCollection;
use App\Collections\WidgetCollection;
use App\Models\Admin;
use App\Models\AdminMenu;
use App\Classes\Page\FormPage;
use App\Models\Delivery;
use App\Repositories\AdminRepository;
use App\Repositories\DeliveryRepository;
use Illuminate\Http\Request;
use App\Http\Requests\DeliveryRequest;

use App\Http\Requests;

class DeliveriesController extends Controller
{
    public function index(Request $request)
    {
        $table = new Table('Список техники в ремонте');

        $tableFields = new TableFieldCollection();

        $tableField = new TableField('', '50px', TableField::SORT_TYPE_NO_SORTABLE, TableField::CLASS_CHECKER);
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Дата привоза', '115px');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Оформлял привоз');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('', '115px', TableField::SORT_TYPE_NO_SORTABLE);
        $tableFields->pushTableField($tableField);

        $table->setTableFields($tableFields);

        // Table tabs
        $tableTabs = new TableTabCollection();

        $tableTab = new TableTab('Все', !$request->input('tab') ? TableTab::STATUS_ACTIVE : TableTab::STATUS_INACTIVE);
        $deliveries = DeliveryRepository::get(15);
        $tableTab->setRows(DeliveryRepository::toTableRows($deliveries));
        $tableTapPagination = new TablePagination($deliveries);
        $tableTab->setPagination($tableTapPagination);
        $tableTabs->pushTableTab($tableTab);

        $table->setTableTabs($tableTabs);

        // Table actions
        $tableActions = new TableActionCollection();

        $tableAction = new TableAction(
            TableAction::TYPE_DELETE,
            TableAction::FORM_INLINE,
            sprintf('%s/delete', DeliveryRepository::getLink())
        );
        $tableActions->pushTableAction($tableAction);

        $tableAction = new TableAction(
            TableAction::TYPE_CREATE,
            TableAction::FORM_EXTERNAL,
            sprintf('%s/create', DeliveryRepository::getLink())
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

    public function create(Request $request)
    {
        /**
         * @var Delivery $delivery
         */
        $delivery = Delivery::firstOrNew(['id' => $request->id ?? 0]);

        $widgets = [];

        $widgetCollection = new WidgetCollection('Информация о привозе');

        $widget = new WidgetInput('', 'id');
        $widget->setValue($delivery->getId());
        $widget->setValueType('hidden');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetDatePicker('Дата привоза', 'created_at', true);
        $widget->setValue($delivery->getCreatedAtForInput());
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Оформлял привоз', 'worker_id', true);
        $widget->setValue($delivery ? $delivery->getWorker() : false);
        $widget->setSelectItems(AdminRepository::getRepairAdmins());
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        $form = [
            'widgets' => $widgets,
            'url' => sprintf('%s/%s', DeliveryRepository::getLink(), $request->id ? $request->id : ''),
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

    public function store(DeliveryRequest $request)
    {
        Delivery::create($request->all());

        return redirect()->action('DeliveriesController@index');
    }

    public function edit($id)
    {
        return redirect()->action('DeliveriesController@create', ['id' => $id]);
    }

    public function update(DeliveryRequest $request)
    {
        Delivery::where('id', '=', $request->id)
            ->update($request->except(['_method', '_token']));

        return redirect()->action('DeliveriesController@index');
    }

    public function destroy(Request $request)
    {
        DeliveryRepository::destroy($request->deleteItems);

        return redirect()->action('DeliveriesController@index');
    }
}
