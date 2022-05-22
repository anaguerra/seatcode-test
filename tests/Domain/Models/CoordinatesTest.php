<?php declare(strict_types=1);

namespace SeatCode\Interview\Tests\Domain\Models;

use PHPUnit\Framework\TestCase;
use SeatCode\Interview\Domain\Models\CardinalPointEnum;
use SeatCode\Interview\Domain\Models\Coordinates;

class CoordinatesTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testLessThanZero(): void
    {
        $coordinates = new Coordinates(-1, 3);
        $this->assertEquals(new Coordinates(0, 3), $coordinates);
    }

    public function testMoveNorth(): void
    {
        $coordinates = new Coordinates(3, 3);
        $newCoordinates = $coordinates->moveByHeading(CardinalPointEnum::north());
        $this->assertEquals(Coordinates::create(3, 4), $newCoordinates);
    }

    public function testMoveSouth(): void
    {
        $coordinates = new Coordinates(3, 3);
        $newCoordinates = $coordinates->moveByHeading(CardinalPointEnum::south());
        $this->assertEquals(Coordinates::create(3, 2), $newCoordinates);
    }

    public function testMoveEast(): void
    {
        $coordinates = new Coordinates(3, 3);
        $newCoordinates = $coordinates->moveByHeading(CardinalPointEnum::east());
        $this->assertEquals(Coordinates::create(4, 3), $newCoordinates);
    }

    public function testMoveWest(): void
    {
        $coordinates = new Coordinates(3, 3);
        $newCoordinates = $coordinates->moveByHeading(CardinalPointEnum::west());
        $this->assertEquals(Coordinates::create(2, 3), $newCoordinates);
    }
}
