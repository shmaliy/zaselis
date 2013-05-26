<div class="login-button"><a href="#">Регистрация</a></div>
<div class="form"><?php echo $this->form; ?></div>

<script>
function sRSendData() {
    $.ajax({
        url: '<?php echo $this->url(array(), 'simple-register'); ?>',
        data: $('#SimpleRegister').serialize(),
        type: 'POST',
        error: function(jqXHR, textStatus, errorThrown) {

        },
        success: function(data, textStatus, jqXHR) {
                //$(container).html(jqXHR.responseText);
                //var response = jQuery.parseJSON(jqXHR.responseText);
        },
        complete: function(jqXHR, textStatus) {

        }
    });
    return false;
}
</script>