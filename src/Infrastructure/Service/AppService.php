<?php declare(strict_types=1);

namespace SeatCode\Interview\Infrastructure\Service;

use DI\Container;

class AppService
{
    public static Container $container;

    public function __construct(Container $container)
    {
        self::$container = $container;
    }

    public static function getContainer(): Container
    {
        return self::$container;
    }
}
