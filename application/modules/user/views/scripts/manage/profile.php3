<h1>Редактирование личной информации</h1>
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
            [['testCallback', '656465645'], ['testCallback', 'jdjhdfkhdfkf']]
        );
        return false;
    });
    $('#birth').datepicker({ dateFormat: "yy-mm-dd", maxDate: "-18y",  changeMonth: true, changeYear: true });
</script>
