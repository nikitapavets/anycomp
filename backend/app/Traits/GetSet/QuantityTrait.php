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

    public function decrementQuantity()
    {
        $this->setQuantity($this->getQuantity() - 1);
        $this->save();
    }

    public function incrementQuantity()
    {
        $this->setQuantity($this->getQuantity() + 1);
        $this->save();
    }

    public function hasInStock()
    {
        return !!$this->getQuantity();
    }
}
