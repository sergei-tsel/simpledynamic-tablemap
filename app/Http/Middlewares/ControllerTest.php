<?php


declare(strict_types=1);

namespace App\Http\Middlewares;

/**
 * Тестовый мидлвар для контроллера
 */
class ControllerTest
{
    /**
     * Обработать запрос
     */
    public function handle(): array
    {
        return [
            'controller' => true,
        ];
    }
}
