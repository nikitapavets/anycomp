<?php

namespace App\Observers;

use App\Models\Repair;
use App\Repositories\RepairRepository;

class RepairObserver
{
    public function creating(Repair $repair)
    {
        $repair->token = substr(md5(time()), -8, 8);
        $repair->receipt_number = RepairRepository::makeReceiptNumber();
    }
}
