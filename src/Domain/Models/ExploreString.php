<?php declare(strict_types=1);

namespace SeatCode\Interview\Domain\Models;

use SeatCode\Interview\Domain\Exception\ExploreStringException;

class ExploreString
{
    const VALID_LETTERS = ['L','M', 'R'];
    private string $stringLetters;

    public function __construct(string $stringLetters)
    {
        $this->assertValidLetters($stringLetters);
        $this->stringLetters = $stringLetters;
    }

    public function getStringLetters(): string
    {
        return $this->stringLetters;
    }

    private function assertValidLetters(string $stringLetters): void
    {
        $arrLetters = str_split($stringLetters);
        $invalidLetters = array_diff($arrLetters, self::VALID_LETTERS);

        if (count($invalidLetters)) {
            throw ExploreStringException::invalidLetters($invalidLetters);
        }
    }
}
