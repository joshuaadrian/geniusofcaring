var _throttleTimer = null;
var _throttleDelay = 100;
var $window = $(window);
var $document = $(document);

function ScrollHandler(e) {
    if($('body').hasClass('has_modal') ){
        return false;
    }
    //throttle event:
    clearTimeout(_throttleTimer);
    _throttleTimer = setTimeout(function () {
        //do work
        if ($window.scrollTop() + $window.height() > $document.height() - 300) {
            LoadMore();
        }

    }, _throttleDelay);
}

function LoadMore(){
    var page = $('ul.gallery').data('page');
    if(!page){
        page = 1;
    } else {
        page = page+1;
    }
	$('ul.gallery').data('page', page);
    $.post( '/wp-content/themes/caring/helpers/load_more.php', { limit: "100", page: page } ) 
        .done(function( data ) {
            var newitems = $(data);
            $('ul.gallery').isotope( 'insert', newitems )
			if(data){
				ScrollHandler();
			}
    }); 
}	

var wait = false;
function story_slider(){
	care_gallery_active = true;
    //var start_slide = $('.story_slider .active');
    //var total_slides = $('.story_slider li').length;
	$($('.story_slider li').get().reverse()).each(function() {
		if($(this).hasClass('active')){
			$('.story_slider li').first().appendTo('.story_slider');
			return false;
		}else{
			$('.story_slider').prepend(this);
		}
	});
	$('.story_slider li').each(function() {
		if($(this).hasClass('active')){
			$('.story_slider li').last().prependTo('.story_slider');
			return false;
		}else{
			$('.story_slider').append(this);
		}
	});


    $('body').on('click','.slider_controls .next',function(){
		if(wait){
			$('.next').click();
		}
		wait = true;
        var first_slide = $('.story_slider li').first();
        var active_slide = $('.story_slider .active');
        $('.story_slider').animate({'left':'-700px'},600,function(){
            $(this).css({'left':'0'}).append(first_slide);
            active_slide.next().addClass('active');
			wait = false;
        })
        active_slide.removeClass('active');
    })
    $('body').on('click','.slider_controls .prev',function(){
		if(wait){
			$('.prev').click();
		}
			wait = true;
        var last_slide = $('.story_slider li').last();
        var active_slide = $('.story_slider .active');
        $('.story_slider').css({'left':'-700px'}).prepend(last_slide).animate({'left':'0px'},600,function(){
            active_slide.prev().addClass('active');
			wait = false;
        });
        active_slide.removeClass('active')
    })
    updateSliderMargin();
    $(window).resize(updateSliderMargin);
	
	$('.email_user').click(function(){
		$('.email_user_modal').fadeIn();
		if($('body').hasClass('has_modal')){
			$('body').addClass('has_modal_layer');
		} else {
			$('body').addClass('has_modal');
		}
		return false;
	})
	$('.share_story').click(function(){
		$('.share_story_modal').fadeIn();
		if($('body').hasClass('has_modal')){
			$('body').addClass('has_modal_layer');
		} else {
			$('body').addClass('has_modal');
		}
		return false;
	})
	$('.email_user_modal form').submit(function(){
		var send_to_id = $('.user_details').data('user_id');
		var your_message = $('.email_user_modal #your_message').val();
		$.post( '/wp-content/themes/caring/helpers/handle_private_message.php', { send_to_id: send_to_id, your_message: your_message } )
			.done(function( data ) {
				$('.email_user_modal form').html('<p>Your private message has been sent! This user will now have your personal email address for future correspondence.</p>');
				setTimeout(function(){ $('.email_user_modal').fadeOut() }, 1600);
				$('body').removeClass('has_modal');
			}
		);
		return false;
	})
	
	$('button.sign_guestbook').click(function(){
		$('.modal').animate({ scrollTop: "900px" });
	})
	$('.email_user_modal .close').click(function(e){
		$('.email_user_modal').fadeOut();
		if($('body').hasClass('has_modal_layer')){
			$('body').removeClass('has_modal_layer');
		} else {
			$('body').removeClass('has_modal');
		}
		e.stopPropagation();
		return false;
	})
	$('.share_story_modal .close').click(function(e){
		$('.share_story_modal').fadeOut();
		if($('body').hasClass('has_modal_layer')){
			$('body').removeClass('has_modal_layer');
		} else {
			$('body').removeClass('has_modal');
		}
		e.stopPropagation();
		return false;
	})
}

function updateSliderMargin(){
    var documentWidth = $(document).width();
    var center = documentWidth / 2;
    var offset = center - 1062;
	var numslides = $('.story_slider li').length;
    $('.story_slider').css({'margin-left':offset});

}

function updateDetailProgress(){
	var number_complete = $('.story_slider .complete').length;
	var progress_width = number_complete * 5.88;
	$('.progress_bar .progress').css({'width':progress_width+'%'});
	$('.progress_tooltip').css({'left':progress_width+'%'}).html('You have filled out <span>'+number_complete+'/17</span> story panels.').fadeIn().delay(1000).fadeOut();

}

function my_story_functions(){
	updateDetailProgress();
	$('.story_slider li').last().prependTo('.story_slider');
	$('.story_slider li').last().prependTo('.story_slider');
    story_slider();
	$('.help_content button').click(function(){
		$('.help_content').fadeOut();
	})

    $('body').on('click','.story_slider img', function(){
        var list = $(this).closest('li');
        list.find('.cropControlUpload').click();
    })
	
    $('body').on('click','.story_slider button', function(e){

        var list = $(this).closest('li');
		if(list.hasClass('user_details')){
            //user details
            var photo = list.find('img').attr('src');
            var is_profile = 'is_profile';
            var bio = list.find('textarea').first().val();
            var name = list.find('.name').first().val();
            var user_type = list.find('.user_type').first().val();
            var website_url = list.find('.website_url').first().val();
			$.post( '/wp-content/themes/caring/helpers/handle_profiles.php', { is_profile: is_profile, photo: photo, bio: bio, name: name, user_type: user_type, website_url: website_url } )
				.done(function( data ) {
                $(list).children('.saved').show();
                $(list).children('.saved').fadeOut(3000);
			});
			if(photo != '' && bio != '' && name != '' && photo != undefined){
				list.addClass('complete');
			}
		} else {
			//prompts
            var field_id = list.data('field_id');
            var photo = list.find('img').attr('src');
            var content_id = list.data('content_id');
            var field_content = list.find('select').first().val();
            var additional = list.find('textarea').first().val();
			$.post( '/wp-content/themes/caring/helpers/handle_profiles.php', { field_id: field_id, content_id: content_id, field_content: field_content, additional: additional, photo : photo } )
				.done(function( data ) {
                $(list).children('.saved').show();
                $(list).children('.saved').fadeOut(3000);
			}); 
			if(photo != '' && additional != '' && photo != undefined){console.log(photo);
				list.addClass('complete');
			}
			
		}
		updateDetailProgress();
		if(e.originalEvent !== undefined){
			$('.next').click();
		}

  })
      


            var croppicProfileOptions = {
                    uploadUrl:'/wp-content/themes/caring/helpers/crop_temp/img_save_to_file.php',
                    cropUrl:'/wp-content/themes/caring/helpers/crop_temp/img_crop_to_file.php',
                    modal:true,
                    imgEyecandyOpacity:0.4,
                    loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
                    onAfterImgCrop:		profile_uploaded,
                    uploadData:{
                                    "profile":true,
                                }
            }
            var cropprofile = new Croppic('crop-profile', croppicProfileOptions);
            var croppicOptions = {
                    uploadUrl:'/wp-content/themes/caring/helpers/crop_temp/img_save_to_file.php',
                    cropUrl:'/wp-content/themes/caring/helpers/crop_temp/img_crop_to_file.php',
                    modal:true,
                    imgEyecandyOpacity:0.4,
                    loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
                    onAfterImgCrop:		remove_images
            }
            var crop1 = new Croppic('crop-1', croppicOptions);
            var crop2 = new Croppic('crop-2', croppicOptions);
            var crop3= new Croppic('crop-3', croppicOptions);
            var crop4 = new Croppic('crop-4', croppicOptions);
            var crop5 = new Croppic('crop-5', croppicOptions);
            var crop6 = new Croppic('crop-6', croppicOptions);
            var crop7 = new Croppic('crop-7', croppicOptions);
            var crop8 = new Croppic('crop-8', croppicOptions);
            var crop9 = new Croppic('crop-9', croppicOptions);
            var crop10 = new Croppic('crop-10', croppicOptions);
            var crop11 = new Croppic('crop-11', croppicOptions);
            var crop12 = new Croppic('crop-12', croppicOptions);
            var crop13 = new Croppic('crop-13', croppicOptions);
            var crop14 = new Croppic('crop-14', croppicOptions);
            var crop15 = new Croppic('crop-15', croppicOptions);
            var crop16 = new Croppic('crop-16', croppicOptions);
}

function profile_uploaded(){
    remove_images();
    var thumb_src =  $('.user_details .croppit img').attr('src');
    $('.secondary_nav img').attr('src', thumb_src);
    $('.user_details button').click();

}

function remove_images(){
    $('.story_slider li').each(function(){
        if($(this).find('.croppit').find('img').length){
            $(this).children('img').remove();  
            $(this).find('button').click();            
        }
    })

}

function home_functions(){
    $('.intro button, .intro img').click(function(){
        $('.intro button, .intro img').hide();
        $(this).hide();
        $('.welcome_text').fadeIn();
    })
    testfeature_functions();
}


function gallery_functions(){
    $('.soundcloud_button').click(function(){
        if($(this).hasClass('open')){
            $(this).removeClass('open').parent().animate({'left':'-600px'},1000,function(){$('.soundcloud_player').css({'z-index':'9999'});});
        }else{
            $('.soundcloud_player').css({'z-index':'9999999'});
            $(this).addClass('open').parent().animate({'left':'-50px'},1000);
        }
    })
    $('ul.gallery').isotope({
        itemSelector: 'li',
        percentPosition: true,
        masonry: {
            // use outer width of grid-sizer for columnWidth
            columnWidth: 'li'
        }
    });

	$('.filter .switch').click(function(){
		if($(this).parent().hasClass('open')){
			$(this).parent().removeClass('open')
			$('body').removeClass('has_modal');
		}else{
			$(this).parent().addClass('open')
			$('body').addClass('has_modal');
		}
	})
	$('.filter .switch form, .filter .switch input').click(function(e){
		e.stopPropagation();
	})
    $('.filter li').not('.switch').click(function(){
        $('.filter .switch .filter_text').html($(this).html());
        var filter_var = $(this).data('filter');
        $('ul.gallery').isotope({ filter: filter_var });
		$(this).parent().removeClass('open').scrollTop(0);
		$('body').removeClass('has_modal');
		setTimeout(ScrollHandler,500);
    })
    $('.gallery').on('click', 'a', function(){
        var get_user = $(this).parent().data('user_id');
        var get_field = $(this).parent().data('field_id');
        $.post( '/wp-content/themes/caring/helpers/handle_gallery_modal.php', { field_id: get_field, user_id: get_user } )
            .done(function( data ) {
            $('body').addClass('has_modal');
            $('body').append(data);
        });
        return false;
    });
    $('body').on('click','.close',function(){
        if(!$('body[class*=paged]').length){
			if(!$('body').hasClass('has_modal')){
				return;
			}
            $('.modal').fadeOut().remove();
            $('body').removeClass('has_modal');
			care_gallery_active = false;
            return false;
        }
    })

    $window
        .off('scroll', ScrollHandler)
        .on('scroll', ScrollHandler);


}

function hide_header(){
    if(!$('.page_header').is(':hover')){
        $('.page_header').css({'opacity':'0.2'});
        $('.chapter_display').css({'opacity':'0.2'});
        $('.video_controls').css({'opacity':'0'});
    }
}

function hide_header_new(){
    if(!$('.page_header').is(':hover')){
        $('.page_header').css({'opacity':'0'});
        $('.chapter_display').css({'opacity':'0'});
        $('.video_controls').css({'opacity':'0'});
        $('.chapters_nav').css({'opacity':'0'});
        $('.need_help_button').css({'opacity':'0'});
    }
}

function global_functions(){
	$('.social_button').click(function(){
		if(care_gallery_active){
			$('.share_story_modal').fadeIn();
			$('body').addClass('has_modal');
		} else {
			$('.share_page_modal').fadeIn();
			$('body').addClass('has_modal');
		}
		return false;
	})
	$('.share_page_modal .close').click(function(e){
		$('.share_page_modal').fadeOut();
		if($('body').hasClass('has_modal_layer')){
			$('body').removeClass('has_modal_layer');
		} else {
			$('body').removeClass('has_modal');
		}
		e.stopPropagation();
		return false;
	})
	$('.secondary_nav a.facebook').click(function(){
		var share_url = window.location.href;
		FB.ui(
		 {
		  method: 'share',
		  href: share_url,
		}, function(response){});
		return false;
	})
	// $('.need_help_button').click(function(){
	// 	$('.need_help_modal').fadeIn();
	// 	if($('body').hasClass('has_modal')){
	// 		$('body').addClass('has_modal_layer');
	// 	} else {
	// 		$('body').addClass('has_modal');
	// 	}
	// 	return false;
	// })
	$('.need_help_modal form').submit(function(){
		var your_email = $('.need_help_modal #help_your_email').val();
		var your_message = $('.need_help_modal #help_your_message').val();
		if(your_email=='' || your_email==''){
			alert('Please enter your email and a message');
			return false;
		}
		$.post( '/wp-content/themes/caring/helpers/handle_help_message.php', { your_email: your_email, your_message: your_message } )
			.done(function( data ) {
				$('.need_help_modal form').html('<p>Your message has been sent</p>');
				setTimeout(function(){ $('.need_help_modal').fadeOut() }, 1600);
		});
		return false;
	})
	$('.need_help_modal .close').click(function(e){
		if($('body').hasClass('has_modal_layer')){
			$('body').removeClass('has_modal_layer');
		} else {
			$('body').removeClass('has_modal');
		}
		$('.need_help_modal').fadeOut();
		e.stopPropagation();
		return false;
	})

}

function portrait_selection(){
    $('section.portraits').fadeIn();
    document.getElementById('Portraits_Loop').play();
    $('.portraits .pam_and_ed').click(function(){
        $('section.portraits').hide();
    })
}


function init_chapter_display(chapter_digit){
	$('.chapter_display span').removeClass('on').removeClass('over').css('width','');
	$('.chapter_display .chapter_'+chapter_digit).addClass('on').nextAll().removeClass('on').removeClass('over');
	$('.chapter_display .chapter_'+chapter_digit).prevAll().addClass('over');
}

function chapter_one(video_time){
	init_chapter_display('1');
    var video_id='Chapter_One_Video';
    if($('section.video_container').hasClass('hd_on')){
        video_id='Chapter_One_Video';
    }else{
        video_id='Chapter_One_Video_SD';
    }
    chapter_init(video_id,video_time);
    $('.chapters_nav li.one').addClass('active');
    $('#'+video_id).bind("ended", function(){
        $('.video_controls').hide();
        $('#'+video_id).hide();
        $('#Chapter_One_Loop').show();
        $('section.response_one').fadeIn();
        document.getElementById('Chapter_One_Loop').play();
    });
    
    $('.response_one .prompt button').click(function(){
        var field_content = $(this).html();
        var content_id = $(this).data('content_id');
        var field_id = $(this).data('field_id');
        if($(this).parent('fieldset').length){ //only post if in fieldset
            $.post( '/wp-content/themes/caring/helpers/handle_stories.php', { field_id: field_id, field_content: field_content, content_id: content_id } )
                .done(function( data ) {
            });
        }
        $('.response_one .prompt').fadeOut();
        $('.response_one .data').fadeIn();
    })
    $('.response_one .data button').click(function(){
        $('section.response_one').hide();
        $('#Chapter_One_Loop').hide();
        document.getElementById('Chapter_One_Loop').pause();
        chapter_two();
    })
}

function chapter_two(video_time){
	init_chapter_display('2');
    var video_id='Chapter_Two_Video';
    if($('section.video_container').hasClass('hd_on')){
        video_id='Chapter_Two_Video';
    }else{
        video_id='Chapter_Two_Video_SD';
    }
    chapter_init(video_id,video_time);
    $('.chapters_nav li.two').addClass('active');
    $('#'+video_id).bind("ended", function(){
        $('.video_controls').hide();
        $('#'+video_id).hide();
        $('#Chapter_Two_Loop').show();
        $('section.response_two').fadeIn();
        document.getElementById('Chapter_Two_Loop').play();
    });
    $('.response_two .prompt button').click(function(){
        var field_content = $(this).html();
        var content_id = $(this).data('content_id');
        var field_id = $(this).data('field_id');
        if($(this).parent('fieldset').length){ //only post if in fieldset
            $.post( '/wp-content/themes/caring/helpers/handle_stories.php', { field_id: field_id, field_content: field_content, content_id: content_id } )
                .done(function( data ) {
            });
        }
        $('section.response_two').hide();
        document.getElementById('Chapter_Two_Loop').pause();
        $('#Chapter_Two_Loop').hide();
        chapter_three();
    })
}

function chapter_three(video_time){
	init_chapter_display('3');
    var video_id='Chapter_Three_Video';
    if($('section.video_container').hasClass('hd_on')){
        video_id='Chapter_Three_Video';
    }else{
        video_id='Chapter_Three_Video_SD';
    }
    chapter_init(video_id,video_time);
    $('.chapters_nav li.three').addClass('active');
    $('#'+video_id).bind("ended", function(){
        $('.video_controls').hide();
        $('#'+video_id).hide();
        $('section.response_three').fadeIn();
        $('#Chapter_Three_Loop').show();
        document.getElementById('Chapter_Three_Loop').play();
    });
    $('.response_three .prompt button').click(function(){
        var field_content = $(this).html();
        var content_id = $(this).data('content_id');
        var field_id = $(this).data('field_id');
        if($(this).parent('fieldset').length){ //only post if in fieldset
            $.post( '/wp-content/themes/caring/helpers/handle_stories.php', { field_id: field_id, field_content: field_content, content_id: content_id } )
                .done(function( data ) {
            });
        }
        $('section.response_three').hide();
        $('#Chapter_Three_Loop').hide();
        document.getElementById('Chapter_Three_Loop').pause();
        chapter_four();
    })
}

function chapter_four(video_time){
	init_chapter_display('4');
    var video_id='Chapter_Four_Video';
    if($('section.video_container').hasClass('hd_on')){
        video_id='Chapter_Four_Video';
    }else{
        video_id='Chapter_Four_Video_SD';
    }
    chapter_init(video_id,video_time);
    $('.chapters_nav li.four').addClass('active');
    $('#'+video_id).bind("ended", function(){
        $('.video_controls').hide();
        $('#'+video_id).hide();
        $('section.response_four').fadeIn();
        $('#Chapter_Four_Loop').show();
        document.getElementById('Chapter_Four_Loop').play();
    });
    $('.response_four .prompt button').click(function(){
        var field_content = $('.response_four textarea').val();
        var content_id = $('.response_four textarea').data('content_id');
        var field_id = $('.response_four textarea').data('field_id');
        $.post( '/wp-content/themes/caring/helpers/handle_stories.php', { field_id: field_id, field_content: field_content, content_id: content_id } )
            .done(function( data ) {
        });
        $('section.response_four').hide();
        $('#Chapter_Four_Loop').hide();
        document.getElementById('Chapter_Four_Loop').pause();
        chapter_five();
    })
}

function chapter_five(video_time){
	init_chapter_display('5');
    var video_id='Chapter_Five_Video';
    if($('section.video_container').hasClass('hd_on')){
        video_id='Chapter_Five_Video';
    }else{
        video_id='Chapter_Five_Video_SD';
    }
    chapter_init(video_id,video_time);
    $('.chapters_nav li.five').addClass('active');
    $('#'+video_id).bind("ended", function(){
        $('.video_controls').hide();
        $('#'+video_id).hide();
        $('section.response_five').fadeIn();
        $('#Chapter_Five_Loop').show();
        document.getElementById('Chapter_Five_Loop').play();
        if($('body').hasClass('logged-in')){
            $('.response_five .prompt').hide();
            $('.response_five .data').fadeIn();
        } else {
            $('.response_five .data').hide();
            $('.response_five .prompt').fadeIn();
        }
    });
    $('.response_five .prompt button').click(function(){
        var email_address = $('.response_five .email_address').val();
        if( /(.+)@(.+){2,}.(.+){2,}/.test(email_address) ){
             $.post( '/wp-content/themes/caring/helpers/handle_signup.php', { email_address: email_address } )
                 .done(function( data ) {console.log(data);
					if(data=='Error'){
						//display error
						alert('Error: Please try again.');
					}else{
						$('.response_five .data').prepend('<p>Thank you for signing up. You will receive an email with your password. To add more details, visit your My Story page.</p>');
						$('.response_five .prompt').fadeOut();
						$('.response_five .data').fadeIn();
					}
             });
        } else {
          alert('Invalid Email Address');
          return false;
        }
    })
}

function video_event_listener(){ 
    var video_element = document.getElementById( $('video.active').attr('id'));
	var seekbar_value = (1000 / video_element.duration) * video_element.currentTime;
	$( '.seek_bar' ).slider( 'option', 'value', seekbar_value );
	$('.seek_bar .handle_time_pop').html(formatTime(video_element.currentTime));
	var chapter_display_value = seekbar_value / 10;
	$('.chapter_display .on span').css({'width':chapter_display_value+'%'});
}

function chapter_init(video_id,video_time){
    $('.video_controls').show();
    $('.chapters_nav li').removeClass('active');
    var video_element = document.getElementById(video_id);
    var $video = $('#'+video_id);
    $video.removeClass('ended');
    video_element.addEventListener("timeupdate", video_event_listener );
    $('video').removeClass('active');
    $video.addClass('active').fadeIn();
    video_element.play();
	if(video_time){
				console.log(video_time);
		if(video_element.readyState >= 3){
			video_element.currentTime = video_time;
		}
	} else {
        video_element.currentTime = 0;
    }
}

function formatTime(seconds) {
    minutes = Math.floor(seconds / 60);
    minutes = (minutes >= 10) ? minutes : "" + minutes;
    seconds = Math.floor(seconds % 60);
    seconds = (seconds >= 10) ? seconds : "0" + seconds;
    return minutes + ":" + seconds;
}
  
  
function portrait_functions(){
    var timer;
    $('body').mousemove(function() {
        $('.page_header').css({'opacity':'1'});
        $('.chapter_display').css({'opacity':'1'});
        $('.video_controls').css({'opacity':'1'});
        clearTimeout (timer);
        timer = setTimeout(hide_header, 2000);
    })
	if($('body').hasClass('page-id-351')){  //Pam and Ed
        chapter_one();
    } else {
        portrait_selection();
    }

    $('.chapters_nav .heading').click(function(){
        if($(this).hasClass('open')){
            $(this).removeClass('open').addClass('closed');
            $('.chapters_nav').animate({'height':'70px'},400);
        } else {
            $(this).removeClass('closed').addClass('open');
            $('.chapters_nav').animate({'height':'425px'},400,function(){
                $("html, body").animate({ scrollTop: $(document).height() }, "slow");
            });
        }
    })

    $('.chapters_nav li').click(function(){
        if($(this).hasClass('heading')){
            return false;
        }
        if($(this).hasClass('active')){
            return false;
        }
        pausePlayers();
        $('video').hide();
        $('section.response').hide();
        $('.chapters_nav li').removeClass('active');
        var chapter = $(this).attr('class');
        switch(chapter){
            case 'one':
                $('.chapters_nav li.one').addClass('active');
                chapter_one();
                break;
            case 'two':
                $('.chapters_nav li.two').addClass('active');
                chapter_two();
                break;
            case 'three':
                $('.chapters_nav li.three').addClass('active');
                chapter_three();
                break;
            case 'four':
                $('.chapters_nav li.four').addClass('active');
                chapter_four();
                break;
            case 'five':
                $('.chapters_nav li.five').addClass('active');
                chapter_five();
                break;
        }
        $('.chapters_nav .heading').click();
        $("html, body").animate({ scrollTop: 0 }, "fast");
    }) 

	$('.play_pause').click(function(){
		var this_video = $('video.active').attr('id');
		var video_element = document.getElementById(this_video)
		if($(this).hasClass('play')){
            $(this).removeClass('play').addClass('pause');
            video_element.play();
		} else {
            $(this).removeClass('pause').addClass('play');
			video_element.pause();
		}
	})
    
	$('.mute_button').click(function(){
		var this_video = $('video.active').attr('id');
		var video_element = document.getElementById(this_video)
		if($(this).hasClass('mute_off')){
			$(this).removeClass('mute_off').addClass('mute_on').data('volume',video_element.volume);
			video_element.volume = 0;
            $( '.volume_slider' ).slider( 'option', 'value',0 );
		} else {
			$(this).removeClass('mute_on').addClass('mute_off');
			video_element.volume = $(this).data('volume');
            $( '.volume_slider' ).slider( 'option', 'value' , $(this).data('volume') * 100);
		}
	})
var video_time;    
	$('.hd_sd').click(function(){
		var this_video = $('video.active').attr('id');
		var video_element = document.getElementById(this_video)
		video_element.pause();
		video_time = video_element.currentTime;		
		$('video.active').hide();
		if($(this).hasClass('sd_on')){
            $('section.video_container').removeClass('hd_off').addClass('hd_on');
			$(this).removeClass('sd_on').addClass('hd_on');
            var video_id = this_video.substr(0, this_video.length-3);
		} else {
            $('section.video_container').addClass('hd_off').removeClass('hd_on');
			$(this).removeClass('hd_on').addClass('sd_on');
            var video_id = this_video+'_SD';
		}
        switch(this_video){
            case 'Chapter_One_Video':
            case 'Chapter_One_Video_SD':
                chapter_one(video_time);
                break;
            case 'Chapter_Two_Video':
            case 'Chapter_Two_Video_SD':
                chapter_two(video_time);
                break;
            case 'Chapter_Three_Video':
            case 'Chapter_Three_Video_SD':
                chapter_three(video_time);
                break;
            case 'Chapter_Four_Video':
            case 'Chapter_Four_Video_SD':
                chapter_four(video_time);
                break;
            case 'Chapter_Five_Video':
            case 'Chapter_Five_Video_SD':
                chapter_five(video_time);
                break;
        }
	})
    
	 $( ".seek_bar" ).slider({
		value: 0,
        min: 10,
        max: 1000,
		orientation: "horizontal",
		range: "min",
		animate: true,
		start: function( event, ui ) {
			var this_video = $('video.active').attr('id');
			var video_element = document.getElementById(this_video);
			video_element.pause();
			$('span.play_pause').removeClass('play').addClass('pause');
			video_element.removeEventListener("timeupdate", video_event_listener );
		},
		change: function(event, ui) {
			if (event.originalEvent) {
				//manual change
				video_seek_change();
			}
		}
	});
	 $( ".volume_slider" ).slider({
		value: 100,
		orientation: "horizontal",
		range: "min",
		animate: true,
		change: function( event, ui ) {video_volume_change()},
	});

    var $handle_time_popup = $("<span/>").text("0:00").addClass('handle_time_pop');
    $(".seek_bar").slider().find(".ui-slider-handle").append($handle_time_popup)
    
}

function video_seek_change(){
    var this_video = $('video.active').attr('id');
    var video_element = document.getElementById(this_video);
	video_element.removeEventListener("timeupdate", video_event_listener );
	var position = $( '.seek_bar' ).slider( 'option', 'value' );
    var time = video_element.duration * (position / 1000);
    video_element.currentTime = time;
    video_element.play();
	video_element.addEventListener("timeupdate", video_event_listener );
}

function video_volume_change(){
    var this_video = $('video.active').attr('id');
    var video_element = document.getElementById(this_video);
	var position = $( '.volume_slider' ).slider( 'option', 'value' );
    video_element.volume = position / 100;
}


function pausePlayers() {
    var htmlPlayer = document.getElementsByTagName('video');
  for(var i = 0; i < htmlPlayer.length; i++){
    htmlPlayer[i].pause();
  }
}

function login_functions(){
    
    $('span.login').click(function(){
        $('span').removeClass('active');
        $('form').removeClass('active');
        $('#login').addClass('active');
        $('.login').addClass('active');
    })
    $('span.lostpassword').click(function(){
        $('span').removeClass('active');
        $('form').removeClass('active');
        $('#lostpassword').addClass('active');
        $('.login').addClass('active');
    })
    $('span.signup').click(function(){
        $('span').removeClass('active');
        $('form').removeClass('active');
        $('.signup').addClass('active');
        $('#signup').addClass('active');
    })
    $('#signup').submit(function(){
        var email_address = $('#signup input[type=email]').val();
         $.post( '/wp-content/themes/caring/helpers/handle_signup.php', { email_address: email_address } )
             .done(function( data ) {
                if(data.indexOf("Error")>=0){
                    $('#signup').prepend('<p class="error">That Username is Taken. Please login or choose a different email.</p>');
                } else {
                    window.location = '/my-story';
                }
         });
         return false;
     })
    $('#lostpassword').submit(function(){
        var email_address = $('#lostpassword input[type=email]').val();
         $.post( '/wp-content/themes/caring/helpers/handle_password_reset.php', { email_address: email_address } )
             .done(function( data ) {
                $('#lostpassword').html('<p>Your password has been reset. A new password has been sent to your email address.</p>');
         });
         return false;
     })
}

function default_functions(){
    $('.inner nav li').click(function(){
        if($(this).hasClass('active')){
            return false;
        }
        var showclass = $(this).attr('class');
        $('.inner nav li').removeClass('active');
        $(this).addClass('active');
        $('.inner section').removeClass('active').hide();
        $('.inner .'+showclass).fadeIn().addClass('active');
    })
    
    $('section.logout button').click(function(){
        $.post( '/wp-content/themes/caring/helpers/handle_logout.php' )
            .done(function( data ) {
            window.location = '/';
        }); 
    })

    $('section.change_password button').click(function(){
		var old_password = $('section.change_password .old_password').val();
		var new_password = $('section.change_password .new_password').val();
		var repeat_password = $('.change_password .repeat_password').val();
		if(new_password==repeat_password && new_password!=''){
			$.post( '/wp-content/themes/caring/helpers/handle_change_password.php', { new_password: new_password } ) 
				.done(function( data ) {
				$('section.change_password').html('<p>Your password has been updated.</p>');
			}); 
		}
	}); 
		
}

function settings_functions(){

	$('section.seturl button').click(function(){
		
		var seturl = $('#seturl').val();
		if(seturl=='' || (!/^[0-9a-zA-Z]+$/.test(seturl))){
			alert('Please enter only letters and numbers for your custom URL.');
			return false;
		}
			$.post( '/wp-content/themes/caring/helpers/handle_seturl.php', { seturl: seturl } ) 
				.done(function( data ) {
					if(data=='Error-1'){ //URL Exists
						$('section.seturl button').before('<p>This URL is taken. Please choose another.</p>');
					} else if (data=='Success'){ //All Good
						$('section.seturl').html('<p>Success. Your new Care Gallery URL is: <a href="http://www.geniusofcaring.com/care-gallery/' + seturl + '">www.geniusofcaring.com/care-gallery/' + seturl + '</a></p>');
					} else { //Error
						$('section.seturl button').before('<p>Something went wrong. Please try again.</p>');
					}
			}); 
	
	})
    
	$('section.privacy  input:radio').change(function(){
        if($('#private_radio').is(':checked')) {
            $('label[for=public_password], #public_password').show();
        } else {
            $('label[for=public_password], #public_password').hide();
            $('#public_password').val('');
        }
	})

	$('section.privacy  button').click(function(){
		
		var public_password = $('#public_password').val();
			$.post( '/wp-content/themes/caring/helpers/handle_privacy.php', { public_password: public_password } ) 
				.done(function( data ) {
					$('.return_message').remove();
					if (data=='Success'){ //All Good
						$('section.privacy button').before('<p class="return_message">Success. Your privacy settings have been saved.</p>');
					} else { //Error
						$('section.privacy button').before('<p class="return_message">Something went wrong. Please try again.</p>');
					}
			}); 
	
	})


}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }
    return "";
}

function launch_roadblock() {
    if (getCookie('rb2') != 'true') {
        $('.preorder_modal').delay(10000).fadeIn();
        $('.preorder_modal .close').click(function () {
            document.cookie = "rb2=true";
            $('.preorder_modal').fadeOut();
        })
        $('.preorder_modal').click(function () {
            document.cookie = "rb2=true";
            $('.preorder_modal').fadeOut();
        })
    }
}

function conversation_functions(){
    $('article .button').click(function(){
		ga('send', 'event', 'social', 'buttonclick', 'shareyourstory', 1);
    });
    $('article .facebook_icon').click(function(){
		ga('send', 'event', 'social', 'buttonclick', 'facebook', 1);
    });
    $('article .twitter_icon').click(function(){
		ga('send', 'event', 'social', 'buttonclick', 'twitter', 1);
    });
}

$(document).ready(function(){

	global_functions();

	if($('body').hasClass('page-id-35')){ //settings page
		settings_functions();
	}

	if($('body').hasClass('page-template-default')){
		default_functions();
	}

	if($('body').hasClass('page-template-custom-my_story-php')){
		my_story_functions();
	}

	if($('body').hasClass('page-template-custom-portrait-php')){
		portrait_functions();
	}

	if($('body').hasClass('page-template-custom-home-php')){
		home_functions();
	}
    if($('body').hasClass('page-template-custom-care_gallery-php')){
        gallery_functions();
    }
    if($('body').hasClass('page-template-custom-featuretest')){
        testfeature_functions();
    }
	if($('body').hasClass('page-template-custom-login-php')){
		login_functions();
	}
 	if($('body').hasClass('page-template-custom-conversations-php')){
		conversation_functions();
	}
    if($('body').hasClass('page-template-custom-kamaria')){
        kamaria_functions();
    }
    if($('body').hasClass('page-template-custom-pamed')){
        pamed_functions();
    }
    if(!($('body').hasClass('page-template-custom-kamaria') || $('body').hasClass('page-template-custom-portrait'))){
        launch_roadblock();
    }

});
var care_gallery_active = false;



function kamaria_functions(){
    var timer;
    $('body').mousemove(function() {
        $('.page_header').css({'opacity':'1'});
        $('.chapter_display').css({'opacity':'1'});
        $('.video_controls').css({'opacity':'1'});
        $('.chapters_nav').css({'opacity':'1'});
        $('.need_help_button').css({'opacity':'1'});
        clearTimeout (timer);
        timer = setTimeout(hide_header_new, 2000);
    })

    story2_chapter_one();
    $('.chapters_nav .heading').click(function(){
        if($(this).hasClass('open')){
            $(this).removeClass('open').addClass('closed');
            $('.chapters_nav').animate({'height':'70px'},400);
        } else {
            $(this).removeClass('closed').addClass('open');
            $('.chapters_nav').animate({'height':'425px'},400,function(){
                $("html, body").animate({ scrollTop: $(document).height() }, "slow");
            });
        }
    })

    $('.chapters_nav li').click(function(){
        if($(this).hasClass('heading')){
            return false;
        }
        if($(this).hasClass('active')){
            return false;
        }
        pausePlayers();
        $('video').hide();
        $('section.response').hide();
        $('.chapters_nav li').removeClass('active');
        var chapter = $(this).attr('class');
        switch(chapter){
            case 'one':
                $('.chapters_nav li.one').addClass('active');
                story2_chapter_one();
                break;
            case 'two':
                $('.chapters_nav li.two').addClass('active');
                story2_chapter_two();
                break;
            case 'three':
                $('.chapters_nav li.three').addClass('active');
                story2_chapter_three();
                break;
            case 'four':
                $('.chapters_nav li.four').addClass('active');
                story2_chapter_four();
                break;
            case 'five':
                $('.chapters_nav li.five').addClass('active');
                story2_chapter_five();
                break;
        }
        $('.chapters_nav .heading').click();
        $("html, body").animate({ scrollTop: 0 }, "fast");
    })

    $('.play_pause').click(function(){
        var this_video = $('video.active').attr('id');
        var video_element = document.getElementById(this_video)
        if($(this).hasClass('play')){
            $(this).removeClass('play').addClass('pause');
            video_element.play();
        } else {
            $(this).removeClass('pause').addClass('play');
            video_element.pause();
        }
    })

    $('.mute_button').click(function(){
        var this_video = $('video.active').attr('id');
        var video_element = document.getElementById(this_video)
        if($(this).hasClass('mute_off')){
            $(this).removeClass('mute_off').addClass('mute_on').data('volume',video_element.volume);
            video_element.volume = 0;
            $( '.volume_slider' ).slider( 'option', 'value',0 );
        } else {
            $(this).removeClass('mute_on').addClass('mute_off');
            video_element.volume = $(this).data('volume');
            $( '.volume_slider' ).slider( 'option', 'value' , $(this).data('volume') * 100);
        }
    })
    var video_time;

    $( ".seek_bar" ).slider({
        value: 0,
        min: 10,
        max: 1000,
        orientation: "horizontal",
        range: "min",
        animate: true,
        start: function( event, ui ) {
            var this_video = $('video.active').attr('id');
            var video_element = document.getElementById(this_video);
            video_element.pause();
            $('span.play_pause').removeClass('play').addClass('pause');
            video_element.removeEventListener("timeupdate", video_event_listener );
        },
        change: function(event, ui) {
            if (event.originalEvent) {
                //manual change
                video_seek_change();
            }
        }
    });
    $( ".volume_slider" ).slider({
        value: 100,
        orientation: "horizontal",
        range: "min",
        animate: true,
        change: function( event, ui ) {video_volume_change()},
    });

    var $handle_time_popup = $("<span/>").text("0:00").addClass('handle_time_pop');
    $(".seek_bar").slider().find(".ui-slider-handle").append($handle_time_popup);

}

var is_map_init = false;
function story2_chapter_one(video_time){
    init_chapter_display('1');
    var video_id='Chapter_One_Video';
    chapter_init(video_id,video_time);
    $('.chapters_nav li.one').addClass('active');

    var video_loop_begin = '83.1';
    var video_loop_end = '121.05';
    $("#Chapter_One_Video").on('timeupdate',function(event){
        if(!$('#'+video_id).hasClass('ended')){
            if (this.currentTime >= video_loop_begin) {
                $('.video_controls').hide();
                $('section.response_one').fadeIn();
                $('#'+video_id).addClass('ended');
                if(!is_map_init){
                    is_map_init = true;
                    initMap();
                }

            }
            if (this.currentTime >= video_loop_end) {
                this.currentTime = video_loop_begin;
            }
        }
    });


    $('#'+video_id).bind("ended", function(){
        this.currentTime = video_loop_begin;
        document.getElementById('Chapter_One_Video').play();
    });

    $('.response_one .prompt button').click(function(){
        //this all needs to change to include map
        var field_content = $('#pac-input').val();
        var content_id = $(this).data('content_id');
        var field_id = $(this).data('field_id');
        if($(this).parent('fieldset').length){ //only post if in fieldset
            $.post( '/wp-content/themes/caring/helpers/handle_stories.php', { field_id: field_id, field_content: field_content, content_id: content_id } )
                .done(function( data ) {
                });
        }
        $('.response_one fieldset').fadeOut();
        $('.response_one .data').fadeIn();
        $('#mapPicker').animate({'opacity':'1'});
        setTimeout( function(){
            $('.response_one .data button').click();
        }  , 5200 );
    })
    $('.response_one .data button').click(function(){
        $('section.response_one').hide();
        $('.response_one fieldset').fadeIn();
        $('.response_one .data').fadeOut();
        $('#mapPicker').animate({'opacity':'0'});
        $('#Chapter_One_Video').hide();
        document.getElementById('Chapter_One_Video').pause();
        story2_chapter_two();
    })
}

function story2_chapter_two(video_time){
    init_chapter_display('2');
    var video_id='Chapter_Two_Video';
    chapter_init(video_id,video_time);
    $('.chapters_nav li.two').addClass('active');
    var video_loop_begin = '223';
    var video_loop_end = '244';
    $("#Chapter_Two_Video").on('timeupdate',function(event){
        if(!$('#'+video_id).hasClass('ended')){
            if (this.currentTime >= video_loop_begin) {
                $('.video_controls').hide();
                $('section.response_two').fadeIn();
                $('#'+video_id).addClass('ended');
            }
            if (this.currentTime >= video_loop_end) {
                this.currentTime = video_loop_begin;
            }
        }
    });

    $('#'+video_id).bind("ended", function(){
        this.currentTime = video_loop_begin;
        document.getElementById('Chapter_Two_Video').play();
    });


    $('.response_two .prompt button').click(function(){
        var field_content = $(this).html();
        var content_id = $(this).data('content_id');
        var field_id = $(this).data('field_id');
        if($(this).parent('fieldset').length){ //only post if in fieldset
            $.post( '/wp-content/themes/caring/helpers/handle_stories.php', { field_id: field_id, field_content: field_content, content_id: content_id } )
                .done(function( data ) {
                });
        }
        $('section.response_two').hide();
        document.getElementById('Chapter_Two_Video').pause();
        $('#Chapter_Two_Video').hide();
        story2_chapter_three();
    })
}

function story2_chapter_three(video_time){
    init_chapter_display('3');
    var video_id='Chapter_Three_Video';
    chapter_init(video_id,video_time);
    $('.chapters_nav li.three').addClass('active');
    var video_loop_begin = '125.2';
    var video_loop_end = '163';
    $("#Chapter_Three_Video").on('timeupdate',function(event){
        if(!$('#'+video_id).hasClass('ended')){
            if (this.currentTime >= video_loop_begin) {
                $('.video_controls').hide();
                $('section.response_three').fadeIn();
                $('#'+video_id).addClass('ended');
            }
            if (this.currentTime >= video_loop_end) {
                this.currentTime = video_loop_begin;
            }
        }
    });

    $('#'+video_id).bind("ended", function(){
        this.currentTime = video_loop_begin;
        document.getElementById('Chapter_Three_Video').play();
    });

    $('.response_three .prompt button').click(function(){
        var field_content = $('.response_four textarea').val();
        var content_id = $('.response_four textarea').data('content_id');
        var field_id = $('.response_four textarea').data('field_id');
        $.post( '/wp-content/themes/caring/helpers/handle_stories.php', { field_id: field_id, field_content: field_content, content_id: content_id } )
            .done(function( data ) {
            });
        $('section.response_three').hide();
        $('#Chapter_Three_Video').hide();
        document.getElementById('Chapter_Three_Video').pause();
        story2_chapter_four();
    })
}

function story2_chapter_four(video_time){
    init_chapter_display('4');
    var video_id='Chapter_Four_Video';
    chapter_init(video_id,video_time);
    $('.chapters_nav li.four').addClass('active');
    var video_loop_begin = '124.4';
    var video_loop_end = '159';
    $("#Chapter_Four_Video").on('timeupdate',function(event){
        if(!$('#'+video_id).hasClass('ended')){
            if (this.currentTime >= video_loop_begin) {
                $('.video_controls').hide();
                $('section.response_four').fadeIn();
                $('#'+video_id).addClass('ended');
            }
            if (this.currentTime >= video_loop_end) {
                this.currentTime = video_loop_begin;
            }
        }
    });

    $('#'+video_id).bind("ended", function(){
        this.currentTime = video_loop_begin;
        document.getElementById('Chapter_Four_Video').play();
    });

    $('.response_four .prompt button').click(function(){
        var field_content = $('.response_four textarea').val();
        var content_id = $('.response_four textarea').data('content_id');
        var field_id = $('.response_four textarea').data('field_id');
        $.post( '/wp-content/themes/caring/helpers/handle_stories.php', { field_id: field_id, field_content: field_content, content_id: content_id } )
            .done(function( data ) {
            });
        $('section.response_four').hide();
        $('#Chapter_Four_Video').hide();
        document.getElementById('Chapter_Four_Video').pause();
        story2_chapter_five();
    })
}

function story2_chapter_five(video_time){
    init_chapter_display('5');
    var video_id='Chapter_Five_Video';
    chapter_init(video_id,video_time);
    $('.chapters_nav li.five').addClass('active');
    var video_loop_begin = '142';
    var video_loop_end = '171';
    $("#Chapter_Five_Video").on('timeupdate',function(event){
        if(!$('#'+video_id).hasClass('ended')){
            if (this.currentTime >= video_loop_begin) {
                $('.video_controls').hide();
                $('section.response_five').fadeIn();
                $('#'+video_id).addClass('ended');
            }
            if (this.currentTime >= video_loop_end) {
                this.currentTime = video_loop_begin;
            }
        }
    });

    $('#'+video_id).bind("ended", function(){
        this.currentTime = video_loop_begin;
        document.getElementById('Chapter_Five_Video').play();
    });

    $('.response_five .prompt button').click(function(){
        var email_address = $('.response_five .email_address').val();
        if( /(.+)@(.+){2,}.(.+){2,}/.test(email_address) ){
            $.post( '/wp-content/themes/caring/helpers/handle_signup.php', { email_address: email_address } )
                .done(function( data ) {
                    if(data=='Error'){
                        //display error
                        alert('Error: Please try again.');
                    }else{
                        $('.response_five .data').prepend('<p>Thank you for signing up. You will receive an email with your password. To add more details, visit your My Story page.</p>');
                        $('.response_five .prompt').fadeOut();
                        $('.response_five .data').fadeIn();
                    }
                });
        } else {
            alert('Invalid Email Address');
            return false;
        }
    })
}

function testfeature_functions(){
    $('.soundcloud_button').click(function(){
        if($(this).hasClass('open')){
            $(this).removeClass('open').parent().animate({'left':'-600px'},1000,function(){$('.soundcloud_player').css({'z-index':'9999'});});
        }else{
            $('.soundcloud_player').css({'z-index':'9999999'});
            $(this).addClass('open').parent().animate({'left':'-50px'},1000);
        }
    })
    $('ul.gallery').isotope({
        itemSelector: 'li',
        percentPosition: true,
        masonry: {
            // use outer width of grid-sizer for columnWidth
            columnWidth: '.gallerysizer'
        }
    });

    $('.filter .switch').click(function(){
        if($(this).parent().hasClass('open')){
            $(this).parent().removeClass('open')
            $('body').removeClass('has_modal');
        }else{
            $(this).parent().addClass('open')
            $('body').addClass('has_modal');
        }
    })
    $('.filter .switch form, .filter .switch input').click(function(e){
        e.stopPropagation();
    })
    $('.filter li').not('.switch').click(function(){
        $('.filter .switch .filter_text').html($(this).html());
        var filter_var = $(this).data('filter');
        $('ul.gallery').isotope({ filter: filter_var });
        $(this).parent().removeClass('open').scrollTop(0);
        $('body').removeClass('has_modal');
        setTimeout(ScrollHandler,500);
    })
    $('.gallery').on('click', 'a', function(){
        var get_user = $(this).parent().data('user_id');
        var get_field = $(this).parent().data('field_id');
        $.post( '/wp-content/themes/caring/helpers/handle_gallery_modal.php', { field_id: get_field, user_id: get_user } )
            .done(function( data ) {
                $('body').addClass('has_modal');
                $('body').append(data);
            });
        return false;
    });
    $('body').on('click','.close',function(){
        if(!$('body[class*=paged]').length){
            if(!$('body').hasClass('has_modal')){
                return;
            }
            $('.modal').fadeOut().remove();
            $('body').removeClass('has_modal');
            care_gallery_active = false;
            return false;
        }
    })

    $window
        .off('scroll', NewScrollHandler)
        .on('scroll', NewScrollHandler);

}


function pamed_functions(){
    var timer;
    $('body').mousemove(function() {
        $('.page_header').css({'opacity':'1'});
        $('.chapter_display').css({'opacity':'1'});
        $('.video_controls').css({'opacity':'1'});
        $('.chapters_nav').css({'opacity':'1'});
        $('.need_help_button').css({'opacity':'1'});
        clearTimeout (timer);
        timer = setTimeout(hide_header_new, 2000);
    })

    pamed_chapter_one();
    $('.chapters_nav .heading').click(function(){
        if($(this).hasClass('open')){
            $(this).removeClass('open').addClass('closed');
            $('.chapters_nav').animate({'height':'70px'},400);
        } else {
            $(this).removeClass('closed').addClass('open');
            $('.chapters_nav').animate({'height':'425px'},400,function(){
                $("html, body").animate({ scrollTop: $(document).height() }, "slow");
            });
        }
    })

    $('.chapters_nav li').click(function(){
        if($(this).hasClass('heading')){
            return false;
        }
        if($(this).hasClass('active')){
            return false;
        }
        pausePlayers();
        $('video').hide();
        $('section.response').hide();
        $('.chapters_nav li').removeClass('active');
        var chapter = $(this).attr('class');
        switch(chapter){
            case 'one':
                $('.chapters_nav li.one').addClass('active');
                pamed_chapter_one();
                break;
            case 'two':
                $('.chapters_nav li.two').addClass('active');
                pamed_chapter_two();
                break;
            case 'three':
                $('.chapters_nav li.three').addClass('active');
                pamed_chapter_three();
                break;
            case 'four':
                $('.chapters_nav li.four').addClass('active');
                pamed_chapter_four();
                break;
            case 'five':
                $('.chapters_nav li.five').addClass('active');
                pamed_chapter_five();
                break;
        }
        $('.chapters_nav .heading').click();
        $("html, body").animate({ scrollTop: 0 }, "fast");
    })

    $('.play_pause').click(function(){
        var this_video = $('video.active').attr('id');
        var video_element = document.getElementById(this_video)
        if($(this).hasClass('play')){
            $(this).removeClass('play').addClass('pause');
            video_element.play();
        } else {
            $(this).removeClass('pause').addClass('play');
            video_element.pause();
        }
    })

    $('.mute_button').click(function(){
        var this_video = $('video.active').attr('id');
        var video_element = document.getElementById(this_video)
        if($(this).hasClass('mute_off')){
            $(this).removeClass('mute_off').addClass('mute_on').data('volume',video_element.volume);
            video_element.volume = 0;
            $( '.volume_slider' ).slider( 'option', 'value',0 );
        } else {
            $(this).removeClass('mute_on').addClass('mute_off');
            video_element.volume = $(this).data('volume');
            $( '.volume_slider' ).slider( 'option', 'value' , $(this).data('volume') * 100);
        }
    })
    var video_time;

    $( ".seek_bar" ).slider({
        value: 0,
        min: 10,
        max: 1000,
        orientation: "horizontal",
        range: "min",
        animate: true,
        start: function( event, ui ) {
            var this_video = $('video.active').attr('id');
            var video_element = document.getElementById(this_video);
            video_element.pause();
            $('span.play_pause').removeClass('play').addClass('pause');
            video_element.removeEventListener("timeupdate", video_event_listener );
        },
        change: function(event, ui) {
            if (event.originalEvent) {
                //manual change
                video_seek_change();
            }
        }
    });
    $( ".volume_slider" ).slider({
        value: 100,
        orientation: "horizontal",
        range: "min",
        animate: true,
        change: function( event, ui ) {video_volume_change()},
    });

    var $handle_time_popup = $("<span/>").text("0:00").addClass('handle_time_pop');
    $(".seek_bar").slider().find(".ui-slider-handle").append($handle_time_popup);

}

function pamed_chapter_one(video_time){
    init_chapter_display('1');
    var video_id='Chapter_One_Video';
    chapter_init(video_id,video_time);
    $('.chapters_nav li.one').addClass('active');

    var video_loop_begin = '62.2';
    var video_loop_end = '92.1';
    $("#Chapter_One_Video").on('timeupdate',function(event){
        if(!$('#'+video_id).hasClass('ended')){
            if (this.currentTime >= video_loop_begin) {
                $('.video_controls').hide();
                $('section.response_one').fadeIn();
                $('#'+video_id).addClass('ended');

            }
            if (this.currentTime >= video_loop_end) {
                this.currentTime = video_loop_begin;
            }
        }
    });


    $('#'+video_id).bind("ended", function(){
        this.currentTime = video_loop_begin;
        document.getElementById('Chapter_One_Video').play();
    });

    $('.response_one .prompt button').click(function(){
        var field_content = $(this).html();
        var content_id = $(this).data('content_id');
        var field_id = $(this).data('field_id');
        if($(this).parent('fieldset').length){ //only post if in fieldset
            $.post( '/wp-content/themes/caring/helpers/handle_stories.php', { field_id: field_id, field_content: field_content, content_id: content_id } )
                .done(function( data ) {
                });
        }
        $('section.response_one .prompt').hide();
        $('section.response_one .data').fadeIn();
    });
    $('.response_one .data button').click(function(){
        $('section.response_one').hide();
        $('#Chapter_One_Video').hide();
        document.getElementById('Chapter_One_Video').pause();
        pamed_chapter_two();
    })
}

function pamed_chapter_two(video_time){
    init_chapter_display('2');
    var video_id='Chapter_Two_Video';
    chapter_init(video_id,video_time);
    $('.chapters_nav li.two').addClass('active');
    var video_loop_begin = '150';
    var video_loop_end = '168.1';
    $("#Chapter_Two_Video").on('timeupdate',function(event){
        if(!$('#'+video_id).hasClass('ended')){
            if (this.currentTime >= video_loop_begin) {
                $('.video_controls').hide();
                $('section.response_two').fadeIn();
                $('#'+video_id).addClass('ended');
            }
            if (this.currentTime >= video_loop_end) {
                this.currentTime = video_loop_begin;
            }
        }
    });

    $('#'+video_id).bind("ended", function(){
        this.currentTime = video_loop_begin;
        document.getElementById('Chapter_Two_Video').play();
    });


    $('.response_two .prompt button').click(function(){
        var field_content = $(this).html();
        var content_id = $(this).data('content_id');
        var field_id = $(this).data('field_id');
        if($(this).parent('fieldset').length){ //only post if in fieldset
            $.post( '/wp-content/themes/caring/helpers/handle_stories.php', { field_id: field_id, field_content: field_content, content_id: content_id } )
                .done(function( data ) {
                });
        }
        $('section.response_two').hide();
        document.getElementById('Chapter_Two_Video').pause();
        $('#Chapter_Two_Video').hide();
        pamed_chapter_three();
    })
}

function pamed_chapter_three(video_time){
    init_chapter_display('3');
    var video_id='Chapter_Three_Video';
    chapter_init(video_id,video_time);
    $('.chapters_nav li.three').addClass('active');
    var video_loop_begin = '162.2';
    var video_loop_end = '191';
    $("#Chapter_Three_Video").on('timeupdate',function(event){
        if(!$('#'+video_id).hasClass('ended')){
            if (this.currentTime >= video_loop_begin) {
                $('.video_controls').hide();
                $('section.response_three').fadeIn();
                $('#'+video_id).addClass('ended');
            }
            if (this.currentTime >= video_loop_end) {
                this.currentTime = video_loop_begin;
            }
        }
    });

    $('#'+video_id).bind("ended", function(){
        this.currentTime = video_loop_begin;
        document.getElementById('Chapter_Three_Video').play();
    });

    $('.response_three .prompt button').click(function(){
        var field_content = $('.response_four textarea').val();
        var content_id = $('.response_four textarea').data('content_id');
        var field_id = $('.response_four textarea').data('field_id');
        $.post( '/wp-content/themes/caring/helpers/handle_stories.php', { field_id: field_id, field_content: field_content, content_id: content_id } )
            .done(function( data ) {
            });
        $('section.response_three').hide();
        $('#Chapter_Three_Video').hide();
        document.getElementById('Chapter_Three_Video').pause();
        pamed_chapter_four();
    })
}

function pamed_chapter_four(video_time){
    init_chapter_display('4');
    var video_id='Chapter_Four_Video';
    chapter_init(video_id,video_time);
    $('.chapters_nav li.four').addClass('active');
    var video_loop_begin = '149.1';
    var video_loop_end = '180';
    $("#Chapter_Four_Video").on('timeupdate',function(event){
        if(!$('#'+video_id).hasClass('ended')){
            if (this.currentTime >= video_loop_begin) {
                $('.video_controls').hide();
                $('section.response_four').fadeIn();
                $('#'+video_id).addClass('ended');
            }
            if (this.currentTime >= video_loop_end) {
                this.currentTime = video_loop_begin;
            }
        }
    });

    $('#'+video_id).bind("ended", function(){
        this.currentTime = video_loop_begin;
        document.getElementById('Chapter_Four_Video').play();
    });

    $('.response_four .prompt button').click(function(){
        var field_content = $('.response_four textarea').val();
        var content_id = $('.response_four textarea').data('content_id');
        var field_id = $('.response_four textarea').data('field_id');
        $.post( '/wp-content/themes/caring/helpers/handle_stories.php', { field_id: field_id, field_content: field_content, content_id: content_id } )
            .done(function( data ) {
            });
        $('section.response_four').hide();
        $('#Chapter_Four_Video').hide();
        document.getElementById('Chapter_Four_Video').pause();
        pamed_chapter_five();
    })
}

function pamed_chapter_five(video_time){
    init_chapter_display('5');
    var video_id='Chapter_Five_Video';
    chapter_init(video_id,video_time);
    $('.chapters_nav li.five').addClass('active');
    var video_loop_begin = '73.2';
    var video_loop_end = '102.2';
    $("#Chapter_Five_Video").on('timeupdate',function(event){
        if(!$('#'+video_id).hasClass('ended')){
            if (this.currentTime >= video_loop_begin) {
                $('.video_controls').hide();
                $('section.response_five').fadeIn();
                $('#'+video_id).addClass('ended');
            }
            if (this.currentTime >= video_loop_end) {
                this.currentTime = video_loop_begin;
            }
        }
    });

    $('#'+video_id).bind("ended", function(){
        this.currentTime = video_loop_begin;
        document.getElementById('Chapter_Five_Video').play();
    });

    $('.response_five .prompt button').click(function(){
        var email_address = $('.response_five .email_address').val();
        if( /(.+)@(.+){2,}.(.+){2,}/.test(email_address) ){
            $.post( '/wp-content/themes/caring/helpers/handle_signup.php', { email_address: email_address } )
                .done(function( data ) {
                    if(data=='Error'){
                        //display error
                        alert('Error: Please try again.');
                    }else{
                        $('.response_five .data').prepend('<p>Thank you for signing up. You will receive an email with your password. To add more details, visit your My Story page.</p>');
                        $('.response_five .prompt').fadeOut();
                        $('.response_five .data').fadeIn();
                    }
                });
        } else {
            alert('Invalid Email Address');
            return false;
        }
    })
}

function NewScrollHandler(e) {
    if($('body').hasClass('has_modal') ){
        return false;
    }
    //throttle event:
    clearTimeout(_throttleTimer);
    _throttleTimer = setTimeout(function () {
        //do work
        if ($window.scrollTop() + $window.height() > $document.height() - 300) {
            NewLoadMore();
        }
        if ($window.scrollTop() >= ($(window).height() - 200)) {
            $('.filter').addClass('show');
        } else {
            $('.filter').removeClass('show');
        }

    }, _throttleDelay);
}

function NewLoadMore(){
    var page = $('ul.gallery').data('page');
    if(!page){
        page = 1;
    } else {
        page = page+1;
    }
    $('ul.gallery').data('page', page);
    $.post( '/wp-content/themes/caring/helpers/new_load_more.php', { limit: "10", page: page } )
        .done(function( data ) {
            var newitems = $(data);
            $('ul.gallery').isotope( 'insert', newitems )
            if(data){
                NewScrollHandler();
            }
        });
}
