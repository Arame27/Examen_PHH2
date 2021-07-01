<h1 class="text-center mt-5"><u>Page des Absences</u></h1>
<div style="margin-top:100px mb-5">
    <table class="table mt-5 container table-bordered">
        <thead>
            <tr>
                <th>date d'absence</th>
                <th>Matricule étudiant</th>
                <th>prenom Etudiant</th>
                <th>Module de cours</th>
                <th>Absence marquée par</th>
                <th>Semestre</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($absences as  $abs) : ?>
                <tr>
                    <td>
                        <?= $abs["dateAbsence"] ?>
                    </td>
                    <td>
                        <?= $abs["matriculeEtu"] ?>
                    </td>
                    <td>
                        <?= $abs["prenomEtu"] ?>
                    </td>
                    <td>
                        <?= $abs["moduleCours"] ?>
                    </td>
                    <td>
                        <?= "professeur " . $abs["professeurCours"] ?>
                    </td>
                    <td>
                        <?= $abs["semestreCours"] ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>