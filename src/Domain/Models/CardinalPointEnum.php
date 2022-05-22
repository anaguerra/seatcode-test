<?php declare(strict_types=1);

namespace SeatCode\Interview\Domain\Models;

use BenSampo\Enum\Enum;

class CardinalPointEnum extends Enum
{
    public const N = 'N';
    public const S = 'S';
    public const E = 'E';
    public const W = 'W';

    public static function north(): self
    {
        return self::fromValue(self::N);
    }

    public static function south(): self
    {
        return self::fromValue(self::S);
    }

    public static function east(): self
    {
        return self::fromValue(self::E);
    }

    public static function west(): self
    {
        return self::fromValue(self::W);
    }
}
