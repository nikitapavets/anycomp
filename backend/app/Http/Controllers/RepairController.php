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
use App\Models\Database\ReceptionPlace;
use App\Models\Worker;
use App\Repositories\AdminRepository;
use App\Repositories\ClientRepository;
use App\Repositories\RepairRepository;
use Illuminate\Http\Request;
use App\Models\Repair;
use App\Models\Database\CityType;
use App\Models\Database\Category;
use App\Models\AdminMenu;
use App\Models\Database\Brand;
use App\Models\Database\Organization;
use App\Models\Database\City;
use App\Interfaces\ExcelDocument;

class RepairController extends Controller
{
    public function repairList(Request $request)
    {

        $table = new Table('Список техники в ремонте');

        // Table fields
        $tableFields = new TableFieldCollection();

        $tableField = new TableField('', '50px', TableField::SORT_TYPE_NO_SORTABLE, TableField::CLASS_CHECKER);
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('№', '80px');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Техника');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Клиент');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Номер телефона', '115px');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Выдан', '75px', TableField::SORT_TYPE_SORTABLE);
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('', '115px', TableField::SORT_TYPE_NO_SORTABLE);
        $tableFields->pushTableField($tableField);

        $table->setTableFields($tableFields);

        // Table tabs
        $tableTabs = new TableTabCollection();

        $tableTab = new TableTab('В ремонте', !$request->input('tab') ? TableTab::STATUS_ACTIVE : TableTab::STATUS_INACTIVE);
        $repairs = RepairRepository::getRepairsByStatus(Repair::STATUS_REPAIR);
        $repairs->appends(['tab' => $request->input('tab')]);
        $tableTab->setRows(
            RepairRepository::repairsToRows($repairs)
        );
        $tableTapPagination = new TablePagination($repairs);
        $tableTab->setPagination($tableTapPagination);
        $tableTabs->pushTableTab($tableTab);

        $tableTab = new TableTab('На выдаче', $request->input('tab') == 1 ? TableTab::STATUS_ACTIVE : TableTab::STATUS_INACTIVE);
        $repairs = RepairRepository::getRepairsByStatus(Repair::STATUS_COMPLETE);
        $repairs->appends(['tab' => $request->input('tab')]);
        $tableTab->setRows(
            RepairRepository::repairsToRows($repairs)
        );
        $tableTapPagination = new TablePagination($repairs);
        $tableTab->setPagination($tableTapPagination);
        $tableTabs->pushTableTab($tableTab);

        $tableTab = new TableTab('У клиента', $request->input('tab') == 2 ? TableTab::STATUS_ACTIVE : TableTab::STATUS_INACTIVE);
        $repairs = RepairRepository::getRepairsByStatus(Repair::STATUS_ISSUED);
        $repairs->appends(['tab' => $request->input('tab')]);
        $tableTab->setRows(
            RepairRepository::repairsToRows($repairs)
        );
        $tableTapPagination = new TablePagination($repairs);
        $tableTab->setPagination($tableTapPagination);
        $tableTabs->pushTableTab($tableTab);

        $table->setTableTabs($tableTabs);

        // Table actions
        $tableActions = new TableActionCollection();

        $tableAction = new TableAction(
            TableAction::TYPE_DELETE,
            TableAction::FORM_INLINE,
            '/admin/repair/delete'
        );
        $tableActions->pushTableAction($tableAction);

        $tableAction = new TableAction(
            TableAction::TYPE_CREATE,
            TableAction::FORM_EXTERNAL,
            '/admin/repair/choose_client'
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
        $block['clients'] = ClientRepository::clientsToArray(ClientRepository::getClients());

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

    public function repairCreateUpdate(Request $request)
    {
        /**
         * @var Repair $repair
         */
        $repair = Repair::firstOrNew(['id' => $request->repair_id ?? 0]);
        if($request->client_id && !$request->repair_id) {
            $repair->setClient(Client::find($request->client_id));
        }

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

        $widget = new WidgetInput('Фамилия', 'client_second_name', false);
        $widget->setValue($repair->getClient() ? $repair->getClient()->getSecondName() : false);
        $widget->setValidationType(WidgetInput::VALIDATION_TYPE_ONLY_RUS);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Имя', 'client_first_name', false);
        $widget->setValue($repair->getClient() ? $repair->getClient()->getFirstName() : false);
        $widget->setValidationType(WidgetInput::VALIDATION_TYPE_ONLY_RUS);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Отчество', 'client_father_name', false);
        $widget->setValue($repair->getClient() ? $repair->getClient()->getFatherName() : false);
        $widget->setValidationType(WidgetInput::VALIDATION_TYPE_ONLY_RUS);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Организация', 'client_organization_id', false);
        $widget->setValue($repair->getClient() ? $repair->getClient()->getOrganization() : false);
        $widget->setSelectItems(Organization::getAll());
        $widget->setAllowAddName('client_organization_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Мобильный телефон', 'client_mobile_phone', false);
        $widget->setValue($repair->getClient() ? $repair->getClient()->getMobilePhone() : false);
        $widget->setValueType(WidgetInput::VALUE_TYPE_PHONE);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Домашний телефон', 'client_home_phone', false);
        $widget->setValue($repair->getClient() ? $repair->getClient()->getHomePhone() : false);
        $widget->setValueType(WidgetInput::VALUE_TYPE_HOME_PHONE);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Тип населённого пункта', 'client_city_type_id', false);
        $widget->setValue($repair->getClient() ? $repair->getClient()->getCityType() : false);
        $widget->setSelectItems(CityType::getAll());
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Населённый пункт', 'client_city_id', false);
        $widget->setValue($repair->getClient() ? $repair->getClient()->getCity() : false);
        $widget->setSelectItems(City::getAll());
        $widget->setAllowAddName('client_city_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Улица', 'client_street', false);
        $widget->setValue($repair->getClient() ? $repair->getClient()->getStreet() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Дом', 'client_house', false);
        $widget->setValue($repair->getClient() ? $repair->getClient()->getHouse() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Квартира', 'client_flat', false);
        $widget->setValue($repair->getClient() ? $repair->getClient()->getFlat() : false);
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        // Section 2 (about product)
        $widgetCollection = new WidgetCollection('Информация о технике');

        $widget = new WidgetSelect('Категория', 'product_category_id', true);
        $widget->setValue($repair ? $repair->getCategory() : false);
        $widget->setSelectItems(Category::getAll());
        $widget->setAllowAddName('product_category_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Бренд', 'product_brand_id', true);
        $widget->setValue($repair ? $repair->getBrand() : false);
        $widget->setSelectItems(Brand::getAll());
        $widget->setAllowAddName('product_brand_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Название', 'product_title', false);
        $widget->setValue($repair ? $repair->getTitle() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Заводской номер', 'product_code', false);
        $widget->setValue($repair ? $repair->getHashCode() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('В комплекте', 'product_set', false);
        $widget->setValue($repair ? $repair->getSet() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Неисправность', 'product_defect', false);
        $widget->setValue($repair ? $repair->getDefect() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Внешний вид', 'product_appearance', false);
        $widget->setValue($repair ? $repair->getAppearance() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Комментарий', 'product_comment', false);
        $widget->setValue($repair ? $repair->getComment() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Ориентировочная стоимость', 'product_approximate_cost', false);
        $widget->setValue($repair ? $repair->getApproximateCost() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Место приема заказа', 'reception_place_id', true);
        $widget->setValue($repair ? $repair->getReceptionPlace() : false);
        $widget->setSelectItems(ReceptionPlace::getAll());
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Принял в ремонт', 'worker_id', true);
        $widget->setValue($repair ? $repair->getWorker() : false);
        $widget->setSelectItems(AdminRepository::getRepairAdmins());
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        $form = array(
            'widgets' => $widgets,
            'url' => '/admin/repair/save',
        );

        $userAdmin = Admin::getAuthAdmin();
        $menu = AdminMenu::getAdminMenu();
        $page = new FormPage('Добавление техники в ремонт');

        return view($page->getViewName(),
            [
                'admin' => $userAdmin,
                'adminMenu' => $menu,
                'page' => $page,
                'form' => $form,
            ]
        );
        //todo-pavet
    }

    public function repairSave(Request $request)
    {
        RepairRepository::saveRepair($request);

        return redirect()->route('admin.repair.list');
    }

    public function repairDelete(Request $request)
    {
        RepairRepository::removeRepairs($request->deleteItems);

        return redirect()->route('admin.repair.list');
    }

    public function updateStatus(Request $request)
    {
        RepairRepository::updateRepairStatus(RepairRepository::getRepairById($request->selectItemId), $request->status);

        return redirect()->route('admin.repair.list');
    }

    public function printDoc(Request $request)
    {
        $currentRepair = RepairRepository::getRepairById($request->input('id'));
        $fileInfo = array(
            'file_name' => 'Квитанция о приеме в ремонт № ' . $currentRepair->getReceiptNumber() . ' от ' . $currentRepair->getCreatedForPrintDate(),
            'list_name' => 'Квитанция о приеме в ремонт',
        );
        $orgInfo = array(
            'org_name' => 'ЧТУП "ЭниКомп"',
            'org_address' => 'г. Лепель, ул. Ленинская, д. 9, каб. 1',
            'org_phone' => '8-02132-4-62-62',
        );

        $excel = new ExcelDocument();
        $excel->create($fileInfo, $orgInfo, $currentRepair);
    }

    public function statistics(Request $request)
    {
        $block = [];
        $block['title'] = 'Статистика';
        $block['clients'] = ClientRepository::clientsToArray(ClientRepository::getClients());

        $userAdmin = Admin::getAuthAdmin();
        $menu = AdminMenu::getAdminMenu();
        $page = new TablePage('Статистика');

        return view($page->getViewName(),
            [
                'admin' => $userAdmin,
                'adminMenu' => $menu,
                'page' => $page,
                'block' => $block
            ]
        );
    }

    public function statisticsPrint()
    {
        $excel = new ExcelDocument();
        $excel->repairStatistics(
            'Статистика',
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

    public function show(Repair $repair)
    {
        $block = [];
        $block['title'] = 'Техника';
        $block['repair'] = RepairRepository::repairToArray($repair);

        $userAdmin = Admin::getAuthAdmin();
        $menu = AdminMenu::getAdminMenu();
        $page = new Page(sprintf('Ремонт %s', $repair->getFullName()), 'admin.repair_show');

        return view($page->getViewName(),
            [
                'admin' => $userAdmin,
                'adminMenu' => $menu,
                'page' => $page,
                'block' => $block
            ]
        );
    }
}
