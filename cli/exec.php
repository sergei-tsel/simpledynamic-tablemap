<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Simpledynamic\Services\Configuration\App;
use Simpledynamic\Services\CLI\Command;

if (PHP_SAPI !== 'cli' || !isset($_SERVER['argv']) || count($_SERVER['argv']) < 2) {
    exit(1);
}

/**
 * @psalm-suppress UndefinedMagicMethod
 * @var array<array-key, array<array-key, scalar>|scalar>|scalar|null $commands
 */
$commands = App::getConfigPart('commands') ?? [];

if (!is_array($commands)) {
    exit(1);
}

if ($_SERVER['argv'][1] === 'list') {
    foreach ($commands as $name => $command) {
        if (is_string($command)) {
            echo $name . ' - ' . $command . PHP_EOL;
        }

        if (is_array($command)) {
            /** @var class-string[] $command */
            foreach ($command as $key => $value) {
                if ($key === 0) {
                    echo $name . ' - ' . $value . PHP_EOL;
                } else {
                    echo '     - ' . $value . PHP_EOL;
                }
            }
        }
    }

    exit(0);
}

if (!isset($commands[$_SERVER['argv'][1]])) {
    exit(1);
}

/**
 * @var array<array-key, array<array-key, class-string<Command>>|class-string<Command>> $commands
 */
$commandName = $commands[$_SERVER['argv'][1]];

if (is_array($commandName)) {
    foreach ($commandName as $name) {
        if (class_exists($name) && is_subclass_of($name, Command::class)) {
            $name::run();
        }
    }
} elseif (class_exists($commandName) && is_subclass_of($commandName, Command::class)) {
    $commandName::run();
}

exit(0);
