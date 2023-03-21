$(function(){
    //delete availability
    let availabilityToDelete;
    $('.availability-bin').click(function(e){
      e.preventDefault();
      availabilityToDelete = e.target.id;
      // $('#main').load('../assets/removeImage.php', {'url': tmpUrl});
      // setTimeout(() => location.href = "/creer-plat", 500);
      let link = '/delete-availability/' + availabilityToDelete;
      $('#delete-availability').attr('href',link);
    })
  
    $('#cancel-availability').click(function(e){
      e.preventDefault();
      $('#delete-availability').attr('href','');
    })

      //delete booking
  let BookingToDelete;
  $('.booking-bin').click(function(e){
    e.preventDefault();
    BookingToDelete = e.target.id;
    // $('#main').load('../assets/removeImage.php', {'url': tmpUrl});
    // setTimeout(() => location.href = "/creer-plat", 500);
    let link = '/delete-booking/' + BookingToDelete;
    $('#delete-booking').attr('href',link);
  })

  $('#cancel-booking').click(function(e){
    e.preventDefault();
    $('#delete-booking').attr('href','');
  })
})