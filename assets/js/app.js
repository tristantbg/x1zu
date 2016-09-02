/* globals $:false */
var width,
    height,
    isMobile = false,
    $slider = null,
    $root = '/xuzhi',
    $body, $intro, $menu, $collections, $container, $header, content, flkty, flickityFirst = true;
$(function() {
    var app = {
        init: function() {
            $(window).load(function() {
                app.deferImages();
                $(".loader").fadeOut(300);
            });
            $(window).resize(function(event) {
                app.sizeSet();
            });
            $(document).ready(function($) {
                $body = $('body');
                $intro = $('#intro');
                $container = $('#container');
                $menu = $('#menu');
                $collections = $('#menu ul');
                $header = $('header');
                app.sizeSet();
                $intro.bind('click touchstart', function(event) {
                    event.preventDefault();
                    app.hideIntro();
                });
                setTimeout(function() {
                    app.hideIntro();
                }, 4000);
                // $menu.hover(function(event) {
                //   $menu.toggleClass('opened');
                // });
                History.Adapter.bind(window, 'statechange', function() {
                    var State = History.getState();
                    console.log(State);
                    content = State.data;
                    if (content.type == 'collection') {
                        app.loadContent(State.url, $container);
                    } else if (content.type == 'page') {
                        app.loadContent(State.url, $container);
                    } else {
                        app.loadContent(State.url, $container);
                        if ($slider != null) {
                            $slider = null;
                            flkty = null;
                        }
                    }
                });
                $('body').on('click', '[data-target]', function(e) {
                    $el = $(this);
                    e.preventDefault();
                    $('.active').removeClass('active');
                    $el.parent('li').addClass('active');
                    if ($el.data('target') == "collection") {
                        History.pushState({
                            type: 'collection'
                        }, $sitetitle + " | " + $el.data('title'), $el.attr('href'));
                    } else if ($el.data('target') == "page") {
                        History.pushState({
                            type: 'page'
                        }, $sitetitle + " | " + $el.data('title'), $el.attr('href'));
                    } else if ($el.data('target') == "index") {
                        e.preventDefault();
                        app.goIndex();
                    }
                });
                $('body').on('touchstart', '[data-gps]', function(e) {
                    e.preventDefault();
                    $el = $(this);
                    $el.toggleClass('displayed');
                });
                $menu.find('.menu_title').on('touchstart', $menu, function(e) {
                    e.preventDefault();
                    $collections.toggle();
                });
                //esc
                $(document).keyup(function(e) {
                    if (e.keyCode === 27) app.goIndex();
                });
                //left
                // $(document).keyup(function(e) {
                //     if (e.keyCode === 37 && $slider) app.goPrev($slider);
                // });
                // //right
                // $(document).keyup(function(e) {
                //     if (e.keyCode === 39 && $slider) app.goNext($slider);
                // });
                $(window).scroll(function(event) {
                    if ($(window).scrollTop() > 45) {
                        $header.addClass('scrolled');
                    } else {
                        $header.removeClass('scrolled');
                    }
                });
                window.viewportUnitsBuggyfill.init();
            });
        },
        hideIntro: function() {
            $intro.addClass('hidden');
            setTimeout(function() {
                $intro.remove();
            }, 1000);
        },
        sizeSet: function() {
            width = $(window).width();
            height = $(window).height();
            isMobile = ((width <= 770 || Modernizr.touch) ? true : false);
            if (isMobile) {} else {
                // var s = skrollr.init({
                //     smoothScrollingDuration: 500,
                //     forceHeight: false
                // });
                //app.scrollEffect();
            }
        },
        mouseNav: function(event) {
            $(window).mousemove(function(event) {
                if ($body.hasClass('page')) {
                    posX = event.pageX;
                    posY = event.pageY;
                    $('.img_hover').css({
                        'top': posY + 5 + 'px',
                        'left': posX + 'px',
                    });
                }
            });
        },
        scrollEffect: function() {
            parallax = new ScrollMagic.Controller({
                globalSceneOptions: {
                    triggerHook: 'onEnter'
                }
            });
            var $albums = document.querySelectorAll(".album_thumb");
            for (var i = 0; i < $albums.length; i++) {
                app.placeElem($albums[i]);
            }
        },
        placeElem: function(elem) {
            //     if (elem.getAttribute("data-ratio") > 1) {
            //         elemW = 100;
            //     } else {
            //         elemW = rand(85, 93);
            //     }
            //     rotationStart = rand(-10, 10);
            //     rotationEnd = rand(-10, 10);
            //     ySpeed = (startPos + rand(-30, 50)) + '%';
            ySpeed = elem.dataset.yvel + "%";
            TweenLite.to(elem, 0, {
                y: 0,
                force3D: true
            });
            new ScrollMagic.Scene({
                triggerElement: elem,
                duration: rand(2, 3) * height + "px"
            }).setTween(elem, {
                y: ySpeed,
                force3D: true
            }).addTo(parallax);
        },
        loadSlider: function() {
            $slider = $('.slider').flickity({
                cellSelector: '.gallery_cell',
                imagesLoaded: true,
                lazyLoad: 1,
                setGallerySize: false,
                friction: 0.3,
                //percentPosition: false,
                wrapAround: false,
                prevNextButtons: false,
                pageDots: false,
                draggable: true
            });
            flkty = $slider.data('flickity');
            var prevCell;
            if (flickityFirst) {
                $('body').on('click touchstart', '.prev', function(e) {
                    e.preventDefault();
                    app.goPrev($slider);
                });
                $('body').on('click touchstart', '.next', function(e) {
                    e.preventDefault();
                    app.goNext($slider);
                });
                flickityFirst = false;
            }
            $slider.on('staticClick.flickity', function(event, pointer, cellElement, cellIndex) {
                if (!cellElement) {
                    return;
                }
                app.goNext($slider);
            });
            $slider.on('lazyLoad.flickity', function(event, cellElement) {
                $body.removeClass('loading');
            });
            $slider.on('cellSelect.flickity', function() {
                if (prevCell <= flkty.selectedIndex) {
                    $slider.removeClass('backwards').addClass('forwards');
                } else {
                    $slider.removeClass('forwards').addClass('backwards');
                }
                var adjCellPrev = $slider.flickity('getAdjacentCellElementAlone', -1);
                var adjCellNext = $slider.flickity('getAdjacentCellElementAlone', 1);
                $(adjCellPrev).removeClass('is-next').addClass('is-prev');
                $(adjCellNext).removeClass('is-prev').addClass('is-next');
                prevCell = flkty.selectedIndex;
            });
        },
        goIndex: function() {
            History.pushState({
                type: 'index'
            }, $sitetitle, window.location.origin + $root);
        },
        goNext: function($slider) {
            $slider.flickity('next', false);
        },
        goPrev: function($slider) {
            $slider.flickity('previous', false);
        },
        loadContent: function(url, target) {
            // $.ajax({
            //     url: url,
            //     success: function(data) {
            //         $(target).html(data);
            //         app.loadSlider();
            //     }
            // });
            //
            $body.addClass('leaving');
            setTimeout(function() {
                $body.scrollTop(0);
                $(target).load(url + ' #container .inner', function(response) {
                    setTimeout(function() {
                        $body.removeClass('leaving');
                    }, 100);
                    if (content.type == 'collection') {
                        $body.attr('class', 'leaving collection');
                        //app.loadSlider();
                    } else if (content.type == 'page') {
                        $body.attr('class', 'leaving page');
                    } else {
                        $body.attr('class', 'leaving collection');
                    }
                    app.deferImages();
                    app.sizeSet();
                });
            }, 200);
        },
        deferImages: function() {
            var imgDefer = document.getElementsByTagName('img');
            for (var i = 0; i < imgDefer.length; i++) {
                if (imgDefer[i].getAttribute('data-srcset')) {
                    imgDefer[i].setAttribute('srcset', imgDefer[i].getAttribute('data-srcset'));
                }
            }
        }
    };
    app.init();
});

function rand(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function arrayRand(myArray) {
    var rand = myArray[Math.floor(Math.random() * myArray.length)];
    return rand;
}