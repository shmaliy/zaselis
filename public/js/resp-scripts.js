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
            $('#fold-bottom-shadow').fadeIn("slow");
            $.cookie('foldMenu', 'open', {expires: 2, path: '/'});


        } else {
            $( "#foldMenu" ).hide( 'blind', options, 500 );
            $('#fold-bottom-shadow').fadeOut("slow");
            $.removeCookie('foldMenu', {path: '/'});
        }
            
        return false;
    });

    if ($.cookie('foldMenu') == 'open') {
        $('#foldControl').trigger('click');
    }

    $('#UserFoldOpen').click(function(){
        var options = [];

        if ($('#foldUser').css('display') !== 'block') {
            $( "#foldUser" ).show( 'blind', options, 500 );
            $(this).removeClass('icon-chevron-down').addClass('icon-chevron-up');
            $.cookie('foldUser', 'open', {expires: 2, path: '/'});
        } else {
            $( "#foldUser" ).hide( 'blind', options, 500 );
            $(this).removeClass('icon-chevron-up').addClass('icon-chevron-down');
            $.removeCookie('foldUser', {path: '/'});
        }

        return false;
    });

    if ($.cookie('foldUser') == 'open') {
        $('#UserFoldOpen').trigger('click');
    }
});

