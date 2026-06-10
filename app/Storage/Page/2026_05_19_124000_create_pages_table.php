<?php

declare(strict_types=1);

namespace App\Storage\Page;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return new class () extends Migration {
    /**
     * Прокатить миграцию
     */
    public function up(Builder $schema): void
    {
        $schema->create('pages', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('title');

            /**
             * @psalm-suppress UndefinedMagicMethod
             * @psalm-suppress MixedMethodCall
             */
            $table->foreignId('page_id')->nullable()->constrained('pages');
            /** @psalm-suppress UndefinedMagicMethod */
            $table->string('description')->nullable();
            /** @psalm-suppress UndefinedMagicMethod */
            $table->jsonb('layout')->nullable();

            /** @psalm-suppress UndefinedMagicMethod */
            $table->timestamp('early_dated_at')->nullable();
            /** @psalm-suppress UndefinedMagicMethod */
            $table->timestamp('late_dated_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Прокатить миграцию
     */
    public function down(Builder $schema): void
    {
        $schema->dropIfExists('pages');
    }
};
