<?php
namespace ism\lib;
class DataBase {
    private $pdo;
   public function __construct(){
        /* Connexion à une base MySQL avec l'invocation de pilote */
        $dsn = 'mysql:dbname=bd_ism_2021;host=localhost';
        $user = 'root';
        $password = '';
    
        try {
            $this->pdo = new \PDO($dsn, $user, $password);
            //activation des erreurs de PDO 
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_ASSOC);
         
        } catch (\Exception $ex) {
            die("erreur de connection");
        }
    
    }
    public function closeConnection(){
        $this->pdo = null;
    }
    
    public function executeSelect(string $sql,array $data=[],bool $single=false):array{
        $stm=$this->pdo->prepare($sql);
        $stm->execute($data);
        if($single){
            $result=$stm->fetch();
        }else{
            $result=$stm->fetchAll();
        }
        $this->closeConnection();
        return [
            "data"=>$result,
            "count" => $stm->rowCount()
        ];
    }
    
    function executeUpdate(string $sql, array $data):int{
        //dd($this->pdo);
        $stm=$this->pdo->prepare($sql);
        //dd($stm);
        $stm->execute($data);
        
        $count=stripos($sql,'insert')==false?$stm->rowCount():$this->pdo->lastInsertId();
        $this->closeConnection();
        return $count;
    }
}



?>