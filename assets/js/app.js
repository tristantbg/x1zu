/* globals $:false */
var width = $(window).width(),
    height = $(window).height(),
    $slider = null,
    $root = '/new',
    $sitetitle = 'Estelle Hanania',
    $body, $container, $currentyear, $currenttitle, content, flkty, flickityFirst = true;
$(function() {
    Flickity.prototype.getAdjacentCellElementAlone = function(adjacentCount, index) {
        adjacentCount = adjacentCount || 1;
        index = index === undefined ? this.selectedIndex : index;
        var startIndex = index + adjacentCount;
        var len = this.cells.length;
        var cellElems = [];
        var cellIndex = this.options.wrapAround ? fizzyUIUtils.modulo(startIndex, len) : startIndex;
        var cell = this.cells[cellIndex];
        if (cell) {
            cellElems.push(cell.element);
        }
        return cellElems;
    };
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
                $container = $('#container');
                $currentyear = $('.current_title .year');
                $currenttitle = $('.current_title .project_title');
                History.Adapter.bind(window, 'statechange', function() {
                    var State = History.getState();
                    console.log(State);
                    content = State.data;
                    if (content.type == 'project') {
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
                    if ($el.data('target') == "project") {
                        History.pushState({
                            type: 'project'
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
                $('body').on('click', '.infos_switch', function(e) {
                    e.preventDefault();
                    $container.toggleClass('infos');
                });
                if ($body.hasClass('album')) {
                    app.loadSlider();
                } else if ($body.hasClass('index')) {
                    $('.album_thumb img').hover(function() {
                        $el = $(this).parent().parent();
                        $currentyear.html($el.data('year'));
                        $currenttitle.html($el.data('title') + ' (' + $el.data('category') + ')');
                    }, function() {
                        if (!$body.hasClass('leaving')) {
                            $currentyear.html('');
                            $currenttitle.html('');
                        }
                    });
                }
                smoothScroll.init({
                    speed: 1300
                });
                //var rellax = new Rellax('.album_thumb');
                //esc
                $(document).keyup(function(e) {
                    if (e.keyCode === 27) app.goIndex();
                });
                //left
                $(document).keyup(function(e) {
                    if (e.keyCode === 37 && $slider) app.goPrev($slider);
                });
                //right
                $(document).keyup(function(e) {
                    if (e.keyCode === 39 && $slider) app.goNext($slider);
                });
                if (Modernizr.touch) {
                    app.mobileMenu();
                } else {
                    app.mouseNav();
                }
            });
        },
        sizeSet: function() {
            width = $(window).width();
            height = $(window).height();
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
        mobileMenu: function() {
            $("ul.category .title").click(function(event) {
                var parent = $(this).parent();
                if (!parent.hasClass('active')) {
                    $("ul.category.active").removeClass('active').find('ul.albums').slideToggle(800);
                    parent.addClass('active').find('ul.albums').slideToggle(800);
                }
            });
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
                $slider.on('staticClick.flickity', function(event, pointer, cellElement, cellIndex) {
                    if (!cellElement) {
                        return;
                    }
                    app.goNext($slider);
                });
                $slider.on('lazyLoad.flickity', function(event, cellElement) {
                    $body.removeClass('loading');
                });
                $('body').on('click', '.prev', function(e) {
                    e.preventDefault();
                    app.goPrev($slider);
                });
                $('body').on('click', '.next', function(e) {
                    e.preventDefault();
                    app.goNext($slider);
                });
                flickityFirst = false;
            }
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
                        if (content.type == 'project') {
                            $body.attr('class', 'album');
                        }
                    }, 100);
                    if (content.type == 'project') {
                        $body.attr('class', 'leaving index');
                        app.loadSlider();
                    } else if (content.type == 'page') {
                        $body.attr('class', 'leaving').addClass('page');
                    } else if (content.type == 'index') {
                        $body.attr('class', 'leaving').addClass('index');
                        $currentyear = $('.current_title .year');
                        $currenttitle = $('.current_title .project_title');
                        $('.album_thumb img').hover(function() {
                            $el = $(this).parent().parent();
                            $currentyear.html($el.data('year'));
                            $currenttitle.html($el.data('title') + ' (' + $el.data('category') + ')');
                        }, function() {
                            if (!$body.hasClass('leaving')) {
                                $currentyear.html('');
                                $currenttitle.html('');
                            }
                        });
                        app.deferImages();
                    }
                });
            }, 200);
        },
        deferImages: function() {
            var imgDefer = document.getElementsByTagName('img');
            for (var i = 0; i < imgDefer.length; i++) {
                if (imgDefer[i].getAttribute('data-src')) {
                    imgDefer[i].setAttribute('src', imgDefer[i].getAttribute('data-src'));
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

function init() {}
init();