var admin;
var subscribe = false;
var closedSubscribe = false;

jQuery(document).ready(function($){

	$('.slider-wrapper [href]').click( function(e) {
		e.stopPropagation();
		e.preventDefault();
		window.open($(this).attr('href'), '_blank');
	} );

	var fixFlickty = function() {
		if ($('.slider-posts').length) {
			$('.slider-posts').each( function() {
				var mh = 0;
				$(this).find('.post .post-inner').css('height', 'auto');
				$(this).find('.post .post-inner').each( function() {
					if( $(this).height() > mh ) {
						mh = $(this).height();
					}
				} );
				$(this).find('.post .post-inner').css('height', mh+'px');
			} );
		}

		if ($('.flickity-slider').length) {
			$('.flickity-slider').each( function() {

				var mh = 0;
				$(this).find('.slider-wrapper').css('height', 'auto');
				$(this).find('.slider-wrapper').each( function() {
					if( $(this).height() > mh ) {
						mh = $(this).height();
					}
				} );
				$(this).find('.slider-wrapper').css('height', mh+'px');
			} );
		}
	}
	$(window).resize( fixFlickty );
	fixFlickty();

	if ($('body').hasClass('home')) {
		var posts = 3;
	} else {
		var posts = 2;
	}

	if ($('.flickity .post').length <= posts && $(window).outerWidth()>989) {
		$('.flickity').addClass('flex');
	} else {
		$('.flickity').flickity({
			autoPlay: false,
			wrapAround: true,
			pageDots: false,
			groupCells: 1,
			cellAlign: $(window).outerWidth()<768 ? 'center' : 'left',
			freeScroll: false,
			contain: true,
			on: {
				ready: fixFlickty,
			}
		});
	}

	if ($(window).outerWidth()<768) { 
		$('.slider-dentists').flickity({
			autoPlay: false,
			wrapAround: true,
			pageDots: false,
			groupCells: 1,
			cellAlign: 'center',
			freeScroll: false,
			contain: true,
			on: {
				ready: fixFlickty,
			}
		});
	} else {
		$('.slider-dentists').addClass('flex');
	}

	function fix_header(e){

		if ( ($('header').outerHeight() - 40 < $(window).scrollTop()) ) {
			$('header').addClass('fixed-header');
		} else {
			$('header').removeClass('fixed-header');
		}
	}
	$(window).scroll(fix_header);
	fix_header();


	$('.mobile-menu').click( function(e) {
		e.stopPropagation();
		$('body').addClass('menu-open dark');
	});

	$('.close-menu').click( function() {
		$('body').removeClass('menu-open dark');
	});


	$('body').click( function(e) {

		if ($('body.menu-open').length) {
			if (!$(e.target).closest('.main-menu').length) {
				$('body').removeClass('menu-open dark');
			}
		}
	});

	$('.close-popup').click( function() {
		closePopup();
	});

	$('.popup').click( function(e) {
		if( !$(e.target).closest('.popup-inner').length ) {
			closePopup();
		}
	} );

	showPopup = function(id, e) {
		$('#'+id).addClass('active');
		handlePopups();
		$('body').addClass('popup-open');
		$('body').removeClass('menu-open');
	}

	closePopup = function() {
		$('.popup').removeClass('active');
		$('body').removeClass('popup-open');
	}

	handlePopups = function(id) {
		$('[data-popup]').off('click').click( function(e) {
			showPopup( $(this).attr('data-popup'), e );
		} );
	}
	handlePopups();

	if(getUrlParameter('popup')) {
		showPopup( getUrlParameter('popup') );
	}

	$('.search-magnifier').click( function() {
		$('body').addClass('dark search');
		$('.search-form').show();
	});

	$('.black-overflow').click( function(e) {
		$('body').removeClass('dark search');
	});

	$('.subscribe-button').click( function() {
		$(this).closest('.subscribe-wrapper').toggleClass('active');

		if( $(window).outerWidth() <= 990 ) {
			$('.single-subscribe-button').addClass('active');
		}
	});

	$('.single-subscribe-button').click( function(e) {
		e.preventDefault();
		$('.subscribe-wrapper').toggleClass('active');
		$(this).removeClass('active');
	});

	if ($('img.aligncenter').length) {
		$('img.aligncenter').closest('p').css('text-align', 'center');
	}

	var stickyMenu = function() {
		var top = $(window).outerHeight() / 2 - 45;
		var top_cats = $(window).outerHeight() / 2 - 95 - ($('.right-inner').outerHeight() / 4);

        if( $(window).outerWidth()>989 ) {
            $(".shares-outer").stick_in_parent({ offset_top: top });
            $(".right-inner").stick_in_parent({ offset_top: top_cats });
        } else {
            $(".shares-outer").trigger("sticky_kit:detach");
            $(".right-inner").trigger("sticky_kit:detach");
        }
    }
    if ($('body').hasClass('single-post')) {
	    stickyMenu();
	    $(window).resize(stickyMenu);
	}

	$('.comment-reply-link').click( function(e) {
		e.preventDefault();

		var id = $(this).closest('.comment').attr('id');
		var res = id.split("-");
		var new_id = res[1];

		$('#respond').insertAfter($(this).closest('.comment'));
		$('#cancel-comment-reply-link').show();
		$('#reply-title').css('font-size', '0px');
		$('#comment_parent').val(new_id);
	});

	$('#cancel-comment-reply-link').click( function(e) {
		e.preventDefault();
		$('#cancel-comment-reply-link').hide();
		$('#reply-title').css('font-size', '20px');
		$('#respond').insertAfter($('.commentlist').next());
	});

    modernFieldsUpdate = function() {
	    $('.modern-input').focus( function() {
	    	$(this).closest('.modern-field').addClass('active');
	    });

	    $('.modern-input').focusout( function() {
	    	if (!$(this).val()) {
	    		$(this).closest('.modern-field').removeClass('active');
	    	}
	    });

	    if ($('.modern-input').length) {
	    	setTimeout( function() {

		    	$('.modern-input').each( function() {
		    		if ($(this).val() || $(this).is(":-webkit-autofill")) {
		    			$(this).closest('.modern-field').addClass('active');
		    		}
		    	});
	    	} , 0)
	    }
    }
    modernFieldsUpdate();

    if ($('.comment').length) {
    	$('.comment').each( function() {
	    	if ($(this).find('.children').length) {
	    		$(this).find('.comment-body').first().find('.reply').prepend('<a href="javascript:;" class="show-hide" alternative="▾ Show replies">▴ Hide replies</a>');
	    	}
    	});
    }

    $('.show-hide').off('click').click( function() {
        var tmp = $(this).attr('alternative');
        $('.show-hide').attr('alternative', $(this).text());
        $('.show-hide').html(tmp);
        $(this).closest('.comment').find('.children').toggle();
    });

    function share_buttons() {
		$('.share.fb, .share.twt, .share.in, .share.email').click( function() {
			var post_url = $(this).closest('.shares').attr('data-url');
			var post_title = $(this).closest('.shares').attr('data-title');
			if ($(this).hasClass('fb')) {
				var url = 'https://www.facebook.com/dialog/share?app_id=1906201509652855&display=popup&href=' + escape(post_url);
			} else if ($(this).hasClass('twt')) {
				var url = 'https://twitter.com/share?url=' + escape(post_url) + '&text=' + post_title;
			} else if ($(this).hasClass('in')) {
				var url = 'https://www.linkedin.com/shareArticle?mini=true&url=' + escape(post_url) + '&title=' + post_title + '&source=BlogTRP&target=new';
			} else if ($(this).hasClass('email')) {
				var url = 'mailto:?subject=' + escape(post_title);
			}
			window.open( url , 'ShareWindow', 'height=450, width=550, top=' + (jQuery(window).height() / 2 - 275) + ', left=' + (jQuery(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');

		});
	}
	share_buttons();

	if ($('.subscribe-wrapper').length && $(window).outerWidth()>989 ) {
		$('.subscribe-wrapper').css('bottom', '-'+$('.subscribe-wrapper').outerHeight()+'px');
	}

	if (!admin) {
		$.ajax({
			type: "GET",   
			url: "https://dentavox.dentacoin.com/en/status/",  
		   xhrFields: {
		      withCredentials: true
		   },
			dataType: 'json',
			success : function(text) {
				if (text) {				
					$('#email').val(text.email);
					$('#author').val(text.name);
					$('.comments-flex').hide();
				}
			}
		});
	}

	$('.scrolling').click( function(e){
        e.preventDefault();

        var id = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(id).offset().top - $('header').height() - 30
        }, 300);
    } );

    if ($('.privacy-policy-cookie').length > 0)  {

		$('.privacy-policy-cookie .accept-all').click(function()    {
			basic.cookies.set('performance_cookies', 1);
			basic.cookies.set('marketing_cookies', 1);
			basic.cookies.set('strictly_necessary_policy', 1);

			if($('#pixel-code').length) {
                $('#pixel-code').remove();
                $('head').append("<script id='pixel-code'>\
                    !function(f,b,e,v,n,t,s)\
                    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?\
                    n.callMethod.apply(n,arguments):n.queue.push(arguments)};\
                    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';\
                    n.queue=[];t=b.createElement(e);t.async=!0;\
                    t.src=v;s=b.getElementsByTagName(e)[0];\
                    s.parentNode.insertBefore(t,s)}(window,document,'script',\
                    'https://connect.facebook.net/en_US/fbevents.js');\
                    fbq('consent', 'grant');\
                    fbq('init', '2366034370318681'); \
                    fbq('track', 'PageView');\
                </script>");
            }

			$('.privacy-policy-cookie').hide();
			$('.agree-cookies').hide();
		});

		$('.adjust-cookies').click(function() {
			$('.privacy-policy-cookie').removeClass('blink');
			$('#customize-cookies').show();

			$('.close-customize-cookies-popup').click(function() {
				$('.customize-cookies').hide();
			});

			$('.custom-cookie-save').click(function() {
				basic.cookies.set('strictly_necessary_policy', 1);

				if($('#marketing-cookies').is(':checked')) {
					basic.cookies.set('marketing_cookies', 1);

					if($('#pixel-code').length) {
		                $('#pixel-code').remove();
		                $('head').append("<script id='pixel-code'>\
		                    !function(f,b,e,v,n,t,s)\
		                    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?\
		                    n.callMethod.apply(n,arguments):n.queue.push(arguments)};\
		                    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';\
		                    n.queue=[];t=b.createElement(e);t.async=!0;\
		                    t.src=v;s=b.getElementsByTagName(e)[0];\
		                    s.parentNode.insertBefore(t,s)}(window,document,'script',\
		                    'https://connect.facebook.net/en_US/fbevents.js');\
		                    fbq('consent', 'grant');\
		                    fbq('init', '2366034370318681'); \
		                    fbq('track', 'PageView');\
		                </script>");
		            }
				}

				if($('#performance-cookies').is(':checked')) {
					basic.cookies.set('performance_cookies', 1);
				}

				$('.privacy-policy-cookie').hide();
				$('.agree-cookies').hide();
			});
		});
	}

	$('.cookie-checkbox').change( function() {
		$(this).closest('label').toggleClass('active');
	});


	$('.has-cookies-button').click( function(e) {
	    if (!Cookies.get('strictly_necessary_policy')) {
	        $('.agree-cookies').show();
	        $('.privacy-policy-cookie').addClass('blink');
	        $('.bottom-drawer').css('z-index', '1010');
	        e.preventDefault();
	        e.stopPropagation();
	    }
	});

	var handleTooltip = function(e) {

        $('.tooltip-window').html($(this).attr('text'));

        if (window.innerWidth < 768) {

	        var that = $(this).closest('.tooltip-text');
	        var y = that.offset().top + that.outerHeight() + 10;
	    	var x = that.offset().left + that.outerWidth() / 2 - $('.tooltip-window').outerWidth() / 2 ;

	        $('.tooltip-window').css('left', x );
	        $('.tooltip-window').css('top', y );
        } else {

        	 $('.tooltip-window').css('left', e.pageX - ($('.tooltip-window').outerWidth() / 2) );

	        if (window.innerWidth > 768) {
		        if (window.innerWidth - $('.tooltip-window').outerWidth() - 20 < e.pageX ) {
		            $('.tooltip-window').css('left', window.innerWidth - $('.tooltip-window').outerWidth() - 20 );
		        }
		    }

	        if (window.innerWidth < 768) {
	        	$('.tooltip-window').css('top', e.pageY + 15 );
	        } else {
	        	$('.tooltip-window').css('top', e.pageY + 30 );
	        }
        }

        $('.tooltip-window').css('display', 'block');

        if ($(this).closest('.tooltip-text').hasClass('info-cookie')) {
        	$('.tooltip-window').addClass('dark-tooltip');
        } else {
        	$('.tooltip-window').removeClass('dark-tooltip');
        }
    }

    var attachTooltips = function() {
	    if($('.tooltip-text:not(.tooltip-initted)').length) {

	        $('.tooltip-text:not(.tooltip-initted)').on('mouseover mousemove', function(e) {
	            if (window.innerWidth > 768) {
	                handleTooltip.bind(this)(e);
	            }
	        });

	        $('.tooltip-text:not(.tooltip-initted)').on('click', function(e) {
	            if (window.innerWidth < 768 && !$(this).hasClass('no-mobile-tooltips')) {
	                handleTooltip.bind(this)(e);
	            }
	        });

	        $('.tooltip-text:not(.tooltip-initted)').on('mouseout', function(e) {

	            $('.tooltip-window').hide();
	        });
	        //$('.tooltip-text:not(.tooltip-initted)').addClass('tooltip-initted');
	    }
    }
    attachTooltips();

    $('.alm-load-more-btn').click( function() {
    	$('#loader').show();
    });

    if($('body').hasClass('single-post') && $('.test-box').length) {
    	$('.right-inner').css('z-index', 1000);

    	setTimeout( function() {
    		if(!closedSubscribe && $(window).scrollTop() >= 500) {

    			activeSubscribe();
    		}
    	},60000);

    	$(window).on('scroll', function() {
    		if(!closedSubscribe) {

	    		if($(window).scrollTop() <= 500) {
	    			subscribe =false;
	    			closeSubscribe();
	    		}
	    		if(!$('.subscribe-wrapper').hasClass('active') || !$('.test-box').hasClass('active')) {

		    		if($('body').outerHeight() * 0.7 < $(window).scrollTop()) {
		    			activeSubscribe();
		    		}
	    		}
    		}
    	});

    	$('.close-subscr').click( function() {
    		closedSubscribe = true;
    		closeSubscribe()
    	});

    	if($('body').outerHeight() * 0.7 < $(window).scrollTop()) {
    		setTimeout( function() {

	    		$('.test-box').css('right', '-1100px');
				$('.test-box').removeClass('active');
    		}, 10);
    	}

    	var activeSubscribe = function() {
    		$('.subscribe-wrapper').addClass('active');
			$('.test-box').css('width', $('.post-wrapper').innerWidth());
			$('.test-box').css('right', $('.test-box').outerWidth() - $('.right-inner').outerWidth());
			$('.test-box').addClass('active');
			if(!subscribe) {
		    	$( "<h3>to get the latest dental marketing tips straight to your inbox.</h3>" ).insertAfter( ".test-box h2" );
		    	$('.test-box input[type="email"]').attr('placeholder', 'Enter your email');
				subscribe = true;
			}
    	}

    	var closeSubscribe = function() {
    		$('.test-box h3').remove();
    		$('.test-box').removeClass('active');
    		$('.test-box').css('width', 'auto');
    		$('.test-box').css('right', 'auto');
    	}
    }

    $('.download-asset').click( function(e) {
    	e.preventDefault();

    	$('html, body').animate({
            scrollTop: $('.asset-form').offset().top - $('header').height() - 30
        }, 300);
    });

    console.log('sdfdsf');

    if($('.asset-form').length) {
    	$('#asset-type').val($('.asset-form').attr('type'));

    	$('#accept-privacy').find('.wpcf7-list-item-label').html($('#accept-privacy').find('.wpcf7-list-item-label').html().replace(/&lt;/g,'<').replace(/&gt;/g,'>').replace(/&amp;/g,'&'));
    }

});

window.almComplete = function(alm){
	document.getElementById("loader").style.display = "none";
	console.log('loaded');
};

var basic = {
    cookies: {
        set: function(name, value) {
            if(name == undefined){
                name = "cookieLaw";
            }
            if(value == undefined){
                value = 1;
            }
            var d = new Date();
            d.setTime(d.getTime() + (100*24*60*60*1000));
            var expires = "expires="+d.toUTCString();
            document.cookie = name + "=" + value + "; " + expires + ";domain=.dentacoin.com;path=/;secure";
            if(name == "cookieLaw"){
                $(".cookies_popup").slideUp();
            }
        },
        get: function(name) {

            if(name == undefined){
                var name = "cookieLaw";
            }
            name = name + "=";
            var ca = document.cookie.split(';');
            for(var i=0; i<ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1);
                if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
            }

            return "";
        }
    }
};


var getUrlParameter = function(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};



/*
 Sticky-kit v1.1.2 | WTFPL | Leaf Corcoran 2015 | http://leafo.net
*/
(function(){var b,f;b=this.jQuery||window.jQuery;f=b(window);b.fn.stick_in_parent=function(d){var A,w,J,n,B,K,p,q,k,E,t;null==d&&(d={});t=d.sticky_class;B=d.inner_scrolling;E=d.recalc_every;k=d.parent;q=d.offset_top;p=d.spacer;w=d.bottoming;null==q&&(q=0);null==k&&(k=void 0);null==B&&(B=!0);null==t&&(t="is_stuck");A=b(document);null==w&&(w=!0);J=function(a,d,n,C,F,u,r,G){var v,H,m,D,I,c,g,x,y,z,h,l;if(!a.data("sticky_kit")){a.data("sticky_kit",!0);I=A.height();g=a.parent();null!=k&&(g=g.closest(k));
if(!g.length)throw"failed to find stick parent";v=m=!1;(h=null!=p?p&&a.closest(p):b("<div />"))&&h.css("position",a.css("position"));x=function(){var c,f,e;if(!G&&(I=A.height(),c=parseInt(g.css("border-top-width"),10),f=parseInt(g.css("padding-top"),10),d=parseInt(g.css("padding-bottom"),10),n=g.offset().top+c+f,C=g.height(),m&&(v=m=!1,null==p&&(a.insertAfter(h),h.detach()),a.css({position:"",top:"",width:"",bottom:""}).removeClass(t),e=!0),F=a.offset().top-(parseInt(a.css("margin-top"),10)||0)-q,
u=a.outerHeight(!0),r=a.css("float"),h&&h.css({width:a.outerWidth(!0),height:u,display:a.css("display"),"vertical-align":a.css("vertical-align"),"float":r}),e))return l()};x();if(u!==C)return D=void 0,c=q,z=E,l=function(){var b,l,e,k;if(!G&&(e=!1,null!=z&&(--z,0>=z&&(z=E,x(),e=!0)),e||A.height()===I||x(),e=f.scrollTop(),null!=D&&(l=e-D),D=e,m?(w&&(k=e+u+c>C+n,v&&!k&&(v=!1,a.css({position:"fixed",bottom:"",top:c}).trigger("sticky_kit:unbottom"))),e<F&&(m=!1,c=q,null==p&&("left"!==r&&"right"!==r||a.insertAfter(h),
h.detach()),b={position:"",width:"",top:""},a.css(b).removeClass(t).trigger("sticky_kit:unstick")),B&&(b=f.height(),u+q>b&&!v&&(c-=l,c=Math.max(b-u,c),c=Math.min(q,c),m&&a.css({top:c+"px"})))):e>F&&(m=!0,b={position:"fixed",top:c},b.width="border-box"===a.css("box-sizing")?a.outerWidth()+"px":a.width()+"px",a.css(b).addClass(t),null==p&&(a.after(h),"left"!==r&&"right"!==r||h.append(a)),a.trigger("sticky_kit:stick")),m&&w&&(null==k&&(k=e+u+c>C+n),!v&&k)))return v=!0,"static"===g.css("position")&&g.css({position:"relative"}),
a.css({position:"absolute",bottom:d,top:"auto"}).trigger("sticky_kit:bottom")},y=function(){x();return l()},H=function(){G=!0;f.off("touchmove",l);f.off("scroll",l);f.off("resize",y);b(document.body).off("sticky_kit:recalc",y);a.off("sticky_kit:detach",H);a.removeData("sticky_kit");a.css({position:"",bottom:"",top:"",width:""});g.position("position","");if(m)return null==p&&("left"!==r&&"right"!==r||a.insertAfter(h),h.remove()),a.removeClass(t)},f.on("touchmove",l),f.on("scroll",l),f.on("resize",
y),b(document.body).on("sticky_kit:recalc",y),a.on("sticky_kit:detach",H),setTimeout(l,0)}};n=0;for(K=this.length;n<K;n++)d=this[n],J(b(d));return this}}).call(this);