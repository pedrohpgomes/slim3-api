<?php

use function src\slimConfiguration;
use function src\basicAuth;
use App\Controllers\ProductController;
use App\Controllers\StoreController;
use Tuupola\Middleware\HttpBasicAuthentication;




require_once 'vendor/autoload.php';

$app = new \Slim\App(slimConfiguration());

// ===================== ROUTES ====================================

$app->group('', function() use ($app) {
    $app->get('/lojas',     StoreController::class . ':getStores');
    $app->get('/loja/{id}', StoreController::class . ':getStore');
    $app->post('/loja',     StoreController::class . ':insertStore');
    $app->put('/loja',      StoreController::class . ':updateStore');
    $app->delete('/loja',   StoreController::class . ':deleteStore');

    $app->get('/produtos', ProductController::class . ':getProducts');
    $app->get('/produto/{id}',         ProductController::class . ':getProduct');
    $app->post('/produto',             ProductController::class . ':insertProduct');
    $app->put('/produto',         ProductController::class . ':updateProduct');
    $app->delete('/produto',      ProductController::class . ':deleteProduct');
})->add(basicAuth());
// ==================================================================

$app->run();