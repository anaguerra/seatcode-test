<?php declare(strict_types=1);

namespace SeatCode\Interview\Domain\Models;

class CardinalPoint
{
    private CardinalPointEnum $cardinalPointEnum;

    public function __construct(CardinalPointEnum $cardinalPointEnum)
    {
        $this->cardinalPointEnum = $cardinalPointEnum;
    }

    public function getCardinalPointEnum(): CardinalPointEnum
    {
        return $this->cardinalPointEnum;
    }


    public function moveRight(): self
    {
        switch ($this->cardinalPointEnum->value) {
            case CardinalPointEnum::N:
                return new CardinalPoint(CardinalPointEnum::east());
            case CardinalPointEnum::S:
                return new CardinalPoint(CardinalPointEnum::west());
            case CardinalPointEnum::E:
                return new CardinalPoint(CardinalPointEnum::south());
            case CardinalPointEnum::W:
            default:
                return new CardinalPoint(CardinalPointEnum::north());
        }
    }

    public function moveLeft(): self
    {
        switch ($this->cardinalPointEnum->value) {
            case CardinalPointEnum::N:
                return new CardinalPoint(CardinalPointEnum::west());
            case CardinalPointEnum::S:
                return new CardinalPoint(CardinalPointEnum::east());
            case CardinalPointEnum::E:
                return new CardinalPoint(CardinalPointEnum::north());
            case CardinalPointEnum::W:
            default:
                return new CardinalPoint(CardinalPointEnum::south());
        }
    }
}
