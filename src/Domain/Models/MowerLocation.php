<?php declare(strict_types=1);

namespace SeatCode\Interview\Domain\Models;

class MowerLocation
{
    private Coordinates $coordinates;
    private CardinalPointEnum $cardinalPoint;

    public function __construct(Coordinates $coordinates, CardinalPointEnum $cardinalPoint)
    {
        $this->coordinates = $coordinates;
        $this->cardinalPoint = $cardinalPoint;
    }

    public static function create(Coordinates $coordinates, CardinalPointEnum $cardinalPoint): self
    {
        return new self($coordinates, $cardinalPoint);
    }

    public function getCoordinates(): Coordinates
    {
        return $this->coordinates;
    }

    public function getCardinalPoint(): CardinalPointEnum
    {
        return $this->cardinalPoint;
    }
}
