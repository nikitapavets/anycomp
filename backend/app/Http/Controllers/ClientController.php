<?php

namespace App\Http\Controllers;

use App\Classes\Table\Table;
use App\Classes\Table\TableField;
use App\Classes\Table\TableTab;
use App\Collections\TableActionCollection;
use App\Collections\TableFieldCollection;
use App\Collections\TableTabCollection;
use App\Repositories\ClientRepository;
use App\Models\Admin;
use App\Models\AdminMenu;

class ClientController extends Controller
{
    public function clientsRepair()
    {
        $table = new Table('Список клиентов');

        // Table fields
        $tableFields = new TableFieldCollection();

        $tableField = new TableField('', '50px', TableField::SORT_TYPE_NO_SORTABLE, TableField::CLASS_CHECKER);
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('№', '50px');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Ф.И.О');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Организация');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Мобильный телефон');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Дополнительный телефон');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Адрес');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Добавлен');
        $tableFields->pushTableField($tableField);

        $table->setTableFields($tableFields);

        // Table tabs
        $tableTabs = new TableTabCollection();

        $tableTab = new TableTab('Вcе', TableTab::STATUS_ACTIVE);
        $tableTab->setRows(ClientRepository::clientsToRows(ClientRepository::getClients()));
        $tableTabs->pushTableTab($tableTab);

        $table->setTableTabs($tableTabs);

        // Table actions
        $tableActions = new TableActionCollection();
        $table->setTableActions($tableActions);

        $userAdmin = Admin::getAuthAdmin();
        $menu = AdminMenu::getAdminMenu();

        $page = [
            'title' => 'AnyComp | Панель управления - Список клиентов услуг ремонта',
            'css' => '/styles/admin.min.css',
            'css_header' => '',
            'sub_title' => 'Список клиентов услуг ремонта',
            'sub_descr' => 'Список клиентов, которые пользовались услугами ремонта.',
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
}
