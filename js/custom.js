function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

(function ($) {
    // Instantiate MixItUp:
    $('#containerProducts').mixItUp();

    // Add smooth scrolling to all links in navbar + footer link
    $(".sidenav-custom a").on('click', function(event) {
        // event.preventDefault();
        var hash = this.hash;
        closeNav();

        $('html, body').animate({
            scrollTop: $(hash).offset().top
        }, 900, function(){
            window.location.hash = hash;
        });
    });
    
})(jQuery);

//invocamos al objeto (window) y a su método (scroll), solo se ejecutara si el usuario hace scroll en la página
$(window).scroll(function(){
  if($(this).scrollTop() > 300){ //condición a cumplirse cuando el usuario aya bajado 301px a más.
    $("#js_up").slideDown(300); //se muestra el botón en 300 mili segundos
  }else{ // si no
    $("#js_up").slideUp(300); //se oculta el botón en 300 mili segundos
  }
});

//creamos una función accediendo a la etiqueta i en su evento click
$("#js_up i").on('click', function (e) { 
  e.preventDefault(); //evita que se ejecute el tag ancla (<a href="#">valor</a>).
  $("body,html").animate({ // aplicamos la función animate a los tags body y html
    scrollTop: 0 //al colocar el valor 0 a scrollTop me volverá a la parte inicial de la página
  },700); //el valor 700 indica que lo ara en 700 mili segundos
  return false; //rompe el bucle
});

/*- Carousel -*/
    $('.carousel-img').owlCarousel({
        autoplay:true,
        loop:true,
        margin:10,
        nav:false,
        responsive:{
            0:{
                items:2
            },
            600:{
                items:4
            },
            1000:{
                items:6
            }
        }
    })

   $('.carousel-text').owlCarousel({
        autoplay:true,
        autoplayTimeout: 9000,
        loop:true,
        margin:10,
        nav:false,
        items:1
    })
    /*-/ Carousel -*/