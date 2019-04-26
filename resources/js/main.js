$(document).ready(function(){
	setClock();

// set event-handlers
  // event-handler for making the row clickable in the dashboard table
  $(document).on('click', 'tr[data-href]', function(){
    // console.log('document test')
    window.location = $(this).data('href');
  });

  // add confirm, before deleting sessions like a hero
  $(document).on('click', 'input[value="Delete"]', function(){
    // console.log('document test')
    return confirm('Are you sure, you want to delete that item?');
  });

// declare functions
	// needed for the clock in the right upper corner
  function setClock(){
      setInterval(function() {
          var date = new Date();
          $('#date-element').html(
              (date.getDate()) + "." + (date.getMonth()+1) + "." + date.getFullYear() + " | " +  date.getHours() + ":" + (( date.getMinutes() < 10 ? "0" : "" ) + date.getMinutes()) + ":" + (( date.getSeconds() < 10 ? "0" : "" ) + date.getSeconds())
              );
        }, 500)
     };
});
