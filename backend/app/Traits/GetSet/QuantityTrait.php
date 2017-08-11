<?php

namespace App\Traits\GetSet;

trait QuantityTrait
{
    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
}
