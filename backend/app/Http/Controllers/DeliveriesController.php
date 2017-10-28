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
use App\Models\Employee;
use App\Repositories\DeliveryRepository;
use App\Services\ElasticSearchService;
use App\Services\PaginationService;
use Illuminate\Http\Request;
use App\Http\Requests\DeliveryRequest;

use App\Http\Requests;

class DeliveriesController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->tab ?? 0;
        $pageSize = $request->size ?? PaginationService::DEFAULT_PAGE_SIZE;
        $pageNumber = $request->page ?? PaginationService::DEFAULT_PAGE_NUMBER;
        $searchRequest = [
            'search' => $request->search ?? '',
            'page' => $pageNumber,
            'size' => $pageSize,
        ];

        $table = new Table('Список техники в ремонте');

        $tableFields = new TableFieldCollection();

        $tableField = new TableField('', '50px', TableField::SORT_TYPE_NO_SORTABLE, TableField::CLASS_CHECKER);
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Дата привоза', '115px');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Оформлял привоз');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Колличество деталей', '175px');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('', '115px', TableField::SORT_TYPE_NO_SORTABLE);
        $tableFields->pushTableField($tableField);

        $table->setTableFields($tableFields);

        // Table tabs
        $tableTabs = new TableTabCollection();

        $tableTab = new TableTab('Все', TableTab::STATUS_ACTIVE);
        if($searchRequest['search']) {
//            $elasticsearchService = new ElasticSearchService(new Delivery);
//            $deliveries = new PaginationService(new Delivery, $elasticsearchService->search($searchRequest), $searchRequest);
//            $deliveries->setPath($request->getBasePath());
        } else {
            $deliveries = Delivery::paginate($pageSize);
        }
        $deliveries->appends(['tab' => $tab]);
        $tableTab->setRows(DeliveryRepository::toTableRows($deliveries, $pageSize, $pageNumber));
        $tableTapPagination = new TablePagination($deliveries);
        $tableTab->setPagination($tableTapPagination);
        $tableTabs->pushTableTab($tableTab);

        $table->setTableTabs($tableTabs);

        // Table actions
        $tableActions = new TableActionCollection();

        $tableAction = new TableAction(
            TableAction::TYPE_DELETE,
            TableAction::FORM_INLINE,
            route('admin.deliveries.delete')
        );
        $tableActions->pushTableAction($tableAction);

        $tableAction = new TableAction(
            TableAction::TYPE_CREATE,
            TableAction::FORM_EXTERNAL,
            route('admin.deliveries.create')
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

    public function create()
    {
        $delivery = new Delivery();

        $widgets = $this->generateView($delivery);

        $form = array(
            'widgets' => $widgets,
            'url' => route('admin.deliveries.store'),
        );

        $userAdmin = Admin::getAuthAdmin();
        $menu = AdminMenu::getAdminMenu();
        $page = new FormPage('Оформление привоза');

        return view($page->getViewName(),
            [
                'admin' => $userAdmin,
                'adminMenu' => $menu,
                'page' => $page,
                'form' => $form,
            ]
        );
    }

    public function store(Request $request)
    {
        $delivery = new Delivery($request->all());
        $delivery->employee()->associate(Employee::findOrFail($request->employee_id));
        $delivery->save();

        return redirect()->route('admin.deliveries.index');
    }

    public function edit($id)
    {
        $delivery = Delivery::find($id);

        $widgets = $this->generateView($delivery);

        $form = array(
            'widgets' => $widgets,
            'method' => 'put',
            'url' => route('admin.deliveries.update', ['id' => $delivery->id]),
        );

        $userAdmin = Admin::getAuthAdmin();
        $menu = AdminMenu::getAdminMenu();
        $page = new FormPage('Оформление привоза');

        return view($page->getViewName(),
            [
                'admin' => $userAdmin,
                'adminMenu' => $menu,
                'page' => $page,
                'form' => $form,
            ]
        );
    }

    public function update(DeliveryRequest $request, $id)
    {
        $delivery = Delivery::findOrFail($id);
        $delivery->fill($request->all());
        $delivery->employee()->associate(Employee::findOrFail($request->employee_id));
        $delivery->save();

        return redirect()->route('admin.deliveries.index');
    }

    public function delete(Request $request)
    {
        $repairIds = explode(',', $request->deleteItems);
        Delivery::destroy($repairIds);

        return redirect()->route('admin.deliveries.index');
    }

    private function generateView(Delivery $delivery)
    {
        $widgets = [];

        $widgetCollection = new WidgetCollection('Информация о привозе');

        $widget = new WidgetInput('', 'id');
        $widget->setValue($delivery->id);
        $widget->setValueType('hidden');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetDatePicker('Дата привоза', 'delivered_at', true);
        $widget->setValue($delivery->delivered_at_timestamp);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Оформлял привоз', 'employee_id', true);
        $widget->setValue($delivery->employee);
        $widget->setSelectItems(Employee::all());
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        return $widgets;
    }
}
