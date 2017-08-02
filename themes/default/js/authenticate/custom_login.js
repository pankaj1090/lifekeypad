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
			
			this.search_box();
			
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
		search_box: function(){
			$('#lk_input_search').keyup(function(){
				$('.lk_search').addClass('open_autocomp');
			});
			$('.lk_search').mouseleave(function(){
				$('.lk_search').removeClass('open_autocomp');
			});
		}
		
	};

	

	// Load Event
	$(window).on('load', function() {
		/* Trigger side menu scrollbar */
		//LifeKeypad.menuScrollbar();

		//$(".ml_loading_wrapper").delay(350).fadeOut("slow");
		
		var body_h = window.innerHeight;
		$('body').css('min-height',body_h);
		
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

	
	// ready function
	$(document).ready(function() {
		LifeKeypad.init();
	});
	

})(jQuery);

function removeMessage() {
    ($(".ts_message_popup").is(".ts_popup_error") || $(".ts_message_popup").is(".ts_popup_success")) && setTimeout(function() {
        $(".ts_message_popup_text").text(""), $(".ts_message_popup").removeClass("ts_popup_error ts_popup_success")
    }, 3e3)
}

function checkformvalidation() {
    var t = 0,
        s = {};
    $(".ts_submit_wait").removeClass("hideme"), $(".validate").each(function() {
        var e = ($(this).attr("id"), $(this).parent());
        if (e.removeClass("ts_error_input"), e.removeClass("ts_success_input"), "" == $.trim($(this).val())) e.addClass("ts_error_input"), $(".ts_message_popup_text").text($("#emptyerr_text").val()), $(".ts_message_popup").addClass("ts_popup_error"), t++;
        else {
            var a = $(this).attr("class");
            if (e.addClass("ts_error_input"), -1 != a.search("username")) {
                var p = $.trim($(this).val());
                (0 == /^[a-zA-Z0-9]*$/.test(p) || p.length > 10) && ($(".ts_message_popup_text").text($("#usernameerr_text").val()), $(".ts_message_popup").addClass("ts_popup_error"), t++)
            }
            if (-1 != a.search("email")) {
                var r = $.trim($(this).val()),
                    _ = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,15}(?:\.[a-z]{2})?)$/i;
                _.test(r) || ($(".ts_message_popup_text").text($("#emailerr_text").val()), $(".ts_message_popup").addClass("ts_popup_error"), t++)
            }
            if (-1 != a.search("pwd")) {
                var o = $.trim($(this).val());
                o.length < 7 && ($(".ts_message_popup_text").text($("#pwderr_text").val()), $(".ts_message_popup").addClass("ts_popup_error"), t++)
            }
            if (-1 != a.search("repwd")) {
                var i = $.trim($(this).val()),
                    o = $.trim($(".pwd").val());
                o != i && ($(".ts_message_popup_text").text($("#repwderr_text").val()), $(".ts_message_popup").addClass("ts_popup_error"), t++)
            }
        }
        0 == t && (s[$(this).attr("id")] = $(this).val())
    }), 0 == t ? ($("#register_typepage").length > 0 ? submit_loginform(s) : "", $("#forgotpwd_typepage").length > 0 ? submit_loginform(s) : "", $("#resetpwd_typepage").length > 0 ? submit_resetpwdform(s) : "", $("#login_typepage").length > 0 ? submit_loginform(s) : "", $("#changepwdfromaccount").length > 0 ? changepwdfromaccount(s) : "") : ($(".ts_submit_wait").addClass("hideme"), removeMessage())
}


function submit_loginform(t) {
    if ($(".ts_submit_wait").removeClass("hideme"), $("#remember_me").length > 0) {
        var s = $("#remember_me:checked").length;
        t.rem_me = s
    }
    $(".validate").parent().removeClass("ts_success_input ts_error_input");
    var e = $("#basepath").val();
    $.post(e + "authenticate/getuserin_section", t, function(t, s) {
        console.log(t);
        var a = t.split("#");
        "redirect" == a[1] ? ($(".ts_message_popup_text").text($("#loginsuc_text").val()), $(".ts_message_popup").addClass("ts_popup_success"), $(".validate").parent().addClass("ts_success_input"), setInterval(function() {
            window.location = e + "dashboard"
        }, 2e3)) : "adminredirect" == a[1] ? ($(".ts_message_popup_text").text($("#loginsuc_text").val()), $(".ts_message_popup").addClass("ts_popup_success"), $(".validate").parent().addClass("ts_success_input"), setInterval(function() {
            window.location = e + "backend"
        }, 2e3)) : "email" == a[1] ? ($(".validate").parent().addClass("ts_success_input"), $(".ts_message_popup_text").text($("#forgotpwdsuc_text").val()), $(".ts_message_popup").addClass("ts_popup_success"), setInterval(function() {
            window.location = e + "authenticate/login"
        }, 5e3)) : "register" == a[1] ? ($(".validate").parent().addClass("ts_success_input"), $(".ts_message_popup_text").text($("#registersuc_text").val()), $(".ts_message_popup").addClass("ts_popup_success"), setInterval(function() {
            window.location = e + "authenticate/login"
        }, 5e3)) : 2 == a[0] ? ($(".validate").parent().addClass("ts_error_input"), $(".ts_message_popup_text").text($("#actvtacnt_text").val()), $(".ts_message_popup").addClass("ts_popup_error"), $(".ts_btn").attr("onclick", "checkformvalidation()")) : 3 == a[0] ? ($(".validate").parent().addClass("ts_error_input"), $(".ts_message_popup_text").text($("#blockacnt_text").val()), $(".ts_message_popup").addClass("ts_popup_error"), $(".ts_btn").attr("onclick", "checkformvalidation()")) : 0 == a[0] ? ($(".validate").parent().addClass("ts_error_input"), $(".ts_message_popup_text").text($("#loginerr_text").val()), $(".ts_message_popup").addClass("ts_popup_error"), $(".ts_btn").attr("onclick", "checkformvalidation()")) : 6 == a[0] ? ($(".validate").parent().addClass("ts_error_input"), $(".ts_message_popup_text").text($("#usernameexists_text").val()), $(".ts_message_popup").addClass("ts_popup_error"), $(".ts_btn").attr("onclick", "checkformvalidation()")) : 7 == a[0] ? ($(".validate").parent().addClass("ts_error_input"), $(".ts_message_popup_text").text($("#emailexists_text").val()), $(".ts_message_popup").addClass("ts_popup_error"), $(".ts_btn").attr("onclick", "checkformvalidation()")) : 5 == a[0] ? ($(".validate").parent().addClass("ts_error_input"), $(".ts_message_popup_text").text($("#forgotpwderr_text").val()), $(".ts_message_popup").addClass("ts_popup_error"), $(".ts_btn").attr("onclick", "checkformvalidation()")) : 404 == a[0] && ($(".validate").parent().addClass("ts_error_input"), $(".ts_message_popup_text").text("Server Error. Page will refreshed in 3 seconds."), $(".ts_message_popup").addClass("ts_popup_error"), setInterval(function() {
            window.location.reload(1)
        }, 3e3)), $(".ts_submit_wait").addClass("hideme"), removeMessage()
    })
}

function submit_resetpwdform(t) {
    $(".ts_btn").removeAttr("onclick"), $(".validate").parent().removeClass("ts_success_input ts_error_input");
    var s = $("#basepath").val();
    t.key = $("#pwdKey").val(), $.post(s + "authenticate/update_resetpwdform", t, function(t, e) {
        var a = t.split("#");
        "suc" == a[1] && ($(".validate").parent().addClass("ts_success_input"), $(".ts_message_popup_text").text($("#pwdchngsuc_text").val()), $(".ts_message_popup").addClass("ts_popup_success")), "ts_popup_error" == a[1] && ($(".validate").parent().addClass("ts_error_input"), $(".ts_message_popup_text").text("Server Error. Page will refreshed in 3 seconds."), $(".ts_message_popup").addClass("ts_popup_error")), setInterval(function() {
            window.location = s + "authenticate/login"
        }, 4e3)
    })
}

function changepwdfromaccount(t) {
    $(".ts_btn").removeAttr("onclick"), $(".validate").parent().removeClass("ts_success_input ts_error_input");
    var s = $("#basepath").val();
    $.post(s + "account/change_password", t, function(t, s) {
        "ts_popup_success" == t && ($(".validate").parent().addClass("ts_success_input"), $(".ts_message_popup_text").text("Password changed successfully."), $(".ts_message_popup").addClass("ts_popup_success"), setInterval(function() {
            $(".validate").parent().removeClass("ts_success_input"), $(".ts_message_popup_text").text("Password changed successfully."), $(".ts_message_popup").removeClass("ts_popup_success")
        }, 4e3)), "ts_popup_error" == t && ($(".validate").parent().addClass("ts_error_input"), $(".ts_message_popup_text").text("Server Error. Page will refreshed in 3 seconds."), $(".ts_message_popup").addClass("ts_popup_error"), setInterval(function() {
            window.location.reload(1)
        }, 3e3))
    })
}! function(t) {
    "use strict";
    var s = {
        initialised: !1,
        version: 1,
        mobile: !1,
        init: function() {
            this.initialised || (this.initialised = !0, this.Auth(), this.WindowHeight())
        },
        PreLoader: function() {
            jQuery("#status").fadeOut(), jQuery("#preloader").delay(350).fadeOut("slow")
        },
        WindowHeight: function() {
            var s = window.innerHeight;
            t(".ts_login_page").css("height", s)
        },
        Auth: function() {
            t(".validate").on("keyup", function(t) {
                t.preventDefault(), 13 == t.keyCode && checkformvalidation()
            }), t(".validate").on("blur", function() {
                var s = 0,
                    e = (t(this).attr("id"), t(this).parent());
                if (e.removeClass("ts_error_input"), e.removeClass("ts_success_input"), "" == t.trim(t(this).val())) e.addClass("ts_error_input"), e.removeClass("ts_success_input"), s++;
                else {
                    var a = t(this).attr("class");
                    if (-1 != a.search("email")) {
                        var p = t.trim(t(this).val()),
                            r = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,15}(?:\.[a-z]{2})?)$/i;
                        r.test(p) || (e.addClass("ts_error_input"), e.removeClass("ts_success_input"), s++)
                    }
                    if (-1 != a.search("pwd")) {
                        var _ = t.trim(t(this).val());
                        _.length < 7 && (e.addClass("ts_error_input"), e.removeClass("ts_success_input"), s++)
                    }
                    if (-1 != a.search("repwd")) {
                        var o = t.trim(t(this).val()),
                            _ = t.trim(t(".pwd").val());
                        _ != o && (e.addClass("ts_error_input"), e.removeClass("ts_success_input"), s++)
                    }
                }
                0 == s && (e.addClass("ts_success_input"), e.removeClass("ts_error_input"))
            })
        }
    };
    s.init(), t(window).on("load", function() {
        s.PreLoader()
    })
}(jQuery);