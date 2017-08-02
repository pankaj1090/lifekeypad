/*
Copyright (c) 2016 LifeKeypad
------------------------------------------------------------------
[Master Javascript]

Project:	LifeKeypad

-------------------------------------------------------------------*/

(function ($) {
	"use strict";
	var LifeKeypad = {
		initialised: false,
		version: 1.0,
		mobile: false,
		init: function () {

			if(!this.initialised) {
				this.initialised = true;
			} else {
				return;
			}

			/*-------------- LifeKeypad Functions Calling ---------------------------------------------------
			------------------------------------------------------------------------------------------------*/
			this.nav_toggle();
			this.play_pause_audio();
			this.custom_animation();
			this.search_box();
			this.AudioBookSlider();
			this.MasonryGrid();
                        this.PopupClose();
			
		},
		
		/*-------------- LifeKeypad Functions definition ---------------------------------------------------
		---------------------------------------------------------------------------------------------------*/
		nav_toggle: function(){
			$('.lk_nav_toggle').on('click', function(){
				$('body').toggleClass('sidebar_open');
			});
			$('.sidebar_closer').on('click', function(){
				$('body').removeClass('sidebar_open');
			});
		},
		play_pause_audio: function () {
			$('.lk_audio_control').on('mousedown', function() {
				$(this).toggleClass('pause play');
				if ($('.lk_audio_control').hasClass("pause")) {
					$('.lk_audiobook').removeClass('playing');
					$(this).parent().parent().parent().parent().addClass('playing');
				}else{
					$('.lk_audiobook').removeClass('playing');
				}
			});
		},
		custom_animation: function(){
			var wow = new WOW({
				boxClass:     'lk_anim',
				animateClass: 'lk_animated', 
				offset:       150,          
				mobile:       true,       
				live:         true        
			});
			wow.init();
		},
		search_box: function(){
			/*$('#lk_input_search').keyup(function(){
				$('.lk_search').addClass('open_autocomp');
			});*/
			$('.lk_search').mouseleave(function(){
				$('.lk_search').removeClass('open_autocomp');
			});
		},
		//Related Audiobook slider
		AudioBookSlider: function(){	
				$('.lk_audiobookslider .owl-carousel').owlCarousel({
					loop:true,
					margin:30,
					dots:false,
					nav:true,
					navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
					autoplay:false,
					responsive:{
						0:{
							items:1
						},
						600:{
							items:2
						},
						768:{
							items:4
						},
						1000:{
							items:6
						}
					}
				});
			},
                     PopupClose: function(){
			    $(".lk_closebtn").on('click', function(e){
				e.preventDefault();
				$(".lk_custompopup_wrapper").css("opacity", 0);
				$(".lk_custompopup_wrapper").css("z-index", -1);
			     });
		        },
		MasonryGrid: function(){
			if($('.grid').length > 0){		
				new AnimOnScroll( document.getElementById( 'grid' ), {
					minDuration : 0.4,
					maxDuration : 0.7,
					viewportFactor : 0.2
				} );
			}
		}

		
	};

	

	// Load Event
	$(window).on('load', function() {
		/* Trigger side menu scrollbar */
		//LifeKeypad.menuScrollbar();

		//$(".ml_loading_wrapper").delay(350).fadeOut("slow");
		
		var body_h = window.innerHeight;
		$('body').css('min-height',body_h); 
		$('.lk_collection_single_wrapper').css('min-height',body_h- 238);
		$('.lk_errorpage_wrapper, .lk_profile_setting_wrapper, .lk_cart_wrapper').css('min-height',body_h- 130);
		$('.lk_product_single_wrapper').css('min-height',body_h- 205);
		//$('.lk_custompopup_wrapper').css("opacity", 1);
		// add class on body
		setTimeout(function(){
			$('body').addClass('lk_site_loaded');
		},300);

	});

	// Resize Event
	$(window).on('resize', function () {
		var body_h = window.innerHeight;
		$('body').css('min-height',body_h);
	});

	// Scroll Event
	$(window).on('scroll', function () {
		
	});
	
	// ready function
	$(document).ready(function() {
		LifeKeypad.init();

	});

	$('#view_more_post').click(function(){
		var htmldata='<li class="shown" ><div class="lk_timelinediv"><div class="lk_postedby"><img src="http://localhost/lifekeypad/webimage/xGR3fL.png" class="img-responsive" alt=""><div class="lk_post_detail"><h5><span>zohoaudio</span>Update a Post </h5><p>1 week ago</p></div></div><img src="http://localhost/lifekeypad/repo/postimage/zgevhF.png" class="img-responsive" alt=""><div class="lk_post_img_overlay"><span><a onclick="likes(this)" data-post="10" class="liked"><i class="fa fa-heart-o"></i> <span id="like_count">2</span> Like</a></span><span><a><i class="fa fa-comment-o"></i>0  comments</a></span><span><a><i class="fa fa-eye"></i> 2 views</a></span></div></div></div></li>';
		$('.grid').append(htmldata);
		
		
	})
	

})(jQuery);