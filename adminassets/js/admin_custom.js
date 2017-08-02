function removeMessage() {
    ($(".ts_message_popup").is(".ts_popup_error") || $(".ts_message_popup").is(".ts_popup_success")) && setTimeout(function() {
        $(".ts_message_popup_text").text(""), $(".ts_message_popup").removeClass("ts_popup_error ts_popup_success")
    }, 3e3)
}

function updateSettings(e) {
    if ("logoform" == e) $("#logoform").submit();
    else if ("languageSettings" == e) {
        var t = $.trim($("#addnewlanguage").val()).toLowerCase(),
            s = $("#existinglanguage").val();
        if ("" != t) {
            if ("-1" != s.search(t)) return $(".ts_message_popup_text").text(t + " is already added."), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage(), !1;
            if ("-1" != s.search(" ")) return $(".ts_message_popup_text").text("Space is not allowed."), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage(), !1
        }
        $("#addnewlanguage").val(t), $("#languageForm").submit()
    } else if ("add_testi_form" == e) {
        if ("0" != $("#old_testid").val()) return $("#add_testi_form").submit(), !1;
        $(this).removeAttr("onlick");
        var a = 0;
        $(".add_testi_form").each(function() {
            "" == $.trim($(this).val()) && a++
        }), 0 == a ? $("#add_testi_form").submit() : ($(this).attr("onlick", "updateSettings('add_testi_form')"), $(".ts_message_popup_text").text("All fields are required."), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage())
    } else if ("add_cate_form" == e) {
        $(this).removeAttr("onlick");
        var a = 0;
        $(".add_cate_form").each(function() {
            "cateimage" != $(this).attr("name") && "" == $.trim($(this).val()) && a++
        });
        var p = $.trim($('input[name="cateurlname"]').val());
        if (0 == /^[a-zA-Z0-9- ]*$/.test(p)) return $(".ts_message_popup_text").text("Category URL name should not contain special characters."), $(".ts_message_popup").addClass("ts_popup_error"), a++, removeMessage(), !1;
        0 == a ? $("#add_cate_form").submit() : ($(this).attr("onlick", "updateSettings('add_cate_form')"), $(".ts_message_popup_text").text("Category name is required."), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage())
    } else if ("add_sub_cate_form" == e) {
        $(this).removeAttr("onlick");
        var a = 0;
        $(".add_sub_cate_form").each(function() {
            "" == $.trim($(this).val()) && a++
        });
        var p = $.trim($('input[name="sub_cateurlname"]').val());
        if (0 == /^[a-zA-Z0-9- ]*$/.test(p)) return $(".ts_message_popup_text").text("Sub Category URL name should not contain special characters."), $(".ts_message_popup").addClass("ts_popup_error"), a++, removeMessage(), !1;
        0 == a ? $("#add_sub_cate_form").submit() : ($(this).attr("onlick", "updateSettings('add_sub_cate_form')"), $(".ts_message_popup_text").text("Please, fill in the details."), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage())
    } else if ("add_language_cate" == e) {
        $(this).removeAttr("onlick");
        var a = 0;
        $(".add_language_cate").each(function() {
            "" == $.trim($(this).val()) && a++
        }), 0 == a ? $("#add_language_cate").submit() : ($(this).attr("onlick", "updateSettings('add_language_cate')"), $(".ts_message_popup_text").text("Please, fill in the details."), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage())
    } else {
        var o = {},
            r = {};
        $("." + e).each(function() {
            if ("-1" != $(this).attr("id").search("_checkbox")) {
                var e = $("#" + $(this).attr("id")).is(":checked") ? "1" : "0";
                o[$(this).attr("id")] = e
            } else o[$(this).attr("id")] = $.trim($(this).val())
        });
        var n = $("#basepath").val();
        r.updateform = "yes", r.updatedata = JSON.stringify(o), $.post(n + "settings/update_settingsdetails", r, function(e, t) {
            console.log(e), "1" == e ? ($(".ts_message_popup_text").text("Data updated successfully."), $(".ts_message_popup").addClass("ts_popup_success")) : ($(".ts_message_popup_text").text("Data cannot be updated."), $(".ts_message_popup").addClass("ts_popup_error")), removeMessage()
        })
    }
}

function addproductsbutton(e) {
    var t = 0,
        s = {},
        a = $.trim($("#p_name").val()),
        p = $.trim($("#p_urlname").val());
    if (0 == /^[a-zA-Z0-9- ]*$/.test(p)) return $(".ts_message_popup_text").text("URL Name should not contain special characters."), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage(), !1;
    if (a.length > 80) return $(".ts_message_popup_text").text("Name should not be more than 80 characters."), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage(), !1;
    if (p.length > 80) return $(".ts_message_popup_text").text("URL Name should not be more than 80 characters."), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage(), !1;
    if ($(".productfields").each(function() {
            var e = $.trim($(this).val());
            ("" == e || "0" == e) && t++, s[$(this).attr("id")] = e
        }), 0 != t) return $(".ts_message_popup_text").text("Star (*) mark fields are mandatory."), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage(), !1;
    var t = 0;
    if (0 == $("#p_free:checked").length) {
        if ($("#p_price").length > 0) {
            var o = $.trim($("#p_price").val());
            if ("" == o || "0" == o) return $(".ts_message_popup_text").text("Please mention the price or check it as FREE."), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage(), !1;
            s.p_price = o
        }
        if ($(".priceSettings").length > 0) {
            var r = "";
            if ($(".priceSettings").each(function() {
                    $(this).is(":checked") ? r += $(this).val() + "," : t++
                }), $(".priceSettings").length == t) return $(".ts_message_popup_text").text("Please select a plan or check it as FREE."), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage(), !1;
            s.plan_str = r
        }
        s.is_free = "0"
    } else s.is_free = "1";
    var n = $("#basepath").val();
    s.prod_id = $("#oldprod_id").val(), $(".rest_fields").each(function() {
        s[$(this).attr("id")] = $.trim($(this).val())
    });
    var t = 0;
    if ($.each(s, function(e, s) {
            return s.split("<script").length > 1 ? ($(".ts_message_popup_text").text("Input values are not valid."), $(".ts_message_popup").addClass("ts_popup_error"), t++, removeMessage(), !1) : "p_demourl" != e && "p_downlink" != e || "" == s || 1 != s.split("://").length ? "p_price" == e && 0 == $("#p_free:checked").length && isNaN(s) ? ($(".ts_message_popup_text").text("Price should be numeric only."), $(".ts_message_popup").addClass("ts_popup_error"), t++, removeMessage(), !1) : void 0 : ($(".ts_message_popup_text").text("Please, use valid links."), $(".ts_message_popup").addClass("ts_popup_error"), t++, removeMessage(), !1)
        }), $("#vendorpage").length > 0) var i = n + "vendorboard/add_products_1";
    else var i = n + "products/add_products_1";
    0 == t && $.post(i, s, function(e, t) {
        isNaN(e) ? ($(".ts_message_popup_text").text("Server error. Page will reload in 3 seconds."), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage(), setTimeout(function() {}, 3e3)) : $("#vendorpage").length > 0 ? window.location.href = n + "vendorboard/add_products_2/" + e : window.location.href = n + "products/add_products_2/" + e
    })
}

function addproductsbutton_vendors(e) {
    var t = 0,
        s = {},
        a = $.trim($("#p_name").val()),
        p = $.trim($("#p_urlname").val());
    if (0 == /^[a-zA-Z0-9- ]*$/.test(p)) return $(".ts_message_popup_text").text($("#urlnameerror").val()), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage(), !1;
    if (a.length > 80) return $(".ts_message_popup_text").text($("#prodnameerror").val()), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage(), !1;
    if (p.length > 80) return $(".ts_message_popup_text").text($("#urllengtherror").val()), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage(), !1;
    if ($(".productfields").each(function() {
            var e = $.trim($(this).val());
            ("" == e || "0" == e) && t++, s[$(this).attr("id")] = e
        }), 0 != t) return $(".ts_message_popup_text").text($("#starfielderror").val()), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage(), !1;
    var t = 0;
    if (0 == $("#p_free:checked").length) {
        if ($("#p_price").length > 0) {
            var o = $.trim($("#p_price").val());
            if ("" == o || "0" == o) return $(".ts_message_popup_text").text($("#freetexterror").val()), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage(), !1;
            s.p_price = o
        }
        if ($(".priceSettings").length > 0) {
            var r = "";
            if ($(".priceSettings").each(function() {
                    $(this).is(":checked") ? r += $(this).val() + "," : t++
                }), $(".priceSettings").length == t) return $(".ts_message_popup_text").text($("#freetext2error").val()), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage(), !1;
            s.plan_str = r
        }
        s.is_free = "0"
    } else s.is_free = "1";
    var n = $("#basepath").val();
    s.prod_id = $("#oldprod_id").val(), $(".rest_fields").each(function() {
        s[$(this).attr("id")] = $.trim($(this).val())
    });
    var t = 0;
    if ($.each(s, function(e, s) {
            return s.split("<script").length > 1 ? ($(".ts_message_popup_text").text($("#inputvalueserror").val()), $(".ts_message_popup").addClass("ts_popup_error"), t++, removeMessage(), !1) : "p_demourl" != e && "p_downlink" != e || "" == s || 1 != s.split("://").length ? "p_price" == e && 0 == $("#p_free:checked").length && isNaN(s) ? ($(".ts_message_popup_text").text($("#pricenumberrror").val()), $(".ts_message_popup").addClass("ts_popup_error"), t++, removeMessage(), !1) : void 0 : ($(".ts_message_popup_text").text($("#validlinkerror").val()), $(".ts_message_popup").addClass("ts_popup_error"), t++, removeMessage(), !1)
        }), $("#vendorpage").length > 0) var i = n + "vendorboard/add_products_1";
    else var i = n + "products/add_products_1";
    0 == t && $.post(i, s, function(e, t) {
        isNaN(e) ? ($(".ts_message_popup_text").text("Server error. Page will reload in 3 seconds."), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage(), setTimeout(function() {}, 3e3)) : $("#vendorpage").length > 0 ? window.location.href = n + "vendorboard/add_products_2/" + e : window.location.href = n + "products/add_products_2/" + e
    })
}

function updatethevalue(e, t) {
    var s = {},
        a = $(e).attr("id");
    if ("categories" == t) var p = $(e).is(":checked") ? "1" : "0";
    else var p = $(e).val();
    var o = $("#basepath").val();
    s.id = a, s.type = t, s.vlu = p, $.post(o + "settings/updatethevalue", s, function(e, t) {
        console.log(e), "1" == e ? ($(".ts_message_popup_text").text("Data updated successfully."), $(".ts_message_popup").addClass("ts_popup_success")) : ($(".ts_message_popup_text").text("Data cannot be updated."), $(".ts_message_popup").addClass("ts_popup_error")), removeMessage()
    })
}

function openEmailIntePopup(e) {
    $(".common_form").each(function() {
        $(this).is(".hideme") || $(this).addClass("hideme")
    }), $("#" + e + "_form").removeClass("hideme"), $("#myModalLabel").text("Connect to " + e), $(".theme_btn").attr("onclick", "emailintegration_fun('" + e + "')"), $("#connectemails").modal("show")
}

function openDisconnectPopup(e) {
    var t = $("#basepath").val();
    $("#dis_message").text("Do you want to disconnect " + e + " ? "), $(".dis_btn").attr("onclick", "window.location='" + t + "backend/email_integrations/" + e + "'"), $("#dis_connectemails").modal("show")
}

function emailintegration_fun(e) {
    var t = {},
        s = 0;
    $("." + e + "_cls").each(function() {
        return "" == $.trim($(this).val()) ? ($(".ts_message_popup_text").text("Fields can not be empty."), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage(), !1) : (s++, void(t[$(this).attr("id")] = $.trim($(this).val())))
    });
    var a = $("#basepath").val();
    0 != s && (t.emAppId = e, $.post(a + "backend/email_integrations_ajx", t, function(t, s) {
        "404" == t ? ($(".ts_message_popup_text").text("We can not connect to " + e), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage()) : "ZERO" == t ? ($(".ts_message_popup_text").text("Cannot find any list on " + e), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage()) : window.location.reload(1)
    }))
}

function saveListToConnect() {
    var e = {},
        t = "";
    $(".elistClasses").each(function() {
        if ($(this).is(":checked")) {
            var e = $(this).attr("id").split("_")[1];
            t += e + "@#"
        }
    }), e.newsletter_subs = $("#newsletter").is(":checked") ? "1" : "0", e.registeredemails_subs = $("#registeredemails").is(":checked") ? "1" : "0", e.contactemails_subs = $("#contactemails").is(":checked") ? "1" : "0";
    var s = {};
    s.jsondata = JSON.stringify(e), s.elistStr = t;
    var a = $("#basepath").val();
    $.post(a + "backend/saveListToConnect", s, function(e, t) {
        "1" == e ? ($(".ts_message_popup_text").text("Data updated successfully."), $(".ts_message_popup").addClass("ts_popup_success")) : ($(".ts_message_popup_text").text("Data cannot be updated."), $(".ts_message_popup").addClass("ts_popup_error")), removeMessage()
    })
}

function updateEmailtemplates(e) {
    var t = {};
    $("#" + e + "_logoshow").length > 0 && (t.logoshow = $("#" + e + "_logoshow").is(":checked") ? "1" : "0"), $("#" + e + "_replytoshow").length > 0 && (t.replytoshow = $("#" + e + "_replytoshow").is(":checked") ? "1" : "0"), $("#" + e + "_text").length > 0 && (t.emText = $("#" + e + "_text").val()), $("#" + e + "_linktext").length > 0 && (t.linktext = $("#" + e + "_linktext").val()), $("#" + e + "_fromname").length > 0 && (t.fromname = $("#" + e + "_fromname").val()), $("#" + e + "_fromemail").length > 0 && (t.fromemail = $("#" + e + "_fromemail").val()), $("#" + e + "_replyemail").length > 0 && (t.replyemail = $("#" + e + "_replyemail").val()), $("#" + e + "_contactemail").length > 0 && (t.contactemail = $("#" + e + "_contactemail").val()), t.type = e;
    var s = $("#basepath").val();
    $.post(s + "backend/email_templates", t, function(e, t) {
        "1" == e ? ($(".ts_message_popup_text").text("Template updated successfully."), $(".ts_message_popup").addClass("ts_popup_success")) : ($(".ts_message_popup_text").text("Template cannot be updated."), $(".ts_message_popup").addClass("ts_popup_error")), removeMessage()
    })
}

function sendTestEmails(e) {
    var t = {};
    t.testemail = $("#" + e + "_emailinput").val(), t.type = e;
    var s = $("#basepath").val();
    $.post(s + "backend/sendTestEmails", t, function(e, t) {
        "1" == e ? ($(".ts_message_popup_text").text("Test email has been sent successfully."), $(".ts_message_popup").addClass("ts_popup_success")) : ($(".ts_message_popup_text").text("Email cannot be sent."), $(".ts_message_popup").addClass("ts_popup_error")), removeMessage()
    })
}

function updatePaymentSettings(e) {
    var t = {},
        s = {},
        a = 0;
    if ($("." + e).each(function() {
            if ("-1" != $(this).attr("id").search("_status")) {
                var e = $("#" + $(this).attr("id")).is(":checked") ? "1" : "0";
                t[$(this).attr("id")] = e
            } else "" == $.trim($(this).val()) ? a++ : t[$(this).attr("id")] = $.trim($(this).val())
        }), "0" != a) $(".ts_message_popup_text").text("Details can not be empty."), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage();
    else {
        var p = $("#basepath").val();
        s.updateform = "yes", s.updatedata = JSON.stringify(t), $.post(p + "settings/update_settingsdetails", s, function(e, t) {
            "1" == e ? ($(".ts_message_popup_text").text("Data updated successfully."), $(".ts_message_popup").addClass("ts_popup_success")) : ($(".ts_message_popup_text").text("Data cannot be updated."), $(".ts_message_popup").addClass("ts_popup_error")), removeMessage()
        })
    }
}

function checkplanprod(e) {
    var t = $(e).val(),
        s = $(e).attr("id"),
        a = s.split("type#")[1];
    "limited" == t ? $('[data-type="planNum_' + a + '"]').css("display", "block") : $('[data-type="planNum_' + a + '"]').css("display", "none")
}

function addnewplan(e) {
    if ("products" == e) {
        pCounter++;
        var t = parseInt(100) + pCounter,
            s = $(".pHeading:last").attr("id").split("_")[1],
            a = parseInt(s) + 1,
            p = $("#plan_html_content").html();
        p = p.split("CNUM").join(a), p = p.split("UNIQNUM").join("V" + t), p = p.split("th_subheading").join("th_subheading pHeading"), $(".plan_section_div").append(p)
    } else {
        vpCounter++;
        var t = parseInt(200) + vpCounter,
            s = $(".vpHeading:last").attr("id").split("_")[1],
            a = parseInt(s) + 1,
            p = $("#vplan_html_content").html();
        p = p.split("CNUM").join(a), p = p.split("UNIQNUM").join("T" + t), p = p.split("th_subheading").join("th_subheading vpHeading"), $(".vplan_section_div").append(p)
    }
}

function save_testimonial_order() {
    var e = "";
    $(".ui-sortable-handle").each(function() {
        e += $(this).attr("id"), e += ","
    });
    var t = e.replace(/(^,)|(,$)/g, ""),
        s = $("#basepath").val();
    $.post(s + "backend/save_testimonial_order/", {
        testi_id: t
    }, function(e) {
        "1" == e ? ($(".ts_message_popup_text").text("Order updated successfully."), $(".ts_message_popup").addClass("ts_popup_success")) : ($(".ts_message_popup_text").text("Order cannot be updated."), $(".ts_message_popup").addClass("ts_popup_error")), removeMessage()
    })
}

function updatePageContent(e) {
    if (void 0 != e) {
        $(e).text("Wait");
        var t = $(e).attr("data-type"),
            s = $(e).attr("data-counter"),
            a = {},
            p = {},
            o = $("#basepath").val(),
            r = $.trim($("#page_headingV7" + s).val()),
            n = editorArr[s].getData();
        "" != r && "" != n ? (a.page_headingV71 = r, a.page_contentV71 = n, a.typee = t, p.pageSection = JSON.stringify(a), $.post(o + "backend/compliance_pages", p, function(e, t) {
            "1" == e ? ($(".ts_message_popup_text").text("Data updated successfully."), $(".ts_message_popup").addClass("ts_popup_success")) : ($(".ts_message_popup_text").text("Data cannot be updated."), $(".ts_message_popup").addClass("ts_popup_error")), removeMessage()
        })) : ($(".ts_message_popup_text").text("Fields can not be empty."), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage()), $(e).text("UPDATE")
    }
}

function select_file_type(e) {
	var v = $(e).val();
	if( v == 'Preview.mp3@#mp3,ogg,wav' ) {
		$("#audio_msg").html("Please, upload 3 format audio files ( mp3, ogg & wav) to make your product compatible for most of the existing devices.<br/>Remove the files once upload is done, by clicking CANCEL button.");
	}
	else {
		$("#audio_msg").html("");
	}
}

function submit_sort_form() {
    return $("#sort_form").submit(), !1
}

function displayDate(e) {
    var t = $(e).val();
    "custom" == t ? $(".th_datepicker").css("display", "block") : $(".th_datepicker").css("display", "none")
}

function admin_change_password() {
    var e = 0,
        t = {};
    if ($(".pwd_validate").each(function() {
            var s = $.trim($(this).val());
            s.length < 7 ? e++ : t[$(this).attr("id")] = s
        }), "0" == e)
        if (t.new_pwd == t.confirm_new_pwd) {
            var s = $("#basepath").val();
            $.post(s + "backend/admin_change_password", t, function(e, t) {
                "1" == e ? ($(".ts_message_popup_text").text("Password updated successfully."), $(".ts_message_popup").addClass("ts_popup_success"), $(".pwd_validate").val(""), $(".close").trigger("click")) : ($(".ts_message_popup_text").text("Current password is incorrect."), $(".ts_message_popup").addClass("ts_popup_error")), removeMessage()
            })
        } else $(".ts_message_popup_text").text("New and confirm password should be same."), $(".ts_message_popup").addClass("ts_popup_error");
    else $(".ts_message_popup_text").text("Passwords should be more than 7 characters."), $(".ts_message_popup").addClass("ts_popup_error");
    $(".user_name").trigger("click"), removeMessage()
}

function updateWithdrawalSettings(e) {
    var t = {},
        s = {},
        a = 0;
    if ($("." + e).each(function() {
            if ("-1" != $(this).attr("id").search("_status")) {
                var e = $("#" + $(this).attr("id")).is(":checked") ? "1" : "0";
                t[$(this).attr("id")] = e
            } else "" == $.trim($(this).val()) ? a++ : t[$(this).attr("id")] = $.trim($(this).val())
        }), "0" != a) $(".ts_message_popup_text").text("Details can not be empty."), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage();
    else {
        var p = $("#basepath").val();
        s.updateform = "yes", s.updatedata = JSON.stringify(t), $.post(p + "vendorboard/update_withdrawaldetails", s, function(e, t) {
            console.log(e), "1" == e ? ($(".ts_message_popup_text").text("Data updated successfully."), $(".ts_message_popup").addClass("ts_popup_success")) : ($(".ts_message_popup_text").text("Data cannot be updated."), $(".ts_message_popup").addClass("ts_popup_error")), removeMessage()
        })
    }
}

function updateWithdrawal() {
    var e = $("#amounttobepaid").val();
    if (isNaN(e)) $(".ts_message_popup_text").text("Amount should be numeric."), $(".ts_message_popup").addClass("ts_popup_error");
    else {
        var t = {},
            s = $("#basepath").val();
        t.amounttobepaid = $("#amounttobepaid").val(), t.paymentnote = $("#paymentnote").val(), t.vendorId = $("#vendorId").val();
        var a = $("#sendnotification:checked").length;
        t.sendnotification = a, $.post(s + "backend/updateWithdrawal", t, function(e, t) {
            console.log(e), "1" == e ? ($(".ts_message_popup_text").text("Data updated successfully."), $(".ts_message_popup").addClass("ts_popup_success"), setTimeout(function() {
                window.location.reload(1)
            }, 3e3)) : ($(".ts_message_popup_text").text("Data cannot be updated."), $(".ts_message_popup").addClass("ts_popup_error")), removeMessage()
        })
    }
}

function getSubCategories(e) {
    var t = $(e).val();
    if ("0" != t) {
        var s = {},
            a = $("#basepath").val();
        if (s.cateId = t, $("#vendorpage").length > 0) var p = a + "vendorboard/getSubCategories";
        else var p = a + "backend/getSubCategories";
        $.post(p, s, function(e, t) {
            console.log(e), $("#vendorpage").length > 0 ? "0" == e ? ($(".ts_message_popup_text").text($("#checksubcateerror").val()), $(".ts_message_popup").addClass("ts_popup_error")) : ($(".ts_message_popup_text").text($("#checksubcatetext").val()), $(".ts_message_popup").addClass("ts_popup_success"), $("#p_subcategory").html(e)) : "0" == e ? ($(".ts_message_popup_text").text("Something went wrong."), $(".ts_message_popup").addClass("ts_popup_error")) : ($(".ts_message_popup_text").text("Check sub category now."), $(".ts_message_popup").addClass("ts_popup_success"), $("#p_subcategory").html(e)), removeMessage()
        })
    } else $("#vendorpage").length > 0 ? $(".ts_message_popup_text").text($("#checksubcatetext").val()) : $(".ts_message_popup_text").text("Please, select a Category first."), $(".ts_message_popup").addClass("ts_popup_error"), removeMessage()
}! function(e) {
    "use strict";
    var t = {
        initialised: !1,
        version: 1,
        mobile: !1,
        init: function() {
            this.initialised || (this.initialised = !0, this.Initialize(), this.Auth(), this.Language(), this.RevenueJS(), this.ProductJS(), this.TransactionHistoryJS())
        },
        Initialize: function() {
            e.smoothScroll();
            var t = new WOW({
                boxClass: "wow",
                animateClass: "animated",
                offset: 0,
                mobile: !0,
                live: !0,
                callback: function(e) {}
            });
            t.init(), e(".menu_toggle").on("click", function() {
                window.innerWidth;
                e(".th_menu").toggleClass("open_menu"), e(".th_main_wrapper").toggleClass("slide_wrapper")
            }), e(".th_menu_container ul > li:has(ul) > a").on("click", function(t) {
                t.preventDefault(), e(this).parent(".th_menu_container ul li").children("ul").slideToggle()
            }), e(".th_menu_container ul li ul li a").on("click", function(t) {
                e(this).parent(".th_menu_container ul li ul li").children("ul").slideToggle()
            }), e(".user_name").on("click", function() {
                window.innerWidth;
                e(".th_user_profile").toggleClass("open_popup")
            }), e(".commonTable").length > 0 && e(".commonTable").DataTable(), e("#sortable").length > 0 && (e("#sortable").sortable(), e("#sortable").disableSelection()), e(".datepicker").length > 0 && e(".datepicker").datepicker({
                inline: !0,
                Default: !0,
                todayHighlight: !0
            }), removeMessage()
        },
        Auth: function() {
            e(".validate").on("keyup", function(e) {
                e.preventDefault(), 13 == e.keyCode && checkformvalidation()
            }), e(".validate").on("blur", function() {
                var t = 0,
                    s = (e(this).attr("id"), e(this).parent());
                if (s.removeClass("ts_error_input"), s.removeClass("ts_success_input"), "" == e.trim(e(this).val())) s.addClass("ts_error_input"), s.removeClass("ts_success_input"), t++;
                else {
                    var a = e(this).attr("class");
                    if (-1 != a.search("email")) {
                        var p = e.trim(e(this).val()),
                            o = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,15}(?:\.[a-z]{2})?)$/i;
                        o.test(p) || (s.addClass("ts_error_input"), s.removeClass("ts_success_input"), t++)
                    }
                    if (-1 != a.search("pwd")) {
                        var r = e.trim(e(this).val());
                        r.length < 7 && (s.addClass("ts_error_input"), s.removeClass("ts_success_input"), t++)
                    }
                    if (-1 != a.search("repwd")) {
                        var n = e.trim(e(this).val()),
                            r = e.trim(e(".pwd").val());
                        r != n && (s.addClass("ts_error_input"), s.removeClass("ts_success_input"), t++)
                    }
                }
                0 == t && (s.addClass("ts_success_input"), s.removeClass("ts_error_input"))
            })
        },
        Language: function() {
            e("body").on("dblclick", ".dblclicklang", function() {
                var t = e(this).text(),
                    s = e(this).attr("data-id");
                e("#langText").val(t), e("#langText").attr("data-db", s), e("#commonLanguageModel").modal("show")
            }), e(".languageUpdateBtn").on("click", function() {
                var t = e("#basepath").val(),
                    s = e("#langText").val(),
                    a = e("#langText").attr("data-db"),
                    p = {};
                p.currentText = s, p.dataId = a, e.post(t + "settings/update_languagetext", p, function(t, p) {
                    "1" == t ? (e('[ data-id = "' + a + '" ]').text(s), e(".ts_message_popup_text").text("Language updated successfully."), e(".ts_message_popup").addClass("ts_popup_success")) : (e(".ts_message_popup_text").text("Language cannot be updated."), e(".ts_message_popup").addClass("ts_popup_error")), e("#commonLanguageModel").modal("hide"), removeMessage()
                })
            })
        },
        RevenueJS: function() {
            e("#portal_revenuemodel").on("change", function() {
                var t = e(this).val();
                "subscription" == t ? (e(".plan_products_section").removeClass("hideme"), e(".prod_plan_btn").removeClass("hideme"), e(".marketvendor_commission").addClass("hideme"), e(".subscription_type").addClass("hideme"), e(".plan_vendor_section").addClass("hideme"), e(".vend_plan_btn").addClass("hideme"), e(".marketplace_vendortype").addClass("hideme")) : (e(".plan_products_section").addClass("hideme"), e(".prod_plan_btn").addClass("hideme"), e(".subscription_type").removeClass("hideme"), e(".marketplace_vendortype").removeClass("hideme"), "multi" == e("#marketplace_typevendor").val() && "plans" == e("#vendor_revenuemodel").val() ? (e(".marketvendor_commission").addClass("hideme"), e(".plan_vendor_section").removeClass("hideme"), e(".vend_plan_btn").removeClass("hideme")) : "multi" == e("#marketplace_typevendor").val() && "commission" == e("#vendor_revenuemodel").val() && (e(".marketvendor_commission").removeClass("hideme"), e(".plan_vendor_section").addClass("hideme"), e(".vend_plan_btn").addClass("hideme")))
            }), e("#marketplace_typevendor").on("change", function() {
                var t = e(this).val();
                "multi" == t ? (e(".marketplace_vendortype").removeClass("hideme"), "plans" == e("#vendor_revenuemodel").val() ? (e(".marketvendor_commission").addClass("hideme"), e(".plan_vendor_section").removeClass("hideme"), e(".vend_plan_btn").removeClass("hideme")) : (e(".marketvendor_commission").removeClass("hideme"), e(".plan_vendor_section").addClass("hideme"), e(".vend_plan_btn").addClass("hideme"))) : (e(".marketplace_vendortype").addClass("hideme"), e(".marketvendor_commission").addClass("hideme"), e(".plan_vendor_section").addClass("hideme"), e(".vend_plan_btn").addClass("hideme"))
            }), e("#vendor_revenuemodel").on("change", function() {
                var t = e(this).val();
                "plans" == t ? (e(".marketvendor_commission").addClass("hideme"), e(".plan_vendor_section").removeClass("hideme"), e(".vend_plan_btn").removeClass("hideme")) : (e(".marketvendor_commission").removeClass("hideme"), e(".plan_vendor_section").addClass("hideme"), e(".vend_plan_btn").addClass("hideme"))
            }), e("#update_revenuemodel").on("click", function() {
                var t = e("#plan_html_content").html(""),
                    s = e("#vplan_html_content").html("");
                e(this).text("WAIT"), e(this).removeAttr("id");
                var a = {},
                    p = {},
                    o = {},
                    r = {},
                    n = {},
                    i = {};
                e(".revenuefields").each(function() {
                    a[e(this).attr("id")] = e.trim(e(this).val())
                }), e(".timetype_input").each(function() {
                    p[e(this).attr("id")] = e.trim(e(this).val())
                }), e(".vendortype_input").each(function() {
                    o[e(this).attr("id")] = e.trim(e(this).val())
                });
                var _ = e("#basepath").val();
                r.updateform = "yes", r.updatedata = JSON.stringify(a), n.planupdate = "yes", n.updatedata = JSON.stringify(p), i.vplanupdate = "yes", i.updatedata = JSON.stringify(o);
                var d = e("#portal_revenuemodel").val();
                return e.post(_ + "settings/update_settingsdetails", r, function(t, s) {
                    "1" == t && ("subscription" == d ? e.post(_ + "backend/update_plantable", n, function(t, s) {
                        "1" == t && (e(".ts_message_popup_text").text("Revenue model updated successfully."), e(".ts_message_popup").addClass("ts_popup_success"))
                    }) : e.post(_ + "backend/update_vendore_plantable", i, function(t, s) {
                        "1" == t && (e(".ts_message_popup_text").text("Revenue model updated successfully."), e(".ts_message_popup").addClass("ts_popup_success"))
                    }))
                }), setTimeout(function() {
                    e(".ts_message_popup_text").text(""), e(".ts_message_popup").removeClass("ts_popup_error ts_popup_success"), e(".portalBtn").text("UPDATE"), e(".portalBtn").attr("id", "update_revenuemodel"), e("#plan_html_content").html(t), e("#vplan_html_content").html(s)
                }, 3e3), !1
            })
        },
        ProductJS: function() {
            e("#p_name").on("keyup", function() {
                var t = e(this).val().length;
                t > 79 && e(this).val(function(e, t) {
                    return t.substr(0, t.length - 1)
                }), e(".name_counter").text(80 - t)
            }), e("#p_urlname").on("keyup", function() {
                var t = e(this).val().length;
                t > 79 && e(this).val(function(e, t) {
                    return t.substr(0, t.length - 1)
                }), e(".urlname_counter").text(80 - t)
            }), e("#p_free").on("change", function() {
                1 == e("#p_free:checked").length && ("" == e('input[name="p_price"]').val() || "0" == e('input[name="p_price"]').val()) && e('input[name="p_price"]').val("1")
            })
        },
        TransactionHistoryJS: function() {
            e("body").on("click", ".detailss", function() {
                var t = e(this).attr("id");
                if (e(this).is(".bankTranscDetails")) var s = "1";
                else var s = "0";
                if (e("#vendorpage").length > 0) var a = "vendorboard";
                else var a = "backend";
                var p = e("#basepath").val(),
                    o = {};
                o.currentId = t, e.post(p + a + "/transaction_history_detail", o, function(t, a) {
                    "1" == s ? e(".transactionHeading").text("Check and Approve") : e(".transactionHeading").text("Transaction Details"), e("#trans_data").html(t), e("#transactiondetails").modal("show")
                })
            })
        }
    };
    if (t.init(), e("#file_upload_type").length > 0) {
        var s = e("#basepath").val();
        if (e("#vendorpage").length > 0) var a = s + "vendorboard/upload_prod_files",
            p = e("#cancelbtntext").val(),
            o = e("#uploadcanceltext").val(),
            r = e("#extensionerror").val(),
            n = e("#uploadsuctext").val(),
            i = e("#uploaderrortext").val();
        else var a = s + "products/upload_prod_files",
            p = "Cancel",
            o = "Do you want to cancel this upload?",
            r = "Please, check the file extension, it should match the above field.",
            n = "File uploaded successfully.",
            i = "Error in uploading file.";
        e("div#tp_upload_section").dropzone({
            paramName: "file",
            url: a,
            addRemoveLinks: !0,
            maxFilesize:1000,
            dictCancelUpload: p,
            dictCancelUploadConfirmation: o,
            dictRemoveFile: p,
            sending: function(t, s, a) {
                var p = e("#file_upload_type").val(),
                    o = p.split("@#");
                a.append("prod_id", e("#prod_id").val()), a.append("prod_type", e("#prod_type").val()), a.append("prod_name", o[0])
            },
            init: function() {
                e(".dz-default").show()
            },
            accept: function(t, s) {
                var a = t.name,
                    p = e("#file_upload_type").val(),
                    o = p.split("@#"),
                    n = o[1],
                    i = a.split(".");
                "-1" == n.indexOf(i[1]) ? (e(".ts_message_popup_text").text(r), e(".ts_message_popup").addClass("ts_popup_error"), removeMessage(), this.removeAllFiles()) : s()
            },
            success: function(t, s) {
                if(e("#file_upload_type").val() != 'Preview.mp3@#mp3,ogg,wav') {this.removeAllFiles();}
                console.log(s), "1" == s ? (e(".ts_message_popup_text").text(n), e(".ts_message_popup").addClass("ts_popup_success")) : (e(".ts_message_popup_text").text(i), e(".ts_message_popup").addClass("ts_popup_error")), removeMessage()
            }
        }), Dropzone.autoDiscover = !1
    }
}(jQuery);
var pCounter = 0,
    vpCounter = 0;