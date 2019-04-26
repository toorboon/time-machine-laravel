$(document).ready(function(){
 
  initTimeMachine(); 
  checkSession();

  function initTimeMachine(){
    //set inital variables for running the programme
      // makes sure the sessionId check in start_button works
      sessionId = undefined;
      breakIndicator = false;
      x = undefined;
      setCSRF();

    //set event handler for buttons
      //this button starts the counter
      $(document).on('click','#start_button', function(){
        if (!(sessionId)) {
          //Write the start counter to the database
          var action = 'ajaxStart';
          setCSRF();
          controlSession(action, sessionId);
          
        } else {
          swal('Nothing to do!', 'Process is already running!','error');
        }
      });

      //this button stops the counter
      $(document).on('click','#stop_button', function(){
        console.log('sessionId stopbutton: ' + sessionId);
        if (sessionId) {
          // Write the stop_date to the database and finish that instance
          var action = 'ajaxStop';
          setCSRF();
          controlSession(action, sessionId);
          
        } else {
          swal('Nothing to do!', 'No process is running!','error');
        }
      });

       //this button pauses the counter
      $(document).on('click','#pause_button', function(){
        if (sessionId) {
          //get the start_break pause the actual running counter
          var action = 'ajaxPause';
          setCSRF();
          controlSession(action, sessionId);
          
        } else {
          swal('Nothing to do!', 'No session is running, cannot pause nothing!','error');
        }
      });
  }

  function setCSRF(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  }

  function checkSession(){
    //check PHP, if a running counter is in there
    // This is necessary due to the reason that the client cannot know for sure, that a session is running, or not. The stop_date is the
    // indicator for this in the database. If there is no stop_date set, you will return this row and ask what should happen with it!
    $.ajax({
      url:"timeMachine/ajaxSessionCheck",
      method:"post",
      dataType:"text",
      success:function(response)
        {
          var response = $.parseJSON(response);

          if (response['error']){
            swal('', response['message'],'error');
          } else {
            console.log(response)
            setSession(response);
          }
        }
    });
  };

  function setSession(sessionObject){
    emptyInfofield();
    // write content from Array into the programme
    sessionId = sessionObject[0].id;
    var startDate = sessionObject[0].start_time;
    var startBreak = sessionObject[0].start_pause;
    var endBreak = sessionObject[0].stop_pause;
    var offset = sessionObject[0].duration_pause;
    var endDate = sessionObject[0].stop_time;

    printInfofield('Start Time: ' + startDate);
    // makes the background green so you know the counter is running
    if (startDate){
      $('#lightbox').css('background-color','#b3ffb3');
      // printInfofield('Start time today: ' + startDate);
    }
    
    // for setting the break variable, so the break handler in PHP can operate
    // if in startBreak is a value, you have to set 
    // the actual session and wait for the break to end  
    if (startBreak){
      if (endBreak){
        runSession(startDate, offset);
        // calculate the break or put it to default sentence
        breakIndicator = false;
        var pauseTimeRecalc = Math.round(offset/1000/60);
        var pauseTime = 'You had ' + pauseTimeRecalc + ' minute(s) off already!';
      } else {
        // maybe figure a way out how to start a new intervall
        var now = startBreak;
        printInfofield(calculateCounter(startDate, now, offset));
        
        breakIndicator = true;
        var pauseTime = 'You are on break! Go wild!<br>';
        $('#lightbox').css('background-color','#b3b3b3');
        
        runSession(startBreak, 0);
      }
    } else {  
      runSession(startDate, offset);
      var pauseTime = 'You didn\'t have a break yet!';
    }
    console.log('breakIndicator: ' + breakIndicator); 

    printInfofield(pauseTime);
  }

  function printInfofield(content){
    var printout = '<span>' + content + '</span><br>';
    $('#infobox').append(printout);
  }

  function emptyInfofield(){
    //use the data attribute of the infobox to hand over the employer value from
    var headerTopic = $('#infobox').attr('data-test');
    
    $('#infobox').html('<h5 class="text-center">' + headerTopic + '</h5>');
  }

  function runSession(startDate, offset){
    // you don't want to have two active intervalls in the same html element 
    if (x){clearInterval(x)};
    // Update the counter every 1 second
    x = setInterval(function() {
      // Get date and time for right now
      var now = new Date();
      
      $('#counter_box').html(calculateCounter(startDate, now, offset));
    }, 1000);
    // console.log('sessionId runSession: ' + sessionId);
  }

  function calculateCounter(startDate, now, offset){
    // Set the date we're starting from
    if (startDate === undefined) {
      var startDate = new Date();
    } 
   
    var startDate = new Date(startDate);
    // console.log('startDate: ' + startDate)

    // Convert break date to JS date object
    var now = new Date(now);
    // console.log('now: ' + now)
    // Find the distance between now and the startDate
    var distance = now-startDate-offset;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)); 
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // console.log('distance: ' + distance)
    // console.log('duration' + offset)

    // construct a nice html output so the user knows what intervall he is serving where
    if (breakIndicator){
      var text = 'Break counter: ';
    } else {
      var text = 'Working time today: ';
    }

    displayTime = text + days + 'd ' + hours + 'h ' + minutes + 'm ' + seconds + 's';

    // console.log('displayTime: ' + displayTime)

    return displayTime;
  }

  function controlSession(action, sessionId){
    // depending on the clicked button, perform the action in PHP which is needed
    // BREAK
    // If you click break you set start_break, if you click break again you set end_break and calculate the amount of 
    // minutes and put it to duration and so on
    var date = new Date();
    console.log('breakIndicator controlSession: ' + breakIndicator);
    // Use this for reformating the date so you can transfer it to mysql
    var SQLDate = date .getFullYear() + "-" + (date.getMonth()+1) + "-" + date.getDate() + " " + date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds(); 
    // var sessionId = 2; 
    // Write the actual date to the database depending on the action
    console.log('action date: ' + action + SQLDate);
    console.log('sessionId: ' + sessionId);
    $.ajax({
      url:"timeMachine/" + action,
      method:"post",
      data:{date:SQLDate, sessionId:sessionId, breakIndicator:breakIndicator},
      dataType:"text",
      }).done(function(response){
          swal('Well done!', response, 'success');
          if ((action === 'ajaxStart') || (action === 'ajaxPause')){
              checkSession();
          } else if (action === 'ajaxStop'){
              killSession(SQLDate);
          }
      }).fail(function(response){
        swal('Server Error', 'Talk to your Administrator!','error');
      });
  }

  function killSession(stopDate){
    clearInterval(x);
    // printInfofield('Start Time: ' + startDate);
    printInfofield('End Time: ' + stopDate);
    $('#lightbox').css('background-color','#ff8080');
    sessionId = undefined;
    console.log('sessionId killSession: ' + sessionId);
  }

}); //end of $(document).ready(function())};