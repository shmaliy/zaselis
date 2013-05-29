<li class="main-menu-list-item" id="userBlock" 
    onmouseover="$('#UserDrop').show(); $('.menu-item-user').addClass('menu-item-user-hover');" 
    onmouseout="$('#UserDrop').hide(); $('.menu-item-user').removeClass('menu-item-user-hover');">

    <a href="#" class="menu-item-user main-menu-list-item-link image">
        <span>
            <?php echo $this->user['name']; ?>
        </span>
    </a>
    <div class="main-menu-list-item-drop" id="UserDrop">
        <div class="top cf">
            <div class="img">
                <?php if (!empty($this->user['avatar'])) : ?>
                
                <?php else : ?>
                    <img src="/theme/img/user-drop/no-avatar.png" />
                <?php endif; ?>
            </div>
            <div class="text">
                <div class="name"><?php echo $this->user['firstname']; ?> <?php echo $this->user['name']; ?></div>
                <div class="email"><?php echo $this->user['email']; ?></div>
                <div class="notifications"></div>
            </div>
        </div>
        <div class="user-menu">
            <div class="menu-row cf">
                <a href="#">Почтовый ящик</a>
                <a href="#">Ваши объявления</a>
            </div>
            <div class="menu-row cf">
                <a href="#">Поездки</a>
                <a href="#">Профиль</a>
            </div>
            <div class="menu-row cf">
                <a href="#">Настройки аккаунта</a>
            </div>
            <?php if ($this->user['z_users_roles_id'] == 1) : ?>
            <div class="menu-row cf">
                <a href="#">Почтовый ящик</a>
                <a href="#">Ваши объявления</a>
            </div>
            <?php endif; ?>
        </div>
        <a href="<?php echo $this->url(array(), 'logout'); ?>">Выход</a>
    </div>
    <script>
        $('#userBlock').css({'width': $('#userBlock .menu-item-user').width()+38 + 'px'});
        $('#UserDrop').css({'min-width': $('#UserDrop').width()+20 + 'px'});
    </script>
</li>
