<div class="header">
    <div class="header-resize cf">
        <a class="logo" href="<?php echo $this->url(array(), 'index'); ?>"></a>
        <div class="header-resize-controls">
            <div class="main-menu cf right">
                <ul class="main-menu-list">
                    <?php if (!Zend_Auth::getInstance()->hasIdentity() || $this->active == 0) : ?>
                        <li class="main-menu-list-item">
                            <a onclick ="$('#register-dialog').dialog({'modal':true});" class="menu-item main-menu-list-item-link"><span>Регистрация</span></a>
                        </li>
                        <li class="main-menu-list-item">
                            <a onclick ="$('#login-dialog').dialog({'modal':true});" class="menu-item main-menu-list-item-link"><span>Войти</span></a>
                        </li>
                    <?php else: ?>
                       <?php echo $this->Common()->userDrop(); ?> 
                    <?php endif; ?>
                    <li class="main-menu-list-item">
                        <a href="#" class="menu-item main-menu-list-item-link"><span>Как это работает</span></a>
                    </li>
                    <li class="main-menu-list-item">
                        <a href="#" class="menu-item main-menu-list-item-link"><span>Контакты</span></a>
                    </li>
                    <?php echo $this->Common()->langSelector(); ?>
                    <?php echo $this->Common()->currSelector(); ?>
                    <li class="main-menu-list-item">
                        <div id="google_translate_element"></div>
                        <script type="text/javascript">
                            function googleTranslateElementInit() {
                              new google.translate.TranslateElement({pageLanguage: 'ru', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                            }
                        </script>
                        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                    </li>
                    <li class="main-menu-list-item">
                        <a href="#" class="menu-item-button main-menu-list-item-link"><span>Сдайте свое жилье</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <?php if (Zend_Auth::getInstance()->hasIdentity() && $this->active == 1) : 
        $lang = Zend_Registry::get('lang');
        $l_alias = $lang['alias'];
        $currencie = Zend_Registry::get('currencie');
        $c_alias = strtolower($currencie['alias']);

        $stopUrl = '/' . $l_alias . '/' . $c_alias . '/user/flats/edit';

        if (!strstr($_SERVER['REQUEST_URI'], $stopUrl)) : 
    ?>
        <div id="change-avatar-dialog" title="Смена аватара" style="display: none;"><?php  echo $this->Common()->avatarManger(); ?></div>
        <?php endif; ?>
    <?php else : ?>
        <div id="login-dialog" style="display: none;" title="Авторизация"><?php echo $this->Common()->loginForm(); ?></div>
        <div id="register-dialog" style="display: none;" title="Регистрация"><?php echo $this->Common()->regForm(); ?> </div>
        <div id="restore-dialog" style="display: none;" title="Напоминание пароля"><?php echo $this->Common()->restorePasswordForm(); ?> </div>
    <?php endif; ?>
</div>

