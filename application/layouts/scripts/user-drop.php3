<li class="main-menu-list-item" id="userBlock" 
    onmouseover="$('#UserDrop').show(); $('.menu-item-user').addClass('menu-item-user-hover');" 
    onmouseout="$('#UserDrop').hide(); $('.menu-item-user').removeClass('menu-item-user-hover');">

    <a href="#" class="menu-item-user main-menu-list-item-link image">
        <span>
            <?php echo $this->user['name']; ?>
        </span>
    </a>
    <div class="main-menu-list-item-drop user-drop-container" id="UserDrop">
        <div class="top cf">
            <div class="img">
                <?php if (!empty($this->user['avatar'])) : ?>
                
                <?php else : ?>
                    <img src="/theme/img/user-drop/no-avatar.png" />
                <?php endif; ?>
                <a id="AvatarManager" onclick ="$('#change-avatar-dialog').dialog({'modal':true});">Сменить</a>
            </div>
            <div class="text">
                <div class="name"><?php echo $this->user['firstname']; ?> <?php echo $this->user['name']; ?></div>
                <div class="email"><a href="<?php echo $this->url(array(), 'user-index'); ?>"><?php echo $this->user['email']; ?></a></div>
                <div class="notifications cf">
                    <div class="item cf"><div class="msg"></div><a href="#">1 новое письмо</a></div>
                    <div class="item cf"><div class="frnd"></div><a href="#">1 новый друг</a></div>
                    <div class="item cf"><div class="bkng"></div><a href="#">1 новая бронь</a></div>
                </div>
            </div>
        </div>
        <div class="user-menu">
            <div class="menu-row cf">
                <a href="<?php echo $this->url(array(), 'user-profile'); ?>" class="menu-row-item"><span>Профиль</span></a>
                <a href="<?php echo $this->url(array(), 'user-mail'); ?>" class="menu-row-item"><span>Почтовый ящик</span></a>
                <a href="<?php echo $this->url(array(), 'user-flats'); ?>" class="menu-row-item"><span>Ваши объявления</span></a>
                <a href="<?php echo $this->url(array(), 'user-travels'); ?>" class="menu-row-item"><span>Поездки</span></a>
                <a href="<?php echo $this->url(array(), 'user-settings'); ?>" class="menu-row-item"><span>Настройки аккаунта</span></a>
                <a href="<?php echo $this->url(array(), 'user-friends'); ?>" class="menu-row-item"><span>Друзья</span></a>
            
            <?php if ($this->user['z_users_roles_id'] == 1) : ?>
                <a href="" class="menu-row-item"><span>Почтовый ящик</span></a>
                <a href="" class="menu-row-item"><span>Ваши объявления</span></a>
            <?php endif; ?>
            </div>
        </div>
        <a href="<?php echo $this->url(array(), 'logout'); ?>" class="logout-button"><span>Выход</span></a>
    </div>
    <script>
        $('#userBlock').css({'width': $('#userBlock .menu-item-user').width()+38 + 'px'});
        $('#UserDrop').css({'min-width': $('#UserDrop').width()+20 + 'px'});
    </script>
</li>
