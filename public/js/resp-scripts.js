$(document).ready(function(){
    
    $('#SlideLeft').mouseover(function(){
        $('#SlideLeft i').css({display: 'block'});
    }).mouseout(function(){
        $('#SlideLeft i').hide();
    });
    
    $('#SlideRight').mouseover(function(){
        $('#SlideRight i').css({display: 'block'});
    }).mouseout(function(){
        $('#SlideRight i').hide();
    });
    
    $('#IncomeDate, #OutDate').datepicker();
    
    
    $('#foldControl').click(function(){
        var options = [];
        
        if ($('#foldMenu').css('display') !== 'block') {
            $( "#foldMenu" ).show( 'blind', options, 500 );
        } else {
            $( "#foldMenu" ).hide( 'blind', options, 500 );
        }
            
        return false;
    });
});

