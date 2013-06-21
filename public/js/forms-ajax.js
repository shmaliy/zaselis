

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



function initialize() {
  var mapOptions = {
    center: new google.maps.LatLng(-33.8688, 151.2195),
    zoom: 13,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  var map = new google.maps.Map(document.getElementById('map-canvas'),
    mapOptions);

  var input = /** @type {HTMLInputElement} */(document.getElementById('searchTextField'));
  var autocomplete = new google.maps.places.Autocomplete(input);

  autocomplete.bindTo('bounds', map);

  var infowindow = new google.maps.InfoWindow();
  var marker = new google.maps.Marker({
    map: map
  });

  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    input.className = '';
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      // Inform the user that the place was not found and return.
      input.className = 'notfound';
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);  // Why 17? Because it looks good.
    }
    marker.setIcon(/** @type {google.maps.Icon} */({
      url: place.icon,
      size: new google.maps.Size(71, 71),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 34),
      scaledSize: new google.maps.Size(35, 35)
    }));
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }

    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
    infowindow.open(map, marker);
  });

  // Sets a listener on a radio button to change the filter type on Places
  // Autocomplete.
  function setupClickListener(id, types) {
    var radioButton = document.getElementById(id);
    google.maps.event.addDomListener(radioButton, 'click', function() {
      autocomplete.setTypes(types);
    });
  }

  setupClickListener('changetype-all', []);
  setupClickListener('changetype-establishment', ['establishment']);
  setupClickListener('changetype-geocode', ['geocode']);
}

google.maps.event.addDomListener(window, 'load', initialize);
