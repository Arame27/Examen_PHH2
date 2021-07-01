<?php
namespace ism\models;
use ism\lib\AbstractModel;
class ProfModel extends AbstractModel{

    public function __construct() {
        parent::__construct();
        $this->tableName = "professeur";
        $this->primaryKey = "matriculeProf";
    }

    public function selectProf(){
        $result = $this->selectAll();
        return $result["count"] == 0 ? [] : $result["data"];
    }

    public function insertProf(array $user)
    {
        extract($user);
        $sql = "INSERT INTO professeur
        (matriculeProf,login,prenomProf,dateNaissanceProf,sexeProf,gradeProf,classeProf,
        moduleProf)
        VALUES 
        (?,?,?,?,?,?,?,?)";
        $result = $this->persit($sql, $user);
        return $result["count"] == 0 ? false : true;
    }

    public function selectProfByLogin($login){
        $users=$this->selectProf();
        $array=[];
        foreach ($users as $user) {
            if($user["login"]==$login){
                $array=$user;
            }
        }
        return $array;
    }

    

}