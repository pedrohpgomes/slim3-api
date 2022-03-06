<?php

namespace App\DAO\MySQL\Slim3GerenciadorDeLojas;

use App\Models\MySQL\Slim3GerenciadorDeLojas\StoreModel;

class StoresDAO extends Connection {

    protected $table = 'lojas';

    // =======================================
    public function __construct()
    {
        parent::__construct();
    }//construct

    // ========================================
    public function getAllStores(): array {
        $query = "SELECT id, nome, telefone, endereco, ativo FROM {$this->table}";
        $stores = $this->pdo->query($query)->fetchAll(\PDO::FETCH_CLASS);
        return $stores;
    }//function

    // ========================================
    public function getStoreById(int $id) {
        $query = "SELECT id, nome, telefone, endereco, ativo FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'id' => $id
        ]);
        $store = $stmt->fetchObject();
        return $store;
    }//function

    // =========================================
    public function insertStore(StoreModel $store): void {

        $stmt = $this->pdo
            ->prepare("INSERT INTO {$this->table} VALUES (null, :nome, :telefone, :endereco, :ativo)");

        $stmt->execute([
            'nome'     => $store->getNome(),
            'telefone' => $store->getTelefone(),
            'endereco' => $store->getEndereco(),
            'ativo'    => $store->getAtivo()
        ]);
    }//function

    // =========================================
    public function updateStoreById(int $id, StoreModel $store) : void {
        $store_array = $store->toArrayWhitoutId();
        $array_update = [];
        $set = '';

        foreach ($store_array as $key => $value){
            if(!empty($value)){
                $array_update[$key] = $value;
            }
        }

        $size_array_update = count($array_update);

        if($size_array_update > 0) {
            $columns = array_keys($array_update);
            
            $last = $size_array_update - 1;
            for($i=0;$i < $size_array_update; $i++){
                if ($i != $last){
                    $set .= " $columns[$i] = :{$columns[$i]},";
                } else {
                    $set .= " $columns[$i] = :{$columns[$i]}";
                }
            }
            $array_update['id'] = $id;
            $query = "UPDATE {$this->table} SET" . $set . " WHERE id = :id";
            //echo $query.'<br>';print_r($array_update);die();
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($array_update);
        }
    }//function

    // =========================================
    public function deleteStoreById(int $id) : void {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $id]);
        
    }//function

}//class