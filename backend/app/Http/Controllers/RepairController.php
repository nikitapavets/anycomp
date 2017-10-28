<?php

namespace App\Http\Controllers;

use App\Classes\Page\FormPage;
use App\Classes\Page\Page;
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
use App\Models\Client;
use App\Models\Database\Location;
use App\Models\Database\ReceptionPlace;
use App\Models\Employee;
use App\Models\Worker;
use App\Repositories\RepairRepository;
use App\Services\ElasticSearchService;
use App\Services\PaginationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Repair;
use App\Models\Database\CityType;
use App\Models\Database\Category;
use App\Models\AdminMenu;
use App\Models\Database\Brand;
use App\Models\Database\Organization;
use App\Models\Database\City;
use App\Interfaces\ExcelDocument;
use Illuminate\Support\Facades\DB;

class RepairController extends Controller
{
    public function index(Request $request)
    {
        $elasticsearchRepairService = new ElasticSearchService(new Repair);
        $tab = $request->tab ?? 0;
        $search = [
            'current_status' => $tab,
            'search' => $request->search ?? '',
            'page' => $request->page ?? 1,
            'size' => $request->size ?? 15,
        ];

        $table = new Table('Список техники в ремонте');

        // Table fields
        $tableFields = new TableFieldCollection();

        $tableField = new TableField('', '50px', TableField::SORT_TYPE_NO_SORTABLE, TableField::CLASS_CHECKER);
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('№', '80px', TableField::SORT_TYPE_SORTABLE);
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Техника');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Клиент');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Номер телефона', '115px', TableField::SORT_TYPE_NO_SORTABLE);
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Выдан', '75px');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('', '115px', TableField::SORT_TYPE_NO_SORTABLE);
        $tableFields->pushTableField($tableField);

        $table->setTableFields($tableFields);

        // Table tabs
        $tableTabs = new TableTabCollection();

        $tableTab = new TableTab('В ремонте', $tab == Repair::STATUS_REPAIR ? TableTab::STATUS_ACTIVE : TableTab::STATUS_INACTIVE);
        if($search['search']) {
            $repairs = new PaginationService(new Repair, $elasticsearchRepairService->search($search), $search);
            $repairs->setPath($request->getBasePath());
        } else {
            $repairs = RepairRepository::getRepairsByStatus($search['current_status']);
        }
        $repairs->appends(['tab' => $tab]);
        $tableTab->setRows(RepairRepository::repairsToRows($repairs));
        $tableTapPagination = new TablePagination($repairs);
        $tableTab->setPagination($tableTapPagination);
        $tableTabs->pushTableTab($tableTab);

        $tableTab = new TableTab('На выдаче', $tab == Repair::STATUS_COMPLETE ? TableTab::STATUS_ACTIVE : TableTab::STATUS_INACTIVE);
        $tableTabs->pushTableTab($tableTab);

        $tableTab = new TableTab('У клиента', $tab == Repair::STATUS_ISSUED ? TableTab::STATUS_ACTIVE : TableTab::STATUS_INACTIVE);
        $tableTabs->pushTableTab($tableTab);

        $table->setTableTabs($tableTabs);

        // Table actions
        $tableActions = new TableActionCollection();

        $tableAction = new TableAction(
            TableAction::TYPE_DELETE,
            TableAction::FORM_INLINE,
            route('admin.repairs.delete')
        );
        $tableActions->pushTableAction($tableAction);

        $tableAction = new TableAction(
            TableAction::TYPE_CREATE,
            TableAction::FORM_EXTERNAL,
            route('admin.repairs.choose_client')
        );
        $tableActions->pushTableAction($tableAction);

        $table->setTableActions($tableActions);

        $userAdmin = Admin::getAuthAdmin();
        $menu = AdminMenu::getAdminMenu();
        $page = new TablePage('Список техники в ремонте');

        return view($page->getViewName(),
            [
                'admin' => $userAdmin,
                'adminMenu' => $menu,
                'page' => $page,
                'table' => $table->toArray(),
            ]
        );
    }

    public function chooseClient()
    {
        $block = [];
        $block['title'] = 'Поиск клиента';
        $block['clients'] = Client::all()->toArray();

        $userAdmin = Admin::getAuthAdmin();
        $menu = AdminMenu::getAdminMenu();
        $page = new Page('Поиск клиента', 'admin.create_repair_order');

        return view($page->getViewName(),
            [
                'admin' => $userAdmin,
                'adminMenu' => $menu,
                'page' => $page,
                'block' => $block
            ]
        );
    }

    public function create(Request $request)
    {
        $repair = new Repair();
        $client = Client::findOrNew($request->client_id);
        $repair->setClient($client);

        $widgets = $this->generateView($repair);

        $form = array(
            'widgets' => $widgets,
            'url' => route('admin.repairs.store'),
        );

        $userAdmin = Admin::getAuthAdmin();
        $menu = AdminMenu::getAdminMenu();
        $page = new FormPage('Прием техники в ремонт');

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
        DB::transaction(function() use ($request) {
            $client = Client::findOrNew($request->client_id);
            $client->fill($request->all());
            $client->setOrganization($request->organization_id, $request->organization_new);
            $client->setCity($request->city_id, $request->city_new);
            $client->setCityType($request->city_type_id, $request->city_type_new);
            $client->save();

            $repair = new Repair($request->all());
            $repair->setClient($client);
            $repair->setAdmin(Admin::getAuthAdmin());
            $repair->setCategory($request->category_id, $request->category_new);
            $repair->setBrand($request->brand_id, $request->brand_new);
            $repair->reception_place()->associate(ReceptionPlace::findOrFail($request->reception_place_id));
            $repair->location()->associate(ReceptionPlace::findOrFail($request->reception_place_id));
            $repair->employee()->associate(Employee::find($request->employee_id));
            $repair->save();
        });

        return redirect()->route('admin.repairs.index');
    }

    public function show($id)
    {
        $repair = Repair::find($id);

        $block = [];
        $block['title'] = 'Техника';
        $block['repair'] = $repair;

        $widget = new WidgetSelect('Отремонтировал', 'worker_id');
        $widget->setValue($repair->worker);
        $widget->setSelectItems(Worker::all());
        $block['worker'] = $widget->toArray();

        $widget = new WidgetSelect('Местонахождение', 'location_id');
        $widget->setValue($repair->location);
        $widget->setSelectItems(Location::all());
        $block['location'] = $widget->toArray();

        $userAdmin = Admin::getAuthAdmin();
        $menu = AdminMenu::getAdminMenu();
        $page = new Page(sprintf('Ремонт %s', $repair->full_name), 'admin.repair_show');

        return view($page->getViewName(),
            [
                'admin' => $userAdmin,
                'adminMenu' => $menu,
                'page' => $page,
                'block' => $block
            ]
        );
    }

    public function edit($id)
    {
        $repair = Repair::find($id);
        $widgets = $this->generateView($repair);

        $form = array(
            'widgets' => $widgets,
            'method' => 'put',
            'url' => route('admin.repairs.update', ['id' => $repair->id]),
        );

        $userAdmin = Admin::getAuthAdmin();
        $menu = AdminMenu::getAdminMenu();
        $page = new FormPage('Изменение техники находящийся в ремонт');

        return view($page->getViewName(),
            [
                'admin' => $userAdmin,
                'adminMenu' => $menu,
                'page' => $page,
                'form' => $form,
            ]
        );
    }

    public function update(Request $request, $id)
    {
        $repair = Repair::find($id);

        DB::transaction(function() use ($request, $repair) {
            $client = Client::find($request->client_id);
            $client->fill($request->all());
            $client->setOrganization($request->organization_id, $request->organization_new);
            $client->setCity($request->city_id, $request->city_new);
            $client->setCityType($request->city_type_id, $request->city_type_new);
            $client->save();

            $repair->fill($request->all());
            $repair->setAdmin(Admin::getAuthAdmin());
            $repair->setCategory($request->category_id, $request->category_new);
            $repair->setBrand($request->brand_id, $request->brand_new);
            $repair->reception_place()->associate(ReceptionPlace::findOrFail($request->reception_place_id));
            $repair->location()->associate(ReceptionPlace::findOrFail($request->reception_place_id));
            $repair->employee()->associate(Employee::find($request->employee_id));
            $repair->save();
        });

        return redirect()->route('admin.repairs.index');
    }

    public function delete(Request $request)
    {
        $repairIds = explode(',', $request->deleteItems);
        Repair::destroy($repairIds);

        return redirect()->route('admin.repairs.index');
    }

    private function generateView(Repair $repair)
    {
        $widgets = [];

        // Section 1 (about client)
        $widgetCollection = new WidgetCollection('Информация о клиенте');

        $widget = new WidgetInput('Ремонд ИД', 'repair_id');
        $widget->setValue($repair->getId());
        $widget->setValueType('hidden');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Клиент ИД', 'client_id');
        $widget->setValue($repair->getClient() ? $repair->getClient()->getId() : false);
        $widget->setValueType('hidden');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Фамилия', 'second_name', false);
        $widget->setValue($repair->getClient() ? $repair->getClient()->second_name : false);
        $widget->setValidationType(WidgetInput::VALIDATION_TYPE_ONLY_RUS);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Имя', 'first_name', false);
        $widget->setValue($repair->getClient() ? $repair->getClient()->first_name : false);
        $widget->setValidationType(WidgetInput::VALIDATION_TYPE_ONLY_RUS);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Отчество', 'father_name', false);
        $widget->setValue($repair->getClient() ? $repair->getClient()->father_name : false);
        $widget->setValidationType(WidgetInput::VALIDATION_TYPE_ONLY_RUS);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Организация', 'organization_id', false);
        $widget->setValue($repair->getClient() ? $repair->getClient()->getOrganization() : false);
        $widget->setSelectItems(Organization::getAll());
        $widget->setAllowAddName('organization_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Мобильный телефон', 'mobile_phone', false);
        $widget->setValue($repair->getClient() ? $repair->getClient()->mobile_phone : false);
        $widget->setValueType(WidgetInput::VALUE_TYPE_PHONE);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Домашний телефон', 'home_phone', false);
        $widget->setValue($repair->getClient() ? $repair->getClient()->home_phone : false);
        $widget->setValueType(WidgetInput::VALUE_TYPE_HOME_PHONE);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Тип населённого пункта', 'city_type_id', false);
        $widget->setValue($repair->getClient() ? $repair->getClient()->getCityType() : false);
        $widget->setSelectItems(CityType::getAll());
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Населённый пункт', 'city_id', false);
        $widget->setValue($repair->getClient() ? $repair->getClient()->getCity() : false);
        $widget->setSelectItems(City::getAll());
        $widget->setAllowAddName('city_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Улица', 'address_street', false);
        $widget->setValue($repair->getClient() ? $repair->getClient()->address_street : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Дом', 'address_house', false);
        $widget->setValue($repair->getClient() ? $repair->getClient()->address_house : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Квартира', 'address_flat', false);
        $widget->setValue($repair->getClient() ? $repair->getClient()->address_flat : false);
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        // Section 2 (about product)
        $widgetCollection = new WidgetCollection('Информация о технике');

        $widget = new WidgetSelect('Категория', 'category_id', true);
        $widget->setValue($repair ? $repair->getCategory() : false);
        $widget->setSelectItems(Category::getAll());
        $widget->setAllowAddName('category_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Бренд', 'brand_id', true);
        $widget->setValue($repair ? $repair->getBrand() : false);
        $widget->setSelectItems(Brand::getAll());
        $widget->setAllowAddName('brand_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Название', 'title', false);
        $widget->setValue($repair->title);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Заводской номер', 'code', false);
        $widget->setValue($repair ? $repair->code : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('В комплекте', 'set', false);
        $widget->setValue($repair ? $repair->set : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Неисправность', 'defect', false);
        $widget->setValue($repair ? $repair->defect : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Внешний вид', 'appearance', false);
        $widget->setValue($repair ? $repair->appearance : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Комментарий', 'comment', false);
        $widget->setValue($repair ? $repair->comment : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Ориентировочная стоимость', 'approximate_cost', false);
        $widget->setValue($repair ? $repair->approximate_cost : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Место приема заказа', 'reception_place_id', true);
        $widget->setValue($repair ? $repair->getReceptionPlace() : false);
        $widget->setSelectItems(ReceptionPlace::getAll());
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Принял в ремонт', 'employee_id', true);
        $widget->setValue($repair ? $repair->employee : false);
        $widget->setSelectItems(Employee::all());
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        return $widgets;
    }

    public function printDoc(Request $request)
    {
        RepairRepository::printReceipt(Repair::findOrFail($request->id));
    }

    public function statisticsPrint()
    {
        $excel = new ExcelDocument();
        $excel->repairStatistics(
            'Статистика услуги ремонта на ' . date('d.m.Y', Carbon::now()->timestamp),
            [
                'В ремонте',
                'На выдаче',
                'У клиента'
            ],
            [
                RepairRepository::getRepairsByStatus(Repair::STATUS_REPAIR, false),
                RepairRepository::getRepairsByStatus(Repair::STATUS_COMPLETE, false),
                RepairRepository::getRepairsByStatus(Repair::STATUS_ISSUED, false)
            ]
        );
    }
}
