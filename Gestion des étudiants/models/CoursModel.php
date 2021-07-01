<?php

namespace ism\models;

use ism\lib\AbstractModel;

class CoursModel extends AbstractModel
{

    public function __construct()
    {
        parent::__construct();
        $this->tableName = "cours";
        $this->primaryKey = "idCours";
    }
    
    public function allCours(){
        $result = $this->selectAll();
        return $result["count"] == 0 ? [] : $result["data"];
    }

    public function selectCoursById($id){
        $sql="SELECT * FROM cours 
        WHERE idCours=?";
        $result = $this->selectBy($sql, [$id], true);
        return $result["count"] == 0 ? [] : $result["data"];
    }

    public function selectCoursByClasse($class){
        $all=$this->allCours();
        $array=[];
        foreach($all as $a){
            if($a["classeCours"]==$class){
                array_push($array,$a);
            }
        }
        return $array;
    }

    public function selectCoursByModule($module)
    {
        $all = $this->allCours();
        $cour=[];
        foreach ($all as $a) {
            if ($a["moduleCours"] == $module) {
                $cour= $a;
            }
        }
        return $cour;
    }

    public function insertCours(array $data){
        $sql="INSERT INTO cours
        (dateCours,classeCours,professeurCours,moduleCours,semestreCours,nbrHeureCours,heureDebutCours,heureFinCours)
        VALUES
        (?,?,?,?,?,?,?,?)";
        $result = $this->persit($sql, $data);
        return $result["count"] == 0 ? false : true;
    }
    

}

 


?>