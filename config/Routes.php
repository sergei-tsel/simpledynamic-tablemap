<?php

declare(strict_types=1);

namespace Config;

use Simpledynamic\Base\Controller\Route;
use Simpledynamic\Services\Arrays\NotationManager;
use Simpledynamic\Services\Configuration\Config;
use Uri\Rfc3986\Uri;

/**
 * Конфигурация роутов
 *
 * @api
 * @psalm-suppress ClassCanBeFinal
 */
class Routes extends Config
{
    /**
     * @var array<string, array<array-key, mixed>|scalar|null>
     * @psalm-suppress InvalidAttribute
     */
    #[\Override]
    protected static array  $local    = [
        'base' => 'http://localhost:8000',
    ];

    /**
     * @psalm-suppress InvalidAttribute
     */
    #[\Override]
    protected static string $filename = '';

    /**
     * @var string[]
     */
    protected static array $routers   = [
        \App\Http\Routes\TestRouter::class,
    ];

    protected static ?Uri $uri = null;

    /**
     * Получить роуты
     *
     * @return Route[]
     */
    public static function get(): array
    {
        $routes = [];

        if (self::$routers !== []) {
            foreach (self::$routers as $router) {
                if (class_exists($router) && method_exists($router, 'getRoutes')) {
                    /**
                     * @psalm-suppress MixedArgument
                     * @psalm-suppress MixedMethodCall
                     */
                    $routes = array_merge(
                        $routes,
                        $router::getRoutes(),
                    );
                }
            }
        }

        return Route::instanceMany(
            NotationManager::instanceOne('.')->fromMdsArray($routes)
        );
    }
}
