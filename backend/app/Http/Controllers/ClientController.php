<?php

namespace App\Http\Controllers;

use App\Classes\Page\TablePage;
use App\Classes\Table\Table;
use App\Classes\Table\TableField;
use App\Classes\Table\TablePagination;
use App\Classes\Table\TableTab;
use App\Collections\TableActionCollection;
use App\Collections\TableFieldCollection;
use App\Collections\TableTabCollection;
use App\Models\Client;
use App\Repositories\ClientRepository;
use App\Models\Admin;
use App\Models\AdminMenu;
use App\Services\ElasticSearchService;
use App\Services\PaginationService;
use Illuminate\Http\Request;


class ClientController extends Controller
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

        $table = new Table('Список клиентов');

        // Table fields
        $tableFields = new TableFieldCollection();

        $tableField = new TableField('', '50px', TableField::SORT_TYPE_NO_SORTABLE, TableField::CLASS_CHECKER);
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('№', '50px');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Ф.И.О', 0,TableField::SORT_TYPE_SORTABLE);
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Организация');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Номер телефона', '115px', TableField::SORT_TYPE_NO_SORTABLE);
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Доп. телефон', '115px', TableField::SORT_TYPE_NO_SORTABLE);
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Адрес', 0,TableField::SORT_TYPE_NO_SORTABLE);
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Заказов');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Последний заказ', 0,TableField::SORT_TYPE_NO_SORTABLE);
        $tableFields->pushTableField($tableField);

        $table->setTableFields($tableFields);

        // Table tabs
        $tableTabs = new TableTabCollection();

        $tableTab = new TableTab('Вcе', TableTab::STATUS_ACTIVE);
        if($searchRequest['search']) {
            $elasticsearchService = new ElasticSearchService(new Client);
            $clients = new PaginationService(new Client, $elasticsearchService->search($searchRequest), $searchRequest);
            $clients->setPath($request->getBasePath());
        } else {
            $clients = Client::paginate($pageSize);
        }
        $clients->appends(['tab' => $tab]);
        $tableTab->setRows(ClientRepository::clientsToRows($clients, $pageSize, $pageNumber));
        $tableTapPagination = new TablePagination($clients);
        $tableTab->setPagination($tableTapPagination);
        $tableTabs->pushTableTab($tableTab);

        $table->setTableTabs($tableTabs);

        // Table actions
        $tableActions = new TableActionCollection();
        $table->setTableActions($tableActions);

        $userAdmin = Admin::getAuthAdmin();
        $menu = AdminMenu::getAdminMenu();
        $page = new TablePage('Клиенты услуг ремонта');

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
