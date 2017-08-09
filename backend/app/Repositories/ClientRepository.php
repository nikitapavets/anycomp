<?php

namespace App\Repositories;

use App\Classes\Table\TableCell;
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

    public static function saveClient(Request $request)
    {
        /**
         * @var Client $client
         */
        $client = Client::firstOrNew(['id' => $request->client_id ?? 0]);
        $client->setSecondName($request->client_second_name);
        $client->setFirstName($request->client_first_name);
        $client->setFatherName($request->client_father_name);
        $client->setOrganization($request->client_organization_id ?? Database::NO_SELECTED, $request->client_organization_new);
        $client->setMobilePhone($request->client_mobile_phone);
        $client->setHomePhone($request->client_home_phone);
        $client->setEmail($request->client_email);
        $client->setCityType($request->client_city_type_id ?? Database::NO_SELECTED, $request->client_city_type_new);
        $client->setCity($request->client_city_id ?? Database::NO_SELECTED, $request->client_city_new);
        $client->setStreet($request->client_street);
        $client->setHouse($request->client_house);
        $client->setFlat($request->client_flat);
        $client->setPassword($request->client_password ?? 0);
        $client->setRang($request->client_id ? Client::RANG_REGISTERED : Client::RANG_NO_REGISTERED);
        $client->save();

        return $client;
    }

    public static function clientToArray(Client $client, $withRepairs = true)
    {
        $clientArray = [
            'id' => $client->getId(),
            'second_name' => $client->getSecondName(),
            'first_name' => $client->getFirstName(),
            'father_name' => $client->getFatherName(),
            'full_name' => $client->getFullName(),
            'short_name' => $client->getShortName(),
            'organization' => $client->getOrganization()->getName(),
            'mobile_phone' => $client->getMobilePhone(),
            'mobile_phone_native' => $client->getMobilePhoneOnNativeFormat(),
            'home_phone' => $client->getHomePhone(),
            'home_phone_native' => $client->getHomePhoneOnNativeFormat(),
            'email' => $client->getEmail(),
            'address_city_type' => $client->getCityType()->getName(),
            'address_city' => $client->getCity()->getName(),
            'address_street' => $client->getStreet(),
            'address_house' => $client->getHouse(),
            'address_flat' => $client->getFlat(),
            'address' => $client->getAddress(),
            'link' => $client->getLinkHref(),
        ];
        if($withRepairs) {
            $clientArray['repairs'] = RepairRepository::repairsToArray($client->getRepairs());
        }

        return $clientArray;
    }

    /**
     * @param Client[] $clients
     * @return array
     */
    public static function clientsToArray($clients)
    {
        return $clients->map(function ($item) {
            return self::clientToArray($item);
        });
    }


}