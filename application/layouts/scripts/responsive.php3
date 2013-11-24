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
            ->appendStylesheet('/theme/css/header.css')
            ->appendStylesheet('/js/jquery/jquery-ui-1.10.3.custom/css/flick/jquery-ui-1.10.3.custom.min.css')
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
    $this->headScript()->appendFile('/js/jquery/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js');
    $this->headScript()->appendFile('/js/resp-scripts.js');
    $this->headScript()->appendFile('/js/resp-slider.js');
    echo $this->headScript();
?>

</head>
<body>
<div id="fb-root"></div>
<?php //echo $this->Common()->header(); ?>
<?php //echo $this->Common()->indexSlider(); ?>
    
    <?php echo $this->action('header', 'index', 'default'); ?>
    <div class="index-wrap" id="IndexWrap">
        <?php echo $this->action('search-form', 'index', 'default'); ?>
        <?php echo $this->action('slider', 'index', 'default'); ?>
        
        
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
<?php if (!Zend_Auth::getInstance()->hasIdentity() && $this->active !== 1) : ?>
    <div id="login-dialog" style="display: none;" title="Авторизация"><?php echo $this->Common()->loginForm(); ?></div>
    <div id="register-dialog" style="display: none;" title="Регистрация"><?php echo $this->Common()->regForm(); ?> </div>
    <div id="restore-dialog" style="display: none;" title="Напоминание пароля"><?php echo $this->Common()->restorePasswordForm(); ?> </div>
<?php endif; ?>
</body>
</html>