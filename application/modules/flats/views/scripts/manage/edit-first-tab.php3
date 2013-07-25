<?php echo $this->form; ?>

<script>
    $('#EditFirstTab').submit(function(){
        processUserForm(
            'edit-first-tab', 
            {'lang': globalLang, 'currencie': globalCurr},
            '#EditFirstTab',
            [['testCallback', '656465645'], ['testCallback', 'jdjhdfkhdfkf']]
        );
            return false;
    });

    function initializeIndexSlider() {
        var input = /** @type {HTMLInputElement} */(document.getElementById('flatAdress'));
        var autocomplete = new google.maps.places.Autocomplete(input);
    }

    google.maps.event.addDomListener(window, 'load', initializeIndexSlider);
</script>