<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '<?php echo $this->client_id; ?>',
            status     : true, // check login status
            cookie     : true, // enable cookies to allow the server to access the session
            xfbml      : true,  // parse XFBML
            scope      : '<?php echo $this->scope; ?>'
        });
    };

    // Load the SDK asynchronously
    (function(d){
        var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement('script'); js.id = id; js.async = true;
        js.src = "//connect.facebook.net/en_US/all.js";
        ref.parentNode.insertBefore(js, ref);
    }(document));
</script>

<div class="header">
    <div class="header-resize">
        <div class="row-fluid">
            <div class="span2 logo"></div>
            <div class="span2 offset3 center visible-desktop">
                <div class="world-link">
                    <a href="#" class="white-shad">Мир «Название»</a>
                </div>
                <div class="fold-control">
                    <div id="foldControl"></div>
                </div>
            </div>
            <div class="span4 offset1 buttons">
                <?php if (!$this->user) : ?>
                <a onclick ="$('#register-dialog').dialog({'modal':true});" class="btn">Регистрация</a>
                <a onclick ="$('#login-dialog').dialog({'modal':true});" href="#" class="btn">Войти</a>
                <?php else : ?>
                <span class="btn user-btn-container">
                    <i class="icon icon-user"></i>
                    <a class="user-name" href="<?php echo $this->url(array(), 'user-index'); ?>"><?php echo $this->user['name']; ?></a>
                    <i id="UserFoldOpen" class="icon icon-chevron-down"></i>
                </span>
                <span>
                    <a onclick="FB.logout(function(response) {window.location = '<?php echo $this->url(array(), 'logout'); ?>';});" href="#" class="btn btn-danger">Выход<i class="icon icon-off icon-white"></i></a>
                </span>
                <?php endif; ?>
                <a href="#" class="btn btn-info"><i class="icon-white icon-comment"></i>FAQ</a>
                <a href="#" class="btn btn-warning add-flat"><i class="icon-thumbs-up icon-white"></i><span>Сдавайте жилье</span></a>

            </div>
        </div>
    </div>
</div>
<div class="fold-menu-holder">
    <div class="row-fluid fold-menu" id="foldMenu">
        <div class="span5">
            <div class="sub-container first">
                <ul class="links-group">
                    <li class="info-title white-shad">Информация</li>
                    <li class="link"><a href="#" class="white-shad">О компании</a></li>
                    <li class="link"><a href="#" class="white-shad">Доверие и Безопасность</a></li>
                    <li class="link"><a href="#" class="white-shad">Зачем сдавать жилье?</a></li>
                    <li class="link"><a href="#" class="white-shad">Почему стоит принимать гостей?</a></li>
                </ul>
            </div>
        </div>
        <div class="span2">
            <div class="sub-container">
                <ul class="links-group">
                    <li class="geo-title white-shad">Региональные настройки</li>
                    <li class="link">
                        <div class="btn-group">
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                Русский
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>English</li>
                            </ul>
                        </div>
                    </li>
                    <li class="link">
                        <div class="btn-group">
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                USD
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>EURO</li>
                                <li>RUR</li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="span5">
            <div class="sub-container">
                <ul class="links-group">
                    <li class="help-title white-shad">Помощь</li>
                    <li class="link"><a href="#" class="white-shad">С чего начать?</a></li>
                    <li class="link"><a href="#" class="white-shad">Как создать аккаунт?</a></li>
                    <li class="link"><a href="#" class="white-shad">Как сдавать жилье?</a></li>
                    <li class="link"><a href="#" class="white-shad">Как путешествовать?</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row-fluid fold-menu" id="foldUser">
        <div class="span4">
            <div class="sub-container first">
                <ul class="links-group">
                    <li class="custom-title white-shad"><i class="icon icon-user"></i>Это вы!</li>
                    <li class="link row-fluid">
                        <div class="span2"><img class="img-polaroid" src="<?php echo str_replace('avatars/', 'avatars/thumbnail/', $this->user['avatar']); ?>" /></div>
                        <div class="span10">
                            <div><?php echo $this->user['firstname'] . ' ' . $this->user['name']; ?></div>
                            <div><?php echo $this->user['email']; ?></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>