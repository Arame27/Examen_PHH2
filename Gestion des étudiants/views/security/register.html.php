<?php

use ism\lib\Session;
use ism\lib\Role;
use ism\lib\Validator;
$mat=Validator::generateRandomString();
//verification des erreur de session
$array_error = [];

if (Session::keyExist("array_error")) {
    //recuperation des erreur de la session dans la variable local
    $array_error = Session::getSession("array_error");
    $data = Session::getSession("array_post");
    Session::destroyKey("array_error");
}
?>
<div class="container mt-2 mr-5 ">
    <h1><u>Inscription</u></h1>
    <?php if (Role::estAC() || Role::estRP() || Role::estAdmin()) : ?>
        <form action=" <?php path("security/register") ?>" method="post" class="mt-5" enctype="multipart/form-data">
            <?php if (Role::estAC() || Role::estRP() || Role::estAdmin()) : ?>
                <div class="col-md-5">
                    <div class="mb-3">
                        <label class="form-label pr-5">Avatar</label>
                        <label class="pl-5">
                            <input type="file" class="form-control" name="avatar" value="Upload">
                        </label>
                        <?php if (isset($array_error["avatar"])) : ?>
                            <div class="form-text text-danger ">
                                <?= $array_error["avatar"]; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (Role::estAC() || Role::estRP()) : ?>
                <div class="mb-3">
                    <label class="form-label pr-3">Matricule</label>
                    <label class="pl-5">
                        <input type="text" class="form-control" name="matricule" value="<?= $mat ?>" disabled>
                    </label>
                </div>
            <?php endif; ?>
            <div class="mb-3 mt-5">
                <label for="exampleInputEmail1" class="form-label">Login</label>
                <label class="pl-5">
                    <input type="text" class="form-control" name="login" value="<?php echo array_key_exists("login", $data) ? $data["login"] : "" ?>">
                </label>
                <?php if (isset($array_error["login"])) : ?>
                    <div id="emailHelp" class="form-text text-danger ">
                        <?= $array_error["login"]; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <label class="pl-3">
                    <input type="password" class="form-control" name="password" value="<?php echo array_key_exists("password", $data) ? $data["password"] : "" ?>">
                </label>
                <?php if (isset($array_error["password"])) : ?>
                    <div id="emailHelp" class="form-text text-danger ">
                        <?= $array_error["password"]; ?></div>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="mb-3">
                        <label class="form-label pr-5">Prénom</label>
                        <label>
                            <input type="text" class="form-control" name="prenom" value="<?php echo array_key_exists("prenom", $data) ? $data["prenom"] : "" ?>">
                        </label>
                        <?php if (isset($array_error["prenom"])) : ?>
                            <div class="form-text text-danger ">
                                <?= $array_error["prenom"]; ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if (Role::estAC() || Role::estRP()) : ?>

                <div class="row">
                    <div class="mb-3">
                        <label class="form-label pl-3">Date de naissance</label>
                        <label>
                            <input type="date" class="form-control" name="dateNaiss" value="<?php echo array_key_exists("dateNaiss", $data) ? $data["dateNaiss"] : "" ?>">
                        </label>
                        <?php if (isset($array_error["dateNaiss"])) : ?>
                            <div id="emailHelp" class="form-text text-danger ">
                                <?= $array_error["dateNaiss"]; ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label class="form-label pr-5">genre</label>
                            <label class="pr-5">
                                <select class="form-control" name="sexe">
                                    <option value="m">M</option>

                                    <option value="f">F</option>
                                </select>
                            </label>
                            <?php if (isset($array_error["sexe"])) : ?>
                                <div class="form-text text-danger ">
                                    <?= $array_error["sexe"]; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (Role::estAdmin() || Role::estAC() || Role::estRP()) : ?>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="" class="pr-5">Role</label>
                            <label class="pl-4">
                                <select class="form-control" name="role" id="">
                                <?php endif; ?>
                                <?php if (Role::estAdmin()) : ?>
                                    <option value="ROLE_AC">ASSISTANT DE CLASSE</option>

                                    <option value="ROLE_RP">RESPONSABLE PEDAGOGIQUE</option>
                                <?php endif; ?>
                                <?php if (Role::estAC()) : ?>
                                    <option value="ROLE_ETU">ETUDIANT</option>
                                <?php endif; ?>
                                <?php if (Role::estRP()) : ?>
                                    <option value="ROLE_PROF">PROFESSEUR</option>
                                <?php endif; ?>
                                </select>
                            </label>
                        </div>
                    </div>
                </div>

                <?php if (Role::estAC() || Role::estRP()) : ?>
                    <div class="mb-3">
                        <label class="form-label pr-3"><?php
                                                        if (Role::estAC()) {
                                                            echo 'Classe';
                                                        } elseif (Role::estRP()) {
                                                            echo 'Classes';
                                                        } ?></label>
                        <?php if (Role::estAC()) : ?>
                            <label class="pl-5">
                                <select name="classe">
                                    <option value="L1 Dev Web Mobile">L1 Dev Web Mobile </option>
                                    <option value="L1 Marketing Digital">L1 Marketing Digital</option>
                                    <option value="L1 Design Numerique">L1 Design Numerique</option>
                                </select>
                            </label>
                        <?php endif; ?>

                        <?php if (Role::estRP()) : ?>
                            <label class="pl-5">
                                <input type="checkbox" name="1" value="L1 Dev Web Mobile" checked id="1">
                                <label for="1"> L1 Dev Web Mobile </label>
                                <input type="checkbox" name="2" value="L1 Marketing Digital" id="2" class="ml-4">
                                <label for="2"> L1 Marketing Digital </label>
                                <input type="checkbox" name="3" value="L1 Design Numerique" id="3" class="ml-4">
                                <label for="3"> L1 Design Numerique </label>
                            </label>
                        <?php endif; ?>

                        <?php if (isset($array_error["classe"])) : ?>
                            <div class="form-text text-danger ">
                                <?= $array_error["classe"]; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label pr-3"><?php if (Role::estAC()) {
                                                            echo 'Ses Competences';
                                                        } elseif (
                                                            Role::estRP()
                                                        ) {
                                                            echo 'Ses Modules';
                                                        } ?></label><br>
                        <label class="pl-5">
                            <?php if (Role::estAC()) : ?>
                                <label class="pl-5">
                                    <input type="checkbox" name="4" value="Maquettage" checked id="4">
                                    <label for="4"> Maquettage </label>
                                    <input type="checkbox" name="5" value="integration web" id="5" class="ml-3">
                                    <label for="5"> integration web </label>
                                    <input type="checkbox" name="6" value="composant dynamique php" id="6" class="ml-3">
                                    <label for="6"> composant dynamique php </label><br>
                                    <input type="checkbox" name="7" value="Acces base de données" id="7">
                                    <label for="7"> Acces base de données</label>
                                    <input type="checkbox" name="8" value="deploiement appli" id="8" class="ml-3">
                                    <label for="8"> deploiement appli</label>
                                    <input type="checkbox" name="9" value="gestion projet" id="9" class="ml-3">
                                    <label for="9"> gestion projet </label>
                                    <input type="checkbox" name="10" value="versionning" id="10" class="ml-3">
                                    <label for="10"> versionning </label>
                                </label>
                            <?php endif; ?>

                            <?php if (Role::estRP()) : ?>
                                <label class="pl-5">
                                    <input type="checkbox" name="11" value="UML" checked id="11">
                                    <label for="11"> UML </label>
                                    <input type="checkbox" name="12" value="JAVA" id="12" class="ml-4">
                                    <label for="12"> JAVA </label>
                                    <input type="checkbox" name="13" value="Webmastering" id="13" class="ml-4">
                                    <label for="13"> Webmastering </label>
                                </label>
                            <?php endif; ?>
                        </label>
                    </div>
                <?php endif; ?>
                <?php if (Role::estRP()) : ?>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="" class="pr-4">Grade</label>
                            <label class="pl-3">
                                <select class="form-control" name="grade" id="">
                                    <option value="ingenieur">INGENIEUR</option>
                                    <option value="docteur">DOCTEUR</option>
                                </select>
                            </label>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (Role::estAC()) : ?>
                    <label class="pl-5">Son parcours</label><br>
                    <textarea name="parcours" id="" cols="50" rows="5" style="resize:none"></textarea>
                <?php endif; ?>
                <?php if (isset($array_error["parcours"])) : ?>
                    <div id="emailHelp" class="form-text text-danger ">
                        <?= $array_error["parcours"]; ?></div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-7">
                    </div>
                    <div class="pl-5">
                        <button type="submit" class="btn btn-outline-primary mb-5" name="btn">Inscription</button>
                    </div>
                </div>
        </form>

</div>
<?php endif; ?>