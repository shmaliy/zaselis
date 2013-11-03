<div class="avatar">
    <?php if (!empty($this->avatar)) : ?>
    
    <img src="<?php echo str_replace('avatars/', 'avatars/thumbnail-180-256/', $this->avatar); ?>" class="img-polaroid">
    <?php else : ?>
    <img src="/theme/img/userpanel/no-avatar-big.png" class="avatar-image">
    <?php endif; ?>
    <a href="<?php echo $this->url(array(), 'user-profile'); ?>" class="btn btn-warning"><i class="icon icon-white icon-asterisk"></i>Сменить</a>
</div>

