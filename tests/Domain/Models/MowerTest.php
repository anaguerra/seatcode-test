<?php declare(strict_types=1);

namespace SeatCode\Interview\Tests\Domain\Models;

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use SeatCode\Interview\Domain\Models\CardinalPoint;
use SeatCode\Interview\Domain\Models\CardinalPointEnum;
use SeatCode\Interview\Domain\Models\Coordinates;
use SeatCode\Interview\Domain\Models\ExploreString;
use SeatCode\Interview\Domain\Models\Mower;
use SeatCode\Interview\Domain\Models\Plateau;

class MowerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @dataProvider moveProvider
     */
    public function testMove(
        string            $movement,
        Coordinates       $initialCoordinates,
        Coordinates       $expectedCoordinates,
        CardinalPointEnum $initialCardinalPoint,
        CardinalPointEnum $expectedFinalCardinalPoint
    ): void {
        $plateau = new Plateau(Uuid::uuid4(), Coordinates::create(5, 5));
        $mower = new Mower(Uuid::uuid4(), $plateau, $initialCoordinates, new CardinalPoint($initialCardinalPoint));

        $mower->move($movement);
        $this->assertEquals($mower->getCoordinates(), $expectedCoordinates);
        $this->assertEquals($mower->getCardinalPoint()->getCardinalPointEnum(), $expectedFinalCardinalPoint);
    }


    public function moveProvider(): array
    {
        return [
            ['movement' => 'M', Coordinates::create(3, 3), Coordinates::create(3, 4), CardinalPointEnum::north(), CardinalPointEnum::north()],
            ['movement' => 'M', Coordinates::create(3, 3), Coordinates::create(3, 2), CardinalPointEnum::south(), CardinalPointEnum::south()],
            ['movement' => 'L', Coordinates::create(3, 3), Coordinates::create(3, 3), CardinalPointEnum::west(), CardinalPointEnum::south()],
            ['movement' => 'R', Coordinates::create(3, 3), Coordinates::create(3, 3), CardinalPointEnum::east(), CardinalPointEnum::south()],
        ];
    }

    public function testExploreThrowExceptionWhenCoordinatesOutOfRange(): void
    {
        $this->expectException(\Exception::class);

        $plateau = new Plateau(Uuid::uuid4(), Coordinates::create(5, 5));
        $coordinates = Coordinates::create(4, 4);
        $mower = new Mower(Uuid::uuid4(), $plateau, $coordinates, new CardinalPoint(CardinalPointEnum::north()));

        $mower->explore(new ExploreString('MM'));
    }


    public function testExploreCase1(): void
    {
        $plateau = new Plateau(Uuid::uuid4(), Coordinates::create(5, 5));
        $coordinates = Coordinates::create(1, 2);
        $mower = new Mower(Uuid::uuid4(), $plateau, $coordinates, new CardinalPoint(CardinalPointEnum::north()));

        $mower->explore(new ExploreString('LMLMLMLMM'));

        $this->assertEquals(Coordinates::create(1, 3), $mower->getCoordinates());
        $this->assertEquals(CardinalPointEnum::north(), $mower->getCardinalPoint()->getCardinalPointEnum());
    }

    public function testExploreCase2(): void
    {
        $plateau = new Plateau(Uuid::uuid4(), Coordinates::create(5, 5));
        $coordinates = Coordinates::create(3, 3);
        $mower = new Mower(Uuid::uuid4(), $plateau, $coordinates, new CardinalPoint(CardinalPointEnum::east()));

        $mower->explore(new ExploreString('MMRMMRMRRM'));

        $this->assertEquals(Coordinates::create(5, 1), $mower->getCoordinates());
        $this->assertEquals(CardinalPointEnum::east(), $mower->getCardinalPoint()->getCardinalPointEnum());
    }
}
