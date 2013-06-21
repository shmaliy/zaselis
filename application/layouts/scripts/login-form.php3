<div class="form"><?php echo $this->form; ?></div>
<a style="cursor:pointer;" onclick="$('#login-dialog').dialog('close'); $('#restore-dialog').dialog({'modal': true});">Забыли пароль?</a>
<script>
$('.ui-dialog #SimpleAuth').submit(function(){
    processUserForm(
        'auth', 
        {'lang': globalLang, 'currencie': globalCurr},
        '#SimpleAuth',
        [['loginSuccess']]
    );
    return false;
});

</script>
