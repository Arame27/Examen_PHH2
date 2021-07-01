<h1 class="text-center mt-5"><u>Mes étudiants</u></h1>
<div style="margin-top:100px">
    <table class="table mt-5 container table-bordered">
        <thead>
            <tr>
                <th>prenom</th>
                <th>date de naissance</th>
                <th>Genre</th>
                <th>Compétences</th>
                <th>Matricule</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as  $user) : ?>
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
                    <td>
                        <?= $user["matriculeEtu"] ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>