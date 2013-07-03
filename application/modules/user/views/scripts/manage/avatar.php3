<div class="avatar">
    <?php if (!empty($this->avatar)) : ?>
    
    <img src="<?php echo str_replace('avatars/', 'avatars/thumbnail-180-256/', $this->avatar); ?>" class="avatar-image">
    <?php else : ?>
    <img src="/theme/img/userpanel/no-avatar-big.png" class="avatar-image">
    <?php endif; ?>
    
    <a class="avatar-change" onclick ="$('#change-avatar-dialog').dialog({'modal':true});">Сменить</a>
    <?php if (!empty($this->avatar)) : ?>
    <a class="avatar-delete">Удалить</a>
    <?php endif; ?>
</div>

<script>
    $('.avatar .avatar-delete').click(function () {
        megaOverlayShow();
        $.ajax({
            url: '<?php echo $this->url(array(), 'ajax-remove-avatar'); ?>',
            data: {},
            type: 'POST',
            error: function(jqXHR, textStatus, errorThrown) {},
            success: function(data, textStatus, jqXHR) {
                updateWindow(); 
            },
            complete: function(jqXHR, textStatus) {}
         });
    });
</script>