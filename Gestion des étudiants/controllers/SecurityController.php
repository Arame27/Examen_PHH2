<?php

namespace ism\controllers;
use ism\lib\Role;
use ism\lib\Request;
use ism\lib\Session;
use ism\lib\Response;
use ism\models\UserModel;
use ism\models\EtuModel;
use ism\models\ProfModel;
use ism\lib\AbstractController;
use ism\lib\PasswordEncoder;
use ism\models\AbsenceModel;
use ism\models\CoursModel;

/**
 * Undocumented class
 */
class SecurityController extends AbstractController{

    public function login(Request $request){
        if($request->isPost()){
            //dd($this->validator->getErrors());
            $data= $request->getBody();
            if(!$this->validator->estVide($data["login"], "login")){
                $this->validator->estMail($data["login"], "login");
            }
            $this->validator->estVide($data["password"], "password");
            if($this->validator->formValide()){
                // login et mot de passe correct
                $model= new UserModel;
                $user = $model->selectUserByLogin($data["login"]);
                
                if(empty($user)){
                    $this->validator->setErrors("error_login","login ou mot de passe incorrect");
                    Session::setSession("array_error",$this->validator->getErrors());
                    Response::redirectUrl("security/login");
                }else{
                    // login et password correct et existe
                    // set_session("user_connect",$user);
                    Session::setSession("user_connect",$user);
                    if(PasswordEncoder::decode($data["password"], $user["password"])){
                        
                        /*if(Session::keyExist("action") && Session::getSession("action")== "reservation"){
                            Response::redirectUrl("reservation/addReservation");
                        }*/
                        
                        if($user["role"]=="ROLE_ADMIN"){
                            Response::redirectUrl("ressources/ShowAdmin");
                        }
                        elseif($user["role"]=="ROLE_ETU"){
                            Response::redirectUrl("ressources/ShowEtu");
                        } 
                        elseif ($user["role"] == "ROLE_PROF") {
                            Response::redirectUrl("ressources/ShowProf");
                        } 
                        elseif ($user["role"] == "ROLE_AC") {
                            Response::redirectUrl("ressources/ShowAC");
                        }
                        elseif ($user["role"] == "ROLE_RP"){
                            Response::redirectUrl("ressources/ShowRP");
                       }
                    }else{
                        $this->validator->setErrors("error_login","login ou mot de passe incorrect");
                        Session::setSession("array_error",$this->validator->getErrors());
                        Response::redirectUrl("security/login");
                    }
                }
            }else {
                //Erreur de validation donc redirection vers page de connexion
                //dd($this->validator->getErrors());
                Session::SetSession("array_error",$this->validator->getErrors());
                Response::redirectUrl("security/login");
            }
        }
        $this->render("security/login");
    }

    public function register(Request $request){
        if($request->isPost()){
            $model= new UserModel();
            $model2= new ProfModel();
            $model3= new EtuModel();
            $competences="";
            $modules = "";
            $classes = "";
            $data=$request->getBody();
            
            if (!$this->validator->estVide($data["login"], "login")) {
                if ($this->validator->estMail($data["login"], "login")) {
                    if ($model->loginExiste($data["login"])) {
                        $this->validator->setErrors("login", "ce login existe deja dans le systeme");
                    }
                }
            }
            $this->validator->estVide($data["password"], "password");
            if (isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] == 0) {
                //Extensions Valides
                $allowed = [
                    "jpg" => "image/jpg",
                    "jpeg" => "image/jpeg",
                    "gif" => "image/gif",
                    "png" => "image/png"
                ];
                $filename =$_FILES["avatar"]["name"];
                $filetype = $_FILES["avatar"]["type"];
                $filesize = $_FILES["avatar"]["size"];
                // recupere l'extension du fichier
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if (!array_key_exists($ext, $allowed)) $this->validator->setErrors("avatar", "Veuillez sélectionner un format de fichier valide.");
                // Vérifie la taille du fichier - 5Mo maximum
                $maxsize = 5 * 1024 * 1024;
                if ($filesize > $maxsize) $this->validator->setErrors("avatar", "La taille du fichier est supérieure à la limite autorisée.");

                // Vérifie le type MIME du fichier
                if (in_array($filetype, $allowed)) {
                    // Vérifie si le fichier existe avant de le télécharger.
                    if (file_exists("../upload_files/" . $filename)) {
                        $this->validator->setErrors("avatar", "$filename existe déja");
                    } else {
                        //$filename=$data["login"];
                        move_uploaded_file($_FILES["avatar"]["tmp_name"], "../upload_files/".$filename);
                        $data["avatar"] = $filename;
                    }
                } else {
                    $this->validator->setErrors("avatar", " Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.");
                }
            } else {
                $this->validator->setErrors("avatar", "fichier non uploadé");
            }

            //verifier prof ou etu
            if($data["role"]=="ROLE_PROF"){
                for ($i = 1; $i <= 3; $i++) {
                    if (isset($data[$i])) $classes .= $data[$i] . ",";
                }
            } else if ($data["role"] == "ROLE_PROF"){
                $classes.=$data["classe"];
            }
            if($data["role"]=="ROLE_PROF"|| $data["role"] == "ROLE_ETU"){
                for ($i =4 ; $i <= 10; $i++) {
                    if (isset($data[$i])) $competences .= $data[$i] . ",";
                }
                for ($i = 11; $i <= 13; $i++) {
                    if (isset($data[$i])) $modules .= $data[$i] . ",";
                }
                $classes=rtrim($classes,",");
                $modules = rtrim($modules, ",");
                $competences = rtrim($competences, ",");
                $this->validator->estVide($data["dateNaiss"], "dateNaiss");
                $this->validator->estVide($data["prenom"], "prenom");
                if($data["role"] == "ROLE_ETU")$this->validator->estVide($data["parcours"], "parcours");
            }
            
            
            

            if ($this->validator->formValide()) {
                $data["password"] = PasswordEncoder::encode($data["password"]);
                $utilisateur=[$data["login"],$data["password"],$data["prenom"],$data["role"],$data["avatar"]];
                $x=$model->insert($utilisateur);
                if ($data["role"] == "ROLE_PROF"){
                    $prof=[$data["matricule"], $data["login"], $data["prenom"], $data["dateNaiss"], $data["sexe"], $data["grade"], $classes, $modules];
                    $y=$model2->insertProf($prof);
                    Response::redirectUrl("ressources/showRP");
                }else if($data["role"] == "ROLE_ETU"){
                    $etu= [$data["matricule"], $data["login"], $data["prenom"], $data["dateNaiss"], $data["sexe"], $classes, $competences,$data["parcours"]];
                    $y=$model3->insertEtu($etu);
                    Response::redirectUrl("ressources/showAC");
                }else if($data["role"] == "ROLE_AC" || $data["role"] == "ROLE_RP"){
                    Response::redirectUrl("ressources/showAdmin");
                }
            } else {
                Session::SetSession("array_error", $this->validator->getErrors());
                Session::SetSession("array_post", $data);
                Response::redirectUrl("security/register");
            }
        }
        $this->render("security/register");
    }

    public function logout(){
        Session::destroySession();
        Response::redirectUrl("security/login");
    }

    public function showUser(){
        //if(!Role::estAdmin())Response::redirectUrl("security/login");
        $model=new UserModel();
        $data=$model->selectAll();
        $this->render("security/show.user",["users"=> $data]);
    }

    //showEtu
    public function showEtu(){
        $model=new EtuModel();
        $data=[];
        $model2 = new ProfModel();
        $Etu=$model->selectEtu();
        $use=Session::getSession("user_connect");
        $prof=$model2->selectProfByLogin($use["login"]);
        foreach ($Etu as $etu) {
            if($etu["classeEtu"]==$prof["classeProf"]){
                array_push($data,$etu);
            }
        }
        $this->render("user/prof2", ["users" => $data]);
    }

    public function showAllEtu()
    {
        $model = new EtuModel();
        $data = $model->selectEtu();
        $this->render("user/rp2", ["users" => $data]);
    }

    public function Update(Request $request){
        if ($request->isPost()) {
            $model = new UserModel();
            $data = $request->getBody();
            if($data["btn"]== "modifier"){
                unset($data["btn"]);
                $this->validator->estVide($data["nom"], "nom");
                if (!$this->validator->estVide($data["login"], "login")) {
                    if (!$this->validator->estMail($data["login"], "login")) {
                        $this->validator->setErrors("login", "saisir un login correct");
                    }
                }
                if ($this->validator->formValide()) {
                    $model->update($data);
                    Response::redirectUrl("security/showUser");
                } else {

                    Session::SetSession("array_error", $this->validator->getErrors());
                    Session::SetSession("array_post", $data);
                    Response::redirectUrl("security/showUser");
                }
            }else if($data["btn"]=="supprimer"){
                unset($data["btn"]);
                $model->delete($data["id"]);
                Response::redirectUrl("security/showUser");
            }
            
        }
        $this->render("security/show.user", ["users" => $data]);
    }

    public function marquerAbsent(Request $request){
        $model=new AbsenceModel();
        $model2=new CoursModel();
        if($request->isPost()){
            $data = $request->getBody();
            $this->validator->estVide($data["matricule"], "matricule");
            if(!$this->validator->estVide($data["module"], "module")) $module=$model2->selectCoursByModule($data["module"]);
            $this->validator->estVide($data["date"], "date");
            
            if ($this->validator->formValide()) {
                $donnee=[$data["date"], $data["matricule"], $module["idCours"]];
                $model->insertAbsence($donnee);
                Response::redirectUrl("security/showEtu");
            } else {
                $this->validator->setErrors("absent", "absence non marqué");
                Session::SetSession("array_error", $this->validator->getErrors());
                Session::SetSession("array_post", $data);
                Response::redirectUrl("security/showEtu");
            }
        }
        $this->render("user/prof2");
    }

    public function planifierCours(Request $request){
        $model=new CoursModel();
        if ($request->isPost()) {
            $data = $request->getBody();
            extract ($data);
            $array=["$date","$classe","$professeur","$module","$semestre","$nbreHeure","$heureD","$heureF"];
            $v=$model->insertCours($array);
            Response::redirectUrl("ressources/showRP");
        }
        
        $this->render("cours/rp3");
    }


}