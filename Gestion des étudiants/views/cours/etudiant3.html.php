<h1 class="text-center mt-5"><u>Page des Cours</u></h1>
<div style="margin-top:100px mb-5">
  <table class="table mt-5 container table-bordered">
    <thead>
      <tr>
        <th scope="col">Cours</th>
        <th scope="col">Professeurs</th>
        <th scope="col">Date</th>
        <th scope="col">Nombre d'heure de cours</th>
        <th scope="col">Semestre</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($cours as  $cour) : ?>
        <tr>
          <td>
            <?= $cour["moduleCours"] ?>
          </td>
          <td>
            <?= $cour["professeurCours"] ?>
          </td>
          <td>
            <?= $cour["dateCours"] ?>
          </td>
          <td>
            <?= $cour["nbrHeureCours"] ?>
          </td>
          <td>
            <?= $cour["semestreCours"] ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>