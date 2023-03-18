//swiper for Homepage
const swiper = new Swiper('.swiper', {
  // Optional parameters
  effect: 'cards',
  loop: true,

  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
  },
  keyboard: {
    enabled: true,
  },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  // And if we need scrollbar
  scrollbar: {
    el: '.swiper-scrollbar',
  },
});

//JQuery
$(function(){

  //Remove dish image if no confirmation at creation
  $('#cancel').click(function(e){
    e.preventDefault();
    console.log(document.URL);
    $('#main').load('../assets/removeImage.php', {'url': tmpUrl});
  })

  //remove meal
  let mealToDelete;
  $('.meal-bin').click(function(e){
    e.preventDefault();
    mealToDelete = e.target.id;
    // $('#main').load('../assets/removeImage.php', {'url': tmpUrl});
    // setTimeout(() => location.href = "/creer-plat", 500);
    let link = '/delete-meal/' + mealToDelete;
    $('#delete-meal').attr('href',link);
  })

  $('#cancel-meal').click(function(e){
    e.preventDefault();
    $('#delete-meal').attr('href','');
  })
  

  //Gallery Image Management
  $('.gallery-manager').click(function(e){
    e.preventDefault();
    if ($(this).children().hasClass('removeFromGallery')) {
      let id = $(this).children().attr('id');
      $(`#${id}`).hide();
      $(`#${id}`).parent().load('/removeImageFromGallery/' + id);
      }
    else {
      let id = $(this).children().attr('id');
      $(`#${id}`).hide();
      $(`#${id}`).parent().load('/addImageToGallery/' + id);
      }
  })

  // $('.addToGallery').click(function(e){
  //   e.preventDefault();
  //   let id = $(this).attr('id');
  //   console.log('hi');
  //   $(`#${id}`).hide();
  //   $(`#${id}`).parent().load('/addImageToGallery/' + id);
  // })

  //Time Slot Dynamic management
  /////////////////////////////////////////////////////////////////////////////////////////
  let slotId = 1;
  const createSlot = (day,slotId) => {
    return $(`<div id="slot-${slotId}"class="slot d-flex flex-wrap align-items-center justify-content-center">\
                <div class="slotTimes d-flex">\
                    <div class="m-2">\
                        <label for="startSlot" class="form-label required">Heure de début</label>\
                        <input required type="time" class="form-control" id="startSlot" name="data[days][${day}][slots][${slotId}][startDateTime]">\
                    </div>\
                    <div class="m-2">\
                        <label for="startSlot" class="form-label required">Heure de fin</label>\
                        <input required type="time" class="form-control" id="startSlot" name="data[days][${day}][slots][${slotId}][endDateTime]">\
                    </div>\
                </div>\
                <i type="button" class="bi bi-trash3 m-3 timeslot-delete"></i>\
              </div>`)
  }

  $('.add-slot').click((e)=>{
    e.preventDefault();
    console.log($(e.target).parent().attr('id'));
    let newSlot = createSlot($(e.target).parent().attr('id'),slotId);
    $(e.target).parent().append(newSlot);
    slotId++;
    $('.timeslot-delete').click((e)=>{
      e.preventDefault();
      $(e.target).parent().remove();
    });
  });


  $('#validate-category-sort').click((e)=> {
    e.preventDefault();
    let orderedCategories = [];
    for (item of $('.list-group-item')) {
      orderedCategories.push(item.innerText)
    }
    let tmpUrl = '/orderCategories';
    $('#empty').load('/orderCategories',{'orderedCategories': orderedCategories, 'url': tmpUrl});
  });

  let arrangementIndex=1;
  $('#add-arrangement').click((e)=> {
    e.preventDefault();
    let arrangementForm =   
    `
    <div class="arrangement card p-5 m-1 mb-2">\
    <div class="mb-3">\
        <label for="arrangementTitle-${arrangementIndex}" class="form-label required">Titre</label>\
        <input required type="text" class="form-control" id="ArrangementTitle-${arrangementIndex}" name=data[arrangement][${arrangementIndex}][title]>\
    </div>
    <div class="mb-3">\
        <label for="description-${arrangementIndex}" class="form-label">Description</label>
        <textarea type="text" class="form-control" id="description-${arrangementIndex}" name=data[arrangement][${arrangementIndex}][description] rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label for="price-${arrangementIndex}" class="form-label required">Prix TTC</label>
        <input required type="number" step="0.01" class="form-control" id="price-${arrangementIndex}" name=data[arrangement][${arrangementIndex}][price]>
    </div>
</div>
    `
    $('#add-arrangement').before(arrangementForm);
    arrangementIndex++;
  })


  ///////////////////////////////////////////////////////////////////////////////////////////////////////


  //Booking management
  let d = new Date(2023, 0, 18);

  $( "#date" ).datepicker({
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
    beforeShowDay: function(d) {
      d = `${d.getDate()}/${d.getMonth()}/${d.getFullYear()}`
      if($.inArray(d,dates) != -1) {
        return[true,""]
        }
      else {
        return[false,"" ,"non disponible"]
      }
    }
  });

  let data = {
    'peopleNumber': 0,
    'date' : ''
  }

  $("#peopleNumberBook").change((e) => {
    $('#date-block').removeClass('hidden');
  })

  const takeSlotId = () => {
    const slots = document.getElementsByClassName('time-slot');
    console.log(slots);
    for (let slot of slots) {
      console.log(slot)
      slot.addEventListener('click', (e) => {
        e.preventDefault();
        console.log('ok');
        $('#slot-input').val($(e.target).attr('id'));
        $('.time-slot').removeClass('btn-primary');
        $('.time-slot').addClass('btn-outline-primary');
        $(`#${$('#slot-input').val()}`).toggleClass('btn-primary btn-outline-primary');
        $('button').removeClass('hidden');
      });
    }
  }
  
  $( "#date" ).change((e) => {
    e.preventDefault();
    data['peopleNumber'] = $('#peopleNumberBook').val();
    data['date'] = $( "#date" ).val();
    $('#timeToBook').remove();
    $(e.target).after('<div id="timeToBook"></div>')
    $('#timeToBook').load('/checkavailabilities', {'data': data, 'url':'/checkavailabilities'});
    setTimeout(takeSlotId,500);
  });
  

 /////////////////////////// Sortable js //////////////////////////////


});

// Simple list
// Sortable.create(simpleList, { /* options */ });

// List with handle
Sortable.create(simpleList, {
  handle: '.bi-arrows-move',
  animation: 150,
  sort: true
});



 ///////////////////////////////////////////////////////////////////////








