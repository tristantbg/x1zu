/* globals $:false */
var width,
    height,
    transition = 400,
    isMobile = false,
    isSliding = false,
    slideCount = 1,
    imgNb,
    $slider = null,
    $root = '',
    $body, $intro, $menu, $collections, $container, $header, content, flkty, flickityFirst = true;
$(function() {
    var app = {
        init: function() {
            $(window).load(function() {
                $(".loader").fadeOut(300);
                app.sizeSet();
                app.displayContent(false);
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
                imgNb = document.getElementsByClassName('image').length;
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
                $('body').on('click touchstart', ".slider", function(e) {
                    e.preventDefault();
                    app.slideNext();
                });
                $('body').on('mouseenter', ".addresslink", function(e) {
                    e.preventDefault();
                    $(this).parents('.entry').find('.addresslink').addClass('hover');
                });
                $('body').on('mouseleave', ".addresslink", function(e) {
                    e.preventDefault();
                    $(this).parents('.entry').find('.addresslink').removeClass('hover');
                });
                $('body').on('mouseenter', "[data-image]", function(e) {
                    e.preventDefault();
                    $('.img_hover img').attr('src', $(this).data('image'));
                });
                $('body').on('mouseleave', "[data-image]", function(e) {
                    e.preventDefault();
                    $('.img_hover img').attr('src', 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==');
                });
                //esc
                $(document).keyup(function(e) {
                    if (e.keyCode === 27) app.goIndex();
                });
                //left
                // $(document).keyup(function(e) {
                //     if (e.keyCode === 37) app.slideNext();
                // });
                // //right
                $(document).keyup(function(e) {
                    if (e.keyCode === 39) app.slideNext();
                });
                // $(window).scroll(function(event) {
                //     if ($(window).scrollTop() > 45) {
                //         $header.addClass('scrolled');
                //     } else {
                //         $header.removeClass('scrolled');
                //     }
                // });
                window.viewportUnitsBuggyfill.init();
                //app.deferImages();
            });
        },
        slideNext: function() {
            if (!isSliding) {
                if (isMobile) {
                    var imgs = $(".slider .image");
                    var $currentImg = $(".image.active");
                    imgs.attr('class', 'image');
                    $activeImg = imgs.eq((imgs.index($currentImg) + 1) % imgs.length).addClass("active");
                    var $currentCell = $activeImg.parent();
                    $currentCell.next().find('.lazyimg').addClass('lazyload');
                    if ($activeImg.is(imgs.eq(0))) {
                        app.updateCounter(true);
                    } else {
                        app.updateCounter();
                    }
                } else {
                    if (imgNb > 2) {
                        isSliding = true;
                        var next = $(".slider .image:not('.displayed'):eq(0)").add(".slider .image:not('.displayed'):eq(1)");
                        var $currentCell = next.parent();
                        $currentCell.next().find('.lazyimg').addClass('lazyload');
                        if (next.length < 1) {
                            var imgs = $(".slider .image");
                            imgs.not(':eq(0), :eq(1), :eq(-1), :eq(-2)').attr('class', 'image');
                            imgs.slice(0, 2).attr('class', 'image animate displayed');
                            var reset = $(".slider .image:eq(-1)").add(".slider .image:eq(-2)");
                            reset.eq(0).removeClass('displayed');
                            app.updateCounter(true);
                            setTimeout(function() {
                                reset.eq(1).removeClass('displayed');
                            }, transition);
                            setTimeout(function() {
                                reset.attr('class', 'image');
                                isSliding = false;
                            }, transition * 2);
                        } else {
                            next.addClass('animate');
                            app.displayContent(true);
                        }
                    }
                }
            }
        },
        updateCounter: function(reset) {
            if (reset) {
                slideCount = 1;
            } else {
                if (isMobile) {
                    slideCount++;
                } else {
                    slideCount += 2;
                }
            }
            if (isMobile) {
                $('.counter').html(slideCount);
            } else {
                $('.counter').html(slideCount + '–' + (slideCount + 1));
            }
        },
        displayContent: function(slider) {
            var time = 0;
            var elems = $('.animate:not(".displayed")');
            count = elems.length;
            elems.each(function(index) {
                var el = $(this);
                setTimeout(function() {
                    el.addClass('displayed');
                    if (slider) {
                        if (index == count - 1) {
                            $(".slider .image.animate.displayed:not('.hide')").slice(0, 2).addClass('hide');
                            isSliding = false;
                        } else {
                            app.updateCounter();
                        }
                    }
                }, time);
                time += transition;
            });
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
        goIndex: function() {
            History.pushState({
                type: 'index'
            }, $sitetitle, window.location.origin + $root);
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
                        app.displayContent(false);
                    }, 100);
                    imgNb = document.getElementsByClassName('image').length;
                    if (content.type == 'collection') {
                        app.updateCounter(true);
                        $body.attr('class', 'leaving collection');
                        //app.loadSlider();
                    } else if (content.type == 'page') {
                        $body.attr('class', 'leaving page');
                    } else {
                        $body.attr('class', 'leaving collection');
                    }
                    //app.deferImages();
                    app.sizeSet();
                });
            }, 200);
        },
        deferImages: function() {
            var imgDefer = document.getElementsByClassName('lazyimg');
            for (var i = 0; i < imgDefer.length; i++) {
                if (imgDefer[i].getAttribute('data-srcset')) {
                    imgDefer[i].setAttribute('srcset', imgDefer[i].getAttribute('data-srcset'));
                    imgDefer[i].setAttribute('class', 'lazyimg lazyloaded');
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