<div class="form"><?php echo $this->form; ?></div>

<script>
    $('#ChangePassword').submit(function(){
    processUserForm(
        'change-password', 
        {'lang': globalLang, 'currencie': globalCurr},
        '#ChangePassword',
        []
    );
        return false;
});
</script>
    