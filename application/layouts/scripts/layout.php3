<?php echo $this->doctype('XHTML1_TRANSITIONAL'); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $this->headTitle('Zaselis')->setSeparator(' | '); ?>

<?php $this->headLink()
//           ->appendStylesheet('/theme/css/style.css')
//	   ->appendStylesheet('/theme/css/swf.css')
	   ->appendStylesheet('/js/jquery/jquery-ui-1.9.0.custom/css/ui-lightness/jquery-ui-1.9.0.custom.css')
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
<link rel="stylesheet/less" type="text/css" href="/theme/css/style.less">
<link rel="stylesheet/css" type="text/css" href="/theme/css/style.css">
<?php echo $this->headLink(); ?>

<?php
    $this->headScript()->appendFile('/js/less.min.js');
    $this->headScript()->appendFile('/js/jquery-1.8.1.min.js');
    $this->headScript()->appendFile('/js/bootstrap.min.js');
    $this->headScript()->appendFile('/js/adaptive.js');
    $this->headScript()->appendFile('/js/jquery/jquery-ui-1.9.0.custom/js/jquery-ui-1.9.0.custom.min.js');
    echo $this->headScript();
?>
<script>
    $(document).ready(function(){
            smartColumns(); //запускаем функцию после загрузки страницы
    });


    $(window).resize(function () { //запускаем функцию после каждого изменения размера экрана
            smartColumns();
    });
</script>
</head>
<body>
<div class="header">
    <div class="header-resize cf">
        <a class="logo" href="#"></a>
        <div class="header-resize-controls">
            <div class="menu cf right">
                <ul>
                    <li><a href="#"><span>Как это работает</span></a></li>
                    <?php if (Zend_Auth::getInstance()->hasIdentity()) : ?>
                        <li><a href="<?php echo $this->url(array(), 'logout'); ?>"><span>Выйти</span></a></li>
                    <?php else: ?>
                        <li><a onclick ="$('#register-dialog').dialog({'modal':true});"><span>Регистрация</span></a></li>
                        <li><a onclick ="$('#login-dialog').dialog({'modal':true});"><span>Войти</span></a></li>
                    <?php endif; ?>
                    <li><a href="#"><span class="simple-arrow">Контакты</span></a></li>
                    <li onmouseover="$('#langControl').show();" onmouseout="$('#langControl').hide();" class="l-selector-container"><?php echo $this->Common()->langSelector(); ?></li>
                    <li onmouseover="$('#currControl').show();" onmouseout="$('#currControl').hide();" class="c-selector-container"><?php echo $this->Common()->currSelector(); ?></li>
                    <li><a href="#" class="blue-button"><span>Сдайте свое жилье</span></a></li>
                </ul>
            </div>
        </div>
        
    	
        
        <?php if (Zend_Auth::getInstance()->hasIdentity()) : ?>
	        <?php $user = Zend_Auth::getInstance()->getIdentity(); ?>
        <?php endif; ?>
    </div>
</div>
<div class="body">
    <div class="push1"></div>
        <div class="wrapper">
            <?php  echo $this->layout()->content;?>
        </div>
    <div class="push2"></div>    
</div>
<div class="footer">
	<div class="footer_resize">
		
	</div>
</div>
    <?php if (!Zend_Auth::getInstance()->hasIdentity()) : ?>
        <div id="login-dialog" style="display: none;" title="Авторизация"><?php echo $this->Common()->loginForm(); ?></div>
        <div id="register-dialog" style="display: none;" title="Регистрация"><?php echo $this->Common()->regForm(); ?> </div>
    <?php endif; ?>
</body>
</html>