<?php declare(strict_types=1);

namespace SeatCode\Interview\Domain\Models;

use Ramsey\Uuid\UuidInterface;
use SeatCode\Interview\Domain\Collections\MowerCollection;

class Plateau
{
    private UuidInterface $uuid;
    private Coordinates $upperRightCorner;
    private MowerCollection $mowerCollection;

    public function __construct(UuidInterface $uuid, Coordinates $upperRightCorner)
    {
        $this->uuid = $uuid;
        $this->upperRightCorner = $upperRightCorner;
        $this->mowerCollection = new MowerCollection();
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function getPlateaUpperRightCorner(): Coordinates
    {
        return $this->upperRightCorner;
    }

    public function getMowerCollection(): MowerCollection
    {
        return $this->mowerCollection;
    }

    public function addMower(Mower $mower): void
    {
        $this->mowerCollection->add($mower);
    }
}
