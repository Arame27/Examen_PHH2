<?php

use ism\lib\Session;
use ism\models\ProfModel;

$user = Session::getSession("user_connect");
$model = new ProfModel();
$prof = $model->selectProfByLogin($user["login"]);
$module = explode(" ", $prof["moduleProf"]);
$array_error = [];
if (Session::keyExist("array_error")) {
    $array_error = Session::getSession("array_error");

    Session::destroyKey("array_error");
}

?>

<h1 class="text-center mt-5"><u>Mes étudiants</u></h1>
<div style="margin-top:100px">
    <table class="table mt-5 container table-bordered">
        <thead>
            <tr>
                <th>prenom</th>
                <th>date de naissance</th>
                <th>Genre</th>
                <th>Compétences</th>
                <th>Marquer Absence</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as  $user) : ?>
                <form action="<?php path("security/marquerAbsent") ?>" method="post">

                    <tr>
                        <td>
                            <?= $user["prenomEtu"] ?>
                        </td>
                        <td>
                            <?= $user["dateNaissanceEtu"] ?>
                        </td>
                        <td>
                            <?php echo $user["sexeEtu"] == "m" ? "Garçon" : "Fille" ?>
                        </td>
                        <td>
                            <?= $user["competenceEtu"] ?>
                        </td>
                        <input type="text" value="<?= $user["matriculeEtu"] ?>" name="matricule" hidden>
                        <td>
                            <select name="module" id="">
                                <option value="">module</option>
                                <?php foreach ($module as  $mod) : ?>
                                    <option value="<?= $mod ?>"><?= $mod ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset($array_error["module"])) : ?>
                                <div class="form-text text-danger ">
                                    <?= $array_error["module"]; ?></div>
                            <?php endif; ?>
                            <input type="date" value="<?= date("Y-m-d") ?>" name="date">
                            <?php if (isset($array_error["date"])) : ?>
                                <div class="form-text text-danger ">
                                    <?= $array_error["date"]; ?></div>
                            <?php endif; ?>
                            <button type="submit" class="btn btn-outline-primary" name="btn_abs">Absent</button>
                        </td>
                    </tr>
                </form>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>