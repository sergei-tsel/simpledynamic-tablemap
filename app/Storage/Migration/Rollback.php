<?php

declare(strict_types=1);

namespace App\Storage\Migration;

use Simpledynamic\Integrations\Eloquent\MigrationRepository;
use Simpledynamic\Services\CLI\Command;
use Simpledynamic\Services\CLI\Option;
use Simpledynamic\Services\CLI\OptionType;

/**
 * Команада, откатывающая миграции
 * migrate:rollback {--batch} {--last-count::}
 */
#[Option(
    type: OptionType::FLAG,
    short: '-b',
    long: '--batch',
    description: 'Если не передан, то откатываются только миграции из последней партии.'
)]
#[Option(
    type: OptionType::OPTIONAL,
    short: '-c',
    long: '--last-count',
    description: 'Количество последних накатанных миграций. Если не передан, откатываются все возможные миграции.'
)]
class Rollback extends Command
{
    /** @psalm-suppress InvalidAttribute */

    #[\Override]
    protected static string $description = 'Откатывает миграции.';

    public function handle(MigrationRepository $repository): void
    {
        /** @var bool|null $hasMaxBatch*/
        $hasMaxBatch = $this->getArgument('batch');
        /** @var int|null */
        $lastCount = $this->getArgument('last-count');

        match (true) {
            $hasMaxBatch === null && $lastCount === null => $repository->rollback(),
            $hasMaxBatch === null && $lastCount !== null => $repository->rollback(lastCount: $lastCount),
            $hasMaxBatch !== null && $lastCount === null => $repository->rollback(hasMaxBatch: $hasMaxBatch),
            $hasMaxBatch !== null && $lastCount !== null => $repository->rollback(hasMaxBatch: $hasMaxBatch, lastCount: $lastCount),
        };
    }
}
