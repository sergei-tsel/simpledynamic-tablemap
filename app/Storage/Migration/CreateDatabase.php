<?php

declare(strict_types=1);

namespace App\Storage\Migration;

use Illuminate\Database\Capsule\Manager;
use Simpledynamic\Services\CLI\Command;
use Simpledynamic\Services\Configuration\ORM;

/**
 * Команда создающая базу данных, если она не существует
 * migrate:create-db
 */
class CreateDatabase extends Command
{
    /** @psalm-suppress InvalidAttribute */
    #[\Override]
    protected static string $description = 'Содаёт базу данных, если она не существует.';

    public function handle(): void
    {
        /**
         * @psalm-suppress UndefinedMagicMethod
         * @var array<array-key, mixed> $config
         */
        $config = ORM::getConfig();
        $query = "CREATE DATABASE \"{$config['database']}\";";

        $config['database'] = 'postgres';
        $connectionName = 'tmp';
        $manager = new Manager();
        $manager->addConnection(config: $config, name: $connectionName);
        $manager->bootEloquent();

        $manager->getConnection(name: $connectionName)->statement($query);

        $manager->getConnection(name: $connectionName)->disconnect();
    }
}
