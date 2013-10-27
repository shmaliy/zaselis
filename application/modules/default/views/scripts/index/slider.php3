<div class="index-flats-slider">
    <div class="after-shadow"></div>
    <a class="slide-left" id="SlideLeft">
        <i></i>
    </a>
    <a class="slide-right" id="SlideRight">
        <i></i>
    </a>
    <div class="info clearfix"></div>
    <div class="introtext">
        <div class="big black-shad">Найдите, где остановиться.</div>
        <div class="small black-shad">Снимайте жилье у реальных людей в 34 000 городов и 192 странах.</div>
    </div>
</div>
<script>

(function( $ ){
  var slides;
  var sliderWidth = $('.index-flats-slider').width();
  var sliderHeight = $('.index-flats-slider').height();
  var newSliderHeight;
  
  var methods = {
    init : function( options ) { 
        newSliderHeight = $(window).height() - $('.header').height() - $('.index-search-form').height() - 9;
        $('.index-flats-slider').css({height: newSliderHeight + 'px'});
        
        $(this).slider('showFlat');
    },
    setSlides : function (data) {
       slides = data; 
    },
    showFlat : function(num) {
        $('#SlideLeft').unbind('click');
        $('#SlideRight').unbind('click');
        
        if (!num) {
            num = 0;
        }
        num = parseInt(num, 10);
        
        var flat = slides[num];
        var slength = parseInt(slides.length, 10);
        var leftSlide = num - 1;
        if (leftSlide == -1) {
            leftSlide = slength - 1;
        }
        
        var rightSlide = num + 1;
        if (rightSlide === slength) {
            rightSlide = 0;
        }
    
        if($('.index-flats-slider .img').length > 0) {
            $('.index-flats-slider .img').each(function(){
               $(this).fadeOut("slow", function(){$(this).remove();}); 
            });
        }
        
        $('.index-flats-slider .info').hide().html('');
        
        var diff = 0;
        if (sliderHeight != flat['img_h']) {
            var diff = (sliderHeight - flat['img_h'])/2;
        }
        
        var imgWidth = flat['img_w'];
        var imgHeight = flat['img_h'];
        
        var newImgHeight = sliderWidth * imgHeight / imgWidth;
        
        var imgShift = 0;
        
        if (newImgHeight > sliderHeight) {
            imgShift = ((newImgHeight - sliderHeight)/2).toFixed(0) * -1;
        }
        
        
        var bsize = '100% auto';
        var bg = ' top ' + imgShift + 'px center no-repeat';
        if (newImgHeight < newSliderHeight) {
            bsize = 'auto 100%';
            bg = 'top center no-repeat';
        } else {
            
        }
        
//        console.log(newImgHeight);
//        console.log(imgShift);
        
        $('.index-flats-slider').prepend('<div class="img"></div>');
        $('.index-flats-slider .img').hide().css({
            background: 'url(' + flat['photos'] + ') top center no-repeat',
            backgroundSize: 'cover'
        }).fadeIn('slow');
        
        $('.index-flats-slider .info').html( 
            '<div class="info-text">' + 
                '<a href="#" class="black-shad">' + flat['district_description'] + '</a>' + 
                '<span class="black-shad">' + flat['adress'] + ' — 500$</span>' + 
            '</div>' + 
            '<div class="image">' + 
            '<a href="#"><img src="/theme/img/newdesign/slider/user-noavatar.png" class="img-polaroid" /></a>' + 
            '</div>').fadeIn('slow', function(){
                $('#SlideLeft').click(function(){
                    $(this).slider('showFlat', leftSlide);
                });
                $('#SlideRight').click(function(){
                    $(this).slider('showFlat', rightSlide);
                });
                
                setTimeout(function(){
                    $(this).slider('showFlat', rightSlide);
                }, 6000);
            });
        
        
    }        
  };

  $.fn.slider = function( method ) {
    // Method calling logic
    if ( methods[method] ) {
      return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
    } else if ( typeof method === 'object' || ! method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error( 'Method ' +  method + ' does not exist on jQuery.tooltip' );
    }    
  };
})( jQuery );

$(document).ready(function(){
    $.fn.slider('setSlides', <?php echo $this->items; ?>);
    $.fn.slider();
});

</script>