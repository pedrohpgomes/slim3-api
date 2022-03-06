<?php
// conexao mysql

namespace App\DAO\MySQL\Slim3GerenciadorDeLojas;

abstract class Connection {

    /**
     * @var \PDO
     */
    protected $pdo;
    
    public function __construct()
    {
        $host     = getenv('SLIM3_GERENCIADOR_DE_LOJAS_MYSQL_HOST');
        $port     = getenv('SLIM3_GERENCIADOR_DE_LOJAS_MYSQL_PORT');
        $user     = getenv('SLIM3_GERENCIADOR_DE_LOJAS_MYSQL_USER');
        $password = getenv('SLIM3_GERENCIADOR_DE_LOJAS_MYSQL_PASSWORD');
        $dbname   = getenv('SLIM3_GERENCIADOR_DE_LOJAS_MYSQL_DBNAME');
        $dsn = "mysql:host={$host};dbname={$dbname};port={$port};charset=utf8mb4";
        $this->pdo = new \PDO($dsn,$user,$password);
        $this->pdo->setAttribute(
            \PDO::ATTR_ERRMODE,
            \PDO::ERRMODE_EXCEPTION
        );
        
    }//construct

}//class