<?php

declare(strict_types=1);

namespace Framework\Providers;

use config\App as AppConfig;
use config\Auth as AuthConfig;
use config\Cookies as CookiesConfig;
use config\Env as EnvConfig;
use config\Headers as HeadersConfig;
use config\ODM as ODMConfig;
use config\ORM as ORMConfig;
use config\Routes as RoutesConfig;
use config\Session as SessionConfig;
use Doctrine\ODM\MongoDB\DocumentManager;
use Illuminate\Database\DatabaseManager;
use Simpledynamic\Providers\ServiceProvider;
use Simpledynamic\Services\Configuration\App as AppFacade;
use Simpledynamic\Services\Configuration\Auth as AuthFacade;
use Simpledynamic\Services\Configuration\Cookies as CookiesFacade;
use Simpledynamic\Services\Configuration\Env as EnvFacade;
use Simpledynamic\Services\Configuration\Headers as HeadersFacade;
use Simpledynamic\Services\Configuration\ODM as ODMFacade;
use Simpledynamic\Services\Configuration\ORM as ORMFacade;
use Simpledynamic\Services\Configuration\Routes as RoutesFacade;
use Simpledynamic\Services\Configuration\Session as SessionFacade;

/**
 * Сервис-провайдер приложения
 *
 * @api
 * @psalm-suppress ClassCanBeFinal
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Зарегистрировать биндинги
     */
    #[\Override]
    public function register(): void
    {
        $this->app->singleton(AppFacade::class, AppConfig::class);
        $this->app->singleton(AuthFacade::class, AuthConfig::class);
        $this->app->singleton(CookiesFacade::class, CookiesConfig::class);
        $this->app->singleton(EnvFacade::class, EnvConfig::class);
        $this->app->singleton(HeadersFacade::class, HeadersConfig::class);
        $this->app->singleton(ODMFacade::class, ODMConfig::class);
        $this->app->singleton(ORMFacade::class, ORMConfig::class);
        $this->app->singleton(RoutesFacade::class, RoutesConfig::class);
        $this->app->singleton(SessionFacade::class, SessionConfig::class);

        $this->app->singleton(DatabaseManager::class, fn (): DatabaseManager => ORMConfig::createEloquent()->getDatabaseManager());
        $this->app->singleton(DocumentManager::class, fn (): DocumentManager => ODMConfig::createDoctrineMongoDB());
    }

    /**
     * Выполнить действия после регистрации биндингов
     */
    #[\Override]
    public function boot(): void
    {
    }
}
