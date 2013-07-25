

/**
 * 
 * @param {string} routename
 * @param {JSON} routeparams
 * @param {string} form_id
 * @param {array} success_callbacks
 * @returns {undefined}
 */

function processUserForm (routename, routeparams, form_id, success_callbacks)
{
    $('#errorsContainer').remove();
    megaOverlayShow();
    $.ajax({
        url: '/' + globalLang + '/' + globalCurr + '/ajax-route',
        data: {'r_name': routename, 'r_params': routeparams},
        type: 'POST',
        error: function(jqXHR, textStatus, errorThrown) {},
        success: function(data, textStatus, jqXHR) {
                var response = jQuery.parseJSON(jqXHR.responseText);
                
                if (response['route']) {
                    $.ajax({
                       url: response['route'],
                       data: $(form_id).serialize(),
                       type: 'POST',
                       error: function(jqXHR, textStatus, errorThrown) {},
                       success: function(data, textStatus, jqXHR) {
                            var result = jQuery.parseJSON(jqXHR.responseText);
                            if(result['formErrors'] || errorsCount(result['formErrors']) > 0) {
                                parseFormErrors(result['formErrors'], form_id);
                            } else {
                                megaOverlayHide();
                                showFormSuccess(form_id, success_callbacks);
                            }
                       },
                       complete: function(jqXHR, textStatus) {}
                    });
                }
                
        },
        complete: function(jqXHR, textStatus) {}
    });
    return false;
}

function showErrorTooltip(text) 
{
    if ($('#errorsContainer').length == 0) {
        $('body').append('<div id="errorsContainer" class="errors-container"></div>');
    }
    var container = $('#errorsContainer');
    $(container).append('<div class="error-tooltip"><a class="error-tooltip-close">x</a>' + text + '</div>');
    
    $('.error-tooltip .error-tooltip-close').each(function(){
        $(this).click(function(){
             $(this).parent().hide();
        });
    });
}

function errorsCount(data)
{
    var errcount = 0;
    for (var i in data) {
        if (data[i].length > 0) {
            for (var j = 0; j < data[i].length; j++) {
                errcount++;
            }
        }
    }
    
    return errcount;
}


function parseFormErrors(data, form_id)
{
    var errcount = 0;
    for (var i in data) {
        if (data[i].length > 0) {
            for (var j = 0; j < data[i].length; j++) {
                var errcode = form_id + '.' + i + '.' + data[i][j];
                errcount++;
                showErrorTooltip(errcode);
                //console.log(form_id + '.' + i + '.' + data[i][j]);
            }
            megaOverlayHide();
        }
    }
}

/**
 * 
 * @param {type} form_id
 * @param {JSON} callbacks [['name', 'value', 'value'], ['name2', 'value', 'value']]
 * @returns {undefined}
 */

function showFormSuccess(form_id, callbacks)
{
    if (callbacks.length > 0) {
        for (var i = 0; i < callbacks.length; i++) {
            var callback_name = callbacks[i][0];
            if(callbacks[i].length > 1) {
                callbacks[i].splice(0, 1);
            }
            window[callback_name](callbacks[i]);
        }
    }
}

function testCallback(data)
{
    alert(data[0]);
}

function loginSuccess()
{
    var redir = window.location.href;
    redir = redir.replace('http://', 'https://')
    window.location = redir;
}

function megaOverlayShow()
{
    $('.mega-overlay').show();
}

function megaOverlayHide()
{
    $('.mega-overlay').hide();
}

function updateWindow()
{
    setTimeout(function(){window.location = window.location.href;}, 500);
}