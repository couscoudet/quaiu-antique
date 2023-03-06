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
  $('.removeFromGallery').click(function(e){
    e.preventDefault();
    let id = $(this).attr('id');
    $(`#${id}`).hide();
    $(`#${id}`).parent().load('/removeImageFromGallery/' + id);
  })

  $('.addToGallery').click(function(e){
    e.preventDefault();
    let id = $(this).attr('id');
    console.log('hi');
    $(`#${id}`).hide();
    $(`#${id}`).parent().load('/addImageToGallery/' + id);
  })
  
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
