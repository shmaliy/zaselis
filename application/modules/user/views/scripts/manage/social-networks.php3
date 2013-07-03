<h2>Вы в социальных сетях</h2>
<div id="panel" class="cf">
    <?php echo $this->form; ?>
</div>
<div id="map-canvas"></div>

<script>
    $('#SocialNetworks').submit(function(){
        processUserForm(
            'user-social-networks', 
            {'lang': globalLang, 'currencie': globalCurr},
            '#SocialNetworks',
            [['updateWindow']]
        );
        return false;
    });
    $('#birth').datepicker({ dateFormat: "yy-mm-dd", maxDate: "-18y",  changeMonth: true, changeYear: true });

</script>
