<?php
// aulas 01 a 05
// https://www.youtube.com/watch?v=vVkOUXpuuJg&list=PLZ8kYL6LBgg62kzIa6Io42Ccz_rWJBS-l&index=2&ab_channel=CodeEasy

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once 'vendor/autoload.php';

/*** Exibe detalhes caso ocorra algum erro ***/
$configuration = [
    'settings' => ['displayErrorDetails' => true],
];
$configuration = new \Slim\Container($configuration);

$app = new \Slim\App($configuration);

// Dessa forma, usa-se o GET tradicional e as variávels ficam:
// BaseURL/produtos?limit=10
$app->get(
    '/produtos', function (Request $request, Response $response, array $args) : Response {
        $limit = $request->getQueryParams()['limit'] ?? 100;
        // Pode pegar com o GET do PHP
        // $limit = $_GET['limit'];
        $response->getBody()->write("limite: {$limit} - Produtos do banco de dados");
        return $response;
    }
);

// Outra forma, mais parecida com uma API é: BaseURL/produto/teclado?limit=22
// Parâmetro opcional:    /produto[/{nome}]
// Parâmetro obrigatório: /produto/{nome}
$app->get(
    '/produto[/{nome}]', function (Request $request, Response $response, array $args) : Response {
        $limit = $request->getQueryParams()['limit'] ?? 15;
        $nome  = $args['nome'] ?? '\'qualquer\''; 
        $response->getBody()->write("limite: {$limit} - Produto do banco de dados com o nome {$nome}");
        return $response;
    }
);

$app->post(
    '/produto', function (Request $request, Response $response, array $args) : Response {
        $data = $request->getParsedBody();
        //echo '<pre>';print_r($data);die();
        $nome = $data['nome'] ?? '';
        $response->getBody()->write("Produto com nome {$nome} - POST");
        return $response;
    }
);

$app->put(
    '/produto', function (Request $request, Response $response, array $args) : Response {
        $data = $request->getParsedBody();
        //echo '<pre>';print_r($data);die();
        $nome = $data['nome'] ?? '';
        $response->getBody()->write("Produto com nome {$nome} - PUT");
        return $response;
    }
);

$app->delete(
    '/produto', function (Request $request, Response $response, array $args) : Response {
        $data = $request->getParsedBody();
        //echo '<pre>';print_r($data);die();
        $nome = $data['nome'] ?? '';
        $response->getBody()->write("Produto com nome {$nome} - DELETE");
        return $response;
    }
);

// Middlewares
// Interceptam as informações que vão do usuário para a aplicação e vice-versa
$mid01 = function(Request $request, Response $response, $next) : Response {
    $response->getBody()->write("\nDentro do middleware 01\n");
    $response = $next($request, $response);
    $response->getBody()->write("\nDentro do middleware 02\n");
    return $response;
};

$app->get(
    '/mid[/{nome}]', function (Request $request, Response $response, array $args) : Response {
        $limit = $request->getQueryParams()['limit'] ?? 15;
        $nome  = $args['nome'] ?? '\'qualquer\''; 
        $response->getBody()->write("limite: {$limit} - Middleware nome {$nome}");
        return $response;
    }
)->add($mid01);


//Agrupar rotas
/* $app->group('/clientes', function() use($app) {
    $app->get('/pessoas',);
    $app->get('/empresas', );
})->add($mid01);
 */
$app->run();
