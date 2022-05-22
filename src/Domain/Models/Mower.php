<?php declare(strict_types=1);

namespace SeatCode\Interview\Domain\Models;

use Ramsey\Uuid\UuidInterface;
use SeatCode\Interview\Domain\Exception\MowerException;

class Mower
{
    private UuidInterface $uuid;
    private Coordinates $coordinates;
    private CardinalPoint $cardinalPoint;
    private Plateau $plateau;

    public function __construct(UuidInterface $uuid, Plateau $plateau, Coordinates $coordinates, CardinalPoint $cardinalPoint)
    {
        $this->uuid = $uuid;
        $this->plateau = $plateau;
        $this->coordinates = $coordinates;
        $this->cardinalPoint = $cardinalPoint;
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function getPlateau(): Plateau
    {
        return $this->plateau;
    }

    public function getCoordinates(): Coordinates
    {
        return $this->coordinates;
    }

    public function getCardinalPoint(): CardinalPoint
    {
        return $this->cardinalPoint;
    }

    public function getLocation(): MowerLocation
    {
        return new MowerLocation($this->coordinates, $this->cardinalPoint->getCardinalPointEnum());
    }

    public function explore(ExploreString $strLetters): void
    {
        $movementsArray = str_split($strLetters->getStringLetters());

        foreach ($movementsArray as $movement) {
            $this->move($movement);
        }
    }

    public function move(string $movement): void
    {
        $cardinalPoint = $this->cardinalPoint;
        $coordinates = $this->coordinates;

        switch ($movement) {
            case 'L':
                $cardinalPoint = $this->cardinalPoint->moveLeft();
                break;
            case 'R':
                $cardinalPoint = $this->cardinalPoint->moveRight();
                break;
            case 'M':
                $coordinates = $this->coordinates->moveByHeading($this->cardinalPoint->getCardinalPointEnum());
                break;
        }

        // Here also we could adjust coordinates to range and not throw exception
        $this->assertCoordinatesInPlateau($coordinates, $this->plateau->getPlateaUpperRightCorner());
        $this->coordinates = $coordinates;
        $this->cardinalPoint = $cardinalPoint;
    }

    private function assertCoordinatesInPlateau(Coordinates $coordinates, Coordinates $plateauCoordinates): void
    {
        if ($coordinates->greaterThan($plateauCoordinates)) {
            throw new MowerException(
                sprintf(
                    'Coordinates (%s, %s) out of plateau',
                    $coordinates->getPositionX(),
                    $coordinates->getPositionY()
                )
            );
        }
    }
}
