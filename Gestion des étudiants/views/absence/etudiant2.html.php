<h1 class="text-center mt-5"><u>Page des absences</u></h1>
<div style="margin-top:100px mb-5">
  <table class="table mt-5 container table-bordered">
    <thead>
      <tr>
        <th>Cours</th>
        <th>Professeur</th>
        <th>Semestre</th>
        <th>Date d'absence</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as  $user) : ?>
        <tr>
          <td>
            <?= $user["moduleCours"] ?>
          </td>
          <td>
            <?= $user["professeurCours"] ?>
          </td>
          <td>
            <?= $user["semestreCours"] ?>
          </td>
          <td>
            <?= $user["dateAbsence"] ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>