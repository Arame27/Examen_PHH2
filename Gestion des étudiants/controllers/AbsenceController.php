<?php

namespace ism\controllers;
use ism\lib\Session;
use ism\models\AbsenceModel;
use ism\models\CoursModel;
use ism\models\EtuModel;
use ism\lib\AbstractController;


class AbsenceController extends AbstractController{

    private AbsenceModel $model;
    public function __construct()
    {
        parent::__construct();
        $this->model = new AbsenceModel();
    }

    public function showAbsence(){
        $model = new AbsenceModel();
        $model2= new EtuModel();
        $data = Session::getSession("user_connect");
        $etuMat= $model2->selectEtuByLogin($data["login"]);
        $absence=$model->getAbsenceByMatricule($etuMat["matriculeEtu"]);
        $this->render("absence/etudiant2", ["users" => $absence]);
    }

    public function showAllAbsence()
    {
        $model = new AbsenceModel();
        $all=[];
        $final=[];
        $absences=$model->getAbsence();
        foreach ($absences as $abs) {
            $model2 = new EtuModel();
            $etu=$model2->selectEtuByMat($abs["etudiantMatricule"]);
            $x=array_merge($etu,$abs);
            array_push($all,$x);
        }
        foreach ($all as $a) {
            $model1=new CoursModel();
            $cours=$model1->selectCoursById($a["coursId"]);
            $y= array_merge($cours,$a);
            array_push($final,$y);
        }
        $this->render("absence/ac2", ["absences" => $final]);
    }


}