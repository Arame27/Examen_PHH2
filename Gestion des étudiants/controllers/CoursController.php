<?php

namespace ism\controllers;
use ism\lib\Session;
use ism\models\CoursModel;
use ism\lib\AbstractController;
use ism\models\EtuModel;
use ism\models\ProfModel;


class CoursController extends AbstractController{

    
    public function __construct()
    {
        parent::__construct();
        $this->model = new CoursModel();
    }

    public function showCoursEtu(){
        $model=new CoursModel();
        $model1=new EtuModel;
        $data = Session::getSession("user_connect");
        $etu=$model1->selectEtuByLogin($data["login"]);
        $cours=$model->selectCoursByClasse($etu["classeEtu"]);
        $this->render("cours/etudiant3",["cours"=>$cours]);
    }

    public function showCoursProf(){
        $model = new CoursModel();
        $model1 = new ProfModel;
        $data = Session::getSession("user_connect");
        $prof = $model1->selectProfByLogin($data["login"]);
        $cours = $model->selectCoursByClasse($prof["classeProf"]);
        $this->render("cours/prof1", ["cours" => $cours]);
    }

    public function showCours(){
        $model = new CoursModel;
        $cours = $model->allCours();
        $this->render("cours/rp1", ["cours" => $cours]);
    }

    public function planifierCours()
    {
        $model1 = new ProfModel;
        $prof=$model1->selectProf();
        $this->render("cours/rp3",["prof"=>$prof]);
    }
}