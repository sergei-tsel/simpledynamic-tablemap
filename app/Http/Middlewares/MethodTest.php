<?php


declare(strict_types=1);

namespace App\Http\Middlewares;

/**
 * Тестовый мидлвар для метода контроллера
 */
class MethodTest
{
    /**
     * Обработать запрос
     */
    public function handle(): array
    {
        return [
            'method' => true,
        ];
    }
}
