
var App = {
  init: function() {
    // scroll func
    $(window).on('scroll', App.onScroll);

    // scroll to
    $('.scrollto').on('click', function() {
      var elem = $(this).data('scroll'),
          side = $(this).data('side'),
          top = $(elem).offset().top + ((side === 'bottom') ? $(elem).height() : 0),
          diff = Math.abs($(document).scrollTop() - top) * 0.75;
      $("html, body").animate({
        scrollTop: top + 'px'
      }, Math.round(diff));
    });

    // current project
    App.projectTitle = '';
    App.projectNumber = 1;
    App.projectImages = [];
    App.projectCredits = [];

    // project handling
    $('.item').on('mouseenter', function(){
      var title = $(this).data('title'),
        number = $(this).data('number');
      $('#project-title').text(title);
      $('#project-nom').text(number);
    });

    $('.projects').on('mouseleave', function(){
      $('#project-title').text(App.projectTitle);
      $('#project-nom').text(App.projectNumber);
    });

    $('.item').on('click', function(){
      App.changeProject(this);
    });

    $('#project-denom').text($('.col-third .item').length);

    // check location hash, do stuff
    App.checkHash();
    App.onScroll();

    // because I'm lazy
    setTimeout(function(){App.onScroll()}, 1000);
  },

  changeProject: function(e) {
    if (App.projectTitle !== $(e).data('title')) {
      var images = $(e).data('images').split('$IMG'),
          credits = $(e).data('credits').split('$PERSON');

      // parse data strings
      for (var i=images.length-1; i>=0; i-=1) {
        if (images[i] == '') {
          images.splice(i, 1);
        }
      }

      for (var i=credits.length-1; i>=0; i-=1) {
        if (credits[i] == '') {
          credits.splice(i, 1);
        } else {
          credits[i] = credits[i].split('$SPLIT');
        }
      }

      // remember things
      App.projectTitle = $(e).data('title');
      App.projectNumber = $(e).data('number');
      App.projectImages = images;
      App.projectCredits = credits;

      // fade out
      $('.project-slider').addClass('hide');

      // inject slider
      setTimeout(function(){
        $('#slider__inject').html('');
        $('#slider__inject').append(
            $('<div />', {class: 'project-slider hide'})
        );

        // inject slides
        for (var i=0; i<images.length; i+=1) {
          $('.project-slider').append(
            $('<div />').append(
              $('<img />', {
                'src': images[i]  //'data-lazy':images[i]
              })
            )
          )
        }

        // add information slide
        var $creditsSlide = $('<div />', {class: 'info-slide__inner'});

        for (var i=0; i<credits.length; i+=1) {
          $creditsSlide.append(
            $('<div />', {class: 'credit'}).append(
              $('<div />', {class: 'role', text: credits[i][0]})
            ).append(
              $('<div />', {class: 'person', text: credits[i][1]})
            )
          )
        }
        $('.project-slider').append($('<div />', {class: 'info-slide'}).append($creditsSlide));

        // slick init
        $('.project-slider').slick({
          arrows: false,
          speed: 500,
          slidesToShow: 3,
          centerMode: false,
          variableWidth: true,
          infinite: true,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 2
              }
            },
            {
              breakpoint: 780,
              settings: {
                centerMode: true
              }
            }
          ]
        });

        // cursors
        $('.project-slider, .slick-list, .slick-track, .slider-overlay').on('mousemove', function(e){
          if (e.clientX > window.innerWidth/2) {
            if (!$(this).hasClass('cursor-next')) {
              $(this).removeClass('cursor-prev');
              $(this).addClass('cursor-next');
            }
          } else {
            if (!$(this).hasClass('cursor-prev')) {
              $(this).removeClass('cursor-next');
              $(this).addClass('cursor-prev');
            }
          }
        });

        // navigation
        $('.project-slider, .slider-overlay').on('click', function(e){
          if (e.clientX > window.innerWidth/2) {
            $('.project-slider').slick('slickNext');
          } else {
            $('.project-slider').slick('slickPrev');
          }
        });

        $('#credits-button').on('click', function() {
          if ($('.project-slider').slick('slickCurrentSlide') * 2 != $('.slick-slide').length) {
            $('.project-slider').slick('slickGoTo', -1);
          }
        });

        // show
        $('.project-slider').removeClass('hide');
      }, 500);

      // inject credits
      $('#info__credits').html('');
      for (var i=0; i<credits.length; i+=1) {
        $('#info__credits').append(
          $('<div />', {class: 'credit'}).append(
            $('<div />', {class: 'role', text: credits[i][0]})
          ).append(
            $('<div />', {class: 'person', text: credits[i][1]})
          )
        )
      }

      // change title
      $('#project-title').text(App.projectTitle);
      $('#project-nom').text(App.projectNumber);

      // colour menu item
      $('.item.active').removeClass('active');
      $(e).addClass('active');
    }
  },

  checkHash: function() {
    var hash = window.location.hash,
      success = false;

    $('.item').each(function(i,e){
      if (hash === '#' + $(e).data('title')) {
        success = true;
        App.changeProject(e);
      }
    })

    if (!success) {
      App.changeProject($('.item:first'));
    }
  },

  onScroll: function() {
    var top = $(document).scrollTop(),
        bottom = top + window.innerHeight,
        navHeight = $('.nav').height(),
        projectsTop = $('.projects').offset().top,
        sliderTop = $('.slider').offset().top,
        infoBottom = $('.info').offset().top + $('.info').height(),
        trigger = top + navHeight;

    // change menu colour
    if (trigger > sliderTop && trigger <= infoBottom) {
      if (!$('.nav').hasClass('active')) {
        $('.nav').addClass('active');
      }
    } else if ($('.nav').hasClass('active')) {
      $('.nav').removeClass('active');
    }

    // fade in elements
    var count = 0;
    $('.cascade-fade').each(function(i, e){
      if ($(e).offset().top < bottom) {
        if (!$(e).find('img').length || $(e).find('img')[0].complete) {
          setTimeout(function(){
            $(e).removeClass('cascade-fade');
          }, count * 200);
          count += 1;
        }
      }
    });

    // lift elements
    count = 0;
    $('.cascade-rise').each(function(i, e){
      if ($(e).offset().top < bottom) {
        setTimeout(function(){
          $(e).removeClass('cascade-rise');
        }, count * 200);
        count += 1;
      }
    });
  }
};

window.onload = function() {
  App.init();
};
