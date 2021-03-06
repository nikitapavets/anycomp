<?php

namespace App\Repositories;

use App\Classes\Table\TableCell;
use App\Classes\Table\TableLinkCell;
use App\Classes\Table\TableRow;
use App\Collections\TableCellsCollection;
use App\Collections\TableRowsCollection;
use App\Models\Client;
use App\Models\Database;
use Illuminate\Http\Request;

class ClientRepository
{
    /**
     * @return Client[]
     */
    public static function getClients()
    {
        return Client::orderBy('second_name')->get();
    }

    /**
     * @param $email
     * @return Client
     */
    public static function getClientByEmail($email)
    {
        return Client::where('email', $email)->first();
    }

    public static function auth($email, $password)
    {
        $client = self::getClientByEmail($email);
        if ($client && $client->checkPassword($password)) {
            return $client;
        }
        return $email;
    }

    /**
     * @param Client[] $clients
     * @param $pageSize
     * @param $pageNumber
     *
     * @return TableRowsCollection
     */
    public static function clientsToRows($clients, $pageSize, $pageNumber)
    {
        $tableRows = new TableRowsCollection();
        $index = $pageSize * ($pageNumber - 1);
        foreach ($clients as $client) {
            $tableCells = new TableCellsCollection();

            $tableCell = new TableCell($client->getId());
            $tableCell->setClass(TableCell::CLASS_CHECKER);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell(++$index);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($client->full_name);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($client->organization->name);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($client->mobile_phone_native);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($client->home_phone_native);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($client->address);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($client->repairs_count);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableLinkCell($client->last_repair->receipt_number);
            $tableCell->setLinkHref(route('admin.repairs.show', ['id' => $client->last_repair->id]));
            $tableCells->pushTableCell($tableCell);

            $tableRow = new TableRow($tableCells);
            $tableRows->pushTableCell($tableRow);
        }

        return $tableRows;
    }
}