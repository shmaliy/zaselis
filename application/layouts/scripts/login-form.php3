<div class="form"><?php echo $this->form; ?></div>
<a style="cursor:pointer;" onclick="$('#login-dialog').dialog('close'); $('#restore-dialog').dialog({'modal': true});">Забыли пароль?</a>
<script>
function sASendData() {
    $.ajax({
        url: '<?php echo $this->url(array(), 'auth'); ?>',
        data: $('#SimpleAuth').serialize(),
        type: 'POST',
        error: function(jqXHR, textStatus, errorThrown) {

        },
        success: function(data, textStatus, jqXHR) {
                //$(container).html(jqXHR.responseText);
                var response = jQuery.parseJSON(jqXHR.responseText);
                
                if (response['redirect'] == true) {
                    var redir = window.location.href;
                    redir = redir.replace('http://', 'https://')
                    window.location = redir;
                }
        },
        complete: function(jqXHR, textStatus) {

        }
    });
    return false;
}
</script>
