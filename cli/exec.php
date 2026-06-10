<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Simpledynamic\Services\Configuration\App;
use Simpledynamic\Services\CLI\Command;
use Simpledynamic\Services\CLI\CommandLineManager;

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

$name = $_SERVER['argv'][1];

/**
 * @var array<array-key, class-string<Command>> $commands
 */
if ($name === 'list') {
    new CommandLineManager()->echoList(commands: $commands);

    exit(0);
}

if (!isset($commands[$name])) {
    exit(1);
}

if (isset($_SERVER['argv'][2]) && ($_SERVER['argv'][2] === '--help' || $_SERVER['argv'][2] === '-h')) {
    new CommandLineManager()->echoHelp(name: $name, command: $commands[$name]);

    exit(0);
}

$command = $commands[$name];

if (class_exists($command) && is_subclass_of($command, Command::class)) {
    try {
        $command::run();
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

exit(0);
