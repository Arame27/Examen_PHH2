<div class="container mt-5 text-center mb-5">

    <h1>Planification de cours</h1>
    <form action="<?php path("security/planifierCours") ?>" method="post">

        <div class="form-group mt-1">
            <label for="date" class="mt-5">Date du cours</label><br>
            <div class="col-sm-1-12">
                <input type="date" name="date" id="date" required>
            </div>
        </div>

        <div class="form-group mt-1">
            <label for="" class="pr-4">Classe du cours</label>
            <div class="col-sm-1-12">
                <label class="pl-5">
                    <select name="classe">
                        <option value="L1 Dev Web Mobile">L1 Dev Web Mobile </option>
                        <option value="L1 Marketing Digital">L1 Marketing Digital</option>
                        <option value="L1 Design Numerique">L1 Design Numerique</option>
                    </select>
                </label>
            </div>
        </div>

        <div class="form-group mt-1">
            <label for="" class="">Professeur du cours</label><br>
            <label class="pl-5">
                <select name="professeur">
                    <?php foreach ($prof as $p) : ?>
                        <option value="<?= $p["prenomProf"] ?>"><?= $p["prenomProf"] . ": (Ses modules: " . $p["moduleProf"] . ")" ?>
                        <?php endforeach ?>
                </select>
            </label>
        </div>

        <div class="mb-3">
            <div class="form-group mt-1">
                <label for="" class="">module à dispenser</label><br>
                <label class="pl-3">
                    <select class="form-control" name="module" id="">
                        <option value="UML">UML</option>
                        <option value="JAVA">Java</option>
                        <option value="WEBMASTERING">Webmastering</option>
                    </select>
                </label>
            </div>
        </div>

        <div class="mb-3">
            <div class="form-group mt-1">
                <label for="" class="">Semestre de cours</label><br>
                <label class="pl-3">
                    <select class="form-control" name="semestre" id="">
                        <option value="s1">semestre 1</option>
                        <option value="s2">semestre 2</option>
                    </select>
                </label>
            </div>
        </div>

        <div class="mb-3">
            <label for="heure" class="col-form-label">Nombre d'heure du cours</label>
            <div class="col-sm-1-12">
                <input type="number" name="nbreHeure" id="heure" required>
            </div>
        </div>

        <div class="form-group">
            <label for="heureD" class="col-sm-1-12 col-form-label" required>Heure de debut du cours</label>
            <div class="col-sm-1-12">
                <input type="time" name="heureD" id="heureD">
            </div>
        </div>

        <div class="form-group">
            <label for="heureF" class="col-sm-1-12 col-form-label" required>Heure de fin du cours</label>
            <div class="col-sm-1-12">
                <input type="time" name="heureF" id="heureF">
            </div>
        </div>

        <div class="form-group mt-2 mb-5">
            <div class="offset-sm-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Action</button>
            </div>
        </div>
    </form>
</div>