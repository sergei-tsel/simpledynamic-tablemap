<?php

declare(strict_types=1);

namespace Config;

use Illuminate\Database\Capsule\Manager;
use Simpledynamic\Services\Configuration\Config;

/**
 * Конфигурация ORM
 *
 * @api
 * @psalm-suppress ClassCanBeFinal
 */
class ORM extends Config
{
    /**
     * @var array<string, array<array-key, mixed>|scalar|null>
     * @psalm-suppress InvalidAttribute
     */
    #[\Override]
    protected static array  $local               = [
        'driver'    => 'pgsql',
        'host'      => 'localhost',
        'database'  => 'tablemap',
        'username'  => 'postgres',
        'password'  => 'postgres',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ];
    /**
     * @psalm-suppress InvalidAttribute
     */
    #[\Override]
    protected static string $filename            = '';

    /**
     * @var string[]
     */
    protected static array $migrationDirectories = [
        __DIR__ . '/../app/Storage/Migration',
        __DIR__ . '/../app/Storage/User',
        __DIR__ . '/../app/Storage/Page',
    ];

    public static function getMigrationDirectories(): array
    {
        return self::$migrationDirectories;
    }

    /**
     * Создать конфигурацию подключения к базе данных для Eloquent
     */
    public static function createEloquent(): Manager
    {
        $eloquent = self::getConfig();

        $manager = new Manager();

        $manager->addConnection($eloquent);

        $manager->bootEloquent();

        return $manager;
    }
}
