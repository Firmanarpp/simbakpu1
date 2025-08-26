<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will require this file so that any requests are gracefully redirected
| to this page. Of course, this is not required while in development.
|
*/

if (file_exists($maintenance = __DIR__.'/../simbakpu_project/storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, auto-loading mechanism for applications,
| which demonstrates a more “PHP-centric” approach to tooling. Here, we
| just load Composer's auto-loader to get a head start on the loading.
|
*/

require __DIR__.'/../simbakpu_project/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| We will load the application from this file and then execute the request
| through the kernel. The kernel will send the response back to the client
| and we'll then begin cleaning up more quickly in the background.
|
*/

$app = require_once __DIR__.'/../simbakpu_project/bootstrap/app.php';

$app->make(Kernel::class)->handle(
    Request::capture()
)->send();
