<?php echo $this->doctype('XHTML1_TRANSITIONAL'); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php 
    
        $this->headTitle('Zaselis')->setSeparator(' | '); 

        $this->headLink()
             ->appendStylesheet('/theme/css/style.css')
             ->appendStylesheet('https://fonts.googleapis.com/css?family=Lobster&subset=latin,cyrillic-ext,latin-ext,cyrillic')
             ->appendStylesheet('https://fonts.googleapis.com/css?family=Open+Sans&subset=latin,cyrillic-ext,cyrillic')
             ->appendStylesheet('https://fonts.googleapis.com/css?family=Roboto:400,300&subset=latin,cyrillic-ext,latin-ext,cyrillic')
             ->appendStylesheet('/js/jquery/jQuery-File-Upload-master/css/style.css')
             ->appendStylesheet('/js/jquery/jQuery-File-Upload-master/css/jquery.fileupload-ui.css')
             ->appendStylesheet('/theme/css/userpanel.css')
             ->appendStylesheet('/js/jquery/jquery-ui-1.9.0.custom/css/smoothness/jquery-ui-1.10.3.custom.css')
             ->appendStylesheet('/theme/css/bootstrap.css')
             ->appendStylesheet('/theme/css/responsive-admin.css')
             ->appendStylesheet('/theme/css/checkboxes.css')
             ->headLink(array('rel' => 'favicon', 'href' => '/favicon.png'), 'PREPEND'); 

        $this->headMeta()->appendName('keywords', '')
             ->appendName('description', '')
             ->appendName('viewport', 'initial-scale=1.0, user-scalable=no')
             ->appendName('robots', 'index, follow')
             ->appendName('revisit', 'after 1 days')
             ->appendHttpEquiv('Content-Type', 'text/html; charset=utf-8')
             ->appendName('document-state', 'dynamic');					 					 					 		

        echo $this->headMeta();
        echo $this->headTitle();
        echo $this->headLink(); 

        $lang = Zend_Registry::get('lang');
        $l_alias = $lang['alias'];
        $currencie = Zend_Registry::get('currencie');
        $c_alias = strtolower($currencie['alias']);
    ?>
    <script>
        var globalLang = '<?php echo $l_alias; ?>';
        var globalCurr = '<?php echo $c_alias; ?>';
    </script>
    <?php
        $this->headScript()->appendFile('https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places');
        $this->headScript()->appendFile('/js/jquery-1.10.2.min.js');
        $this->headScript()->appendFile('/js/bootstrap.min.js');
        $this->headScript()->appendFile('/js/forms-ajax.js');
        $this->headScript()->appendFile('/js/jquery/jquery-ui-1.9.0.custom/js/jquery-ui-1.9.0.custom.min.js');
        $this->headScript()->appendFile('/js/jquery/jQuery-File-Upload-master/js/vendor/jquery.ui.widget.js');
        $this->headScript()->appendFile('/js/jquery/jQuery-File-Upload-master/proprietar/load-image.js');
        $this->headScript()->appendFile('/js/jquery/jQuery-File-Upload-master/proprietar/canvas-to-blob.js');
        $this->headScript()->appendFile('/js/jquery/jQuery-File-Upload-master/js/jquery.iframe-transport.js');
        $this->headScript()->appendFile('/js/jquery/jQuery-File-Upload-master/js/jquery.fileupload.js');
        $this->headScript()->appendFile('/js/jquery/jQuery-File-Upload-master/js/jquery.fileupload-process.js');
        $this->headScript()->appendFile('/js/jquery/jQuery-File-Upload-master/js/jquery.fileupload-resize.js');
        $this->headScript()->appendFile('/js/jquery/jQuery-File-Upload-master/js/jquery.fileupload-validate.js');
        echo $this->headScript();
    ?>

</head>
<body>

<?php echo $this->Common()->header(); ?>
<div class="body">
    <div class="push1"></div>
    <div class="userpanel-header">
        <h1>Панель управления аккаунтом</h1>
    </div>
    <div class="row-fluid">
        <div class="wrapper cf span8 offset2 row-fluid">
            <div class="userpanel-menu span3">
                <ul class="left-menu" id="left-menu">
                    <li class="collapsed">
                        <a href="#" class="main cf">
                            <i class="micon micon-mainpage"></i>
                            <div>Главная страница</div>
                            <i class="marrow"></i>
                        </a>
                        <div class="inner"></div>
                    </li>
                    <li class="collapsed">
                        <a href="#" class="main cf">
                            <i class="micon micon-friends"></i>
                            <div>Друзья</div>
                            <i class="marrow"></i>
                        </a>
                        <div class="inner"></div>
                    </li>
                    <li class="collapsed">
                        <a href="#" class="main cf">
                            <i class="micon micon-profile"></i>
                            <div>Профиль</div>
                            <i class="marrow"></i>
                        </a>
                        <div class="inner"></div>
                    </li>
                    <li class="collapsed">
                        <a href="#" class="main cf">
                            <i class="micon micon-ads"></i>
                            <div>Ваши объявления</div>
                            <i class="marrow"></i>
                        </a>
                        <div class="inner"></div>
                    </li>
                    <li class="collapsed">
                        <a href="#" class="main cf">
                            <i class="micon micon-trips"></i>
                            <div>Поездки</div>
                            <i class="marrow"></i>
                        </a>
                        <div class="inner"></div>
                    </li>
                    <li class="collapsed">
                        <a href="#" class="main cf">
                            <i class="micon micon-chpassword"></i>
                            <div>Смена пароля</div>
                            <i class="marrow"></i>
                        </a>
                        <div class="inner"></div>
                    </li>
                    <li class="collapsed">
                        <a href="#" class="main cf">
                            <i class="micon micon-messages"></i>
                            <div>Сообщения</div>
                            <i class="marrow"></i>
                        </a>
                        <div class="inner"></div>
                    </li>
                    <li class="collapsed">
                        <a href="#" class="main cf">
                            <i class="micon micon-accsettings"></i>
                            <div>Настройка аккаунта</div>
                            <i class="marrow"></i>
                        </a>
                        <div class="inner"></div>
                    </li>
                    <li class="collapsed">
                        <a href="#" class="main cf">
                            <i class="micon micon-sitemanage"></i>
                            <div>Управление сайтом</div>
                            <i class="marrow"></i>
                        </a>
                        <div class="inner"></div>
                    </li>
                </ul>
                <?php echo $this->Common()->userMenu(); ?>
            </div>
            <div class="userpanel-content span6"><?php  echo $this->layout()->content;?></div>
        </div>
    </div>
    <div class="push2"></div>    
</div>
<div class="footer">
	<div class="footer_resize">
		
	</div>
</div>
<div class="mega-overlay">
    <div></div>
</div>
</body>
</html>