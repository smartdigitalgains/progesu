/*!
 * Progesu v1.0.0 (https://smartdigitalgains.com)
 * Copyright 2017-2020 Tizian Thost
 * Licensed under the GPL-2.0-or-later license
 */

document.addEventListener(
  "DOMContentLoaded", () => {
      const menu = new MmenuLight(
          document.querySelector( ".mobile-menu" )
      );

      const navigator = menu.navigation();
      const drawer = menu.offcanvas();

      document.querySelector( 'a[href="#mobile-menu"]' )
          .addEventListener( 'click', ( evnt ) => {
              evnt.preventDefault();
              drawer.open();
          });
  }
);

$(document).ready(function(){

    $('.accordeon > .column > .accordeon-header').on('click', function(){
      $(this).parent().find('.content').slideToggle();
    })

    $('.menu').superfish();

    $(".eq-height").matchHeight({
      byRow: true
    });  

    $('.customers-teaser').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
      });
      
})