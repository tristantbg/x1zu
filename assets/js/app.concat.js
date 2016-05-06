/* globals $:false */
var width = $(window).width(),
    height = $(window).height();
$(function() {
    var app = {
        init: function() {
          $(window).load(function() {
        $(".loader").fadeOut("fast");
    });
    $(window).resize(function(event) {});
    $(document).ready(function($) {});
        },
        loadContent: function(url, target) {
            $.ajax({
                url: url,
                success: function(data) {
                    $(target).html(data);
                }
            });
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