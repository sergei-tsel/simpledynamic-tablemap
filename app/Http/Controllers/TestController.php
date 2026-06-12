<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Middlewares\ControllerTest;
use App\Http\Middlewares\MethodTest;
use App\Storage\User\UserRepository;
use Simpledynamic\Base\Controller\Controller;
use Simpledynamic\Base\Controller\Middleware;
use Simpledynamic\Integrations\Twig\TwigView;

/**
 * Тестовый контроллер
 */
#[Middleware(ControllerTest::class)]
class TestController extends Controller
{
    public function __construct(
        private readonly UserRepository $repository,
    ) {
    }

    /**
     * Поприветствовать
     */
    #[Middleware(name: MethodTest::class)]
    public function welcome(array $request): void
    {
        if ($request['controller'] !== true || $request['method'] !== true) {
            return;
        }

        echo new TwigView('welcome.php.twig')->render();
    }
}
