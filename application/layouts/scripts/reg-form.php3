<div class="form"><?php echo $this->form; ?></div>

<script>

$('#SimpleRegister #password_p-element').hide();
$('#SimpleRegister #password').focus(function(){
    $('#SimpleRegister #password_p-element').show();
});

$('.ui-dialog #SimpleRegister').submit(function(){
    processUserForm(
        'simple-register', 
        {'lang': globalLang, 'currencie': globalCurr},
        '#SimpleRegister',
        [['testCallback', '656465645'], ['testCallback', 'jdjhdfkhdfkf']]
    );
    return false;
});
</script>