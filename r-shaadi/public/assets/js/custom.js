var showChar = 500;  // How many characters are shown by default
var ellipsestext = "...";
var moretext = "Read Full Review";
var lesstext = "Less";
setTimeout(function() {
    $('.loader').fadeOut('fast');
}, 2000); // <-- time in milliseconds

$(window).scroll(function() {
    var scroll = $(window).scrollTop();

    if (scroll >= 500) {
        $(".navbar-default").addClass("navbar2");
    } else {
        $(".navbar-default").removeClass("navbar2");
    }
});
$('.megamenu-main').hover(function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(300);
}, function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(300);
});

$(function () {
    $('#lstFruits').multiselect({
        includeSelectAllOption: true,
        onSelectAll: function () {
            multiselect();
        },
        onDeselectAll: function () {
            multiselect();
        },
        onChange: function(element, checked) {
            multiselect();
        }
    });
    $('#btnSelected').click(function () {
        var selected = $("#lstFruits option:selected");
        var message = "";
        selected.each(function () {
            message += $(this).text() + " " + $(this).val() + "\n";
        });
        alert(message);
    });

    $( ".chnge-photo" ).click(function() {
        $( "#profile_pic" ).click();
    });

    $("#reason_type").change(function(event) {
        var elem = $(this);
        var _val = elem.val();
        if(_val != '' && _val == 'bride_groom'){
            $("#reason").closest("div.reason").removeClass('hide').addClass('show');
        }else if(_val != '' && _val == 'business'){
            $("#reason").closest("div.reason").removeClass('show').addClass('hide');
        }else{
            $("#reason").closest("div.reason").removeClass('show').addClass('hide');
        }
    });

    $('.modal').on('shown.bs.modal', function (e) {
        if(!$( "body" ).hasClass('modal-open')){
            $( "body" ).addClass('modal-open');
        }
    });

    $('.modal').on('hide.bs.modal', function (e) {
        if($( "body" ).hasClass('modal-open')){
            $( "body" ).removeClass('modal-open');
        }

        if($( "body" ).hasClass('modal-open1')){
            $( "body" ).removeClass('modal-open1');
        }
    });

    $(".location").geocomplete();

    if($("#birthdate").length>0){
        $('#birthdate').datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0",
        });
    }
});

var multiselect = function () {
    var cats = $('#lstFruits option:selected');
    var options = $('#lstFruits option:not(:selected)');

    $(options).each(function(index, option){
        var val = $(this).val();
        $("#cat"+val).removeClass("show").addClass("hide");
        $("#field"+val).remove();
        $("#vcat"+val).remove();
    });

    $(cats).each(function(index, cat){
        var val = $(this).val();
        $("#cat"+val).removeClass("hide").addClass("show");
        var hidden_field = "<input type='hidden' class='cat_type' name='cat"+val+"' id='field"+val+"' value='"+val+"'/><input type='hidden' class='vcat' name='vcat[]' id='vcat"+val+"' value='"+val+"'/>";
        $("#cat"+val).find('h3.vcategory-box-heading').after(hidden_field);
    });
}
var show_loginpopup = function () {
    $(".modal").modal("hide");
    $("#user-login-form")[0].reset();
    $("#vendor-login-form")[0].reset();
    $("#login-modal").modal("show");
}

var user_registration_popup = function (elem) {
    $(".modal").modal('hide');
    $("#user-signup-form")[0].reset();
    $("#user-signup-model").modal({ show: true });
}
$('.custom-link').click(function(){
	$('body').addClass("modal-open1");
});
var vendor_registration_popup = function (elem) {
    $(".modal").modal('hide');
    $("#vendor-signup-form")[0].reset();
    $('body').addClass("modal-open");
    $("#vendor-signup-model").modal({ show: true });
}

var forgot_password = function () {
    $(".modal").modal("hide");
    $("#forgot-password-form")[0].reset();
    $("#forgot-password-model").modal("show");
}

var ajax = function (form, formData) {
    var _form = $("#" + form);
    $.ajax({
        url: _form.attr('action'),
        type: "POST",
        data : formData,
        dataType: "json",
        beforeSend: function(){

        },
        success: function (data) {
            if (!data.error) {
                var msg = '<div class="col-sm-12 aletta"><div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data.msg + '</div></div>';
                _form[0].reset();
                _form.before(msg);
                setTimeout(function () {
                    $(".alert-success").remove();
                    _form.closest(".modal").modal('hide');
                    location.reload();
                }, 1000);
            }else if(data.validator_error && data.error) {
                var msg = '<div class="col-sm-12"><div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                $.each( data.msg, function( key, value ) {
                    msg  += value;
                });
                msg  += '</div></div>';
                _form.before(msg);
                setTimeout(function () {
                    $(".alert-danger").remove();
                }, 3000);
            }else {
                var msg = '<div class="col-sm-12"><div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data.msg + '</div></div>';
                _form.before(msg);
                setTimeout(function () {
                    $(".alert-danger").remove();
                }, 3000);
            }
        },
        error: function (jqXHR, textStatus, errorMessage) {
            var msg = '<div class="col-sm-12"><div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + errorMessage + '</div></div>';
            _form.before(msg);
            setTimeout(function () {
                $(".alert-danger").remove();
            }, 3000);
        }
    });
}

var search_service = function () {
    $("#search-service-form").submit();
}

var subscribe = function(){
    $("#subscriber-form").submit();
}

var filter = function (rating) {
    var cat = $("#category").val();
    var city = $("#city").val();
    if($("#rating").length>0){
        rating = $("#rating").val();
    }

    if((cat.trim() && cat.trim() !='') && (city.trim() && city.trim() !='') && (rating.trim() && rating.trim() !='')){
        window.location.href = url+"/service/filter?category=" +cat.trim()+"&city="+city.trim()+"&rating="+rating.trim();
    }else if((cat.trim() && cat.trim() !='') || (city.trim() && city.trim() !='') || (rating.trim() && rating.trim() !='')){
        if((cat.trim() && cat.trim() !='') && (city.trim() && city.trim() !='')){
            window.location.href = url+"/service/filter?category=" +cat.trim()+"&city="+city.trim();
        }

        else if((city.trim() && city.trim() !='') && (rating.trim() && rating.trim() !='')){
            window.location.href = url+"/service/filter?city="+city.trim()+"&rating="+rating.trim();
        }

        else if((cat.trim() && cat.trim() !='') && (rating.trim() && rating.trim() !='')){
            window.location.href = url+"/service/filter?category=" +cat.trim()+"&rating="+rating.trim();
        }

        else if((cat.trim() && cat.trim() !='')){
            window.location.href = url+"/service/filter?category="+cat.trim();
        }

        else if((city.trim() && city.trim() !='')){
            window.location.href = url+"/service/filter?city="+city.trim();
        }

        else if((rating.trim() && rating.trim() !='')){
            window.location.href = url+"/service/filter?rating="+rating.trim();
        }
    }else{
        window.location.href= url+'/listings';
    }
}



var show_more = function(){
    var i = 1;
$('.more').each(function() {
    var content = $(this).html();
    if(content.length > showChar) {

        var c = content.substr(0, showChar);
        var h = content.substr(showChar, content.length - showChar);

        var html = c + '<span class="col-sm-12 p0 moreellipses">' + ellipsestext+ '&nbsp;</span><span class="col-sm-12 p0 morecontent"><span class="col-sm-12 p0">' + h + '</span>&nbsp;&nbsp;<a id="more'+i+'" href="javascript:void(0);" onclick="morelink(this)" class="morelink">' + moretext + '</a></span>';

        $(this).html(html);
        i++;
    }

});
}

var morelink = function(elem)
{
    var _id = elem.id;
    if($("#"+_id).hasClass("less")) {
        $("#"+_id).removeClass("less");
        $("#"+_id).html(moretext);
    } else {
        $("#"+_id).addClass("less");
        $("#"+_id).html(lesstext);
    }
    $("#"+_id).parent().prev().toggle();
    $("#"+_id).prev().toggle();
    return false;
}

var serach_vendor= function () {
    var search = $("#search").val();
    if(search.trim() && search.trim() !=''){
        window.location.href = url+"/search?search=" +search.trim();
    }else{
        bootbox.alert('<div class="alert alert-danger">Please enter vendor name before the search</div>');
    }
}

var submit_vendor = function(){
    var search = $("#search").val();
    if (event.which == 13 && search.trim() && search.trim() !='') {
        event.preventDefault();
        window.location.href = url+"/search?search=" +search.trim();
    }
}

/*document.getElementById('search').onkeydown = function(e){
   if(e.keyCode == 13){
     window.location.href = url+"/search?vendor=" +search.trim();
   }else{
        bootbox.alert('<div class="alert alert-danger">Please enter vendor name before the search</div>');
    }
};*/
/* For Login with Facebook */
window.fbAsyncInit = function () {
    FB.init({
        appId: '280506745721657',
        cookie: true,
        xfbml: true,
        oauth: true
    });
};

(function (d) {
    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement('script');
    js.id = id;
    js.async = true;
    js.src = "//connect.facebook.net/en_US/all.js";
    ref.parentNode.insertBefore(js, ref);
}(document));

function facebookLogin() {
    FB.login(function (response) {
        if (response.authResponse) {
            window.location.href = "redirect";
        }
    }, {scope: 'public_profile,publish_actions,email'});
}
/* End Login with Facebook */

$('document').ready(function() {
    /*For Show more and show less review content */
    var showChar = 500;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Read Full Review";
    var lesstext = "Less";


    $('.more').each(function() {
        var content = $(this).html();
        if(content.length > showChar) {

            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);

            var html = c + '<span class="col-sm-12 p0 moreellipses">' + ellipsestext+ '&nbsp;</span><span class="col-sm-12 p0 morecontent"><span class="col-sm-12 p0">' + h + '</span>&nbsp;&nbsp;<a href="javascript:void(0);" class="morelink">' + moretext + '</a></span>';

            $(this).html(html);
        }

    });

    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
    /* End */

    $('#rating-input').rating({
        filledStar: '<i class="fa fa-star"></i>',
        emptyStar: '<i class="fa fa-star-o"></i>',
        showCaption: false,
    });

    $('.recent-review').rating({
        displayOnly: true,
        filledStar: '<i class="fa fa-star"></i>',
        emptyStar: '<i class="fa fa-star-o"></i>',
        //showCaption: false,
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /* For Services registration form validation */
    $("#user-signup-form").validate({
        rules:
            {
                firstname: {
                    required: true,
                },
                lastname: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                },
                upassword: {
                    required: true,
                },
                upassword_confirmation: {
                    required: true,
                    equalTo: '#upassword'
                },
            },
        messages:
            {
                firstname: "Firstname field is required.",
                lastname: "Lastname field is required.",
                email:{
                    required: "Email field is required",
                    email: "Please enter a valid email.",
                },
                upassword: "Please enter a valid email.",
                upassword_confirmation:{
                    required: "Enter valid new confirm password.",
                    equalTo: "Passwords did not match! retype new confirm password."
                },
            },
        submitHandler: function(form) {
            var _form = $("#" + form.id);
            var formData = _form.serialize()+ "&type=1";
            ajax(form.id,formData);
        }
    });
    /* End Normal User registration form validation */

    /* For vendor registration form validation */
    $("#vendor-signup-form").validate({
            rules:
                {
                    vendor_company_name: {
                        required: true,
                    },
                    vendor_firstname: {
                        required: true,
                    },
                    vendor_lastname: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    vpassword: {
                        required: true,
                    },
                    vpassword_confirmation: {
                        required: true,
                        equalTo: '#vpassword',
                    },
                    category: {
                        required: true,
                    },
                },
            messages:
                {
                    vendor_company_name: "Company Name field is required.",
                    vendor_firstname: "Firstname field is required.",
                    vendor_lastname: "Lastname field is required.",
                    email:{
                    required: "Email field is required",
                    email: "Please enter a valid email.",
                },
                    vpassword: "Please enter a valid email.",
                    vpassword_confirmation:{
                        required: "Enter valid new confirm password.",
                        equalTo: "Passwords did not match! retype new confirm password.",
                    },
                    category: "Please select valid category.",
                },
        submitHandler: function(form) {
            var _form = $("#" + form.id);
            var formData = _form.serialize()+ "&type=2";
            ajax(form.id,formData);
        }
    });
    /* End Vendor registration form validation */

    /* For user login form validation */
    $("#user-login-form").validate({
        rules:
            {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                },
            },
        messages:
            {
                email: "Enter a valid email.",
                password:{
                    required: "Enter valid password.",
                },
            },
        submitHandler: function(form) {
            var _form = $("#" + form.id);
            var formData = _form.serialize()+ "&type=1";
            ajax(form.id,formData);
        }
    });
    /* End login form validation */

    /* For vendor login form validation */
    $("#vendor-login-form").validate({
        rules:
            {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                },
            },
        messages:
            {
                email: "Enter a valid email.",
                password:{
                    required: "Enter valid password.",
                },
            },
        submitHandler: function(form) {
            var _form = $("#" + form.id);
            var formData = _form.serialize()+ "&type=2";
            ajax(form.id,formData);
        }
    });
    /* End login form validation */

    /* For Vendor Custom Url Validation Rules */
        $.validator.addMethod("complete_url", function(value, element) { 
            if(value.substr(0,7) != 'http://'){
                value = 'http://' + value;
            }
            if(value.substr(value.length-1, 1) != '/'){
                value = value + '/';
            }
            return this.optional(element) || /^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test(value); 
        });
    /* End */

    /* For vendor information form validation */
    $("#vendor-info-form").validate({
        rules:
            {
                firstname: {
                    required: true,
                },
                lastname: {
                    required: true,
                },
                company_name: {
                    required: true,
                },
                contact_email: {
                    email: true
                },
                area_code: {
                    number: true,
                },
                phone_number: {
                    number: true,
                },
                category: {
                    required: true,
                },
                about_me: {
                    maxlength: 1200,
                },

                website_url: {
                    url: "complete_url",
                },

                facebook_url: {
                    url: "complete_url",
                },

                instagram_url: {
                    url: "complete_url",
                },

                twitter_url: {
                    url: "complete_url",
                },

                youtube_url: {
                    url: "complete_url",
                },
            },
        messages:
            {
                firstname: "Firstname field is required.",
                lastname: "Lastname field is required.",
                company_name: "Company Name field is required.",
                contact_email: "Enter a valid email.",
                phone_number: {
                    number: "Only numeric values are valid."
                },
                area_code: {
                    number: "Only numeric values are valid."
                },
                category: {
                    required: "Category field is required.",
                },
                website_url: {
                    url: "Please enter valid url",
                },

                facebook_url: {
                    url: "Please enter valid url",
                },

                instagram_url: {
                   url: "Please enter valid url",
                },

                twitter_url: {
                    url: "Please enter valid url",
                },

                youtube_url: {
                    url: "Please enter valid url",
                },
            },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "gender") {
                element.closest('.col-sm-12').after(error);
            } else {
                error.insertBefore(element);
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    /* End Vendor vendor info form validation */

    /* For Services registration form validation */
    $("#reset-password-form").validate({
        rules:
            {
                old_password: {
                    required: true,
                },
                new_password: {
                    required: true,
                },
                confirm_new_password: {
                    required: true,
                    equalTo: '#new_password'
                },
            },
        messages:
            {
                old_password: "Old password field is required.",
                new_password: "New password field is required.",
                confirm_new_password:{
                    required: "Enter valid new confirm password.",
                    equalTo: "Passwords did not match! retype new confirm password."
                },
            },
        submitHandler: function(form) {
            form.submit();
        }
    });
    /* End Normal User registration form validation */

    /* For gallary form validation */
    $("#gallary-form").validate({
        rules:
            {
                banner: {
                    required: true,
                },
                gallary: {
                    required: true,
                },
            },
        message:
            {
                banner: {
                    required: "Please upload banner image",
                },
                gallary: {
                    required: "Please upload gallary images",
                },
            },
        errorPlacement: function(error, element) {
            element.closest('div.controls').append(error);
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    /* For vendor service information form validation */
    $("#vendor-service-form").validate({
        rules:
            {
                vendor_category: {
                    required: true,
                },
                vanue_min_price: {
                    number: true,
                    min: '#vanue_max_price',
                },
                vanue_max_price: {
                    number: true,
                },
                bridal_makeup_starting_price: {
                    number: true,
                },
                videographer_starting_price: {
                    number: true,
                },
                photographer_starting_price: {
                    number: true,
                },
                /*additional_cat: {
                    required: true,
                },*/
            },
        messages:
            {
                vendor_category: {
                    required: "Please select vandor category",
                },

                vanue_min_price: {
                    number: "Only numeric value are valid.",
                },
                vanue_max_price: {
                    number: "Only numeric value are valid.",
                },
                bridal_makeup_starting_price: {
                    number: "Only numeric value are valid",
                },
                videographer_starting_price: {
                    number: "Only numeric value are valid",
                },
                photographer_starting_price: {
                    number: "Only numeric value are valid",
                },
                /*additional_cat: {
                    required: "Please select additional category",
                },*/
            },
        errorPlacement: function(error, element) {
            element.closest('div').append(error);
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    /* End Vendor vendor service info form validation */

    /* For user information form validation */
    $("#user-info-form").validate({
        rules:
            {
                firstname: {
                    required: true,
                },
                lastname: {
                    required: true,
                },
                gender: {
                    required: true,
                },
            },
        messages:
            {
                firstname: {
                    required: "Firstname field is required.",
                },
                lastname: {
                    required: "Lastname field is required.",
                },
                gender: {
                    required: "Please select your gender.",
                },
            },
        errorPlacement: function(error, element) {
            error.insertBefore(element);
            if (element.attr("name") == "gender") {
                element.closest('.col-sm-12').after(error);
            } else {
                error.insertBefore(element);
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    /* End Vendor vendor info form validation */

    /*For validate profile pic */
    $("#profile_pic").on('change', function () {
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            var error = "Only "+fileExtension.join(', ')+"formats are allowed.";
            $(this).val("").clone(true);
            var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+error+'</div>';
            $("#alert-modal").find(".modal-body").html(msg);
            $("#alert-modal").modal("show");
            setTimeout(function(){
                $("#alert-modal").find(".modal-body").empty();
                $("#alert-modal").modal("hide");
            }, 3500);

        }else{
            $(this).closest("form").submit();
        }
    });
    /* End */

    /* For review rating form validation */
    $("#review-rating-form").validate({
        rules:
            {
                review: {
                    required: true,
                },
            },
        message:
            {
                review: {
                    required: "Please write something in review field",
                },
            },
        /*errorPlacement: function(error, element) {
            element.closest('div.controls').append(error);
        },*/
        submitHandler: function(form) {
            if(is_login) {
                if($("#anonymous").length>0){
                    $('#anonymous_confirmation').prop('checked', false);
                    $("#anonymous").closest('div.form-group').remove();
                }
                $("#review-confirm").modal("show");
            }else{
                show_loginpopup();
            }
        }
    });
    /* End */

    /* For review-confirm-form  */
    $('#review-confirm-form').validate({
        rules:
        {
            optradio: {
                required: true
            },
        },
        message:
        {
            optradio: {
                required: "Please select your anonymous choice",
            },
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "optradio") {
                element.closest('.checkbox').append(error);
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            if(is_login) {
                var anonymous = $('input[name=optradio]:checked').val();
                var _form = $("#review-rating-form");
                var formData = _form.serialize();
                formData = formData + "&anonymous="+anonymous;
                
                $.ajax({
                    url: _form.attr('action'),
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    asynch: false,
                    beforeSend: function () {
                        _form.find("#submit-btn").attr('disabled', 'disabled');
                    },
                    success: function (data) {
                        if($("#anonymous").length>0){
                            $('#anonymous_confirmation').prop('checked', false);
                            $("#anonymous").closest('div.form-group').remove();
                        }
                        $("#review-confirm").modal("hide");
                        if (!data.error) {
                            var msg = '<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data.msg + '</div>';
                            _form[0].reset();
                            _form.prepend(msg);
                            setTimeout(function () {
                                _form.find(".alert-success").remove();
                                _form.find("#submit-btn").removeAttr('disabled');
                            }, 4000);
                        } else {
                            var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data.msg + '</div>';
                            _form.prepend(msg);
                            setTimeout(function () {
                                _form.find(".alert-danger").remove();
                                _form.find("#submit-btn").removeAttr('disabled');
                            }, 4000);
                        }
                    },
                    error: function (jqXHR, textStatus, errorMessage) {
                        _form[0].reset();
                        var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + errorMessage + '</div>';
                        _form.prepend(msg);
                        setTimeout(function () {
                            _form.find(".alert-danger").remove();
                            _form.find("#submit-btn").removeAttr('disabled');
                        }, 4000);
                    }
                });
            }else{
                show_loginpopup();
            }
        }
    });
    /* End */

    /* For bookmark vendor by user */
    $(document).on("click",".bookmark", function (e) {
            e.preventDefault();
            if(is_login){
                var _this = $(this);
                var url = _this.attr("href");
                var token = $('meta[name="csrf-token"]').attr('content');
                $.post(url, {_token:token}, function (data) {
                    if (!data.error) {
                        var html = '<a href="'+data.url+'" class="unbookmark unbookmark-'+data.id+'"> <i class="fa fa-bookmark bokmarkic"></i> </a>';
                        $(".bookmark-"+data.id).replaceWith(html);
                    } else {
                        var msg = '<div class="alert alert-danger">' + data.msg + '</div>';
                        bootbox.alert(msg);
                    }
                }, "json");
            }else{
                show_loginpopup();
            }
        })
    /* End */

    /* For unbookmark vendor by user */
    $(document).on("click",".unbookmark", function (e) {
        e.preventDefault();
        if(is_login){
            var _this = $(this);
            var url = _this.attr("href");
            var token = $('meta[name="csrf-token"]').attr('content');
            $.post(url, {_token:token}, function (data) {
                if (!data.error) {
                    var html = '<a href="'+data.url+'" class="bookmark bookmark-'+data.id+'"> <i class="fa fa-bookmark-o bokmarkic"></i> </a>';
                    $(".unbookmark-"+data.id).replaceWith(html);
                } else {
                    var msg = '<div class="alert alert-danger">' + data.msg + '</div>';
                    bootbox.alert(msg);
                }
            }, "json");
        }else{
            show_loginpopup();
        }
    })
    /* End */

    /* For remove bookmark vendor by user */
    $(document).on("click",".remove-bookmark", function (e) {
        e.preventDefault();
        if(is_login){
            var _this = $(this);
            var url = _this.attr("href");
            var token = $('meta[name="csrf-token"]').attr('content');
            bootbox.confirm("Are you sure you want to remove this vendor from your bookmarks?", function(result) {
                if (result) {
                    $.post(url, {_token:token}, function (data) {
                        if (!data.error) {
                            _this.closest('tr').remove();
                        } else {
                            var msg = '<div class="alert alert-danger">' + data.msg + '</div>';
                            bootbox.alert(msg);
                        }
                    }, "json");
                }
            });
        }else{
            show_loginpopup();
        }
    })
    /* End */

    /* For filter vendor services */
    $(document).on("change",".filter", function () {
       filter('');
    });
    /* End */

    /* For filter vendor services by rating*/
    $(document).on("click",".rating-filter", function () {
        var elem = $(this);
        var rating = elem.attr("data-val");
        elem.append("<input type='hidden' id='rating' name='rating' value='"+rating+"'>");
        filter(rating);
    });
    /* End */

    /* For filter vendor services by rating*/
    $(document).on("click",".clear-rating", function () {
        var elem = $(this);
        var rating = '';
        elem.append("<input type='hidden' id='rating' name='rating' value='"+rating+"'>");
        filter(rating);
    });
    /* End */

    $(".filter_location")
    .geocomplete()
    .bind("geocode:result", function (event, result) {
        var cat = $("#category").val();
        var city = $("#city").val();

        if((cat.trim() && cat.trim() !='') && (city.trim() && city.trim() !='')){
            window.location.href = url+"/service/filter?category=" +cat.trim()+"&city="+city.trim();
        }else if((cat.trim() && cat.trim() !='') || (city.trim() && city.trim() !='')){
            if((cat.trim() && cat.trim() !='')){
                window.location.href = url+"/service/filter?category="+cat.trim();
            }

            if((city.trim() && city.trim() !='')){
                window.location.href = url+"/service/filter?city="+city.trim();
            }
        }else{
            window.location.href= url+'/listings';
        }
    });

    /*----- For submit subscriber form -----*/
    $("#subscriber-form").validate({
        rules:
            {
                email: {
                    email: true
                },
            },
        message:
            {
                email: {
                    email: "Please enter valid email",
                },
            },
        /*errorPlacement: function(error, element) {
         element.closest('div.controls').append(error);
         },*/
        submitHandler: function(form) {
            var _form = $("#subscriber-form");
            $.ajax({
                url: _form.attr('action'),
                type: "POST",
                data : _form.serialize(),
                dataType: "json",
                asynch: false,
                beforeSend: function(){
                    _form.find("button").attr('disabled','disabled');
                },
                success: function (data) {
                    if (!data.error) {
                        _form.find("button").removeAttr('disabled');
                        var msg = '<div class="alert alert-success"> ' + data.msg + '</div>';
                        _form[0].reset();
                        bootbox.alert(msg);
                    }else if(data.validator_error && data.error){
                        var msg = '<div class="alert alert-danger">';
                         $.each( data.msg, function( key, value ) {
                            msg  += value;
                         });
                        msg  += '</div>';
                        bootbox.alert(msg);
                    }else{
                        var msg = '<div class="alert alert-danger">' + data.msg + '</div>';
                        _form[0].reset();
                        bootbox.alert(msg);
                    }
                },
                error: function (jqXHR, textStatus, errorMessage) {
                    _form[0].reset();
                    var msg = '<div class="alert alert-danger">' + errorMessage + '</div>';
                    bootbox.alert(msg);
                }
            });
        }
    });
    /*----- End subscriber form ------ */

    /* For forgot_password_form form validation */
    $("#forgot-password-form").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
        },
        messages: {
            email: "Please enter a valid email.",
        },
        submitHandler: function (form) {
            if(is_login){
                window.location.href = url;
            }else {
                var _form = $("#" + form.id);
                $.ajax({
                    url: form.action,
                    type: "POST",
                    data: _form.serialize(),
                    dataType: "json",
                    success: function (data) {
                        if (!data.error) {
                            var msg = '<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data.message + '</div>';
                            _form.prepend(msg);
                            _form[0].reset();
                            setTimeout(function () {
                                _form.find(".alert-success").remove();
                                _form.closest(".modal").modal('hide');
                            }, 2500);
                        }else if(data.validator_error){
                            var msg = '<div class="alert alert-danger">';
                            $.each( data.msg, function( key, value ) {
                                msg  += value;
                            });
                            msg  += '</div>';
                            _form.prepend(msg);
                            setTimeout(function () {
                                _form.find(".alert-danger").remove();
                            }, 3000);
                        } else {
                            var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data.message + '</div>';
                            _form.prepend(msg);
                            setTimeout(function () {
                                _form.find(".alert-danger").remove();
                            }, 3000);
                        }
                    },
                    error: function (jqXHR, textStatus, errorMessage) {
                        var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + errorMessage + '</div>';
                        _form.prepend(msg);
                        setTimeout(function () {
                            _form.find(".alert-danger").remove();
                        }, 3000);
                    }
                });
            }
        }
    });
    /* End forgot_password_form form validation */

    /* For about me character count */
        $('#about_me').bind("keypress paste focus blur", function (e) {
            var elem = $(this);
            var tval = elem.val(),
            tlength = tval.length,
            set = elem.attr("maxlength");
            remain = parseInt(set - tlength);
            elem.closest('form').find('.character_count').remove()
            elem.after('<span class="character_count pull-right">'+remain + ' are remaining.'+'</span>');

            if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
                elem.val((tval).substring(0, tlength - 1))
            }
        });
    /* End */

    /* For review character count */
        $('#review').bind("keypress focus", function (e) {
            var elem = $(this);
            if(!is_login) {
                elem.val('');
                show_loginpopup();
            }
        });
    /* End */

    /* For contact us form validation */
    $("#contactus-frm").validate({
        rules:
            {
                name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                },
                reason_type: {
                    required: true,
                },
                message: {
                    required: true,
                },
            },
        messages:
            {
                name: "Name is required.",
                email: "Email is required.",
                reason_type:{
                    required: "Please select valid role.",
                },
                message: "Comment is required.",
            },
        submitHandler: function(form) {
            form.submit();
        }
    });
    /* End login form validation */

    /*<-Sort By Star Rating On Vendor Profile Page->*/
    $(document).on("click",".sort-rating,.user-sort-rating",function(e){
        e.preventDefault();
        var elem = $(this);
        var rating = elem.text();
        $(".rate_filter").find('button.dropdown-toggle').text(rating);
        var vendor_id = elem.attr("data-val");
        if(elem.hasClass('sort-rating')){
            var href = url+'/sort_reviews';
        }else if(elem.hasClass('user-sort-rating')){
            var href = url+'/user_sort_reviews';
        }
        
        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: href,
            type: "POST",
            data: {_token:token, rating:rating, vendor_id:vendor_id},
            dataType: "json",
            asynch: false,
            beforeSend: function () {
                $(".recent-reviews").empty();
                $(".recent-reviews").append('<div class="ajax-loader text-center"><img src="'+url+'/public/assets/imgs/ajax-loader.gif" alt="ajax-loader" /></div>');
            },
            success: function (data) {
                $(".ajax-loader").remove();
                if (!data.error) {
                    if(data.html.length>0){
                        $(".recent-reviews").append(data.html);
                        $(".recent-review").rating({
                            displayOnly: true,
                            filledStar: '<i class="fa fa-star"></i>',
                            emptyStar: '<i class="fa fa-star-o"></i>',
                            //showCaption: false,
                        });
                        show_more();
                    }
                } else {
                    var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Sorry, some error found. please try again after sometimes.</p></div>';
                   $(".recent-reviews").append(msg);
                    setTimeout(function () {
                        $(".recent-reviews").find(".alert-danger").remove();
                    }, 4000);
                }
            },
            error: function (jqXHR, textStatus, errorMessage) {
                var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + errorMessage + '</div>';
                $(".recent-reviews").empty();
                $(".recent-reviews").append(msg);
                setTimeout(function () {
                    $(".recent-reviews").find(".alert-danger").remove();
                }, 4000);
            }
        });
    });
    /*<-End->*/
});

