"use strict";
var searchVisible = 0;
var transparent = true;
var transparentDemo = true;
var fixedTop = false;
var navbar_initialized = false;
var mobile_menu_visible = 0,
    mobile_menu_initialized = false,
    toggle_initialized = false,
    bootstrap_nav_initialized = false,
    $sidebar,
    isWindows;
var lbd;
lbd = {
    misc: {
        sidebar_mini_active: false
    }
};
$(window).on("load", function () {
    $('.preloader').fadeOut();
    //load nav
    $( "#nav" ).load( "/nav",function(){
    	loadPage(window.location.pathname);
    });
    // laod side bar
    $( ".sidebar" ).load( "/sidebar", function(){
    	 $('.loader-link').on('click', function(e) {
    		 e.preventDefault();
 			$(this).parent().siblings().removeClass('active');
 	        $(this).parent().addClass('active');
 	      	loadPage($(this).attr('href'),false);
 	      	return false;
 	      });
    });
    apScrollToTopButton();
    
});

function convertToListText(text,list='ul'){
	var newText=text.replace(/\d+/g,';');
	var arr = newText.split(';');
	var htmlList='<'+list+' class="list">',i;
	for (i = 1; i < arr.length; ++i) {
		if (arr[i] !=='' && arr[i] !==null && arr[i] !==undefined) 
		{
			htmlList += '<li>' + arr[i].trim() + '</li>';
		}
	}
	htmlList += '</'+list+'>';
	return htmlList;
}

function ValidURL(str) {
	var regex = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
	  if(!regex .test(str)) {
	    return false;
	  } else {
	    return true;
	  }
	}

function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
}

function checkInFuture(date){
	var dateToCheck = new Date(date);
	dateToCheck.setHours(0,0,0,0);
	var currentDate = new Date();
	currentDate.setHours(0,0,0,0);
	if(dateToCheck >= currentDate)
	{
		return true;
	} else {
		return false;
	}
}

function formatDate(date){
	var new_date=$.format.date(new Date(date), "E, MMM dd");
	//$.datepicker.formatDate('M dd', new Date(date));
	return new_date;
}

function formatDateFull(date){
	var new_date=$.format.date(new Date(date), "MMM dd, yyyy");
	//$.datepicker.formatDate('M dd', new Date(date));
	return new_date;
}

function calPeriodFinished(start_date,end_date){
	
	if(checkInFuture(end_date)){
		var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
		var firstDate = new Date(start_date);
		var secondDate = new Date(end_date);
		var now = new Date();

		var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(oneDay)));
		
		var completed = Math.round(Math.abs((firstDate.getTime()-now.getTime())/(oneDay)));
		
		var percent = (completed/diffDays)*100;
		return percent;
	} else {
		return 100;
	}
}

function prettyDate(date){
	var new_date=$.format.prettyDate(new Date(date));
	//$.datepicker.formatDate('M dd', new Date(date));
	return new_date;
}

function prettyTaskDate(date){
	var new_date=$.format.prettyDate(new Date(date+' 23:59:59'));
	return new_date;
}
function clearAllTimeouts(){
	if (typeof clearAllTimeouts.last == 'undefined' ) {
	    clearAllTimeouts.last = setTimeout("||void",0); // Opera || IE other browsers accept "" or "void"
	    }
	var mx = setTimeout("||void",0);
	for(var i=clearAllTimeouts.last;i<=mx;i++){
	    clearTimeout(i);
	    }
	clearAllTimeouts.last = i;
	}
function loadPage(page){
	clearAllTimeouts();
//set URL
    var urlPath = window.location.protocol +'//'+window.location.host+page
    window.history.pushState({"html":"","pageTitle":""},"", urlPath);
	//start refresh
	var effect = "win8_linear";
    var container = $(".ap-box");
    $(container).waitMe({
        effect  : effect,
        text    : 'Loading..',
        bg      : "rgba(255, 255, 255, 0.9)",
        color   : "#9368E9",
        maxSize : '',
        waitTime: -1,
        textPos : 'vertical',
        fontSize: '20px',
        source  : '',
        onClose : function () {
        }
    });
    
	//start loading 
	 $.ajax({
		 url:window.location.protocol +'//'+window.location.host+'/load/'+page,
		 success: function(data, textStatus, xhr) {
			 var arr = $.parseJSON(data);
			 //set page name 
			 $('#page-name').html(arr['pageName']);
			 //set page icon 
			 $('#page-icon').html(arr['pageIcon']);
			 //set active tab
			 
			 //set page content
			 $('#page-content').html(arr['content']);
			 //remove loader
             $(container).waitMe("hide");
			 App.init();
          }
	 });
}

function pageLoadFromServer(page){
	var effect = "win8_linear";
    var container = $(".ap-box");
    $(container).waitMe({
        effect  : effect,
        text    : 'Loading..',
        bg      : "rgba(255, 255, 255, 0.9)",
        color   : "#9368E9",
        maxSize : '',
        waitTime: -1,
        textPos : 'vertical',
        fontSize: '20px',
        source  : '',
        onClose : function () {
        }
    });
	 $.ajax({
		 url:window.location.protocol +'//'+window.location.host+'/data/'+page,
		 success: function(data, textStatus, xhr) {
			 //set page content
			 $('#page-content').html(data);
			 //remove loader
             $(container).waitMe("hide");
             Auth.init();
          }
	 });
}

function dataLoadFromServer(page,element=0){
	if(element==0){
		element = 'data-loader';
	}
	var effect = "win8_linear";
    var container = $(".ap-box");
    $(container).waitMe({
        effect  : effect,
        text    : 'Loading..',
        bg      : "rgba(255, 255, 255, 0.9)",
        color   : "#9368E9",
        maxSize : '',
        waitTime: -1,
        textPos : 'vertical',
        fontSize: '20px',
        source  : '',
        onClose : function () {
        }
    });
	 $.ajax({
		 url:window.location.protocol +'//'+window.location.host+'/data/'+page,
		 success: function(data, textStatus, xhr) {
			 //set page content
			 $('#'+element).html(data);
			 //remove loader
             $(container).waitMe("hide");
			 //App.init();
          }
	 });
}


var apWriteCopyrights = function () {
        "use strict";
        var year = new Date().getFullYear();
        $("#apWriteCopyrights").text(year);
    },
    apScrollToTopButton = function () {
        "use strict";
        var scroll_elem = $("[data-click=scroll-top]");
        $(document).on("scroll", function () {
            $(document).scrollTop() >= 200 ? $(scroll_elem).addClass("fadeInRight").removeClass("fadeOutRight invisible") : $(scroll_elem).removeClass("fadeInRight").addClass("fadeOutRight")
        });
        $(scroll_elem).on("click", function (e) {
            e.preventDefault();
            $("html, body").animate({scrollTop: 0}, 300).animate({scrollTop: 40}, 150).animate({scrollTop: 0}, 100).animate({scrollTop: 20}, 100).animate({scrollTop: 0}, 100).animate({scrollTop: 10}, 50).animate({scrollTop: 0}, 100).animate({scrollTop: 5}, 50).animate({scrollTop: 0}, 100);
        });
    },
    sideBarMenu = function () {
        "use strict";
        $(".sidebar .nav > .has-sub-menu > a").on("click", function () {
            var e = $(this).next(".sub-menu");
            $(e).hasClass("show") ? $(e).collapse('hide') : $(e).collapse('show');
            $(".sidebar .nav > li.has-sub-menu > .sub-menu").not(e).collapse('hide');
            $(e).on('show.bs.collapse', function () {
                $(this).find(".collapse.show").collapse('hide');
            });
            return false;
        });
    },
    checkSidebarImage = function () {
        "use strict";
        var $sidebar_wrapper = $('.sidebar-wrapper');
        $sidebar = $('.sidebar');
        var image_src = $sidebar.data('image');
        var sidebar_container;
        if (image_src !== undefined) {
            sidebar_container = '<div class="sidebar-background" style="background-image: url(' + image_src + ') "></div>';
            $sidebar.append(sidebar_container);
        } else if (mobile_menu_initialized === true) {
            // reset all the additions that we made for the sidebar wrapper only if the screen is bigger than 991px
            $sidebar_wrapper.find('.navbar-form').remove();
            $sidebar_wrapper.find('.nav-mobile-menu').remove();
            mobile_menu_initialized = false;
        }
        $($sidebar_wrapper).perfectScrollbar();
    },
    initRightMenu = function () {
        "use strict";
        var $sidebar_wrapper = $('.sidebar-wrapper');
        var nav_content;
        if (mobile_menu_initialized) {
            if ($(window).width() > 991) {
                // reset all the additions that we made for the sidebar wrapper only if the screen is bigger than 991px
                $sidebar_wrapper.find('.navbar-form').remove();
                $sidebar_wrapper.find('.nav-mobile-menu').remove();
                mobile_menu_initialized = false;
            }
        } else {
            var $navbar;
            $navbar = $('nav').find('.navbar-collapse').first().clone(true);
            nav_content = '';
            var mobile_menu_content;
            mobile_menu_content = '';
            $navbar.children('ul').each(function () {
                var content_buff;
                content_buff = $(this).html();
                nav_content = nav_content + content_buff;
            });
            nav_content = '<ul class="nav nav-mobile-menu">' + nav_content + '</ul>';
            var $sidebar_nav;
            $sidebar_nav = $sidebar_wrapper.find(' > .nav');
            var $nav_content;
            $nav_content = $(nav_content);
            $nav_content.insertBefore($sidebar_nav);
            $(".sidebar-wrapper .dropdown .dropdown-menu > li > a").on("click", function (event) {
                event.stopPropagation();
            });
            mobile_menu_initialized = true;
        }
        var $toggle;
        if (!toggle_initialized) {
            $toggle = $('.navbar-toggler');
            $toggle.on("click", function () {
                var $layer;
                if (mobile_menu_visible === 1) {
                    $('html').removeClass('nav-open');
                    $('.close-layer').remove();
                    setTimeout(function () {
                        $toggle.removeClass('toggled');
                    }, 400);
                    mobile_menu_visible = 0;
                } else {
                    setTimeout(function () {
                        $toggle.addClass('toggled');
                    }, 430);
                    var main_panel_height;
                    main_panel_height = $('.main-panel')[ 0 ].scrollHeight;
                    $layer = $('<div class="close-layer"></div>');
                    $layer.css('height', main_panel_height + 'px');
                    $layer.appendTo(".main-panel");
                    setTimeout(function () {
                        $layer.addClass('visible');
                    }, 100);
                    $layer.on("click", function () {
                        $('html').removeClass('nav-open');
                        mobile_menu_visible = 0;
                        $layer.removeClass('visible');
                        setTimeout(function () {
                            $layer.remove();
                            $toggle.removeClass('toggled');
                        }, 400);
                    });
                    $('html').addClass('nav-open');
                    mobile_menu_visible = 1;
                }
            });
            toggle_initialized = true;
        }
    },
    initMinimizeSidebar = function () {
        "use strict";
        $('.sidebar .collapse').on('in.bs.collapse', function () {
            if ($(window).width() > 991) {
                if (lbd.misc.sidebar_mini_active === true) {
                    return false;
                } else {
                    return true;
                }
            }
        });
        $('#minimizeSidebar').on("click", function () {
            var $btn = $(this);
            if (lbd.misc.sidebar_mini_active === true) {
                $('body').removeClass('sidebar-mini');
                setTimeout(function () {
                    lbd.misc.sidebar_mini_active = false;
                }, 300);
                if (isWindows) {
                    $('.sidebar .sidebar-wrapper').perfectScrollbar();
                }
            } else {
                $('.sidebar .collapse').collapse('hide').on('hidden.bs.collapse', function () {
                    $(this).css('height', 'auto');
                });
                if (isWindows) {
                    $('.sidebar .sidebar-wrapper').perfectScrollbar('destroy');
                }
                setTimeout(function () {
                    $('body').addClass('sidebar-mini');
                    $('.sidebar .collapse').css('height', 'auto');
                    lbd.misc.sidebar_mini_active = true;
                }, 300);
            }
            var simulateWindowResize = setInterval(function () {
                window.dispatchEvent(new Event('resize'));
            }, 180);
            setTimeout(function () {
                clearInterval(simulateWindowResize);
            }, 1000);
        });
    },
    initCollapseArea = function () {
        "use strict";
        $('[data-toggle]').each(function () {
            var thisdiv = $(this).hasClass('card-collapse');
            $(thisdiv).addClass('collapse-preview');
        });
        $('[data-toggle="collapse-hover"]').on("hover", function () {
                var thisdiv = $(this).attr("data-target");
                if (!$(this).hasClass('state-open')) {
                    $(this).addClass('state-hover');
                    $(thisdiv).css({
                        'height'  : '30px',
                        'display' : 'block',
                        'overflow': 'hidden'
                    });
                }
            },
            function () {
                var thisdiv = $(this).attr("data-target");
                $(this).removeClass('state-hover');

                if (!$(this).hasClass('state-open')) {
                    $(thisdiv).css({
                        'height': '0px'
                    });
                }
            }).on("click", function (event) {
            event.preventDefault();
            var thisdiv = $(this).attr("data-target");
            var height = $(thisdiv).children('.card-body').height();
            if ($(this).hasClass('state-open')) {
                $(thisdiv).css({
                    'height': '0px'
                });
                $(this).removeClass('state-open');
            } else {
                $(thisdiv).css({
                    'height': height + 30
                });
                $(this).addClass('state-open');
            }
        });
    },
    apCountJS = function () {
        "use strict";
        $("[data-count=true]").each(function () {
            generateCount($(this))
        })
    },
    generateCount = function (e) {
        "use strict";
        if (!$(e).attr("data-init")) {
            var a = $(e).attr("data-number");
            var id = $(e).attr("id");
            var options = {
                useEasing  : true,
                useGrouping: true,
                separator  : ',',
                decimal    : '.',
            };
            var demo = new CountUp(id, 0, parseInt(a, 10), 0, 2.5, options);
            if (!demo.error) {
                demo.start();
            } else {
                console.error(demo.error);
            }
        }
    },
    apboxControls = function () {
        "use strict";
        var refresh = $("[data-box=refresh]");
        $(refresh).on("click", function () {
        	console.log('sd');
            dataLoadFromServer($(this).attr('data-url'));
            return false;
        });

        var fullscreen = $("[data-box=fullscreen]")
        $(fullscreen).on("click", function () {
            var self = $(this);
            var container = $(".ap-wrapper");
            console.log(container);
            if (container.hasClass("ap-full-box")) {
                $(this).text("fullscreen");
                $(container).removeClass("ap-full-box");
            } else {
                $(container).addClass("ap-full-box");
                $(this).text("fullscreen_exit");
                $(document).on("keydown", function (e) {
                    if (e.keyCode === 27) {
                        $(self).text("fullscreen");
                        $(container).removeClass("ap-full-box");
                    }
                });
            }
        });

        var close = $("[data-box=close]")
        $(close).on("click", function () {
            var container = $(this).closest(".ap-wrapper");
            $(container).addClass('removed-item')
                .one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function (e) {
                    $(this).remove();
                });
        });
    },
    apTypeitJS = function () {
        "use strict";
        $("[data-typeit=true]").each(function () {
            generateTypeit($(this))
        })
    },
    generateTypeit = function (e) {
        "use strict";
        if ("[data-typeit=true]".length !== 0) {
            var a = $.trim($(e).text());
            var id = $(e).attr("id");
            $('#' + id).typeIt({
                whatToType: a,
                typeSpeed : 100,
                cursor: true,
            });
        }
    },
    App = function () {
        "use strict";
        return {
            init               : function () {
                this.initComponent();
                this.initSidebar();
            },
            BeforeDocumentReady: function () {
                apWriteCopyrights()
            },
            initSidebar        : function () {
                var window_width;
                window_width = $(window).width();
                sideBarMenu();
                checkSidebarImage();
                if (window_width <= 991) {
                    initRightMenu();
                }
                initMinimizeSidebar();
                initCollapseArea();
                if ($("[data-toggle='switch']").length !== 0) {
                    $("[data-toggle='switch']").bootstrapSwitch();
                }
                $('body').on('touchstart.dropdown', '.dropdown-menu', function (e) {
                    e.stopPropagation();
                });
                $(window).on("resize", function () {
                    if ($(window).width() <= 991) {
                        initRightMenu();
                    }
                });
            },
            initComponent      : function () {
                apWriteCopyrights();
                apCountJS();
                apTypeitJS();
                apboxControls();
            }
        }
    }();
    
    

App.BeforeDocumentReady();
$(function () {
    App.init();
});