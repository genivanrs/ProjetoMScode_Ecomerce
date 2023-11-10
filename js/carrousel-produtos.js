$(document).ready(function(){
    $('.produto-carousel').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        dots: false,
        prevArrow: '<button class="slick-prev">Previous</button>',
        nextArrow: '<button class="slick-next">Next</button>',
        centerMode: true, // Ativar o modo de centralização
        centerPadding: '0', // Espaçamento entre os slides centrais
        infinite: true, // Para criar a ilusão de um carrossel infinito
        
        responsive: [
            {
                breakpoint: 1900,
                settings: {
                    slidesToShow: 7
                }
            },
            {
                breakpoint: 1400,
                settings: {
                    slidesToShow: 5
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
});


