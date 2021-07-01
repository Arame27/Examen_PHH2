<?php

namespace ism\controllers;
use ism\lib\Role;
use ism\lib\Request;
use ism\lib\Session;
use ism\lib\Response;
use ism\models\AbsenceModel;
use ism\lib\AbstractModel;
use ism\lib\AbstractController;
use ism\lib\PasswordEncoder;

/**
 * Undocumented class
 */
class RessourcesController extends AbstractController{

    private AbsenceModel $model;
    public function __construct()
    {
        parent::__construct();
        $this->model = new AbsenceModel();
    }

    public function ShowAdmin($login){
        //$data = $this->model->selectUserByLogin($login);
        $this->render("user/admin" /*,["user_connect" => $data]*/);
    }

    public function ShowEtu()
    {
        $data = $this->model->getAbsence();
        $this->render("user/etudiant" ,["user" => $data]);
    }

    public function ShowProf()
    {
        //$data = $this->model->selectUserByLogin($login);
        $this->render("user/prof" /*,["user_connect" => $data]*/);
    }

    public function ShowAC()
    {
        //$data = $this->model->selectUserByLogin($login);
        $this->render("user/ac" /*,["user_connect" => $data]*/);
    }

    public function ShowRP()
    {
        //$data = $this->model->selectUserByLogin($login);
        $this->render("user/rp" /*,["user_connect" => $data]*/);
    }

}