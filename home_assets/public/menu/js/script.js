$(document).ready(function () {
    // alert()

    let owlItemLength = $(".category_length_item").length ;
    $('.owl-carousel').owlCarousel({
        loop: owlItemLength <= 3 ? false: true,
        margin:10,
        nav:false,
        items:3,
        center:owlItemLength <= 2 ? true: false,
        // navText: [
        //     "<button class='owl navigation owl_prev'>prev</button>",
        //     "<button class='owl navigation owl_next'>next</button>"
        // ],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:3
            }
        }
    });

    $(".close_text").click(function(){
        $(this).parent(".timeline_text_cont").removeClass("active")
    });

    $(".expand_button").click(function(){
        $(this).parent(".timeline_text_cont").addClass("active");
    });

    $(".select_product_name").each(function(){
        if($(this).attr("data-produc-length")=='') {
            $(this).hide()
        }
    })
   
    $(".nav-item").first().trigger("click");

    $(".nav-item ").click(function(){
        $(".tab-pane").each(function() {
            $(this).removeClass("active").removeClass("show");
        });
        let unreplacedId = $(this).attr("id").replace("-tab","");
        let id = unreplacedId;

        $("#"+id).addClass("active").addClass("show");

    })

    detectActiveMenu();
    //activeProductNav();

    setTimeout(() => {
        $("#strickymenu").fadeIn()
    }, 2500);
});

$(window).on("load", function(){
    $("#strickymenu").fadeIn()
});



function detectActiveMenu() {

    setTimeout(()=>{
        $(".for_children_menu").each(function(){
            if($(this).children("a").hasClass("active")) {
                $(this).parent().parent(".active_btn").find(".chl").addClass("active");
            }
        });
    })
   
}


function isProductPageActivated() {

    if(window.location.href.includes("product/")) {
        return true;
    }
    else {
        return false;
    }
}

function activeProductNav() {
    if(isProductPageActivated()) {
        $(".nav-menu .active_btn").each(function() {
           if($(this).children(".chl").text().includes("Products")) {
            $(this).children(".chl").addClass("active")
           }
        });
    }
}
