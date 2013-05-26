<div class="login-button"><a href="#">Вход</a></div>
<div class="form"><?php echo $this->form; ?></div>

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
                    window.location = window.location.href;
                }
        },
        complete: function(jqXHR, textStatus) {

        }
    });
    return false;
}
</script>
