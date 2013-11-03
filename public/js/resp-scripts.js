// возвращает cookie с именем name, если есть, если нет, то undefined
function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(name, value, options) {
    options = options || {};

    var expires = options.expires;

    if (typeof expires == "number" && expires) {
        var d = new Date();
        d.setTime(d.getTime() + expires*1000);
        expires = options.expires = d;
    }
    if (expires && expires.toUTCString) {
        options.expires = expires.toUTCString();
    }

    value = encodeURIComponent(value);

    var updatedCookie = name + "=" + value;

    for(var propName in options) {
        updatedCookie += "; " + propName;
        var propValue = options[propName];
        if (propValue !== true) {
            updatedCookie += "=" + propValue;
        }
    }

    document.cookie = updatedCookie;
}

function deleteCookie(name) {
    setCookie(name, "", { expires: -1 })
}

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
            setCookie('foldMenu', 'open', {expires: 86400});

        } else {
            $( "#foldMenu" ).hide( 'blind', options, 500 );
            $('#fold-bottom-shadow').fadeOut("slow");
            deleteCookie('foldMenu');
        }
            
        return false;
    });
    if (getCookie('foldMenu') == 'open') {
        $('#foldControl').trigger('click');
    }

    $('#UserFoldOpen').click(function(){
        var options = [];

        if ($('#foldUser').css('display') !== 'block') {
            $( "#foldUser" ).show( 'blind', options, 500 );
            $(this).removeClass('icon-chevron-down').addClass('icon-chevron-up');
            setCookie('foldUser', 'open', {expires: 86400});
        } else {
            $( "#foldUser" ).hide( 'blind', options, 500 );
            $(this).removeClass('icon-chevron-up').addClass('icon-chevron-down');
            deleteCookie('foldUser');
        }

        return false;
    });
    if (getCookie('foldUser') == 'open') {
        $('#UserFoldOpen').trigger('click');
    }
});

