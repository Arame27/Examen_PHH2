<?php
namespace ism\models;
use ism\lib\AbstractModel;
use ism\models\CoursModel;
class AbsenceModel extends AbstractModel{

    public function __construct() {
        parent::__construct();
        $this->tableName = "absence";
        $this->primaryKey = "idAbsence";
    }

    public function getAbsenceByMatricule($matricule):array{
        $all=$this->getAbsence();
        $array=[];
        foreach ($all as $a) {
            $cour = new CoursModel;
            $c= $cour->selectCoursById($a["coursId"]);
            $b=array_merge($a, $c);
            if($a["etudiantMatricule"]==$matricule){
                array_push($array,$b);
            }
        }
        return $array;
    }

    public function insertAbsence($absence):bool{
        extract($absence);
        $sql = "INSERT INTO absence 
        (dateAbsence,etudiantMatricule,coursId)
        VALUES 
        (?,?,?)";
        $result = $this->persit($sql, $absence);
        return $result["count"] == 0 ? false : true;
    }

    public function getAbsence(): array
    {
        $result = $this->selectAll();
        return $result["count"] == 0 ? [] : $result["data"];
    }
    
}