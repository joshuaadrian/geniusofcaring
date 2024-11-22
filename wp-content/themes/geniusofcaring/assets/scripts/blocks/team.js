// var winWidth = $(window).width();

// if ( $('.team--item').length > 0 ) {

// 	$('.team--item-link').on('click',function(e) {

// 		e.preventDefault();
// 		var href     = $(this).attr('href');
// 		var category = $('#team-filter--category').val();
// 		var query    = '';

// 		if ( category ) {

// 			query    = '?';

// 			if ( category ) {
// 				query += '&category=' +category;
// 			}

// 			href = href + query;

// 		}

// 		if (history.pushState) {
// 			var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + query;
// 			window.history.pushState({path:newurl},'',newurl);
// 		}

// 		window.location.href = href;

// 	});

// }

// if ( $('.team--dropdown').length > 0 ) {

//   $('.team--dropdown').on('change', function(e) {
//     e.preventDefault();
//     filterTeam();
//   });

// }

// function filterTeam() {

//   $('#team--search-input').val("");

//   var classesArray          = [];
//   var teamItems             = $('.team--item');

//   $('.team--dropdown').each(function(){

//     var selectClass = $(this).val();

//     if (selectClass) {
//       classesArray.push(selectClass);
//     }

//   });

//   if (classesArray.length > 0) {

//     teamItems.each(function() {

//       var shouldHide = false;
//       var teamItem  = $(this);

//       $.each(classesArray, function(i,val) {

//         if ( !teamItem.hasClass(val) ) {
//           shouldHide = true;
//         }

//       });

//       if (shouldHide) {
//         $(this).addClass('is-hiding');
//       } else {
//         $(this).removeClass('is-hiding');
//       };

//     });

//   } else {

//     teamItems.removeClass('is-hiding');

//   }

//   teamItems.addClass('over');

// }

// $('#team--search-input').on('focus',function(e) {

//   var tagValue = $(this).val();

//   if ( window.document.documentMode ) {

//     if ( tagValue ) {
//       $('.team--dropdown').val("");
//       searchTeam(tagValue);
//     } else {
//       $('.team--item').removeClass('is-hiding');
//       $('.team--dropdown').val("");
//     }

//   } else {

//     if ( tagValue ) {
//       $('.team--dropdown').val("").selectric('refresh');
//       searchTeam(tagValue);
//     } else {
//       $('.team--item').removeClass('is-hiding');
//       $('.team--dropdown').val("").selectric('refresh');
//     }

//   }

// });

// $('.team--search').on('click',function() {

//   let inputValue = $(this).find('input').val();

//   if ( inputValue && !$(this).hasClass('is-expanded') ) {
//     $(this).addClass('has-value');
//     $(this).addClass('is-expanded');
//   } else if ( inputValue ) {
//     $(this).addClass('has-value');
//   } else {
//     $(this).removeClass('has-value');
//     $(this).toggleClass('is-expanded');
//   }

// });

// $('#team--search-input').keyup(function( event ) {
//   var tagValue = $(this).val().toLowerCase();
//   searchTeam(tagValue);
// });

// function searchTeam( value ) {

//   var tagValue              = value.replace(/[^a-z0-9]/gi, '-');
//   tagValue                  = tagValue.replace('--', '-');
//   var teamItems             = $('.team--item');

// 	if (tagValue && tagValue.length > 2) {

// 		teamItems.each(function() {

// 			var shouldHide = false;
// 			var teamItem   = $(this);
//       		var tags       = teamItem.data('searchtags');

// 			if ( !tags.includes(tagValue) ) {
// 				shouldHide = true;
// 			}

// 			if (shouldHide) {
// 				$(this).addClass('is-hiding');
// 			} else {
// 				$(this).removeClass('is-hiding').addClass('over');
// 			};

// 		});


// 	} else {

// 		teamItems.removeClass('is-hiding');
//   	}

// }

// $('.team--item-link').on('click',function(e) {

//   e.preventDefault();

//   var modal     = $('.team-modal');
//   var modalWrap = $('.team-modal-wrap');
//   var id        = $(this).data('id');

//   $.ajax({
//     type     : "post",
//     dataType : "json",
//     url      : localized_object.ajax_url,
//     data : {
//       action : "get_team_modal",
//       id     : id,
//       nonce  : localized_object.nonce
//     },
//     //processData: false,
//     timeout    : 300000,
//     beforeSend : function() {
//       //grid.addClass('is-loading');
//     }
//   }).done( function( response ) {

//     //grid.removeClass('is-loading');
//     //console.log(response);

//     if ( response && typeof response.modal !== 'undefined' ) {

//       modalWrap.html(response.modal);
//       modal.addClass('is-open');

//     }

//   }).fail(function(xhr, status, error) {
//     //Ajax request failed.
//     console.log(error);
//     var errorMessage = xhr.status + ': ' + xhr.statusText
//     console.log('Error - ' + errorMessage);

//   }).always(function() {



//   });

// });