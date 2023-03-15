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
        foreach($days as $day) :
        ?>

        <div class="day d-flex flex-column m-4 ">
            <h4 class="h4"><?= $day ?></h4>
            <div><button type="button" role="button" class="btn btn-secondary">Ajouter plage</button></div>
            <div class="slot d-flex flex-wrap align-items-center justify-content-center">
                <div class="slotTimes d-flex">
                    <div class="m-2">
                        <label for="startSlot" class="form-label required">Heure de début</label>
                        <input required type="time" class="form-control" id="startSlot" name="data[days][<?=$day;?>][slots][startSlot]">
                    </div>
                    <div class="m-2">
                        <label for="startSlot" class="form-label required">Heure de fin</label>
                        <input required type="time" class="form-control" id="startSlot" name="data[days][<?=$day;?>][slots][endSlot]">
                    </div>
                </div>
                <i type="button" class="bi bi-trash3 m-3 meal-bin"></i>
            </div>
        </div>

        <?php
        endforeach;
        ?>
        </div>

        <button type="submit" class="btn btn-secondary">Valider</button>
        </form>
    </div>