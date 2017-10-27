<?php

namespace App\Models;

use App\Services\ElasticSearchService;
use App\Services\StringTransformator;
use App\Traits\GetSet\CreatedAtTrait;
use App\Traits\GetSet\IdTrait;
use App\Traits\Relations\BelongTo\AdminTrait;
use App\Traits\Relations\BelongTo\BrandTrait;
use App\Traits\Relations\BelongTo\CategoryTrait;
use App\Traits\Relations\BelongTo\ClientTrait;
use App\Traits\Relations\BelongTo\ReceptionPlaceTrait;
use App\Traits\Relations\BelongToMany\SparesTrait;
use App\Traits\Relations\HasMany\RepairDescriptionsTrait;

use Carbon\Carbon;

class Repair extends SearchableModel
{
    use ClientTrait;
    use AdminTrait;
    use BrandTrait;
    use CategoryTrait;
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
        'employee_id',
        'reception_place_id',
        'token',
        'receipt_number',
        'current_status',
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
    ];

    protected $hidden = [
        'client_id',
        'admin_id',
        'brand_id',
        'category_id',
        'employee_id',
        'reception_place_id',
    ];

    protected $with = [
        'category',
        'brand',
        'reception_place',
        'client',
        'employee',
        'worker',
        'repairDescriptions',
        'spares',
    ];

    protected $appends = [
        'link',
        'name',
        'full_name',
        'created_at_native',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'completed_at',
        'issued_at'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class, 'worker_id');
    }

    /** ********* Accessors & Mutators ********* */

    public function getLinkAttribute()
    {
        return route('admin.repairs.show', ['id' => $this->id]);
    }

    public function getNameAttribute()
    {
        return $this->getBrand()->getName().' '.$this->title;
    }

    public function getFullNameAttribute()
    {
        return $this->getCategory()->getName().' '.$this->name;
    }

    public function getCreatedAtNativeAttribute()
    {
        return StringTransformator::dateToString($this->created_at);
    }

    public function getCompletedAtAttribute($date)
    {
        return Carbon::parse($date)->timestamp > 0 ?
            Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y') : '';
    }

    public function getIssuedAtAttribute($date)
    {
        return Carbon::parse($date)->timestamp > 0 ?
            Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y') : '';
    }

    /** ********* Transformators ********* */

    public function toSearchArray()
    {
        $searchArray = $this->toArray();
        $searchArray['receipt_number'] = ElasticSearchService::escapeString($searchArray['receipt_number']);

        return $searchArray;
    }

    /** ********* Getters & Setters ********* */

    public function setStatus($status)
    {
        $this->current_status = $status;

        if($this->isComplete()) {
            $this->completing();
        } elseif($this->isIssued()) {
            $this->issuing();
        }
    }

    /** ********* Additional ********* */

    /**
     * Setting date of complete repair
     */
    private function completing()
    {
        $this->completed_at = Carbon::now();
    }

    /**
     *  Did repair is complete?
     */
    private function isComplete()
    {
        return $this->current_status == self::STATUS_COMPLETE;
    }

    /**
     * Setting date of issue
     */
    private function issuing()
    {
        $this->issued_at = Carbon::now();
    }

    /**
     *  Did client receive product?
     */
    private function isIssued()
    {
        return $this->current_status == self::STATUS_ISSUED;
    }
}
