<?php declare(strict_types=1);

namespace SeatCode\Interview\Domain\Models;

class Coordinates
{
    private int $positionX;
    private int $positionY;


    public function __construct(int $positionX, int $positionY)
    {
        $this->positionX = max($positionX, 0);
        $this->positionY = max($positionY, 0);
    }

    public static function create(int $positionX, int $positionY): self
    {
        return new self($positionX, $positionY);
    }

    public function getPositionX(): int
    {
        return $this->positionX;
    }

    public function getPositionY(): int
    {
        return $this->positionY;
    }

    public function equals(Coordinates $coordinates): bool
    {
        return $this->positionX === $coordinates->getPositionX()
            && $this->positionY === $coordinates->getPositionX();
    }

    public function greaterThan(Coordinates $coordinates): bool
    {
        return $this->positionX > $coordinates->getPositionX()
            || $this->positionY > $coordinates->getPositionY();
    }

    public function moveByHeading(CardinalPointEnum $cardinalPoint): self
    {
        switch ($cardinalPoint) {
            case CardinalPointEnum::N:
                return new self($this->positionX, $this->positionY + 1);
            case CardinalPointEnum::S:
                return new self($this->positionX, $this->positionY - 1);
            case CardinalPointEnum::E:
                return new self($this->positionX + 1, $this->positionY);
            case CardinalPointEnum::W:
            default:
                return new self($this->positionX - 1, $this->positionY);
        }
    }
}
