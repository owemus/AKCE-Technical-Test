<?php

require_once __DIR__.'/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__ . '/../../../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

$app->withFacades();

$app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    Interfaces\Console\Kernel::class
);

// Repositories 

$app->bind(
    AKCE\Clients\Contracts\IClientAccountRepository::class,
    AKCE\Clients\Repositories\ClientAccountRepository::class
);

$app->bind(
    AKCE\Clients\Contracts\IClientAddressRepository::class,
    AKCE\Clients\Repositories\ClientAddressRepository::class
);

$app->bind(
    AKCE\Clients\Contracts\IClientRepository::class,
    AKCE\Clients\Repositories\ClientRepository::class
);

$app->bind(
    AKCE\Transactions\Contracts\ITransactionRepository::class,
    AKCE\Transactions\Repositories\TransactionRepository::class
);

//Services

$app->bind(
    AKCE\Clients\Contracts\IClientAccountService::class,
    AKCE\Clients\Services\ClientAccountService::class
);

$app->bind(
    AKCE\Clients\Contracts\IClientAddressService::class,
    AKCE\Clients\Services\ClientAddressService::class
);

$app->bind(
    AKCE\Clients\Contracts\IClientService::class,
    AKCE\Clients\Services\ClientService::class
);

$app->bind(
    AKCE\Transactions\Contracts\ITransactionService::class,
    AKCE\Transactions\Services\TransactionService::class
);

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

// $app->middleware([
//     Interfaces\Http\Middleware\ExampleMiddleware::class
// ]);

// $app->routeMiddleware([
//     'auth' => Interfaces\Http\Middleware\Authenticate::class,
// ]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

$app->register(App\Providers\AppServiceProvider::class);
// $app->register(App\Providers\AuthServiceProvider::class);
// $app->register(App\Providers\EventServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->storagePath(__DIR__.'/../storage');

$app->router->group([
    'namespace' => 'Interfaces\Http\Controllers',
], function ($router) {
    require __DIR__.'/../../../Interfaces/Http/routes/web.php';
});

return $app;
