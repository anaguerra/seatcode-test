<?php declare(strict_types=1);

namespace SeatCode\Interview\Tests\Domain\Models;

use PHPUnit\Framework\TestCase;
use SeatCode\Interview\Domain\Models\CardinalPoint;
use SeatCode\Interview\Domain\Models\CardinalPointEnum;

class CardinalPointTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testMoveRight(): void
    {
        $cardinalPoint = new CardinalPoint(CardinalPointEnum::north());
        $newCardinalPoint = $cardinalPoint->moveRight();
        $this->assertEquals($newCardinalPoint->getCardinalPointEnum(), CardinalPointEnum::east());

        $cardinalPoint = new CardinalPoint(CardinalPointEnum::south());
        $newCardinalPoint = $cardinalPoint->moveRight();
        $this->assertEquals($newCardinalPoint->getCardinalPointEnum(), CardinalPointEnum::west());

        $cardinalPoint = new CardinalPoint(CardinalPointEnum::east());
        $newCardinalPoint = $cardinalPoint->moveRight();
        $this->assertEquals($newCardinalPoint->getCardinalPointEnum(), CardinalPointEnum::south());

        $cardinalPoint = new CardinalPoint(CardinalPointEnum::west());
        $newCardinalPoint = $cardinalPoint->moveRight();
        $this->assertEquals($newCardinalPoint->getCardinalPointEnum(), CardinalPointEnum::north());
    }

    public function testMoveLeft(): void
    {
        $cardinalPoint = new CardinalPoint(CardinalPointEnum::north());
        $newCardinalPoint = $cardinalPoint->moveLeft();
        $this->assertEquals($newCardinalPoint->getCardinalPointEnum(), CardinalPointEnum::west());

        $cardinalPoint = new CardinalPoint(CardinalPointEnum::south());
        $newCardinalPoint = $cardinalPoint->moveLeft();
        $this->assertEquals($newCardinalPoint->getCardinalPointEnum(), CardinalPointEnum::east());

        $cardinalPoint = new CardinalPoint(CardinalPointEnum::east());
        $newCardinalPoint = $cardinalPoint->moveLeft();
        $this->assertEquals($newCardinalPoint->getCardinalPointEnum(), CardinalPointEnum::north());

        $cardinalPoint = new CardinalPoint(CardinalPointEnum::west());
        $newCardinalPoint = $cardinalPoint->moveLeft();
        $this->assertEquals($newCardinalPoint->getCardinalPointEnum(), CardinalPointEnum::south());
    }
}
