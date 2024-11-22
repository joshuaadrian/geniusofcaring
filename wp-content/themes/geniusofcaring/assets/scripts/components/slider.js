// import Swiper bundle with all modules installed
import Swiper from 'swiper/bundle';

// import styles bundle
import 'swiper/css/bundle';

export const slider = () => {

	function setAlignFullCssVar() {
    // Create the measurement node
    let scrollDiv = document.createElement('div');
    scrollDiv.className = 'scrollbar-measure';
    document.body.appendChild(scrollDiv);

    // Get the scrollbar width & half width
    let scrollBarWidth = window.innerWidth - scrollDiv.clientWidth;
    let alignFullOffset = scrollBarWidth / 2;

    // console.log(window.innerWidth);
    // console.log(scrollDiv.clientWidth);
    // console.warn(scrollBarWidth); // Mac:  15

    // Delete the DIV
    document.body.removeChild(scrollDiv);

    //Get .alignfull element
    let root = document.documentElement;
    let root_style = getComputedStyle(root);

    //Set --alignfull-offset css var
    let cssVarAlignFullOffset =
      root_style.getPropertyValue('--alignfull-offset');
    if (alignFullOffset + 'px' !== cssVarAlignFullOffset) {
      root.style.setProperty('--alignfull-offset', alignFullOffset + 'px');
    }
  }

//post sliders
  document
    .querySelectorAll('.wp-block-group.is-slider')
    .forEach((block, i) => {
      // const swiperEl = '.is-style-slider';
      // $(block).removeClass(function (index, css) {
      //   return (css.match(/\bwp-\S+/g) || []).join(' '); // removes anything that starts with "wp-container"
      // });
      // $(swiperEl).attr('class', 'wp-block-gallery is-style-slider swiper');
      $(block)
        .addClass('swiper')
        .find('.wp-block-group__inner-container').eq(0)
        .addClass('swiper-wrapper')
        .children('.wp-block-group')
        .addClass('swiper-slide');

      $(block)
        .append('<div class="swiper-pagination">')
        .append(
          '<div class="swiper-button-prev swiper-button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 77.46 39.74"><polygon fill="#000000" points="55.47 2.12 71.72 18.37 0 18.37 0 21.37 71.72 21.37 55.47 37.62 57.59 39.74 77.46 19.87 57.59 0 55.47 2.12"/></svg>',
        )
        .append(
          '<div class="swiper-button-next swiper-button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 77.46 39.74"><polygon fill="#000000" points="55.47 2.12 71.72 18.37 0 18.37 0 21.37 71.72 21.37 55.47 37.62 57.59 39.74 77.46 19.87 57.59 0 55.47 2.12"/></svg>',
        );

        let slide = $(block).find('.swiper-slide');

        slide.each(function(i) {
          var randomImages = $(this).find('.is-random');
          var randomImagesCount = randomImages.length;
          var randomImage = Math.floor(Math.random() * randomImagesCount);
          randomImages.eq(randomImage).show();
        });

        // let slideCount = $(block).find('.swiper-slide').length;
        // let randomSlide = Math.floor(Math.random() * slideCount);

      let swiper = new Swiper(block, {
        loop: true,
        slidesPerView: 'auto',
        autoHeight: false,
        //initialSlide:randomSlide,
        speed:600,
        autoplay: {
          delay: 5000,
        },
        pagination: {
          el: '.swiper-pagination',
          clickable: true
          // type: 'custom',
          // renderCustom: function (swiper, current, total) {
          //   return (
          //     '<span class="swiper-pagination-current">' +
          //     ('0' + current).slice(-2) +
          //     '</span> / <span class="swiper-pagination-total">' +
          //     ('0' + total).slice(-2) +
          //     '</span>'
          //   );
          // },
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        on: {
          init: function () {
            // console.log('initialized.'); // this works
            //setAlignFullCssVar();
          },
          imagesReady: function () {
            // console.log('images ready.'); // this doesn't work
            setAlignFullCssVar();
          },
        },
      });

      $('.swiper-button').on('click',function() {
        swiper.autoplay.stop();
      });

    });

 }