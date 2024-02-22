// Brands Slider four Column
$('.brands-slider').owlCarousel({
    loop: true,
    margin: 30,
    nav: true,
    dots: false,
    navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"],
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 2
        },
        1000: {
            items: 4
        }
    }
});

// News Brands Slider
$('.news-brands-slider').owlCarousel({
    loop: true,
    margin:30,
    nav: true,
    dots: false,
    autoplay: true,
    autoplayTimeout: 2000,
    autoplayHoverPause: true,
    navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"],
    responsive: {
        0: {
            items:1
        },
        600: {
            items: 3
        },
        1000: {
            items: 4
        },
        1100: {
            items: 5
        },
        1200: {
            items: 7
        }
    }
});

// Product common slider
$('.product-slider').owlCarousel({
    loop: true,
    margin: 30,
    nav: true,
    dots: false,
    navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"],
    autoplay: true,
    autoplayTimeout: 2000,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 1
        },
        450: {
            items: 2
        },
        700: {
            items: 3
        },
        1000: {
            items: 4
        },
        1200: {
            items: 5
        }
    }
});

$('#slider-men-new').on('initialized.owl.carousel changed.owl.carousel', function(e) {
    if (!e.namespace)  {
      return;
    }
    var carousel = e.relatedTarget;
    $('.slider-counter').text(carousel.relative(carousel.current()) + 1 + '/' + carousel.items().length);
  }).owlCarousel({
});


$('.single-product .column .single-img-slider.owl-carousel').on("initialized.owl.carousel changed.owl.carousel", function (e) {
    $("#counterindex").text(
        e.relatedTarget.relative(e.item.index) + 1 + "/" + e.item.count
    );
}).owlCarousel({
    loop: true,
    margin: 30,
    nav: true,
    autoplay: true,
    autoPlaySpeed: 5000,
    autoPlayTimeout: 5000,
    autoplayHoverPause: true,
    dots: false,
    navText: ["<img src='../../../../assets/images/left-arrow.png'>", "<img src='../../../../assets/images/right-arrow.png'>"],
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
})

$('.recently-viewed-products .product-slider1.owl-carousel').on("initialized.owl.carousel changed.owl.carousel", function (e) {
    $("#counterindex1").text(
        e.relatedTarget.relative(e.item.index) + 1 + "/" + e.item.count
    );
}).owlCarousel({
    loop: true,
    margin: 30,
    nav: true,
    autoplay: true,
    autoPlaySpeed: 5000,
    autoPlayTimeout: 5000,
    autoplayHoverPause: true,
    dots: false,
    navText: ["<img src='../../../../assets/images/left-arrow.png'>", "<img src='../../../../assets/images/right-arrow.png'>"],
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
})


// Brands Slider four Column
$('.news-slider').owlCarousel({
    loop: true,
    margin: 30,
    nav: true,
    dots: false,
    navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"],
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 2
        },
        1000: {
            items: 3
        }
    }
});

$('.single-img-slider').owlCarousel({
    loop: true,
    margin: 30,
    nav: true,
    autoplay: true,
    autoPlaySpeed: 5000,
    autoPlayTimeout: 5000,
    autoplayHoverPause: true,
    dots: false,
    navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"],
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
});
$('.single-img-slider_banner').owlCarousel({
    loop: true,
    margin: 30,
    nav: true,
    autoplay: false,
    autoPlaySpeed: 5000,
    autoPlayTimeout: 5000,
    autoplayHoverPause: true,
    dots: false,
    navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"],
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
});

$('.news-card-slide').owlCarousel({
    loop: true,
    margin: 30,
    nav: true,
    autoplay: true,
    autoPlaySpeed: 5000,
    autoPlayTimeout: 5000,
    autoplayHoverPause: true,
    dots: false,
    navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"],
    responsive: {
        0: {
            items: 1
        }
    }
});

// Related News Slider
$('.relatednews-slider').owlCarousel({
    loop: true,
    margin:24,
    nav: true,
    dots: true,
    navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"],
    responsive: {
        0: {
            items: 1
        },
        450: {
            items: 2
        },
        767: {
            items: 3
        },
        1000: {
            items: 4
        }, 
        1100: {
            items: 5
        }
    }
});



$('.three-col-slider').owlCarousel({
    loop: true,
    margin:160,
    nav: true,
    dots: false,
    autoplay: true,
    autoplayTimeout: 2000,
    autoplayHoverPause: true,
    navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"],
    responsive: {
        0: {
            items:1,
            margin:20,
        },
        575: {
            items: 2,
            margin:20,
        },
        991: {
            items: 3,
            margin:50,
        },
        1199: {
            items: 3,
        }
    }
});


$('.four-col-slider').owlCarousel({
    loop: true,
    margin:50,
    nav: true,
    dots: false,
    autoplay: true,
    autoplayTimeout: 2000,
    autoplayHoverPause: true,
    navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"],
    responsive: {
        0: {
            items:1,
            margin:20,
        },
        575: {
            items: 2,
            margin:20,
        },
        991: {
            items: 3,
            margin:50,
        },
        1199: {
            items: 4,
        }
    }
});

// $('.recent-product-slider').owlCarousel({
//     loop: true,
//     margin: 30,
//     nav: true,
//     dots: false,
//     navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"],
//     responsive: {
//         0: {
//             items: 1
//         },
//         400: {
//             items: 2
//         },
//         600: {
//             items: 3
//         },
//         1000: {
//             items: 5
//         }
//     }
// });

// $('.product-pills-slider').owlCarousel({
//     loop: false,
//     margin: 10,
//     nav: true,
//     dots: false,
//     navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"],
//     responsive: {
//         0: {
//             items: 2
//         },
//         400: {
//             items: 3
//         },
//         530: {
//             items: 4
//         },
//         767: {
//             items: 3
//         },
//         1100: {
//             items: 5
//         }
//     }
// });
$('.product-pills-slider').owlCarousel({
    loop: false,
    margin: 20,
    nav: true,
    dots: false,
    // mouseDrag: false,
    navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"],
    responsive: {
        0: {
            items: 2
        },
        375: {
            items: 3,
            margin: 12,
        },
        500: {
            items:5
        },
        600: {
            items: 5
        },
        767: {
            items: 2
        },
        850: {
            items:3
        },
        1100: {
            items: 3,
            margin: 12
        },
        1200: {
            items: 5,
            margin: 20
        },
    }
});

// $('.product-pills-slider').owlCarousel({
//     loop: false,
//     margin: 10,
//     nav: true,
//     dots: false,
//     navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"],
//     responsive: {
//         0: {
//             items: 2
//         },
//         360: {
//             items: 3
//         },
//         460: {
//             items: 4
//         },
//         530: {
//             items: 5
//         },
//         600: {
//             items: 6
//         },
//         767: {
//             items: 3
//         },
//         800: {
//             items: 4
//         },
//         980: {
//             items: 5
//         },
//         1080: {
//             items: 6
//         },
//         1200: {
//             items: 7
//         },
//         1550: {
//             items: 5
//         }
//     }
// });