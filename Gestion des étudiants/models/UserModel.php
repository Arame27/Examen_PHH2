<?php
namespace ism\models;
use ism\lib\AbstractModel;
class UserModel extends AbstractModel{

    public function __construct() {
        parent::__construct();
        $this->tableName = "utilisateur";
        $this->primaryKey = "id";
    }

    public function selectUserByLogin(string $login):array{
        $sql= "SELECT * FROM utilisateur 
        WHERE login=?";
        $result=$this->selectBy($sql,[$login],true);
        return $result["count"]==0?[]:$result["data"];
    }
    
    public function loginExiste(string $login):bool{
        $sql= "SELECT * FROM utilisateur WHERE login=:login";
        $result=$this->selectBy($sql,[':login'=>$login],true);
        return $result["count"]==0?false:true;
    }

    public function insert(array $user):bool{
        $sql= "INSERT INTO utilisateur
        (login,password,nom,role,avatar)
        VALUES 
        (?,?,?,?,?)";
        $result=$this->persit($sql,$user);
        return $result["count"]==0?false:true;
    }

    public function delete($id){
        $this->remove($id);
    }


    
    

}
