//JQuery
$(function(){

  $('#cancel').click(function(e){
    e.preventDefault();
    console.log(document.URL);
    $('#main').load('../assets/removeImage.php', {'url': tmpUrl});
    setTimeout(() => location.href = "/creer-plat", 500);

  })
  
}); 


//swiper
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
