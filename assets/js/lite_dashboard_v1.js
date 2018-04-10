"use strict";
var v1 = function () {
    "use strict";
    $(".add_shadow").realshadow({
        followMouse: false,
        type       : 'drop'
    });

    $("[data-click=todolist]").on('click', function () {
        var e = $(this).closest("li");
        if ($(e).hasClass("active")) {
            $(e).removeClass("active")
        } else {
            $(e).addClass("active")
        }
    });

    $("#datepicker-inline").datepicker({
        todayHighlight: true
    });

};
var Dashboard = function () {
    "use strict";
    return {
        init: function () {
            v1();
        }
    }
}();
$(function () {
    Dashboard.init();
});