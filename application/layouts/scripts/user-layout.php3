<?php echo $this->doctype('XHTML1_TRANSITIONAL'); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $this->headTitle('Zaselis')->setSeparator(' | '); ?>

<?php $this->headLink()
           ->appendStylesheet('/theme/css/style.css')
           ->appendStylesheet('/theme/css/userpanel.css')
//         ->appendStylesheet('/theme/css/swf.css')
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
    $this->headScript()->appendFile('/js/jquery-1.8.1.min.js');
    $this->headScript()->appendFile('/js/bootstrap.min.js');
    $this->headScript()->appendFile('/js/adaptive.js');
    $this->headScript()->appendFile('/js/forms-ajax.js');
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
<?php echo $this->Common()->header(); ?>
<div class="body">
    <div class="push1"></div>
        <div class="wrapper cf">
            <div class="userpanel-header"></div>
            <div class="userpanel-menu">
                <?php echo $this->Common()->userMenu(); ?>
            </div>
            <div class="userpanel-content"><?php  echo $this->layout()->content;?></div>
            
        </div>
    <div class="push2"></div>    
</div>
<div class="footer">
	<div class="footer_resize">
		
	</div>
</div>
</body>
</html>