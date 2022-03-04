<?php
// phpcs:ignore error

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once 'vendor/autoload.php';

$app = new \Slim\App();

// Dessa forma, usa-se o GET tradicional e as variávels ficam:
// BaseURL/produtos?limit=10
$app->get(
    '/produtos', function (Request $request, Response $response, array $args) {
        $limit = $request->getQueryParams()['limit'] ?? 0;
        // Pode pegar com o GET do PHP
        // $limit = $_GET['limit'];
        return $response->getBody()->write("limite: {$limit} - Produtos do banco de dados");
    }
);

// Outra forma, mais parecida com uma API é: BaseURL/produto/teclado?limit=22
// Parâmetro opcional:    /produto[/{nome}]
// Parâmetro obrigatório: /produto/{nome}
$app->get(
    '/produto[/{nome}]', function (Request $request, Response $response, array $args) {
        $limit = $request->getQueryParams()['limit'] ?? 100;
        $nome  = $args['nome'] ?? '\'qualquer\''; 
        return $response->getBody()->write("limite: {$limit} - Produto do banco de dados com o nome {$nome}");
    }
);

$app->run();
