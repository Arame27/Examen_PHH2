<?php
namespace ism\models;
use ism\lib\AbstractModel;
class EtuModel extends AbstractModel{

    public function __construct() {
        parent::__construct();
        $this->tableName = "etudiant";
        $this->primaryKey = "matriculeEtu";
    }

    public function insertEtu(array $user)
    {
        $sql = "INSERT INTO etudiant 
        (matriculeEtu,login,prenomEtu,dateNaissanceEtu,sexeEtu,classeEtu,
        competenceEtu,parcoursEtu)
        VALUES 
        (?,?,?,?,?,?,?,?)";
        $result = $this->persit($sql, $user);
        return $result["count"] == 0 ? false : true;
    }

    public function selectEtu()
    {
        $result = $this->selectAll();
        return $result["count"] == 0 ? [] : $result["data"];
    }

    public function etuByClasse($class){
        $etu= $this->selectEtu();
        $array=[];
        foreach ($etu as $e) {
            if($e["classeEtu"]==$class){
                array_push($array,$e);
            }
        }
        return $array;
    }

    public function selectEtuByLogin($login)
    {
        $users = $this->selectEtu();
        $array = [];
        foreach ($users as $user) {
            if ($user["login"] == $login) {
                $array = $user;
            }
        }
        return $array;
    }

    public function selectEtuByMat($mat): array
    {
        $users = $this->selectEtu();
        $array = [];
        foreach ($users as $user) {
            if ($user["matriculeEtu"] == $mat){
                $array = $user;
            }
        }
        return $array;
    }
}