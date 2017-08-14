<?php

namespace App\Http\Controllers\Orders;

use App\Classes\Page\TablePage;
use App\Classes\Table\Table;
use App\Classes\Table\TableAction;
use App\Classes\Table\TableField;
use App\Classes\Table\TableTab;
use App\Collections\TableActionCollection;
use App\Collections\TableFieldCollection;
use App\Collections\TableTabCollection;
use App\Models\Admin;
use App\Models\AdminMenu;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function index()
    {
        $table = new Table('Список заказов с сайта');

        // Table fields
        $tableFields = new TableFieldCollection();

        $tableField = new TableField('', '50px', TableField::SORT_TYPE_NO_SORTABLE, TableField::CLASS_CHECKER);
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('№', '50px');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Заказ', '75px');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Клиент');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Заказ', false, TableField::SORT_TYPE_SORTABLE);
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Дата');
        $tableFields->pushTableField($tableField);

        $table->setTableFields($tableFields);

        // Table tabs
        $tableTabs = new TableTabCollection();
        $tableTab = new TableTab('Все', TableTab::STATUS_ACTIVE);
        $tableTab->setRows(OrderRepository::ordersToRows(OrderRepository::getOrders()));
        $tableTabs->pushTableTab($tableTab);

        $table->setTableTabs($tableTabs);

        // Table actions
        $tableActions = new TableActionCollection();
        $table->setTableActions($tableActions);

        $userAdmin = Admin::getAuthAdmin();
        $menu = AdminMenu::getAdminMenu();
        $page = new TablePage('Заказы с сайта');

        return view($page->getViewName(),
            [
                'admin' => $userAdmin,
                'adminMenu' => $menu,
                'page' => $page,
                'table' => $table->toArray(),
            ]
        );
    }
}
