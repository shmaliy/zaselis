<div class="form"><?php echo $this->form; ?></div>

<script>

$('.ui-dialog #ForgotPassword').submit(function(){
    processUserForm(
        'restore-password', 
        {'lang': globalLang, 'currencie': globalCurr},
        '#ForgotPassword',
        [['testCallback', '656465645'], ['testCallback', 'jdjhdfkhdfkf']]
    );
    return false;
});
</script>
