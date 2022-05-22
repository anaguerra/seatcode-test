<?php declare(strict_types=1);

namespace SeatCode\Interview\Tests\Domain\Models;

use PHPUnit\Framework\TestCase;
use SeatCode\Interview\Domain\Exception\ExploreStringException;
use SeatCode\Interview\Domain\Models\ExploreString;

class ExploreStringTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testInvalidLetters(): void
    {
        $this->expectException(ExploreStringException::class);
        $this->expectExceptionMessage('Explore contains invalid letter/s: A,O');
        $strLetters = new ExploreString('LMMRAOM');
    }
}
