<?php

declare(strict_types=1);

namespace Config;

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
        'commands'        => [
            'migrate:create-db' => \App\Storage\Migration\CreateDatabase::class,
            'migrate:run'       => \App\Storage\Migration\Run::class,
            'migrate:rollback'  => \App\Storage\Migration\Rollback::class,
        ],
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
