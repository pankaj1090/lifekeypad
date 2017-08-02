/*
Copyright © 2016 Themeportal
------------------------------------------------------------------
[Homepage Javascript]

Project:	Themeportal

-------------------------------------------------------------------*/

(function ($) {
	"use strict";
	var themeportal = {
		initialised: false,
		version: 1.0,
		mobile: false,
		init: function () {

			if(!this.initialised) {
				this.initialised = true;
			} else {
				return;
			}

			/*-------------- themeportal Functions Calling ---------------------------------------------------
			------------------------------------------------------------------------------------------------*/
			this.Initialize();
			this.ShowProducts();
			this.SearchSection();
			this.CartCheckout();
			this.PopupJS();
			this.RatingStar();
		},

		/*-------------- themeportal Functions definition ---------------------------------------------------
		---------------------------------------------------------------------------------------------------*/

		PreLoader: function () {
			jQuery("#status").fadeOut();
			jQuery("#preloader").delay(350).fadeOut("slow");
		},
		Initialize: function(){

            // Related Products Slider
            var owl =  $(".ts_related_themebox .owl-carousel");
            owl.owlCarousel({
                loop:true,
                items:6,
                dots: false,
                nav: true,
				navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
                animateIn: 'fadeIn',
                animateOut: 'fadeOut',
                autoHeight: false,
                touchDrag: false,
                mouseDrag: false,
                margin:10,
                autoplay:false,
                responsiveClass:true,
                responsive:{
                    0:{
                        items:2,
                    },
					420:{
                        items:3,
                    },
                    600:{
                        items:4,
                    },
					991:{
                        items:4,
                    },
                    1000:{
                        items:5,
                    },
					1199:{
                        items:6,
                    }
                }
            });

            // initialise Stellar js
               // $(window).stellar();
				
			// Second Menu Hide ShowProducts
			$("#menu_show").click(function(){
				$("#menu_hide").slideToggle();
			});

            // Menu show Hide
            var counter = 0;
            $('.ts_menu_btn').click(function(){
                if( counter == 0 ) {
                    $('.ts_main_menu_wrapper').addClass('ts_main_menu_hide');
                    $(this).children().removeAttr('class');
                    $(this).children().attr('class','fa fa-close');
                    counter++;
                }
                else {
                    $('.ts_main_menu_wrapper').removeClass('ts_main_menu_hide');
                    $(this).children().removeAttr('class');
                    $(this).children().attr('class','fa fa-bars');
                    counter--;
                }
            });

            // Main Menu on Responsive
            $('.ts_main_menu ul li a.first_sb').on('click',function() {
               $('.ts_main_menu ul li a.first_sb').not($(this)).parent('li').find('ul.sub_menu:first').slideUp(10);
               $(this).parent('li').find('ul.sub_menu:first').slideToggle(10);
              var arrow =  $(this).find('i');
              if(arrow.hasClass('fa-angle-down')){
                  arrow.attr('class','fa fa-angle-right');
              }else{
                   arrow.attr('class','fa fa-angle-down');
              }

            });

            $('.ts_main_menu ul li ul.sub_menu li a.second_sb').on('click',function() {
                $('.ts_main_menu ul li ul.sub_menu li a').not($(this)).parent('li').find('ul.sub_menu').slideUp(10);
                $(this).parent('li').find('ul.sub_menu').slideToggle(10);
                var arrow =  $(this).find('i');
                  if(arrow.hasClass('fa-angle-down')){
                      arrow.attr('class','fa fa-angle-right');
                  }else{
                       arrow.attr('class','fa fa-angle-down');
                  }
            });

		},
		ShowProducts: function () {
		    $('.cateCls').on('click',function(){
		        $('.cateCls').removeClass('ts_cate_active');
		        var idd = $(this).attr('id');
		        var basepath = $('#basepath').val();
		        var dataArr = {};
                dataArr [ 'cid' ] = idd;
                $(this).addClass('ts_cate_active');
                $.post(basepath+"home/get_ajx_products",dataArr,function(data, status) {
                   $('.LatestThemeDiv').html('');
                   $('#inside_loader').removeClass('hideme');
                   if(data != '0') {
                        var dataStr = $.parseJSON(data);
                        $('.LatestThemeDiv').html(dataStr);
                   }
                   $('#inside_loader').addClass('hideme');
                });
		    });
		},
		SearchSection: function () {
		    $('#searchInputBtn').on('click',function(){
		        internalsearchfunction();
		    });
		    $('#searchInput').on('keyup',function(event){
                event.preventDefault();
                if(event.keyCode == 13){
                    internalsearchfunction();
                }
            });
		    function internalsearchfunction() {
                var searchInput = $('#searchInput').val();
                var basepath = $('#basepath').val();

                if( searchInput != '' ) {
                    window.location.href = basepath+"home/products/"+searchInput;
                }
            }
		},
		CartCheckout: function(){
		    var basepath = $('#basepath').val();
		    $('#checkoutBtnCart').on('click',function(){
		        $('.ts_cmn_checkoutbox').each(function(){
		           if( !$(this).is('.hideme') ) {
		                $(this).addClass('hideme');
		           }
		        });
		        var whetherlogin = $('#whetherlogin').val();
		        if(whetherlogin == '1') {
		            $('#payment_checkoutbox').removeClass('hideme');
		        }
		        else {
		            $('#login_checkoutbox').removeClass('hideme');
		        }
		    });

		    $('.authenticateBtnCart').on('click',function(){
		        $('.ts_cmn_checkoutbox').each(function(){
		           if( !$(this).is('.hideme') ) {
		                $(this).addClass('hideme');
		           }
		        });
		        var type = $(this).attr('data-type');
		        $('#'+type+'_checkoutbox').removeClass('hideme');
		    });

            $('.paymentmethod').change(function(){
                var paymentmethod = $(this).val();
                $('.paymentmethod_cls').attr('src',basepath+'themes/default/images/'+paymentmethod+'_logo.png');
            });

            $('.cartloginfields').on('keyup',function(event){
                event.preventDefault();
                if(event.keyCode == 13){
                    loginfromcartpage();
                }
            });
            $('.cartregisterfields').on('keyup',function(event){
                event.preventDefault();
                if(event.keyCode == 13){
                    registerfromcartpage();
                }
            });
		},
		PopupJS: function(){
		    // popup close
            $('.ts_popup_close').on('click', function(){
               // $('.ts_popup_wrapper').addClass('popup_close');
                $('.ts_popup_wrapper').removeClass('popup_open');
            });
		},
		RatingStar: function(){
            $('.rating_star').on('click', function(){
				if( $('#login_user').val() == '1' ) {
                    var star =  $('.dw_rating_form_wrapper #rating').val().trim();
                    var review=$('.dw_rating_form_wrapper #review').val().trim();
					var dataArr = {};
					
                    dataArr['star'] = star;
                    dataArr['review']= review;
                    dataArr['product_id']=   $('.dw_rating_form_wrapper #prod_id').val().trim();

					var basepath = $('#basepath').val();
					$.post(basepath+"home/star_rating_product",dataArr,function(data, status) {
						if( data == '0' ) {
							$('.ts_message_popup_text').text('Please, login to rate the product.');
							$('.ts_message_popup').addClass('ts_popup_error');
							removeMessage();
                            $("#reviewModal").modal('hide');
							return false;
						}
                        else if(data==1){
                          $('.ts_message_popup_text').text('Thanks for rating us.');
                            $('.ts_message_popup').addClass('ts_popup_success');
                            removeMessage();
                            $("#reviewModal").modal('hide');
                            return false;
                        }
                        else if(data==2){
                            $('.ts_message_popup_text').text('Your rating updated.');
                            $('.ts_message_popup').addClass('ts_popup_success');
                            removeMessage();
                            $("#reviewModal").modal('hide');
                            return false;
                        }
						else if( data == '404' ) {
							$('.ts_message_popup_text').text('Server Error.');
							$('.ts_message_popup').addClass('ts_popup_error');
							removeMessage();
                            $("#reviewModal").modal('hide');
							return false;
						}
						else {
							$('.rating_star').removeClass('active_star');
							$('.rating_star').each(function(){
								if( $(this).attr('alt') == star || $(this).attr('alt') < star ) {
									$(this).addClass('active_star');
								}
							});
						}

					});
				}
				else {
					$('.ts_message_popup_text').text('Please, login to rate the product.');
					$('.ts_message_popup').addClass('ts_popup_error');
					removeMessage();
                    $("#reviewModal").modal('hide');
					return false;
				}
            });
		}
	};

	themeportal.init();

	// Load Event
	$(window).on('load', function() {
		themeportal.PreLoader();
	});

	// pagination form
	/*$('.ts_pagination>ul>li>a').click(function(){
		$(this).closest('.ts_pagination').append('<form method="post" style="display:none;" id="paginationForm"><input type="text" name="paginationCount" value="'+$(this).parent().attr('data')+'"></form>');
		$('#paginationForm').submit();
	});*/
	
	$('.search_pagination>ul>li>a').click(function(){
        var target = $(this).parent().attr('data-value');

		$('[name="sub_category"]').after('<input type="text" class="hide" name="paginationCount" value="'+target+'">');
		$('[name="searchInputBtn"]').trigger('click');
	});
    //pagination 
    $('.product_pagination ul li a').click(function(event){
            var target = $(this).parent().attr('data-value');
            $('#productSearchForm').append('<input type="hidden" name="formKey" value="'+target+'">');
            $('[name="searchproductBtn"]').trigger('click'); 
        });
        
	
	// MFP Popup JS
	if($('.popup-gallery').length){
	  $('.popup-gallery').magnificPopup({
	   delegate: 'a',
	   type: 'image',
	   tLoading: 'Loading image #%curr%...',
	   mainClass: 'mfp-img-mobile',
	   gallery: {
		enabled: true,
		navigateByImgClick: true,
		preload: [0,1] // Will preload 0 - before current, and 1 after the current image
	   },
	   image: {
		tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
		titleSrc: function(item) {
		 return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
		}
	   }
	  });
	 }

})(jQuery);

/********** Remove Error / Success Message *************/
function removeMessage(){
    if( $('.ts_message_popup').is('.ts_popup_error') || $('.ts_message_popup').is('.ts_popup_success') ) {
        setTimeout(function(){
            $('.ts_message_popup_text').text('');
            $('.ts_message_popup').removeClass('ts_popup_error ts_popup_success');
        }, 3000);
    }
}

/************** Subscribe Email STARTS *********************/

function subscribe_email(type){
    var em = $('#email_from_'+type).val();
    var emRegex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,15}(?:\.[a-z]{2})?)$/i;

    var err = 0;
    if( em == '' || !emRegex.test(em)) {
        $('.ts_message_popup_text').text($('#emailerr_text').val());
        $('.ts_message_popup').addClass('ts_popup_error');
        removeMessage();
        err++;
        return false;
    }

    if( err == '0' ) {
        var dataArr = {} ;
        dataArr['emails'] = em;
        dataArr['type'] = type;

        var basepath = $('#basepath').val();
        $.post(basepath+"home/subscribe_email",dataArr,function(data, status) {
            if(data != '0'){
                $('.ts_message_popup_text').text($('#newslettersucsuc_text').val());
                $('.ts_message_popup').addClass('ts_popup_success');
            }
            else {
                $('.ts_message_popup_text').text($('#newslettersucerr_text').val());
                $('.ts_message_popup').addClass('ts_popup_error');
            }
            $('#email_from_'+type).val('');
            removeMessage();
        });
    }
}

/************** Subscribe Email ENDS *********************/

/*************** Register / Login from Cart Page STARTS **************/
function registerfromcartpage(){
    $('.ts_submit_wait').removeClass('hideme');
    var uname = $.trim($('#reg_uname').val());
    var pwd = $.trim($('#reg_pwd').val());
    var email = $.trim($('#reg_email').val());
    var dataArr = {};
    if( uname != '' && pwd != '' && email != '' ) {
        var emRegex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,15}(?:\.[a-z]{2})?)$/i;

        if(!emRegex.test(email)) {
            $('.ts_message_popup_text').text($('#emailerr_text').val());
            $('.ts_message_popup').addClass('ts_popup_error');
            $('.ts_submit_wait').addClass('hideme');
            removeMessage();
            return false;
        }
        else {
            if( pwd.length > 7 ) {
                dataArr['users_uname'] = uname;
                dataArr['users_pwd'] = pwd;
                dataArr [ 'users_email' ] = email;
                getuserin_fromcart(dataArr);
                return false;
            }
            else {
                $('.ts_message_popup_text').text($('#pwderr_text').val());
                $('.ts_message_popup').addClass('ts_popup_error');
                $('.ts_submit_wait').addClass('hideme');
                removeMessage();
                return false;
            }
        }
    }
    else {
        $('.ts_message_popup_text').text($('#emptyerr_text').val());
        $('.ts_message_popup').addClass('ts_popup_error');
        $('.ts_submit_wait').addClass('hideme');
        removeMessage();
        return false;
    }
}
function loginfromcartpage() {
    $('.ts_submit_wait').removeClass('hideme');
    var uname = $.trim($('#users_uname').val());
    var pwd = $.trim($('#users_pwd').val());
    var dataArr = {};
    if( uname != '' && pwd != '' ) {

        dataArr['users_uname'] = uname;
        dataArr['users_pwd'] = pwd;
        dataArr[ 'rem_me' ] = 0;
        getuserin_fromcart(dataArr);
        return false;
    }
    else {
        $('.ts_message_popup_text').text($('#emptyerr_text').val());
        $('.ts_message_popup').addClass('ts_popup_error');
        $('.ts_submit_wait').addClass('hideme');
        removeMessage();
        return false;
    }
}

function getuserin_fromcart(dataArr){
    var basepath = $('#basepath').val();
    $.post(basepath+"authenticate/getuserin_section",dataArr,function(data, status) {
    console.log(data);
        var resStr = data.split('#');
        if(resStr[1] == 'redirect'){
            $('.ts_message_popup_text').text($('#loginsuc_text').val());
            $('.ts_message_popup').addClass('ts_popup_success');
            $('.validate').parent().addClass('ts_success_input');
            setInterval(function(){
               $('#login_checkoutbox').addClass('hideme');
               $('#payment_checkoutbox').removeClass('hideme');
            }, 2000);
        }
        else if(resStr[1] == 'adminredirect'){
            $('.ts_message_popup_text').text($('#loginsuc_text').val());
            $('.ts_message_popup').addClass('ts_popup_success');
            $('.validate').parent().addClass('ts_success_input');
            setInterval(function(){
               window.location = basepath+"backend";
            }, 2000);
        }
        else if(resStr[1] == 'register'){
            $('.validate').parent().addClass('ts_success_input');
            $('.ts_message_popup_text').text($('#registersuc_text').val());
            $('.ts_message_popup').addClass('ts_popup_success');
            setInterval(function(){
               $('#register_checkoutbox').addClass('hideme');
               $('#payment_checkoutbox').removeClass('hideme');
            }, 2000);
        }
        else if(resStr[0] == 2){
            $('.validate').parent().addClass('ts_error_input');
            $('.ts_message_popup_text').text($('#actvtacnt_text').val());
            $('.ts_message_popup').addClass('ts_popup_error');
        }
        else if(resStr[0] == 3){
            $('.validate').parent().addClass('ts_error_input');
            $('.ts_message_popup_text').text($('#blockacnt_text').val());
            $('.ts_message_popup').addClass('ts_popup_error');
        }
        else if(resStr[0] == 0){
            $('.validate').parent().addClass('ts_error_input');
            $('.ts_message_popup_text').text($('#loginerr_text').val());
            $('.ts_message_popup').addClass('ts_popup_error');
        }
        else if(resStr[0] == 6){
            $('.validate').parent().addClass('ts_error_input');
            $('.ts_message_popup_text').text($('#usernameexists_text').val());
            $('.ts_message_popup').addClass('ts_popup_error');
        }
        else if(resStr[0] == 7){
            $('.validate').parent().addClass('ts_error_input');
            $('.ts_message_popup_text').text($('#emailexists_text').val());
            $('.ts_message_popup').addClass('ts_popup_error');
        }
        $('.ts_submit_wait').addClass('hideme');
        removeMessage();
    });
}
/*************** Login from Cart Page ENDS **************/


/**************** Initiate payment after clicking Proceed STARTS ************/

function initiatepayment(){
    $('.ts_proceed_wait').removeClass('hideme');
    var paymentmethod = '';

    $('.paymentmethod').each(function(){
        paymentmethod = $(this).val();
    });
    var basepath = $('#basepath').val();
    if( paymentmethod != '' ) {
        var basepath = $('#basepath').val();
        var dataArr = {};
        dataArr [ 'paymentmethod' ] = paymentmethod;
        $.post(basepath+"shop/proceed_payment",dataArr,function(data, status) {
            console.log(data);
            if(data == '0') {
                $('.ts_message_popup_text').text('Server error.');
                $('.ts_message_popup').addClass('ts_popup_error');
                $('.ts_proceed_wait').addClass('hideme');
                window.location.reload(1);
            }
            else if(data == 'EXISTS') {
                window.location.href = basepath+"dashboard/purchased";
            }
            else if(data == 'OWNER') {
                window.location.href = basepath+"vendorboard";
            }
            else if(data == 'empty') {
                $('.ts_message_popup_text').text($('#emptycart_text').val());
                $('.ts_message_popup').addClass('ts_popup_error');
                $('.ts_proceed_wait').addClass('hideme');
            }
            else {
                $('#pay_form_box').html(data);
                if( paymentmethod == 'payu') {
                    $('form[name="payuForm"]').submit();
                }
                else if( paymentmethod == 'paypal') {
                    $('form[name="pay_form_name"]').submit();
                }
                else if( paymentmethod == 'stripe') {
                    $('.ts_proceed_wait').addClass('hideme');
                }
                else if( paymentmethod == '2checkout') {
                    $('form[name="2checkout"]').submit();
                }
                else if( paymentmethod == 'webmoney') {
                    $('form[name="pay"]').submit();
                }
				else if( paymentmethod == 'tpay') {
                    $('form[name="tpay_form_name"]').submit();
                }
                else if( paymentmethod == 'pagseguro') {
                    $('form[name="pagseguro_form_name"]').submit();
                }
                else if( paymentmethod == 'permoney') {
                    $('form[name="permoney_form_name"]').submit();
                }

            }
            removeMessage();

        });
        return false;
    }

}
/**************** Initiate payment after clicking Proceed ENDS ************/

/************** Send contact form STARTS *******************/
function sendcontactform($this){
    var err = 0;
    var dataArr = {};
    var waittext = $('#waittext').val();
    var sendtext = $('#sendtext').val();
    $($this).html(waittext+' <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
    $($this).removeAttr('onclick');
    $('.validate').each(function(){
        var v = $.trim($(this).val());
        var i = $(this).attr('id');
        if( v == '' ) {
            err++;
        }
        else {
            dataArr[i] = v;
        }
    });
    if(err == 0) {

        if( $('#email').length > 0 ) {
            var em = $('#email').val();
            var emRegex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,15}(?:\.[a-z]{2})?)$/i;
            if(!emRegex.test(em)) {
                $('.ts_message_popup_text').text($('#emailerr_text').val());
                $('.ts_message_popup').addClass('ts_popup_error');
                err++;
            }
        }

        if( err == 0 ) {
            var basepath = $('#basepath').val();
            $.post(basepath+"home/contact",dataArr,function(data, status) {
                if(data == '1') {
                    $('.ts_message_popup_text').text($('#contactsuc_text').val());
                    $('.ts_message_popup').addClass('ts_popup_success');
                }
                else {
                    $('.ts_message_popup_text').text($('#emailerr_text').val());
                    $('.ts_message_popup').addClass('ts_popup_error');
                }
                setTimeout(function(){
                    window.location.reload(1);
                }, 3000);
            });
            return false;
        }
    }
    else {
        $('.ts_message_popup_text').text($('#emptyerr_text').val());
        $('.ts_message_popup').addClass('ts_popup_error');
    }
    $($this).html(sendtext+' <i class="fa fa-rocket" aria-hidden="true"></i>');
    $($this).attr('onclick','sendcontactform(this);');
    removeMessage();
    return false;
}
/************** Send contact form ENDS *******************/

/************** Image Gallery STARTS **********************/
    function openthegalleryimages(prodId,type){
        var dataArr = {};
        dataArr['prodId'] = prodId;
        var basepath = $('#basepath').val();
        $.post(basepath+"home/getgalleryimages",dataArr,function(data, status) {
            if( data != '0' ) {
            	if( type == 'other' ) {
                	$('#popupgallery ul').append(data);
                }
            }
            $('.ts_popup_wrapper').addClass('popup_open');

        });
        return false;
    }
/************** Image Gallery ENDS **********************/

/**************** Manual Transactions START ****************/
    function transactionDone($this){
        if( $($this).is(':checked') ) {
            $('.transactionDone_div').css('display','block');
        }
        else {
            $('.transactionDone_div').css('display','none');
        }
    }

    function savetransactionmadedetails(){
        $('.ts_transactionDone_wait').removeClass('hideme');
        var txtDetails = $.trim($('.transactionDone_textarea').val());
        if( txtDetails != '' ) {
            var dataArr = {};
            dataArr['txtDetails'] = txtDetails;
            var basepath = $('#basepath').val();
            $.post(basepath+"shop/savetransactionmadedetails",dataArr,function(data, status) {
                if(data == '1') {
                    window.location = basepath+"pages/wait_for_approval";
                }
            });
        }
        else {
            $('.ts_message_popup_text').text($('#emptyerr_text').val());
            $('.ts_message_popup').addClass('ts_popup_error');
            removeMessage();
        }
    }
/**************** Manual Transactions ENDS ****************/

/**************** User to Vendor Process STARTS *******************/
    function become_a_vendor(type){
        var tnc_chek = $('#tnc:checked').length;
        if(tnc_chek == '1') {
            if( type == 'plans' ) {
                var basepath = $('#basepath').val();
                window.location = basepath+"home/vendor_plans";
            }
            else {
                var dataArr = {};
                dataArr['comm'] = 'comm';
                var basepath = $('#basepath').val();
                $.post(basepath+"dashboard/complete_vendor",dataArr,function(data, status) {
                    setTimeout(function(){
                        window.location = basepath+"vendorboard";
                    }, 3000);
                });
            }
        }
        else {
            $('.ts_message_popup_text').text($('#checkpop_error').val());
            $('.ts_message_popup').addClass('ts_popup_error');
            removeMessage();
        }
    }
/**************** User to Vendor Process ENDS *******************/
/************** Send Query form to Vendor STARTS *******************/
function sendvendorcontactform($this){
    var msg = $.trim($('#vendorMessage').val());
    $($this).removeAttr('onclick','');
    if( msg != '' ) {
        var dataArr = {};
        dataArr [ 'msg' ] = msg;
        dataArr [ 'vid' ] = $($this).attr('data-vendor');
        var basepath = $('#basepath').val();
        $.post(basepath+"home/vendor_contact",dataArr,function(data, status) {
            if(data == '1') {
                $('.ts_message_popup_text').text($('#contactsuc_text').val());
                $('.ts_message_popup').addClass('ts_popup_success');
            }
            else {
                $('.ts_message_popup_text').text($('#emptyerr_text').val());
                $('.ts_message_popup').addClass('ts_popup_error');
            }
            setTimeout(function(){
                window.location.reload(1);
            }, 3000);
        });
        return false;
    }
    else {
        $('.ts_message_popup_text').text($('#emptyerr_text').val());
        $('.ts_message_popup').addClass('ts_popup_error');
    }
    $($this).attr('onclick','sendvendorcontactform(this);');
    removeMessage();
    return false;
}
/************** Send Query form to Vendor ENDS *******************/


/******************** Play audio from Homepage STARTS***************/

function play_music(src,$this,pagetype) {
	/*if( pagetype == 'single' ) {
		$($this).html('<i class="fa fa-pause-circle" aria-hidden="true"></i> <span>Pause</span>');
	}
	else {
		$($this).html('<i class="fa fa-pause-circle" aria-hidden="true"></i>');
	}*/
	var d_a = ($($this).attr('data-audio')).split(',');
	var src_str = '';
	for(var i = 0; i < d_a.length; i++) {
		var aa = d_a[i].split('.');
		src_str += '<source src="'+src+d_a[i]+'" type="audio/'+aa[1]+'">';
	}
	$('#audio_box').html('<audio autoplay loop id="playmyaudio"> '+src_str+'Your browser does not support the audio element.</audio>');
	$($this).attr('onclick','pause_music("'+src+'","'+pagetype+'")');
	$($this).attr('id','pause_music');
	$('#play_music').trigger('click');
}

function trigger_music_play(){
	var audio = document.getElementById('playmyaudio');
	audio.paused ? audio.play() : audio.pause();
}

function pause_music(src,pagetype) {
	/*if( pagetype == 'single' ) {
		$('#pause_music').html('<i class="fa fa-play-circle" aria-hidden="true"></i> <span>Listen</span>');
	}
	else {
		$('#pause_music').html('<i class="fa fa-play-circle" aria-hidden="true"></i>');
	}
	*/
	$('#audio_box').html('');
	$('#pause_music').attr('onclick','play_music("'+src+'",this,"'+pagetype+'")');
	$('#pause_music').removeAttr('id');
}
/******************** Play audio from Homepage ENDS ***************/

/********************* Add to favorite STARTS ***************************/

function add_to_favorites(p_uniqid,$this) {
	if( $('#login_user').val() == '1' ) {
		var dataArr = {};
		dataArr['p_uniqid'] = p_uniqid;
		dataArr['fav'] = 'yes';
		var basepath = $('#basepath').val();
		$.post(basepath+"home/add_to_favorites",dataArr,function(data, status) {
			if( data == '0' ) {
				$('.ts_message_popup_text').text('Please, login to add it to favorite.');
				$('.ts_message_popup').addClass('ts_popup_error');
				removeMessage();
				return false;
			}
			else if( data == '1' ) {
				$($this).html('<i class="fa fa-thumbs-down" aria-hidden="true"></i> <div>Hate</div>');
			}
			else if( data == '2' ) {
				$($this).html('<i class="fa fa-thumbs-up" aria-hidden="true"></i> <div>Love</div>');
			}
			else {
				$('.ts_message_popup_text').text('Server Error.');
				$('.ts_message_popup').addClass('ts_popup_error');
				removeMessage();
				return false;
			}
		});
	}
	else {
		$('.ts_message_popup_text').text('Please, login to add it to favorite.');
        $('.ts_message_popup').addClass('ts_popup_error');
		removeMessage();
		return false;
	}	
}

/********************* Add to favorite ENDS ***************************/

/******************* Get Sub Categories STARTS **********************/

    function getSubCategories($this){
        var cateId = $($this).val();
        if( cateId != '0') {
            var allData = {};
            var basepath = $('#basepath').val();
            allData [ 'cateId' ] = cateId;
            $.post(basepath+"home/getSubCategories",allData,function(data, status) {
				$('select[name="sub_category"]').html(data);
			});
        }
    }
     function getSubCategoriesbylanguage($this){
        var language = $($this).val();
        if( language != '0') {
            var allData = {};
            var basepath = $('#basepath').val();
            allData [ 'language' ] = language;
            $.post(basepath+"home/getSubCategoriesbylanguage",allData,function(data, status) {
                $('select[name="sub_category"]').html(data);
            });
        }
    }
/******************* Get Sub Categories ENDS **********************/


   function sort_product(thiss){
    var current_url=window.location.href;
    var res = current_url.split("home/");
    if(res[1]=='search_products'){
     $('[name="searchInputBtn"]').trigger('click');
    }else{
    var sort_value=$(thiss).val();    
    $('#productSearchForm #sorting').val(sort_value);    
    $('[name="searchproductBtn"]').trigger('click'); 
    }
   }

   $('#withdrawal li  a').click(function(){
     var value=$(this).data('value');
      $('#withdrawal li  a').removeClass('active');
      $(this).addClass('active'); 
      if(value=='payment_detail') {
        $('#payment_detail').removeClass('hide');
        $('#paypal_detail').addClass('hide');
      }else{
        $('#paypal_detail').removeClass('hide');
        $('#payment_detail').addClass('hide')
      }         

   })

    $('.add_action').click(function(){
    var allData = {};       
    var basepath = $('#basepath').val();
    var prod_id=$(this).data('value');

     $.post(basepath+"ajax/opencollectionbox",allData,function(data, status) {
            if(data=='login'){
               location.href = basepath+"authenticate/login";
            }else{
                $('#add_collection_prod_id').val(prod_id);
                $('#tnc_collection_modal').modal('show');
            }   
        });
    
   })
   function addtocollection(){
    var allData = {};       
    var basepath = $('#basepath').val();
    var prod_id=$('#add_collection_prod_id').val();
    var col_id=$('#collection_id').val();
    if(col_id==0){
      $('.ts_message_popup_text').text('Please select a collection');
        $('.ts_message_popup').addClass('ts_popup_error');
        removeMessage();
        return false;  
    }
     allData [ 'col_id' ] = col_id;
     allData [ 'prod_id' ] = prod_id;
     $.post(basepath+"ajax/addtocollection",allData,function(data, status) {
            if(data==1){
                $('.ts_message_popup_text').text('Book successfully added in collection .');
                $('.ts_message_popup').addClass('ts_popup_success');
                removeMessage();
                $('#tnc_collection_modal').modal('hide');
            }else if(data==2){
                $('.ts_message_popup_text').text('This book already added in this collection.');
                $('.ts_message_popup').addClass('ts_popup_error');
                removeMessage();
                $('#tnc_collection_modal').modal('hide');
            }else if(data==3){
                location.href = basepath+"authenticate/login";
            }else{
              $('.ts_message_popup_text').text('you are trying to add in invalid collectiom .');
                $('.ts_message_popup').addClass('ts_popup_error');
                removeMessage();
                $('#tnc_collection_modal').modal('hide');  
            }   
        });
   }

  /* $('#create_collection').click(function(){
    var col_id=$(this).data('id');
    var col_name=$(this).data('name');
    $(".lk_custompopup_wrapper #colllection_id").val(col_id);
    $(".lk_custompopup_wrapper #new_collection_name").val(col_name);
    $(".lk_custompopup_wrapper").css("opacity", 1);
    $(".lk_custompopup_wrapper").css("z-index", 10000);
   })*/
  
  
   function open_create_collection(col_name='',col_id=''){
    $(".lk_custompopup_wrapper #colllection_id").val(col_id);
    $(".lk_custompopup_wrapper #new_collection_name").val(col_name);
    if(col_id!=''){
        $(".lk_custompopup_wrapper .lk_btn").text("Update");
         $(".lk_custompopup_wrapper h2").text("Update Collection");  
    }else{
       $(".lk_custompopup_wrapper .lk_btn").text("Create");
         $(".lk_custompopup_wrapper h2").text("Create New Collection");   
    }
    $(".collection_popup .lk_custompopup_wrapper").css("opacity", 1);
    $(".collection_popup .lk_custompopup_wrapper").css("z-index", 10000);
   }
  
  function create_collection(){
   var col_name=$('#new_collection_name').val().trim();
     if(col_name==''){
        $('.ts_message_popup_text').text('Please write collection name .');
        $('.ts_message_popup').addClass('ts_popup_error');
        removeMessage();
        return false;
     }
   }

   function delete_collection(col_id){
    var conf=confirm("Are you want to delete this collection!");
    if(!conf){
        return false;
    }else{
    var allData = {};       
    var basepath = $('#basepath').val();

     allData [ 'col_id' ] = col_id;
    
     $.post(basepath+"ajax/delete_collection",allData,function(data, status) {
            if(data==1){
                $('.ts_message_popup_text').text('Collection deleted successfully.');
                $('.ts_message_popup').addClass('ts_popup_success');
                removeMessage();
                setTimeout(function(){
                    location.href = basepath+"dashboard/my_collections";
                },3000)
            }else if(data==3){
                location.href = basepath+"authenticate/login";
            }else{
              $('.ts_message_popup_text').text('you are trying to delete  invalid collection .');
                $('.ts_message_popup').addClass('ts_popup_error');
                removeMessage();

            }   
        });
    }
  }

  
  function site_share(id='',type=''){
    var allData = {};       
    var basepath = $('#basepath').val();
     allData [ 'id' ] = id;
     allData [ 'type' ] =type;
     $.post(basepath+"ajax/site_share",allData,function(data, status) {
            if(data==1){
                $('.ts_message_popup_text').text('This ' + type + ' shared on your timeline.');
                $('.ts_message_popup').addClass('ts_popup_success');
                removeMessage();
            }else if(data==2){
              $('.ts_message_popup_text').text('This' + type + 'already shared on your timeline.');
                $('.ts_message_popup').addClass('ts_popup_error');
                removeMessage();
            }else if(data==3){
                $('.ts_message_popup_text').text('Please Login to share this '+ type);
                $('.ts_message_popup').addClass('ts_popup_error');
                removeMessage();
            }else{
               $('.ts_message_popup_text').text('you are trying to share invalid ' + type);
                $('.ts_message_popup').addClass('ts_popup_error');
                removeMessage();
               
            }   
        });
   }

   function open_create_post(){
    $(".add_post_popup .lk_custompopup_wrapper").css("opacity", 1);
    $(".add_post_popup .lk_custompopup_wrapper").css("z-index", 10000);
   }

   function check_post_validate(){
     var post_content=$('#post_form #post_content').val();
     var post_image=$('#post_form #post_image').val();
     if(post_content==''){
        if(post_image==''){
             $('.ts_message_popup_text').text('Please enter atleast one field');
            $('.ts_message_popup').addClass('ts_popup_error');
            removeMessage();
            return false;
        }
     }
     return true;
   }


//check upload image
        $(document).on('change' , '.custom_imagage' , function(){
            console.log($(this));return false;
            var file=$(this).val();
            var extension=file.split('.').pop().toUpperCase();
            if (extension!="PNG" && extension!="JPG" && extension!="GIF" && extension!="JPEG"){
              $(this).val('');
              $('.ts_message_popup_text').text('Please upload only image.');
              $('.ts_message_popup').addClass('ts_popup_error');
              removeMessage();
            }else{
                if($('#upload_text').length){
                 $('#upload_text').text(file);
               } 
            }
        });

function likes($this){
  var thiss=$this;
  post_id=$(thiss).data('post');
  like_count=parseInt($(thiss).find('#like_count').text());
  var allData = {};       
  var basepath = $('#basepath').val();
  allData [ 'post_id' ] = post_id;
  $.post(basepath+"ajax/likes",allData,function(data, status) {
        if(data==1){
            $(thiss).find('#like_count').text(like_count+1);
            $(thiss).addClass('liked');
        }else if(data==2){
           $(thiss).find('#like_count').text(like_count-1);
            $(thiss).removeClass('liked');  
        }else if(data==3){
            $('.ts_message_popup_text').text('Please Login to like this');
            $('.ts_message_popup').addClass('ts_popup_error');
            removeMessage();
        }else{
           $('.ts_message_popup_text').text('you are trying to like invalid post ' );
            $('.ts_message_popup').addClass('ts_popup_error');
            removeMessage();
           
        }   
    });
  
}
$('.lk_checkboxdiv').click(function(){
   var data_checked=$(this).data('checked');
   if(data_checked==0){
       $(this).data('checked',1);
   }else{
        $(this).data('checked',0);
   }
});
function delete_collection_data(col_id){
     var delete_ids='';
     $('.lk_checkboxdiv').each(function(){
     var data_checked=$(this).data('checked');
     if(data_checked==1){
         $(this).data('checked',1);
        delete_ids=delete_ids+','+$(this).data('id');
       }
   })

     var allData = {};       
      var basepath = $('#basepath').val();
      allData ['delete_ids'] = delete_ids;
       allData ['col_id'] = col_id;
      $.post(basepath+"ajax/delete_collection_data",allData,function(data, status) {
            if(data==1){
                $('.ts_message_popup_text').text('Books remove from collection');
                $('.ts_message_popup').addClass('ts_popup_success');
                removeMessage();
                setTimeout(function(){
                    location.reload();
                },3000)

            }else if(data==2){
               
            }else if(data==3){
                $('.ts_message_popup_text').text('Please Login to remove this');
                $('.ts_message_popup').addClass('ts_popup_error');
                removeMessage();
            }else{
               $('.ts_message_popup_text').text('yInvalid access ' );
                $('.ts_message_popup').addClass('ts_popup_error');
                removeMessage();
               
            }   
    });

    
}


$('#lk_input_search').keyup(function(){
     var keywords=$('#lk_input_search').val();
     if(keywords.length>2){
          var allData = {};       
          var basepath = $('#basepath').val();
          allData ['keywords'] = keywords;
          $.post(basepath+"ajax/autosearch",allData,function(data, status) {
              $('.lk_autocomp_box').html(data);   
        });
        $('.lk_search').addClass('open_autocomp');
       }else{
         $('.lk_autocomp_box').html('');   
       }
 });



    $('.dw_rating_div li').hover(function(){ 
    $('.dw_rating_div li').removeClass('active');
    var parentthis=$(this);
    parentindex=parentthis.data('value');
    $('.dw_rating_form_wrapper #rating').val(parentindex);
    $('.dw_rating_div li').each(function(index){
        $(this).addClass('active');
        if($(this).data('value')==parentindex){
            return false;
        }  
    })
    })

    function follow(following_uid){
      var allData = {};       
      var basepath = $('#basepath').val();
      allData ['following_uid'] = following_uid;
      $.post(basepath+"ajax/follow",allData,function(data, status) {
            if(data==1){
                $('.ts_message_popup_text').text('You are now folowing this user');
                $('.ts_message_popup').addClass('ts_popup_success');
                removeMessage();  
            }else if(data==2){
                $('.ts_message_popup_text').text('You are already following this customer');
                $('.ts_message_popup').addClass('ts_popup_error');
                removeMessage();   
            }else if(data==3){
                $('.ts_message_popup_text').text('Please Login to like this');
                $('.ts_message_popup').addClass('ts_popup_error');
                removeMessage();
            }else{
               $('.ts_message_popup_text').text('you are trying to follow blocked user ' );
                $('.ts_message_popup').addClass('ts_popup_error');
                removeMessage();
               
            }   
        });   

    }

    $('.lk_newsletterform #add_comment').click(function(e){
         e.preventDefault();
         var allData = {};       
          var basepath = $('#basepath').val();
         var com_content=  $('.lk_newsletterform #com_content').val().trim();
         if(com_content==''){
            $('.ts_message_popup_text').text('Comment cannot be empty');
            $('.ts_message_popup').addClass('ts_popup_error');
            removeMessage();
            return false;
         }
          allData ['com_post'] = $('.lk_newsletterform #com_post').val();
          allData ['com_content'] =com_content;
          $.post(basepath+"ajax/add_comment",allData,function(data, status) {
            var res=data.split("@@ss@@hh##");
                if(res[0]==1){
                   $('.lk_comment').append(res[1]);
                }else if(data==2){
                    $('.ts_message_popup_text').text('You are already following this customer');
                    $('.ts_message_popup').addClass('ts_popup_error');
                    removeMessage();   
                }else if(res[0]==3){
                    $('.ts_message_popup_text').text('Please Login to like this');
                    $('.ts_message_popup').addClass('ts_popup_error');
                    removeMessage();
                }else{
                   $('.ts_message_popup_text').text('you are trying to follow blocked user ' );
                    $('.ts_message_popup').addClass('ts_popup_error');
                    removeMessage();
                   
                }   
            });   
         
    })


   /* function open_url(urll='',post_id=''){

      var allData = {};       
      var basepath = $('#basepath').val();
      allData ['post_id'] = post_id;
      $.post(basepath+"ajax/increment_postcount",allData,function(data, status) {
        location.href=urll;  
        }); 

    }*/
  