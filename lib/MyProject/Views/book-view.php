<div class="article d-flex flex-column align-items-center">
        <h2 class="h2 mb-5">Réserver</h2>
        <form method="POST" action="/reserver">
        <div class="mb-3">
            <label for="title" class="form-label required">Nom</label>
            <input required type="text" class="form-control" id="title" name="data[title]">
        </div>
        <div class="mb-3">
            <label for="peopleNumberBook" class="form-label required">Nombre de personnes</label>
            <input required style="width:100px;" type="number" min="1" max="20" class="form-control" id="peopleNumberBook" name="data[peopleNumber]">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label required">Email</label>
            <input required type="email" class="form-control" id="email" name="data[email]">
        </div>
        <div class="mb-3 hidden" id="date-block">
            <label for="date" class="form-label required">Sélectionner une date</label>
            <input required type="text" class="form-control" id="date" name="data[date]">
        </div>
            <input class="hidden" type="text" id="slot-input" name=data[slotId]>
            <input type="text" id="url" name="url" value="/reserver">
            <button type="submit" class="btn btn-secondary hidden">Réserver</button>
        </form>
    </div>

<script>
const dates = [];
<?php
$availableDates = [];?>
let year;
let month;
let day;

<?php
foreach($data as $availabitity) {
    array_push($availableDates, $availabitity->getStartSlot());
}
foreach($availableDates as $date) :
?>
year = <?= date_format($date,"Y") ?>;
month = <?= date_format($date,"n") ?> - 1;
day = <?= date_format($date,"j") ?>;

date = `${day}/${month}/${year}`;
dates.push(date);
<?php endforeach ?>

</script>

<script src="<?= ASSETS.DIRECTORY_SEPARATOR.'jquery-ui-1.13.2.custom'.DIRECTORY_SEPARATOR ?>external/jquery/jquery.js"></script>
<script src="<?= ASSETS.DIRECTORY_SEPARATOR.'jquery-ui-1.13.2.custom'.DIRECTORY_SEPARATOR ?>jquery-ui.js"></script>
