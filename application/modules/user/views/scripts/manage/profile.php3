<h2>Редактирование личной информации</h2>
<div id="panel" class="cf">
    <?php echo $this->form; ?>
</div>
<div id="map-canvas"></div>

<script>
    $('#ProfileEdit').submit(function(){
        processUserForm(
            'user-profile', 
            {'lang': globalLang, 'currencie': globalCurr},
            '#ProfileEdit',
            [['updateWindow']]
        );
        return false;
    });
    $('#birth').datepicker({ dateFormat: "yy-mm-dd", maxDate: "-18y",  changeMonth: true, changeYear: true });
    
    function initializeOfficeAddr() {
      var input = /** @type {HTMLInputElement} */(document.getElementById('usersOfficeAddr'));
      var autocomplete = new google.maps.places.Autocomplete(input);
    }
    google.maps.event.addDomListener(window, 'load', initializeOfficeAddr);
</script>
