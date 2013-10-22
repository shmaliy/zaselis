<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $this->headTitle('Zaselis')->setSeparator(' | '); ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&language=en"></script>
<meta name="google-translate-customization" content="4f5d1c2430126e0d-221a6bc2049dbb09-gefb7b869fc9c90a3-12"></meta>
<link href='https://fonts.googleapis.com/css?family=Open+Sans&subset=latin,cyrillic-ext,cyrillic' rel='stylesheet' type='text/css'>
<?php $this->headLink()
            ->appendStylesheet('/theme/css/responsive-base.css')
            ->appendStylesheet('/js/jquery/jquery-ui-1.9.0.custom/css/smoothness/jquery-ui-1.10.3.custom.css')
            ->appendStylesheet('/theme/css/bootstrap.css')
            ->headLink(array('rel' => 'favicon', 'href' => '/favicon.png'), 'PREPEND'); 

      $this->headMeta()->appendName('keywords', '')
           ->appendName('description', '')
           ->appendName('robots', 'index, follow')
           ->appendName('revisit', 'after 1 days')
	   ->appendHttpEquiv('Content-Type', 'text/html; charset=utf-8')
           ->appendName('document-state', 'dynamic');					 					 					 		
?>
<?php echo $this->headMeta();?>
<?php echo $this->headTitle(); ?>
<?php echo $this->headLink(); ?>
<?php
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
    $this->headScript()->appendFile('/js/jquery-1.10.2.min.js');
    $this->headScript()->appendFile('/js/bootstrap.min.js');
    $this->headScript()->appendFile('/js/forms-ajax.js');
    $this->headScript()->appendFile('/js/jquery/jquery-ui-1.9.0.custom/js/jquery-ui-1.9.0.custom.min.js');
    $this->headScript()->appendFile('/js/resp-scripts.js');
    $this->headScript()->appendFile('/js/resp-slider.js');
    echo $this->headScript();
?>

</head>
<body>
    
<?php //echo $this->Common()->header(); ?>
<?php //echo $this->Common()->indexSlider(); ?>
    
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
                    <a onclick ="$('#register-dialog').dialog({'modal':true});" class="btn">Регистрация</a>
                    <a onclick ="$('#login-dialog').dialog({'modal':true});" href="#" class="btn">Войти</a>
                    <a href="#" class="btn btn-info"><i class="icon-white icon-comment"></i></a>
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
                             <div class="btn dropdown-toggle" data-toggle="dropdown">
                                English
                                <span class="caret"></span>
                             </div>                        
                        </li>
                        <li class="link">
                            <div class="btn dropdown-toggle" data-toggle="dropdown">
                                EURO
                                <span class="caret"></span>
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
    </div>
    <div class="index-wrap" id="IndexWrap">
        <div class="after-shadow"></div>
        <?php echo $this->action('slider', 'index', 'default'); ?>
        
        <div class="index-search-form">
            <div class="drop-shadow"></div>
            <div class="row-fluid">
                <div class="span3 offset1 first">
                    <input class="input-large" type="text" placeholder="Куда вы едете?">
                </div>
                <div class="span2 input-prepend">
                    <span class="add-on"><i class="icon icon-black icon-calendar"></i></span>
                    <input class="span2" id="IncomeDate" type="text" placeholder="Заезд">
                </div>
                <div class="span2 input-prepend">
                    <span class="add-on"><i class="icon icon-black icon-calendar"></i></span>
                    <input class="span2" id="OutDate" type="text" placeholder="Выезд">
                </div>
                <div class="span2 ">
                     <div class="btn-group">
                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                            1 гость
                        <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>2 гостя</li>
                        </ul>
                    </div>
                </div>
                <div class="span2 ">
                    <div class="btn btn-info">Поиск</div>
                </div>
            </div>
        </div>
        <div class="after-shadow"></div>
        <div class="row-fluid">
            <div class="span10  offset1 cnt-container">
                <h1>Популярные квартиры</h1>
                <div class="row-fluid">
                    <div class="span4"></div>
                    <div class="span4"></div>
                    <div class="span4"></div>
                </div>
            </div>            
        </div>
    </div>
<?php if (Zend_Auth::getInstance()->hasIdentity() && $this->active == 1) : ?>
        
<?php else : ?>
    <div id="login-dialog" style="display: none;" title="Авторизация"><?php echo $this->Common()->loginForm(); ?></div>
    <div id="register-dialog" style="display: none;" title="Регистрация"><?php echo $this->Common()->regForm(); ?> </div>
    <div id="restore-dialog" style="display: none;" title="Напоминание пароля"><?php echo $this->Common()->restorePasswordForm(); ?> </div>
<?php endif; ?>
</body>
</html>