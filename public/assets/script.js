//JQuery
$(function(){

  //Remove dish image if no confirmation at creation
  $('#cancel').click(function(e){
    e.preventDefault();
    console.log(document.URL);
    $('#main').load('../assets/removeImage.php', {'url': tmpUrl});
    setTimeout(() => location.href = "/creer-plat", 500);

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
  
}); 


//swiper for Homepage
const swiper = new Swiper('.swiper', {
  // Optional parameters
  effect: 'cards',
  loop: true,

  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
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
