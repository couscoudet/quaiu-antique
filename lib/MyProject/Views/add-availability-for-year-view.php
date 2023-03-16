<div class="article d-flex flex-column align-items-center">
        <h2 class="h2 mb-5">Ajouter une année</h2>
        <form method="POST" action="/creer-plage-annee" class="d-flex flex-column align-items-center">
        <div class="head-input d-flex flex-wrap mb-5">
            <div class="m-2">
                <label for="year" class="form-label required">Année</label>
                <input required type="number" class="form-control" id="year" name="data[year]" min="2023" max="3023">
            </div>
            <div class="m-2 ">
                <label for="peopleNumber" class="form-label required">Nombre de places</label>
                <input required type="number" class="form-control" id="peopleNumber" name="data[peopleNumber]" min="5" max="200">
            </div>
        </div>

        <div class="days flex-wrap d-flex justify-content-center">
        <?php 
        $days=['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche']; 
        foreach($days as $index => $day) :
        ?>

        <div class="day d-flex flex-column m-4 p-2" id="<?= $index+1 ?>" >
            <h4 class="h4"><?= $day ?></h4>
            <button type="button" role="button" class="btn btn-secondary add-slot">Ajouter plage</button>
        </div>

        <?php
        endforeach;
        ?>
        </div>

        <input type="text" id="url" name="url" value="/creer-plage-annee">
        <button type="submit" class="btn btn-primary btn-lg">Valider</button>
        </form>
    </div>