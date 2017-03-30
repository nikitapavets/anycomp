<?php

namespace App\Repositories;

use App\Classes\Table\TableCell;
use App\Classes\Table\TableRow;
use App\Collections\TableCellsCollection;
use App\Collections\TableRowsCollection;
use App\Models\Client;

class ClientRepository
{
    /**
     * @return Client[]
     */
    public static function getClients()
    {
        return Client::orderBy('id', 'second_name')->get();
    }

    /**
     * @param string $stringIds
     * @param string $delimiter
     */
    public static function removeClients($stringIds, $delimiter = ',')
    {
        $arrayIds = explode($delimiter, $stringIds);
        Client::destroy($arrayIds);
    }

    /**
     * @param int $id
     * @return Client
     */
    public static function getClientById($id)
    {
        return Client::find($id);
    }

    /**
     * @param Client[] $clients
     * @return TableRowsCollection
     */
    public static function clientsToRows($clients)
    {
        $tableRows = new TableRowsCollection();
        $index = 1;
        foreach ($clients as $client) {
            $tableCells = new TableCellsCollection();

            $tableCell = new TableCell($client->getId());
            $tableCell->setClass(TableCell::CLASS_CHECKER);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($index++);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($client->getFullName());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($client->getOrganization()->getName());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($client->getMobilePhoneOnNativeFormat());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($client->getHomePhoneOnNativeFormat());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($client->getAddress());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($client->getCreatedAt());
            $tableCells->pushTableCell($tableCell);

            $tableRow = new TableRow($tableCells);
            $tableRows->pushTableCell($tableRow);
        }

        return $tableRows;
    }
}