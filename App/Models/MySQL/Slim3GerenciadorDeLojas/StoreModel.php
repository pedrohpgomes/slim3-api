<?php

namespace App\Models\MySQL\Slim3GerenciadorDeLojas;

final class StoreModel {

    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $nome;
    /**
     * @var string
     */
    private $telefone;
    /**
     * @var string
     */
    private $endereco;
    /**
     * @var int
     */
    private $ativo;

    // ====================================
    /**
     *  @return int
     */
    public function getId() : int {
        return $this->id;
    }//function

    // ==========================================
    /**
     *  @return string
     */
    public function getNome() : string {
        return $this->nome;
    }//function

    /**
     *  @param string $nome
     *  @return StoreModel
     */
    public function setNome(string $nome) : StoreModel {
        $this->nome = $nome;
        return $this;
    }//function

    // ==========================================
    /**
     *  @return string
     */
    public function getTelefone() : string {
        return $this->telefone;
    }//function

    /**
     *  @param string $telefone
     *  @return StoreModel
     */
    public function setTelefone(string $telefone) : StoreModel {
        $this->telefone = $telefone;
        return $this;
    }//function

    // ==========================================
    /**
     *  @return string
     */
    public function getEndereco() : string {
        return $this->endereco;
    }//function

    /**
     *  @param string $endereco
     *  @return StoreModel
     */
    public function setEndereco(string $endereco) : StoreModel {
        $this->endereco = $endereco;
        return $this;
    }//function

    // ====================================
    /**
     *  @return int
     */
    public function getAtivo() : int {
        return $this->ativo;
    }//function

    /**
     *  @param int $ativo
     *  @return StoreModel
     */
    public function setAtivo( int $ativo=null) : StoreModel {
        if($ativo == 0 || $ativo == 1){
            $this->ativo = $ativo;
            return $this;
        }
        
    }//function

    public function toArrayWhitoutId(){
        $array = [
            'nome' => $this->getNome(),
            'telefone' => $this->getTelefone(),
            'endereco' => $this->getEndereco()
        ];
        return $array;
    }

    


}//class