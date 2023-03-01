//JQuery
$(function(){

  $('#cancel').click(function(e){
    e.preventDefault();
    console.log(document.URL);
    $('#main').load('../assets/removeImage.php', {'url': tmpUrl});
    setTimeout(() => location.href = "/creer-plat", 500);

  })
  
}); 
    