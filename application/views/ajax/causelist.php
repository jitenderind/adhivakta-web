<link href='assets/plugins/fc/fullcalendar.min.css' rel='stylesheet' />
<link href='assets/plugins/fc/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<script src='assets/plugins/fc/lib/moment.min.js'></script>
<script src='assets/plugins/fc/fullcalendar.min.js'></script>
<script>
var cases = [];
$.ajax({
  	"url": "<?php echo API_URL.'user-cause-list/'.$_SESSION['user']['userId']?>",
      type: "GET",
      dataType: "json",
      contentType: "application/json",
      "async": true,
      "crossDomain": true,
      "headers": {
          "Authorization": "Bearer <?php password_hash('aditiaryan',  PASSWORD_DEFAULT, ['cost' => 5])?>",
          "Content-Type": "application/json"
        },
    success: function(doc) {
      $.each(doc,function(i, item){
	  cases.push({
	            title: $(this).attr('caseTitle'),
	            forum: $(this).attr('forum'),
	            courtNo: $(this).attr('nextListingCourtNo'),
	            itemNo: $(this).attr('nextListingItemNo'),
	            start: $(this).attr('nextListing') // will be parsed
	          });
	        });
     // console.log(JSON.stringify(cases));
     // callback(events);
      $('#calendar').fullCalendar({
  	    header: {
  	      left: 'prev',
  	      center: 'title,today,listDay,listWeek,listMonth',
  	      right: 'next'
  	    },
  	    validRange: {
  	        start: new Date(),
  	    },

  	    // customize the button names,
  	    // otherwise they'd all just say "list"
  	    views: {
  	        today:{ buttonText: 'Today',listDayFormat: 'ddd, MMM DD, YYYY', },
  	      listDay: { buttonText: 'Daily',listDayFormat: 'ddd, MMM DD, YYYY', },
  	      listWeek: { buttonText: 'Week',listDayFormat: 'dddd', },
  	      listMonth: { buttonText: 'Month' }
  	    },
    	contentHeight: 'auto',
  	    defaultView: 'listDay',
  	    defaultDate: new Date(),
  	    navLinks: true, // can click day/week names to navigate views
  	    editable: false,
  	    eventLimit: true,
  	    eventRender: function(event, element) {
  	  	    var titleHTML=event.title +' <span class="f-s-12">[Court No: ' + event.courtNo+' | '+'Item No: '+event.itemNo+']</span>';
  	    	element.find(".fc-list-item-title").html(titleHTML);
  	        element.find(".fc-list-item-time").html(event.forum);
  	      }, // allow "more" link when too many events
  	      events: cases
  	  });
    }
  });



</script>
<div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ap-wrapper">
                        <div class="ap-box">
                            <div id="calendar" class="calendar"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        