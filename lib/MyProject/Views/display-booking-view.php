<div class="article d-flex flex-column align-items-center">
    <h2 class="h2">Liste des réservations</h2>
    <div class="mb-3" id="date-block">
        <label for="book-date" class="form-label required">Sélectionner une date</label>
        <input type="text" class="form-control" id="book-date" name="">
    </div>
</div>

<script src="<?= ASSETS.DIRECTORY_SEPARATOR.'jquery-ui-1.13.2.custom'.DIRECTORY_SEPARATOR ?>external/jquery/jquery.js"></script>
<script src="<?= ASSETS.DIRECTORY_SEPARATOR.'jquery-ui-1.13.2.custom'.DIRECTORY_SEPARATOR ?>jquery-ui.js"></script>
<script>
$(function(){
$( "#book-date" ).datepicker({
    altField: "date",
    closeText: 'Fermer',
    prevText: 'Précédent',
    nextText: 'Suivant',
    currentText: 'Aujourd\'hui',
    monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
    monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
    dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
    dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
    dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
    weekHeader: 'Sem.',
    dateFormat: 'yy-mm-dd',
    firstDay: 1,
  });

  $( "#book-date" ).change((e) => {
    e.preventDefault();
    let date = $( "#book-date" ).val();
    $('#bookings').remove();
    $(e.target).parent().after('<div id="bookings"></div>')
    $('#bookings').load('/check-bookings', {'date': date, 'url':'/check-bookings'});
  });

})
</script>