<?php declare(strict_types=1);


namespace SeatCode\Interview\Domain\Collections;

use SeatCode\Interview\Domain\Models\Mower;

class MowerCollection extends ObjectCollection
{
    /**
     * @return Mower[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public static function allowedObjectClass(): string
    {
        return Mower::class;
    }

    protected function itemAssertions($item): void
    {
    }
}
