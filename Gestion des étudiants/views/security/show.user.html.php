<?php

use ism\lib\Role;
use ism\lib\Session;

$array_error = [];
if (Session::keyExist("array_error")) {
    //recuperation des erreur de la session dans la variable local
    $array_error = Session::getSession("array_error");
    $data = Session::getSession("array_post");
    Session::destroyKey("array_error");
}
?>

<h1 class="text-center"><u>Liste des utilisateurs</u></h1>

<table class="table mt-5 container table-bordered mb-5">
    <?php if (isset($array_error["login"])) : ?>
        <div id="emailHelp" class="form-text text-danger text-center">
            <?= $array_error["login"]; ?>
        </div>
    <?php endif; ?>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Role</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users['data'] as  $user) : ?>
            <form action="<?php path("security/Update") ?>" method="POST">
                <tr>
                    <?php if ($user["role"] == "ROLE_AC" || $user["role"] == "ROLE_RP") : ?>
                        <td>
                            <input type="text" value="<?= $user["nom"] ?>" name="nom">
                        </td>
                        <td>
                            <input type="text" value="<?= $user["login"] ?>" name="login"><br>
                        </td>
                    <?php endif; ?>
                    <?php if ($user["role"] != "ROLE_AC" && $user["role"] != "ROLE_RP") : ?>
                        <td>
                            <?= $user["nom"] ?>
                        </td>
                        <td>
                            <?= $user["login"] ?>
                        </td>
                    <?php endif; ?>
                    <input type="text" name="id" value="<?= $user["id"] ?>" hidden>
                    <td>
                        <?= $user["role"] ?>
                    </td>
                    <?php if ($user["role"] == "ROLE_AC" || $user["role"] == "ROLE_RP") : ?>
                        <td>
                            <button type="submit" class="btn btn-outline-primary" value="modifier" name="btn">Modifier</button>
                            <button type="submit" class="btn btn-outline-primary" value="supprimer" name="btn">Supprimer</button>
                        </td>
                    <?php endif; ?>
                </tr>
            </form>
        <?php endforeach; ?>
    </tbody>
</table>