jQuery(function ($) {

  function init() {
  	
    handleNewsletter();
    handleAnimatedButtons();
    if ($('.carousel').length) handleCarousel();
    if ($('.unternehmen').length) handleTextHight();
    if ($('.appearing').length) handleAppearing();
  }

  function handleNewsletter() {
    /** if input has a value, add the class filled to the element */
    function changeInputClass() {
      if ($(this).val()) $(this).addClass('filled');
      else $(this).removeClass('filled');
    }
    $('#newsletter [type="email"]').on('change', changeInputClass);
  }

  function handleAnimatedButtons() {
    var aniBtns = $('.button.anim-1, .button.anim-2, .button.anim-3');

    function animateButtons() {
      aniBtns.each(animateButton);
    }
    /** shows buttons if they are visible */
    function animateButton() {
      var elementTop = $(this).offset().top;
      var elementBottom = elementTop + $(this).outerHeight();

      var viewportTop = $(window).scrollTop();
      var viewportBottom = viewportTop + $(window).height();

      if (elementTop > viewportTop && elementBottom < viewportBottom) $(this).removeClass('invisible').addClass('show');
      else $(this).removeClass('show').addClass('invisible');
    }

    if (aniBtns.length) {
      $(window).on('load resize scroll', animateButtons);
    }
  }

  /** checks for highest element and sets min-heigth to other elements */
  function normalizeElemHeights(elements) {
    if (!elements.length) return null;
    elements.css('min-height', 0);
    var maxHeight = Math.max.apply(null,
      elements.map(function () {
        return $(this).outerHeight();
      }).get());

    elements.css('min-height', maxHeight + 'px');
    return maxHeight;
  }


  function handleCarousel() {
    /** get sliders biggest content and set min-height to other content */
    function normalizeSlideHeights() {
      $('.carousel').each(function () {
        var items = $('.carousel-item', this);
        var maxHeight = normalizeElemHeights(items);
        if (maxHeight !== null) $('.adjust-h', this).css('min-height', maxHeight + 'px');
      });
    }
    $(window).on('load resize orientationchange', normalizeSlideHeights);

    // carousel touch-event for swiping
    function carouselSwipeLeft() {
      $(this).carousel('next');
    }
    $('.carousel').on('swipeleft', carouselSwipeLeft);
    function carouselSwipeRight() {
      $(this).carousel('prev');
    }
    $('.carousel').on('swiperight', carouselSwipeRight);
  }


  function handleTextHight() {
    function normalizeTextHeights() {
      var selects = ['.executive h5.vary', '.executive h3.vary', '.partner h3.vary'];
      var i = selects.length;

      while (i--) {
        const elems = $(selects[i]);
        normalizeElemHeights(elems);
      }
    }
    $(window).on('load resize orientationchange', normalizeTextHeights);
  }

  function handleAppearing() {
    $('.appearing').one('load', function () {
      $(this).removeClass('js-hide');
    }).each(function () {
      if (this.complete) $(this).trigger("load");
    });
  }

  init();
});

jQuery(function ($) {
	function handleProducts() {
    var nav = $('#sub-nav');
    var navContainer = nav.find('.bg-white');
    var navOutline = nav.find('.outline');
    var navMenu = nav.find('.menu .pad');
    var placeholder = $('#placeholder');
    var products = [];
    var active = null;
    var sticky = {}; // { top, bottom, start, width }

    $('.product.active').removeClass('active');
    nav.addClass('sticky-nav');
/*
    $( document ).ready(function() {
      defaultValues();
      onScroll();
    });*/
/*
    function defaultValues() {
      sticky.top = $('#header').outerHeight() + 30;
      sticky.width = navContainer.find('.menu').outerWidth();
      if (window.innerWidth < 768) sticky.width -= 30;
      sticky.start = placeholder.offset().top - sticky.top;
      nav.find('.nav-container').css({ width: placeholder.width() });

      if (nav.hasClass('sticky')) {
        nav.css({ top: sticky.top });
        navContainer.css({ width: sticky.width, overflow: 'hidden' });
      }
      else {
        nav.css({ top: sticky.start + 30 });
        navContainer.css({ width: '100%' });
      }

      sticky.bottom = sticky.top + navMenu.outerHeight() - 1;

      $('[id^="prod-"]').each(function () {
        var id = $(this).attr('id');
        id = parseInt(id.slice(5));
        var factor = window.innerWidth < 576 ? 0.2 : 0.5;
        products[id] = $(this).offset().top + $(this).outerHeight() * factor;
        sticky.end = $(this).offset().top + $(this).outerHeight() - sticky.bottom;
      });

    }
    $(window).on('resize', defaultValues);
*/
    function dropdownNav() {
      if (nav.hasClass('up')) {
        nav.removeClass('up').addClass('down');
        navMenu.css({ top: 0 });
      } else {
        nav.removeClass('down').addClass('up');
        navMenu.css({ top: -nav.find('.active').position().top });
      }

    }
    nav.find('.menu-arrow').click(dropdownNav);

    function onScroll() {
      var winTop = $(window).scrollTop();
      var nextProd = winTop + sticky.bottom;
      var winBottom = winTop + $(window).height();

      if (winTop < sticky.end) {
        nav.removeClass('end');

        if (!nav.hasClass('sticky') && winTop > sticky.start) {
          nav.addClass('sticky').css({ top: sticky.top });
          navContainer.css({ width: sticky.width, overflow: 'hidden' });
        } else if (nav.hasClass('sticky') && winTop < sticky.start) {
          nav.removeClass('sticky').css({ top: sticky.start + 30 });
          navContainer.css({ width: '100%' });
        }
      }
      else{
       	nav.addClass('end');
		}
      var id, len = products.length;
      for (id = 1; id < len; id++) {
        if (products[id] < winBottom) {
          if (products[id] > nextProd) {
            activateProduct(id);
            return;
          }
        } else if (id > 1) {
          activateProduct(id - 1);
          return;
        }
      }
    }
    $(window).on('scroll', onScroll);

    function activateProduct(id) {
      if (id !== active) {
        active = id;
        $('.product.active').removeClass('active');
        $('#prod-' + id).addClass('active');

        nav.find('.active').removeClass('active');
        const a = nav.find('[href="#prod-' + id + '"]');
        a.parent().addClass('active');

        navOutline.css({
          top: a.parent().position().top,
          width: a.innerWidth()
        });

        if (nav.hasClass('up')) navMenu.css({ top: -a.parent().position().top });
        else navMenu.css({ top: 0 });
      }
    }

    function scrollingTo(e) {
      e.preventDefault();

      if (nav.hasClass('sticky') && nav.hasClass('up')) {
        dropdownNav();
        return;
      }

      var href = $(this).attr('href');
      var scrTo = $(href).offset().top - sticky.bottom;

      $('html, body').animate({
        scrollTop: scrTo
      }, 'slow');
    }
   //$('a[href^="#"]').on('click', scrollingTo);
    $(document).on('click', 'a[href^=\\#]', scrollingTo);

    $('.wpcf7-form').each(function () {
      $(this).find('.col-6')
        .children()
        .addClass('d-block mb-3')
        .appendTo('<div class="col-12 col-sm-5 col-md-12 col-lg-5"></div>')
        .parent()
        .appendTo('<div class="row new"></div>')
        .parent()
        .appendTo($(this));

      $(this).children('p')
        .appendTo('<div class="col-12 col-sm-7 col-md-12 col-lg-7"></div>')
        .parent()
        .appendTo($(this).children('.new'));

      $(this).children('.row:not(.new)').remove();
     // $(this).find('.required').remove();
    });

    $('.product').each(function () {
      var contact = $(this).find('.contact');
      var text = contact.prev();

      $(this).find('input[name="your-type"]').val('Produkt: ' + $(this).data('product'));


      function toggleContact(e) {
        e.preventDefault();
        contact.toggleClass('visible');
        if (contact.hasClass('visible')) text.parent().animate({ height: contact.innerHeight() }, 200, defaultValues);
        else text.parent().animate({ height: text.innerHeight() }, 200, defaultValues);
      }
      $(this).find('.button a, .back').click(toggleContact);

      function autoHeight() {
        if (contact.hasClass('visible')) text.parent().height(contact.innerHeight());
        else text.parent().height(text.innerHeight());
        defaultValues();
      }
      $(window).on('resize orientationchange', autoHeight);

      function autoHeightTimeOut() {
        var id = setInterval(autoHeight, 33);
        setTimeout(function () { clearInterval(id); }, 300);
      }
      $('.wpcf7').on('wpcf7invalid', autoHeightTimeOut);
    });
  }
	if ($('.produkte').length) handleProducts();
});




//von hier
jQuery(function ($) {
  var back_to_top_button = ['<a href="#top" class="back-to-top">⯅</a>'].join("");
  $("body").append(back_to_top_button)
  $(".back-to-top").hide();
  $(function () {
    $(window).scroll(function () {
      if ($(this).scrollTop() > 200) {
        $('.back-to-top').fadeIn();
      } else {
        $('.back-to-top').fadeOut();
      }
    });
    $('.back-to-top').click(function () {
      $('body,html').animate({
        scrollTop: 0
      }, 800);
      return false;
    });
  });

});

//bis hier