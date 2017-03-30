<?php

namespace App\Traits\Relations\BelongToMany;

use App\Models\Database\MemoryCard;
use App\Models\Database;

trait MemoryCardsTrait
{
    /**
     * @return string
     */
    public function getMemoryCardsLikeString()
    {
        $memoryCardsArray = [];
        foreach ($this->getMemoryCards() as $memoryCard) {
            $memoryCardsArray[] = $memoryCard->getName();
        }

        return implode(', ', $memoryCardsArray);
    }

    /**
     * @return MemoryCard[]
     */
    public function getMemoryCards()
    {
        return $this->memoryCards;
    }

    /**
     * @param string $memoryCardsIdsString
     */
    public function setMemoryCards($memoryCardsIdsString)
    {
        $memoryCardsIdsArray = $memoryCardsIdsString
            ? explode(',', $memoryCardsIdsString)
            : array(Database::NO_SELECTED);
        $this->memoryCards()->sync($memoryCardsIdsArray);
    }

    /**
     * @return mixed
     */
    public function memoryCards()
    {
        return $this->belongsToMany('App\Models\Database\MemoryCard');
    }
}
