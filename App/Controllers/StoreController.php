<?php

// Controller

namespace App\Controllers;

use App\DAO\MySQL\Slim3GerenciadorDeLojas\StoreDAO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\DAO\MySQL\Slim3GerenciadorDeLojas\StoresDAO;
use App\Models\MySQL\Slim3GerenciadorDeLojas\StoreModel;

final class StoreController {

    // ================================
    public function getStores(Request $request, Response $response, array $args) : Response {
        $storesDAO = new StoresDAO();
        $stores = $storesDAO->getAllStores();
        // $response = $response->withJson($stores);
        $response->getBody()->write(json_encode($stores));

        return $response;
    }//function

    // ================================
    public function getStore(Request $request, Response $response, array $args) : Response {
        
        $store_id = $args['id'];
        $storesDAO = new StoresDAO();
        $store = $storesDAO->getStoreById($store_id) == true ? $storesDAO->getStoreById($store_id) : ['message' => 'Loja não encontrada'];

        $response->getBody()->write(json_encode(
            $store
        ));
        
        return $response;
    }//function

    // ================================
    public function insertStore(Request $request, Response $response, array $args) : Response {
        $data = $request->getParsedBody();

        $store = new StoreModel();
        $store->setNome($data['nome'])
              ->setTelefone($data['telefone'])
              ->setEndereco($data['endereco'])
              ->setAtivo( isset($data['ativo']) ?? 1 );

        $storesDAO = new StoresDAO();
        $storesDAO->insertStore($store);

        $response->getBody()->write(json_encode(
            [
                'message' => 'Loja inserida com sucesso!'
            ]
        ));        
        return $response;

    }//function

    // ================================
    public function updateStore(Request $request, Response $response, array $args) : Response {
        
        $data = $request->getParsedBody();
        $store = new StoreModel();
        $store_id = $data['id'];
        $store->setNome($data['nome'] ?? '')
              ->setTelefone($data['telefone'] ?? '')
              ->setEndereco($data['endereco'] ?? '')
              ->setAtivo($data['ativo'] ?? null);
        $storesDAO = new StoresDAO();

        $storesDAO->updateStoreById($store_id,$store);

        $response->getBody()->write(json_encode(
            [
                'message' => 'Loja atualizada com sucesso!'
            ]
        ));        
        
        return $response;
    }//function

    // ================================
    public function deleteStore(Request $request, Response $response, array $args) : Response {
        $data = $request->getParsedBody();
        $store_id = $data['id'];
        $storesDAO = new StoresDAO();
        $storesDAO->deleteStoreById($store_id);

        $response->getBody()->write(json_encode([
            "message" => "Loja excluída com sucesso"
        ]));
        
        return $response;
    }//function


}//class