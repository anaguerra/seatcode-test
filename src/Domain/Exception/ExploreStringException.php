<?php declare(strict_types=1);

namespace SeatCode\Interview\Domain\Exception;

class ExploreStringException extends \Exception implements DomainException
{
    public static function invalidLetters(array $invalidLetters): self
    {
        return new self(sprintf('Explore contains invalid letter/s: %s', implode(',', $invalidLetters)));
    }
}
