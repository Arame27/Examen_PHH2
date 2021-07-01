<h1 class="text-center mt-5"><u>Page des cours</u></h1>
<div style="margin-top:100px mb-5">
    <table class="table mt-5 container table-bordered">
        <thead>
            <tr>
                <th>Classe</th>
                <th>Module</th>
                <th>Semestre</th>
                <th>Nombre d'heure</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cours as  $cour) : ?>
                <tr>
                    <td>
                        <?= $cour["classeCours"] ?>
                    </td>
                    <td>
                        <?= $cour["moduleCours"] ?>
                    </td>
                    <td>
                        <?= $cour["semestreCours"] ?>
                    </td>
                    <td>
                        <?= $cour["nbrHeureCours"] ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>