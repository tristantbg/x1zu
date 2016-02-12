/* globals $:false */
var width = $(window).width(),
    height = $(window).height();
$(function() {
    var app = {
        init: function() {}
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

function init() {
    $(window).load(function() {
        $(".loader").fadeOut("fast");
    });
    $(window).resize(function(event) {});
    $(document).ready(function($) {});
}
init();