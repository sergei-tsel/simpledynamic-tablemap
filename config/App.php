<?php

declare(strict_types=1);

namespace config;

use Simpledynamic\Services\Configuration\Config;

/**
 * Конфигурация приложения
 *
 * @api
 * @psalm-suppress ClassCanBeFinal
 * @psalm-suppress PossiblyUnusedProperty
 */
class App extends Config
{
    /**
     * @var array<string, array<array-key, mixed>|scalar|null>
     * @psalm-suppress InvalidAttribute
     */
    #[\Override]
    protected static array $local     = [
        'locale'          => 'en',
        'commands'        => [],
        'providers'       => [
            \Framework\Providers\AppServiceProvider::class,
        ],
        'twig_extensions' => [],
    ];

    /**
     * @psalm-suppress InvalidAttribute
     */
    #[\Override]
    protected static string $filename = '';
}
