<div class="form"><?php echo $this->form; ?></div>

<script>
function sFSendData() {
    $.ajax({
        url: '<?php echo $this->url(array(), 'restore-password'); ?>',
        data: $('#ForgotPassword').serialize(),
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
