var base_url;
$(function() {
    
    "use strict";

    //===== Prealoder
    
    $(window).on('load', function(event) {
        $('.preloader').delay(500).fadeOut(500);
    });
    
    
    //===== Sticky
    
    $(window).on('scroll', function(event) {    
        var scroll = $(window).scrollTop();
        if (scroll < 200) {
            $(".navigation").removeClass("sticky");
        } else{
            $(".navigation").addClass("sticky");
        }
    });

    
    //===== Mobile Menu 
    
    $(".navbar-toggler").on('click', function() {
        $(this).toggleClass('active');
    });
    
    $(".navbar-nav a").on('click', function() {
        $(".navbar-toggler").removeClass('active');
    });
    var subMenu = $(".sub-menu-bar .navbar-nav .sub-menu");

    if (subMenu.length) {
        subMenu.parent('li').children('a').append(function () {
            return '<button class="sub-nav-toggler"> <i class="fa fa-angle-down"></i> </button>';
        });

        var subMenuToggler = $(".sub-menu-bar .navbar-nav .sub-nav-toggler");

        subMenuToggler.on('click', function () {
            $(this).parent().parent().children(".sub-menu").slideToggle();
            return false
        });

    }

    
    //===== Isotope Project 1
    
    $('.container').imagesLoaded(function () {
        // var $grid = $('.grid').isotope({
        //     transitionDuration: '1s'
        // });
        
        // filter items on button click
        $('.project-menu ul').on( 'click', 'li', function() {
          var filterValue = $(this).attr('data-filter');
          // $grid.isotope({ filter: filterValue });
        });
        
        //for menu active class
        $('.project-menu ul li').on('click', function (event) {
            $(this).siblings('.active').removeClass('active');
            $(this).addClass('active');
            event.preventDefault();
        });
    });



    //===== banner animation slick slider

    function mainSlider() {
        var BasicSlider = $('.banner-active');
        BasicSlider.on('init', function (e, slick) {
            var $firstAnimatingElements = $('.single-banner:first-child').find('[data-animation]');
            doAnimations($firstAnimatingElements);
        });
        BasicSlider.on('beforeChange', function (e, slick, currentSlide, nextSlide) {
            var $animatingElements = $('.single-banner[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
            doAnimations($animatingElements);
        });
        BasicSlider.slick({
            autoplay: true,
            autoplaySpeed: 10000,
            dots: false,
            fade: true,
            arrows: true,
            prevArrow: '<span class="prev"><i class="fal fa-angle-left"></i></span>',
            nextArrow: '<span class="next"><i class="fal fa-angle-right"></i></span>',
            responsive: [
                {
                    breakpoint: 1330,
                    settings: {
                        arrows: false
                    }
                }
            ]
        });

        function doAnimations(elements) {
            var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            elements.each(function () {
                var $this = $(this);
                var $animationDelay = $this.data('delay');
                var $animationType = 'animated ' + $this.data('animation');
                $this.css({
                    'animation-delay': $animationDelay,
                    '-webkit-animation-delay': $animationDelay
                });
                $this.addClass($animationType).one(animationEndEvents, function () {
                    $this.removeClass($animationType);
                });
            });
        }
    }
    mainSlider();



    //===== portfolio slide slick slider
    $('.portfolio-active').slick({
        dots: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: true,
        prevArrow: '<span class="prev"><i class="fal fa-long-arrow-left"></i></span>',
        nextArrow: '<span class="next"><i class="fal fa-long-arrow-right"></i></span>',
        speed: 1000,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1201,
                settings: {
                    slidesToShow: 3,
                }
        },
            {
                breakpoint: 992,
                settings: {
                    arrows: false,
                    slidesToShow: 2,
                }
        },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: 1,
                }
        }
      ]
    });






    //===== portfolio slide slick slider
    $('.leadership-active').slick({
        dots: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: true,
        prevArrow: '<span class="prev"><i class="fal fa-long-arrow-left"></i></span>',
        nextArrow: '<span class="next"><i class="fal fa-long-arrow-right"></i></span>',
        speed: 1000,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1201,
                settings: {
                    slidesToShow: 3,
                }
        },
            {
                breakpoint: 992,
                settings: {
                    arrows: false,
                    slidesToShow: 2,
                }
        },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: 1,
                }
        }
      ]
    });


    




    //===== portfolio slide slick slider
    $('.brand-active').slick({
        dots: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed:  1000,
        arrows: false,
        speed: 1000,
        slidesToShow: 5,
        slidesToScroll: 2,
        responsive: [
            {
                breakpoint: 1201,
                settings: {
                    slidesToShow: 5,
                }
        },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 4,
                }
        },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                }
        },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2,
                }
        }
      ]
    });
    



    //===== portfolio slide slick slider
    $('.case-studies-active').slick({
        dots: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed:  3000,
        arrows: true,
        prevArrow: '<span class="prev"><i class="fal fa-angle-left"></i></span>',
        nextArrow: '<span class="next"><i class="fal fa-angle-right"></i></span>',
        speed: 1500,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1201,
                settings: {
                    slidesToShow: 3,
                }
        },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    arrows: false,
                }
        },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    arrows: false,
                }
        },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    arrows: false,
                }
        }
      ]
    });
    
    
    
    
    
    

    $('.shop-active').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,    
        fade: false,
        asNavFor: '.shop-thumb-active'
    });
    $('.shop-thumb-active').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.shop-active',
        dots: false,
        centerMode: true,
        arrows: false,
        centerPadding: "0",
        focusOnSelect: true
    });
    
    
    //====== Magnific Popup
    
    $('.video-popup').magnificPopup({
        type: 'iframe'
        // other options
    });
    
    
    //===== Magnific Popup
    
    $('.image-popup').magnificPopup({
      type: 'image',
      gallery:{
        enabled:true
      }
    });


    //===== counter up
    // $('.counter').counterUp({
    //     delay: 10,
    //     time: 2000
    // });

    
    
    //===== Back to top
    
    // Show or hide the sticky footer button
    $(window).on('scroll', function(event) {
        if($(this).scrollTop() > 600){
            $('.back-to-top').fadeIn(200)
        } else{
            $('.back-to-top').fadeOut(200)
        }
    });
    
    
    //Animate the scroll to yop
    $('.back-to-top').on('click', function(event) {
        event.preventDefault();
        
        $('html, body').animate({
            scrollTop: 0,
        }, 1500);
    });
    
    
    //===== circleProgress

    // $('#circle1').circleProgress({
    //     value: 0.75,
    //     size: 230,
    //     lineCap: "round",
    //     emptyFill: "#f1f9ff",
    //     thickness: "10",
    //     fill: {
    //         gradient: ["#006de8"]
    //     }
    // });
    // $('#circle2').circleProgress({
    //     value: 0.85,
    //     size: 230,
    //     lineCap: "round",
    //     emptyFill: "#f1f9ff",
    //     thickness: "10",
    //     fill: {
    //         gradient: ["#006de8"]
    //     }
    // });
    // $('#circle3').circleProgress({
    //     value: 0.50,
    //     size: 230,
    //     lineCap: "round",
    //     emptyFill: "#f1f9ff",
    //     thickness: "10",
    //     fill: {
    //         gradient: ["#006de8"]
    //     }
    // });
    // $('#circle4').circleProgress({
    //     value: 0.65,
    //     size: 230,
    //     lineCap: "round",
    //     emptyFill: "#f1f9ff",
    //     thickness: "10",
    //     fill: {
    //         gradient: ["#006de8"]
    //     }
    // });


    //===== product quantity

    $('.add').click(function () {
        if ($(this).prev().val()) {
            $(this).prev().val(+$(this).prev().val() + 1);
        }
    });
    $('.sub').click(function () {
        if ($(this).next().val() > 1) {
            if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
        }
    });

        $('.date').datepicker({
            autoclose: true
        });

    //===== Nice Select
    
    // $('select').niceSelect();


    //===== Wow animation js
    
    new WOW().init();



    //===== Syotimer js
    // $('#simple_timer').syotimer({
    //   year: 2020,
    //   month: 5,
    //   day: 9,
    //   hour: 20,
    //   minute: 30,
    // });

        
    $('#input-country').on('change', function(){
        var country = $(this).val();
        $.getJSON(base_url+'register/getcountry/'+country, function(res){
            var items = [];
            $.each( res, function( key, val ) {
               items.push( "<option value='" + key + "'>" + val + "</option>" );
            });
            $( "#input-zone").html( items );
        });
    });

    $('#AddPollOption').on('click', function(){
        var pollOption = $('.optionInput').length;
        var html = '<div class="optionInput input-box mt-15 optionInput_'+pollOption+'">\
                        <label>Answer Option</label>\
                        <div class="fullinput">\
                            <input type="text" name="poll.question_option[]" class="form-control" />\
                            <div class="trashIcon" onclick="deletePollOption('+pollOption+');"><i class="fas fa-trash"></i></div>\
                        </div>\
                    </div>';
        $('#poll-answer').append(html);
    });

    $('[data-toggle="tooltip"]').tooltip();
    
    $('#pollVoteBtn').click(function(){
        $('.spinner-eclipse').show();
        var answe_ids = $(this).attr('data-rel');
        var answe_poll = $('.answe_poll:checked').val();
        var searchParams = window.location.href;
        $.post( base_url+'polls/add', {'answe_poll': answe_poll, 'searchParams': searchParams, 'answe_ids': answe_ids } , function(resp){
            var r = JSON.parse(resp);
            if ( r[0].error == 1 ) {
                $('.poll_error').html('<p class="alert alert-danger mt-10">'+r[0].msg+'</p>');
            } else if ( r[0].error == 2 ) {
                $('.poll_error').html('<p class="mt-10">'+r[0].msg+'</p>');
            }
            $('.spinner-eclipse').hide();
        });
    });

    $('#surveyAdd').on('click', function(){
        $('#SURVEYSMODEL').modal('show');
    });
    
    $('#addSurvey').click(function(){
        $('.spinner-eclipse').show();
        var postSurveyId = $('#postSurveyId').val();
        var surveyName = $('#surveyName').val();
        var description = $('#description').val();
        var start_date =  $('#start_date').val();
        var end_date =  $('#end_date').val();
        var postdata = { 
                            'postSurveyId': postSurveyId, 
                            'surveyName': surveyName, 
                            'description': description, 
                            'start_date': start_date, 
                            'end_date': end_date
                        }
        $.ajax({
            url: base_url+'/dashboard/survey/add',
            type: 'POST',
            data: postdata,
            success: function(resp){
                var r = JSON.parse(resp);
                if(r[0].error_code == 1){
                    $('.spinner-eclipse').hide();
                    $('.poll_error').html('<p class="alert alert-danger">'+r[0].msg+'</p>');
                } else {
                    $('.spinner-eclipse').hide();
                    location.reload();
                }
                $('.spinner-eclipse').hide();
            }
        });
    });

    $('#addQuestionBtn').click(function(){
        $('.spinner-eclipse').show();
        var surveys_ids = $('#surveys_ids').val();
        var eidt_surveys_ids = $('#eidt_surveys_ids').val();
        var question_name = $('#question_name').val();
        var question_type = $('input[name=question_type]:checked').val();
        var postdata = { 
                            'surveys_ids': surveys_ids, 
                            'eidt_surveys_ids': eidt_surveys_ids,
                            'question_name': question_name, 
                            'question_type': question_type
                        }
        $.ajax({
             url: base_url+'/dashboard/survey/qadd',
            type: 'POST',
            data: postdata,
            success: function(resp){
                var r = JSON.parse(resp);
                if(r[0].error_code == 1){
                    $('.spinner-eclipse').hide();
                    $('.q_resp_error').html('<p class="alert alert-danger">'+r[0].msg+'</p>');
                } else {
                    $('.spinner-eclipse').hide();
                    location.reload();
                }
                $('.spinner-eclipse').hide();
            }
        });
    });

});
    
function deletePollOption(ids)
{
    $('.optionInput_'+ids).remove();
}

function addQuestion(ids)
{
    $('#surveys_ids').val(ids);
    $('#QuestionModel').modal('show');
}

function disableSurvey(id)
{
    window.location.href = ''+base_url+'/dashboard/survey/status'+id+'';
}

function deleteSurvey(id)
{
    var r = confirm("Are you sure to delete this?");
    if ( r == true ) {
        window.location.href = ''+base_url+'/dashboard/survey/deleteSurvey'+id+'';
    }
}
