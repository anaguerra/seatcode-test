<?php declare(strict_types=1);
/**
 * The bootstrap file creates and returns the container.
 */

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use SeatCode\Interview\Infrastructure\Service\AppService;

require __DIR__ . '/../../../vendor/autoload.php';

$containerBuilder = new ContainerBuilder;
$containerBuilder->addDefinitions(__DIR__ . '/AppServiceProvider.php');
$container = $containerBuilder->build();

$app = new AppService($container);

if (! function_exists('app')) {
    function app(): ContainerInterface
    {
        return AppService::getContainer();
    }
}

return $container;
