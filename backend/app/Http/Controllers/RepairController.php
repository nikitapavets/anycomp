<?php

namespace App\Http\Controllers;

use App\Classes\Table\Table;
use App\Classes\Table\TableAction;
use App\Classes\Table\TableField;
use App\Classes\Table\TableTab;
use App\Classes\Widget\WidgetInput;
use App\Classes\Widget\WidgetSelect;
use App\Collections\TableActionCollection;
use App\Collections\TableFieldCollection;
use App\Collections\TableTabCollection;
use App\Collections\WidgetCollection;
use App\Models\Admin;
use App\Models\Worker;
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
    public function repairList()
    {

        $table = new Table('Список техники в ремонте');

        // Table fields
        $tableFields = new TableFieldCollection();

        $tableField = new TableField('', '50px', TableField::SORT_TYPE_NO_SORTABLE, TableField::CLASS_CHECKER);
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('№', '150px');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Техника');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Клиент');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Добавлен', false, TableField::SORT_TYPE_SORTABLE);
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('', false, TableField::SORT_TYPE_NO_SORTABLE);
        $tableFields->pushTableField($tableField);

        $table->setTableFields($tableFields);

        // Table tabs
        $tableTabs = new TableTabCollection();

        $tableTab = new TableTab('В ремонте', TableTab::STATUS_ACTIVE);
        $tableTab->setRows(
            RepairRepository::repairsToRows(RepairRepository::getRepairsByStatus(Repair::STATUS_REPAIR))
        );
        $tableTabs->pushTableTab($tableTab);

        $tableTab = new TableTab('На выдаче');
        $tableTab->setRows(
            RepairRepository::repairsToRows(RepairRepository::getRepairsByStatus(Repair::STATUS_COMPLETE))
        );
        $tableTabs->pushTableTab($tableTab);

        $tableTab = new TableTab('У клиента');
        $tableTab->setRows(
            RepairRepository::repairsToRows(RepairRepository::getRepairsByStatus(Repair::STATUS_ISSUED))
        );
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
            '/admin/repair/create'
        );
        $tableActions->pushTableAction($tableAction);

        $table->setTableActions($tableActions);

        $userAdmin = Admin::getAuthAdmin();
        $menu = AdminMenu::getAdminMenu();

        $page = [
            'title' => 'AnyComp | Панель управления - Список техники в ремонте',
            'css' => '/styles/admin.min.css',
            'css_header' => '',
            'sub_title' => 'Список техники в ремонте',
            'sub_descr' => 'Можно добавлять, изменять и удалять элементы таблицы.',
            'view_system_name' => 'admin.blocks.table',
        ];

        return view(
            $page['view_system_name'],
            [
                'admin' => $userAdmin,
                'adminMenu' => $menu,
                'page' => $page,
                'table' => $table->toArray(),
            ]
        );
    }

    public function repairCreateUpdate(Request $request)
    {

        $userAdmin = Admin::getAuthAdmin();
        $menu = AdminMenu::getAdminMenu();
        $repair = RepairRepository::getRepairById($request->repair_id);

        $widgets = [];

        // Section 1 (about client)
        $widgetCollection = new WidgetCollection('Информация о клиенте');

        if ($repair) {
            $widget = new WidgetInput('Ид', 'repair_id', true);
            $widget->setValue($repair->getId());
            $widget->setValueType('hidden');
            $widgetCollection->pushWidget($widget);

            $widget = new WidgetInput('Ид', 'client_id', true);
            $widget->setValue($repair->getClient()->getId());
            $widget->setValueType('hidden');
            $widgetCollection->pushWidget($widget);
        }

        $widget = new WidgetInput('Фамилия', 'client_second_name', false);
        $widget->setValue($repair ? $repair->getClient()->getSecondName() : false);
        $widget->setValidationType(WidgetInput::VALIDATION_TYPE_ONLY_RUS);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Имя', 'client_first_name', false);
        $widget->setValue($repair ? $repair->getClient()->getFirstName() : false);
        $widget->setValidationType(WidgetInput::VALIDATION_TYPE_ONLY_RUS);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Отчество', 'client_father_name', false);
        $widget->setValue($repair ? $repair->getClient()->getFatherName() : false);
        $widget->setValidationType(WidgetInput::VALIDATION_TYPE_ONLY_RUS);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Организация', 'client_organization_id', false);
        $widget->setValue($repair ? $repair->getClient()->getOrganization() : false);
        $widget->setSelectItems(Organization::getAll());
        $widget->setAllowAddName('client_organization_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Мобильный телефон', 'client_mobile_phone', false);
        $widget->setValue($repair ? $repair->getClient()->getMobilePhone() : false);
        $widget->setValueType(WidgetInput::VALUE_TYPE_PHONE);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Домашний телефон', 'client_home_phone', false);
        $widget->setValue($repair ? $repair->getClient()->getHomePhone() : false);
        $widget->setValueType(WidgetInput::VALUE_TYPE_HOME_PHONE);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Тип населённого пункта', 'client_city_type_id', false);
        $widget->setValue($repair ? $repair->getClient()->getCityType() : false);
        $widget->setSelectItems(CityType::getAll());
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Населённый пункт', 'client_city_id', false);
        $widget->setValue($repair ? $repair->getClient()->getCity() : false);
        $widget->setSelectItems(City::getAll());
        $widget->setAllowAddName('client_city_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Улица', 'client_street', false);
        $widget->setValue($repair ? $repair->getClient()->getStreet() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Дом', 'client_house', false);
        $widget->setValue($repair ? $repair->getClient()->getHouse() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Квартира', 'client_flat', false);
        $widget->setValue($repair ? $repair->getClient()->getFlat() : false);
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
        $widget->setValue($repair ? $repair->getCode() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('В комплекте', 'product_set', false);
        $widget->setValue($repair ? $repair->getSet() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Неисправность', 'product_defect', false);
        $widget->setValue($repair ? $repair->getDefect() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Комментарий', 'product_comment', false);
        $widget->setValue($repair ? $repair->getComment() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Принял в ремонт', 'worker_id', true);
        $widget->setValue($repair ? $repair->getWorker() : false);
        $widget->setSelectItems(Worker::getAll());
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        $form = array(
            'widgets' => $widgets,
            'url' => '/admin/repair/save',
        );

        $page = [
            'title' => 'AnyComp | Панель управления - Добавление техники в ремонт',
            'css' => '/styles/admin.min.css',
            'css_header' => '',
            'sub_title' => 'Добавление техники в ремонт',
            'sub_descr' => 'Будьте внимательны, заполняя поля формы.',
            'view_system_name' => 'admin.blocks.form',
        ];

        return view(
            $page['view_system_name'],
            [
                'admin' => $userAdmin,
                'adminMenu' => $menu,
                'page' => $page,
                'form' => $form,
            ]
        );
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
            'file_name' => 'Квитанция о приеме в ремонт № '.$currentRepair->getReceiptNumber(
                ).' от '.$currentRepair->getCreatedForPrintDate(),
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
}
