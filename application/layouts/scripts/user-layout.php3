<?php echo $this->doctype('XHTML1_TRANSITIONAL'); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php 
    
        $this->headTitle('Zaselis')->setSeparator(' | '); 

        $this->headLink()
             ->appendStylesheet('/theme/css/style.css')
//             ->appendStylesheet('http://fonts.googleapis.com/css?family=Lobster&subset=latin,cyrillic-ext,latin-ext,cyrillic')
             ->appendStylesheet('/js/jquery/jQuery-File-Upload-master/css/style.css')
             ->appendStylesheet('/js/jquery/jQuery-File-Upload-master/css/jquery.fileupload-ui.css')
             ->appendStylesheet('/theme/css/userpanel.css')
             ->appendStylesheet('/js/jquery/jquery-ui-1.9.0.custom/css/smoothness/jquery-ui-1.10.3.custom.css')
             ->appendStylesheet('/theme/css/bootstrap.css')
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
        $this->headScript()->appendFile('/js/adaptive.js');
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
        <div class="userpanel-header">
            <h1>Панель управления аккаунтом</h1>
        </div>
        <div class="wrapper cf">
            
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
<div class="mega-overlay">
    <div></div>
</div>
</body>
</html>