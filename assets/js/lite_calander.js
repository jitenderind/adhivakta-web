
"use strict";
var cal = function () {
    "use strict";
    $("#calendar").fullCalendar({
    	defaultView: 'today',

        // customize the button names,
        // otherwise they'd all just say "list"
        views: {
          listDay: { buttonText: 'list day' },
          listWeek: { buttonText: 'list week' },
          listMonth: { buttonText: 'list month' }
        },

        header: {
          left: 'title',
          center: '',
          right: 'listDay,listWeek,listMonth'
        },
        events: 'https://fullcalendar.io/demo-events.json'
    });
};
var Calendar = function () {
    "use strict";
    return {
        init: function () {
            cal();
        }
    }
}();
$(function () {
    Calendar.init();
});