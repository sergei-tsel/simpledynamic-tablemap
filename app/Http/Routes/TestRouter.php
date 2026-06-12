<?php

declare(strict_types=1);

namespace App\Http\Routes;

/**
 * Тестовый роутер
 */
class TestRouter
{
    /**
     * Получить роуты
     */
    public static function getRoutes(): array
    {
        return [
            'test' => [
                'welcome' => [
                    'method' => 'GET',
                    'path'   => '/',
                    'action' =>  [
                        \App\Http\Controllers\TestController::class,
                        'welcome',
                    ],
                ],
            ],
        ];
    }
}
