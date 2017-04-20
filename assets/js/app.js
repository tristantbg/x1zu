/* globals $:false */
var width,
    height,
    transition = 400,
    isMobile = false,
    isSliding = false,
    slideCount = 1,
    imgs,
    imgNb,
    $currentCell, next,
    $slider = null,
    $root = '',
    $body, $intro, $menu, $collections, $container, $header, content, flkty, flickityFirst = true;
$(function() {
    var app = {
        init: function() {
            $(window).load(function() {
                $(".loader").fadeOut(300);
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
                app.sizeSet();
                app.setSlider();
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
                        }, $el.data('title') + " | " + $sitetitle, $el.attr('href'));
                    } else if ($el.data('target') == "page") {
                        History.pushState({
                            type: 'page'
                        }, $el.data('title') + " | " + $sitetitle, $el.attr('href'));
                    } else if ($el.data('target') == "index") {
                        e.preventDefault();
                        app.goIndex();
                    }
                });
                $('body').on('click touchstart', '.prev', function(e) {
                    e.preventDefault();
                    app.slide('prev');
                });
                $('body').on('click touchstart', '.next', function(e) {
                    e.preventDefault();
                    app.slide('next');
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
                // left
                $(document).keyup(function(e) {
                    if (e.keyCode === 37) app.slide('prev');
                });
                //right
                $(document).keyup(function(e) {
                    if (e.keyCode === 39) app.slide('next');
                });
                // $(window).scroll(function(event) {
                //     if ($(window).scrollTop() > 45) {
                //         $header.addClass('scrolled');
                //     } else {
                //         $header.removeClass('scrolled');
                //     }
                // });
                window.viewportUnitsBuggyfill.init();
            });
        },
        slide: function(way) {
            if (!isSliding) {
                if (isMobile) {
                    var $currentImg = $(".image.active");
                    imgs.attr('class', 'image');
                    if (way == 'next') {
                        $activeImg = imgs.eq((imgs.index($currentImg) + 1) % imgs.length).addClass("active");
                        $next = imgs.eq((imgs.index($activeImg) + 1) % imgs.length);
                        $next.find('.lazyimg').addClass('lazyload');
                        if ($activeImg.is(imgs.eq(0))) {
                            app.updateCounter(true, way);
                        } else {
                            app.updateCounter(false, way);
                        }
                    } else {
                        $activeImg = imgs.eq((imgs.index($currentImg) - 1) % imgs.length).addClass("active");
                        $prev = imgs.eq((imgs.index($activeImg) - 1) % imgs.length);
                        $prev.find('.lazyimg').addClass('lazyload');
                        if ($activeImg.is(imgs.eq(-1))) {
                            app.updateCounter(true, way);
                        } else {
                            app.updateCounter(false, way);
                        }
                    }
                } else {
                    if (imgNb > 2) {
                        isSliding = true;
                        var cells = $(".slider .gallery_cell");
                        var $currentCell = $(".gallery_cell.active");
                        cells.attr('class', 'gallery_cell');
                        if (way == 'next') {
                            $currentCell = cells.eq((cells.index($currentCell) + 1) % cells.length).addClass("active");
                            $nextCell = cells.eq((cells.index($currentCell) + 1) % cells.length);
                            $prevCell = cells.eq((cells.index($currentCell) - 1) % cells.length);
                            $nextCell.find('.lazyimg').addClass('lazyload');
                            $currentCell.find('.image').addClass('animate');
                            if ($currentCell.is(cells.eq(0))) {
                                app.updateCounter(true, way);
                            } else {
                                app.updateCounter(false, way);
                            }
                            app.displayContent(false, way);
                            setTimeout(function() {
                                $prevCell.find('.image').attr('class', 'image');
                                isSliding = false;
                            }, transition * 2);
                        } else {
                            $currentCell = cells.eq((cells.index($currentCell) - 1) % cells.length).addClass("active");
                            $nextCell = cells.eq((cells.index($currentCell) + 1) % cells.length);
                            $prevCell = cells.eq((cells.index($currentCell) - 1) % cells.length);
                            $prevCell.find('.lazyimg').addClass('lazyload');
                            $currentCell.find('.image').addClass('animate');
                            if ($currentCell.is(cells.eq(-1))) {
                                app.updateCounter(true, way);
                            } else {
                                app.updateCounter(false, way);
                            }
                            app.displayContent(false, way);
                            setTimeout(function() {
                                $nextCell.find('.image').attr('class', 'image');
                                isSliding = false;
                            }, transition * 2);
                        }
                    }
                }
            }
        },
        updateCounter: function(reset, way) {
            if (reset) {
                if (!way || way == 'next') {
                    slideCount = 1;
                } else {
                    if (isMobile) {
                        slideCount = imgNb;
                    } else {
                        slideCount = imgNb - 1;
                    }
                }
            } else {
                if (isMobile) {
                    if (way == 'next') {
                        slideCount++;
                    } else {
                        slideCount--;
                    }
                } else {
                    if (way == 'next') {
                        slideCount += 2;
                    } else {
                        slideCount -= 2;
                    }
                }
            }
            if (isMobile) {
                $('.counter').html(slideCount);
            } else {
                $('.counter').html(slideCount + '–' + (slideCount + 1));
            }
        },
        setSlider: function() {
            $slider = $('.slider');
            if ($slider.length > 0) {
                imgs = $(".slider .image");
                var images = document.getElementsByClassName('image');
                var lazyimg = document.getElementsByClassName('lazyimg');
                imgNb = images.length;
                if (imgNb > 0) {
                    var lazyload;
                    if (isMobile) {
                        images[0].className += " active";
                        lazyload = [0, 1, lazyimg.length - 1];
                        for (var i = 0; i < lazyload.length; i++) {
                            if (lazyload[i] < imgNb) {
                                lazyimg[lazyload[i]].className += " lazyload";
                            }
                        }
                    } else {
                        images[0].className += " animate";
                        images[1].className += " animate";
                        lazyload = [0, 1, 2, 3, lazyimg.length - 1, lazyimg.length - 2];
                        for (var i = 0; i < lazyload.length; i++) {
                            if (lazyload[i] < imgNb) {
                                lazyimg[lazyload[i]].className += " lazyload";
                            }
                        }
                        document.getElementsByClassName('gallery_cell')[0].className += " active";
                    }
                    app.updateCounter(true);
                }
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
                            app.updateCounter(true, way);
                        }
                    }
                }, time);
                time += transition;
            });
        },
        sizeSet: function() {
            width = $(window).width();
            height = $(window).height();
            if (width <= 770 || Modernizr.touch) isMobile = true;
            if (isMobile) {
                if (width >= 770) {
                    location.reload();
                }
            } else {}
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
                $(window).scrollTop(0);
                $(target).load(url + ' #container .inner', function(response) {
                    app.setSlider();
                    if (content.type == 'collection') {
                        $body.attr('class', 'leaving collection');
                        //app.loadSlider();
                    } else if (content.type == 'page') {
                        $body.attr('class', 'leaving page');
                    } else {
                        $body.attr('class', 'leaving collection');
                    }
                    setTimeout(function() {
                        $body.removeClass('leaving');
                        app.displayContent(false);
                    }, 100);
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