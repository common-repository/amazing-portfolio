;(function ($) {


    $(document).ready(function() {


        $('.apl-portfolio-overlay .left-icon').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            image: {
                verticalFit: true
            }
        });     
        
        $('.apl-youtube-popup, .apl-vimeo-popup').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'apl-mfp-fade',
            removalDelay: 160,
            preloader: false,

            fixedContentPos: false
        });  
        
        $('.apl-gallery .left-icon').magnificPopup({
            //delegate: 'a',
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'apl-mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0,1] // Will preload 0 - before current, and 1 after the current image
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            }
        });              


    });
    

$(document).ready(function(){


});
    


$(window).load(function(){ 
  
    var $container = $('#apl-portfolio'); 
    $container.isotope({ 
        filter: '*', 
        animationOptions: { 
            duration: 750, 
            easing: 'linear', 
            queue: false, 
        } 
    }); 
    
    $('.apl-portfolio-filter li a').click(function(){ 
                var selector = $(this).attr('data-filter'); 
                $container.isotope({ 
                        filter: selector, 
                        animationOptions: { 
                                duration: 750, 
                                easing: 'linear', 
                                queue: false, 
                        } 
                }); 
            return false; 
        });     
    
  
});




})(jQuery);