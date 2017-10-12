<?php

namespace App\Models;

use App\Traits\GetSet\CreatedAtTrait;
use App\Traits\GetSet\IdTrait;
use App\Traits\Relations\BelongTo\AdminTrait;
use App\Traits\Relations\BelongTo\BrandTrait;
use App\Traits\Relations\BelongTo\CategoryTrait;
use App\Traits\Relations\BelongTo\ClientTrait;
use App\Traits\Relations\BelongTo\ReceptionPlaceTrait;
use App\Traits\Relations\BelongTo\WorkerTrait;
use App\Traits\Relations\BelongToMany\SparesTrait;
use App\Traits\Relations\HasMany\RepairDescriptionsTrait;

use Carbon\Carbon;

class Repair extends SearchableModel
{
    use ClientTrait;
    use AdminTrait;
    use BrandTrait;
    use CategoryTrait;
    use WorkerTrait;
    use ReceptionPlaceTrait;
    use IdTrait;
    use CreatedAtTrait;
    use RepairDescriptionsTrait;
    use SparesTrait;

    const STATUS_REPAIR = 0;
    const STATUS_REPAIR_NAME = 'В ремонте';
    const STATUS_COMPLETE = 1;
    const STATUS_COMPLETE_NAME = 'На выдаче';
    const STATUS_ISSUED = 2;
    const STATUS_ISSUED_NAME = 'У клиента';

    const SEARCH = [
        'receipt_number^200',
        'title^50',
        'category.name',
        'brand.name',
        'receptionPlace.name',
        'client.first_name',
        'client.second_name',
        'client.mobile_phone^100',
        'client.city.name',
        'client.organization.name',
    ];

    protected $guarded = [
        'id',
        'client_id',
        'admin_id',
        'brand_id',
        'category_id',
        'worker_id',
        'reception_place_id',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'title',
        'code',
        'set',
        'defect',
        'appearance',
        'comment',
        'approximate_cost',
        'current_status',
    ];

    protected $hidden = [
        'client_id',
        'admin_id',
        'brand_id',
        'category_id',
        'worker_id',
        'reception_place_id',
    ];

    protected $with = [
        'category',
        'brand',
        'receptionPlace',
        'client',
    ];

    public function setHashCode($code)
    {
        $this->code = $code;
    }

    public function getHashCode()
    {
        return $this->code;
    }

    public function setApproximateCost($cost)
    {
        $this->approximate_cost = $cost;
    }

    public function getApproximateCost()
    {
        return $this->approximate_cost;
    }

    public function getStatus()
    {
        return $this->current_status;
    }

    public function setStatus($status)
    {
        $this->current_status = $status;
    }

    public function getStatusName()
    {
        switch ($this->getStatus()){
            case self::STATUS_REPAIR: return self::STATUS_REPAIR_NAME;
            case self::STATUS_COMPLETE: return self::STATUS_COMPLETE_NAME;
            case self::STATUS_ISSUED: return self::STATUS_ISSUED_NAME;
        }
    }

    public function getCode()
    {
        return $this->token;
    }

    public function setCode()
    {
        if (!$this->getCode()) {
            $this->token = substr(md5(time()), -8, 8);;
        }
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getReceiptNumber()
    {
        return $this->receipt_number;
    }

    public function setReceiptNumber($receiptNumber)
    {
        if (!$this->getReceiptNumber()) {
            $this->receipt_number = $receiptNumber;
        }
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function getSet()
    {
        return $this->set;
    }

    public function setSet($set)
    {
        $this->set = $set;
    }

    public function getDefect()
    {
        return $this->defect;
    }

    public function setDefect($defect)
    {
        $this->defect = $defect;
    }

    public function getAppearance()
    {
        return $this->appearance;
    }

    public function setAppearance($appearance)
    {
        $this->appearance = $appearance;
    }

    public function getFullName()
    {
        return $this->getCategory()->getName().' '.$this->getName();
    }

    public function getName()
    {
        return $this->getBrand()->getName().' '.$this->getTitle();
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getCreatedForPrintDate()
    {
        $date = '';
        $date .= date('d ', $this->created_at->getTimestamp());
        switch (date('n', $this->created_at->getTimestamp())) {
            case 1: {
                $date .= "января";
                break;
            }
            case 2: {
                $date .= "февраля";
                break;
            }
            case 3: {
                $date .= "марта";
                break;
            }
            case 4: {
                $date .= "апреля";
                break;
            }
            case 5: {
                $date .= "мая";
                break;
            }
            case 6: {
                $date .= "июня";
                break;
            }
            case 7: {
                $date .= "июля";
                break;
            }
            case 8: {
                $date .= "августа";
                break;
            }
            case 9: {
                $date .= "сентября";
                break;
            }
            case 10: {
                $date .= "октября";
                break;
            }
            case 11: {
                $date .= "ноября";
                break;
            }
            case 12: {
                $date .= "декабря";
                break;
            }
        }
        $date .= date(' Yг.', $this->created_at->getTimestamp());

        return $date;
    }

    public function getCompletedAt()
    {
        $time = Carbon::parse($this->completed_at);

        return $time->timestamp > 0 ? date('d-m-Y', $time->timestamp) : '';
    }

    public function getCompletedAtFull()
    {
        $time = Carbon::parse($this->completed_at);

        return $time->timestamp > 0 ? date('d.m.Y H:i', $time->timestamp) : '';
    }

    public function setCompletedAt()
    {
        $this->completed_at = Carbon::now();
    }

    public function getLinkHref()
    {
        return '/admin/repair/'.$this->getId();
    }

    public function isIssued()
    {
        return $this->getStatus() === self::STATUS_ISSUED;
    }
}
