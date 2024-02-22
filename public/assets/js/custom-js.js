// Mobile Sidebar Nav
$(".mob-sidebar-trigger").click(function() {
    $(".mobile-nav").addClass("show");
});
$(".close-mobile-nav").click(function() {
    $(".mobile-nav").removeClass("show");
});

// Cart Sidebar
$(".cart-btn").click(function() {
    $(".sidebar-cart").addClass("show");
});
$(".close-sidebar-cart").click(function() {
    $(".sidebar-cart").removeClass("show");
});


// header background color on scroll
$(function() {
    $(window).on("scroll", function() {
        if ($(window).scrollTop() > 50) {
            $("header nav").addClass("active");
        } else {
            //remove the background property so it comes transparent again (defined in your css)
            $("header nav").removeClass("active");
        }
    });
});

// Fixed bottom buttons
// $(function () {
//     $(window).on("scroll", function () {
//     if ($(window).scrollTop() > 250) {
//         $(".fixed-buttons").addClass("active");
//     } else {
//         $(".fixed-buttons").removeClass("active");
//     }
//     });
// });

// product Increment/Decrement Button
function increaseValue() {
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    if(value < 1){
        document.getElementById('number').value = `01`;
    }else if(value < 10){
        document.getElementById('number').value = `0${value}`;
    }else{
        document.getElementById('number').value = value;
    }
    
}

function decreaseValue() {
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value < 1 ? value = 1 : '';
    value--;
   // document.getElementById('number').value = value;
   if(value < 1){
        document.getElementById('number').value = `01`;
    }else if(value < 10){
        document.getElementById('number').value = `0${value}`;
    }else{
        document.getElementById('number').value = value;
    }
}

// Show Error Alert in My account Page

$("#login").click(function() {
    $(".login-alert").addClass("show");
});
$(".login-alert .close").click(function() {
    $(".login-alert").removeClass("show");
});

$("#register").click(function() {
    $(".register-alert").addClass("show");
});
$(".register-alert .close").click(function() {
    $(".register-alert").removeClass("show");
});


// Show Alert when news passwords do not match
$("#save-changes").click(function() {
    $(".pass-unmatched").addClass("show");
});
$(".pass-unmatched .close").click(function() {
    $(".pass-unmatched").removeClass("show");
});

// Range Slider for filter

window.onload = function() {
    slideOne();
    slideTwo();
}

let sliderOne = document.getElementById("slider-1");
let sliderTwo = document.getElementById("slider-2");
let displayValOne = document.getElementById("range1");
let displayValTwo = document.getElementById("range2");
let minGap = 0;
let sliderTrack = document.querySelector(".slider-track");
let sliderMaxValue = 0;

if(document.getElementById("slider-1")){

    sliderMaxValue = document.getElementById("slider-1").max;
}
function slideOne() {
    if(sliderOne) {
        if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
            sliderOne.value = parseInt(sliderTwo.value) - minGap;
        }
        displayValOne.textContent = "£" + sliderOne.value;
        fillColor();
    }
}

function slideTwo() {
    if(sliderTwo) {
        if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
            sliderTwo.value = parseInt(sliderOne.value) + minGap;
        }
        displayValTwo.textContent = "£" + sliderTwo.value;
        fillColor();
    }
}

function fillColor() {
    percent1 = (sliderOne.value / sliderMaxValue) * 100;
    percent2 = (sliderTwo.value / sliderMaxValue) * 100;
    sliderTrack.style.background = `linear-gradient(to right, #dadae5 ${percent1}% , #000 ${percent1}% , #000 ${percent2}%, #dadae5 ${percent2}%)`;
}


