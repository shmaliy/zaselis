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
             ->appendStylesheet('/js/jquery/jquery-ui-1.10.3.custom/css/flick/jquery-ui-1.10.3.custom.min.css')
             ->appendStylesheet('/theme/css/bootstrap.css')
             ->appendStylesheet('/theme/css/header.css')
             ->appendStylesheet('/theme/css/responsive-admin.css')
             ->appendStylesheet('/theme/css/checkboxes.css')
             ->appendStylesheet('/js/jquery/fullcalendar-1.6.4/fullcalendar/fullcalendar.css')
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
        $this->headScript()->appendFile('/js/jquery/jquery.cookie.js');
        $this->headScript()->appendFile('/js/bootstrap.min.js');
        $this->headScript()->appendFile('/js/forms-ajax.js');
        $this->headScript()->appendFile('/js/jquery/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js');
        $this->headScript()->appendFile('/js/jquery/jQuery-File-Upload-master/js/vendor/jquery.ui.widget.js');
        $this->headScript()->appendFile('/js/jquery/jQuery-File-Upload-master/proprietar/load-image.js');
        $this->headScript()->appendFile('/js/jquery/jQuery-File-Upload-master/proprietar/canvas-to-blob.js');
        $this->headScript()->appendFile('/js/jquery/jQuery-File-Upload-master/js/jquery.iframe-transport.js');
        $this->headScript()->appendFile('/js/jquery/jQuery-File-Upload-master/js/jquery.fileupload.js');
        $this->headScript()->appendFile('/js/jquery/jQuery-File-Upload-master/js/jquery.fileupload-process.js');
        $this->headScript()->appendFile('/js/jquery/jQuery-File-Upload-master/js/jquery.fileupload-resize.js');
        $this->headScript()->appendFile('/js/jquery/jQuery-File-Upload-master/js/jquery.fileupload-validate.js');
        $this->headScript()->appendFile('/js/jquery/fullcalendar-1.6.4/fullcalendar/fullcalendar.js');
        $this->headScript()->appendFile('/js/resp-scripts.js');
        echo $this->headScript();
    ?>

</head>
<body>

<?php //echo $this->Common()->header(); ?>
<?php echo $this->action('header', 'index', 'default'); ?>
<div class="bottom-shadow"></div>
<div class="body">
    <div class="userpanel-header">
        <h1>Панель управления аккаунтом</h1>
    </div>
    <div class="row-fluid">
        <div class="wrapper cf span8 offset2 row-fluid">
            <div class="userpanel-menu span3">
                <?php echo $this->action('avatar', 'manage', 'user'); ?>
                <?php echo $this->action('left-menu', 'manage', 'user'); ?>

            </div>
            <div class="userpanel-content span9"><?php  echo $this->layout()->content;?></div>
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