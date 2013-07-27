<?php echo $this->doctype('XHTML1_TRANSITIONAL'); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php $this->headTitle('Zaselis')->setSeparator(' | '); ?>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta name="google-translate-customization" content="4f5d1c2430126e0d-221a6bc2049dbb09-gefb7b869fc9c90a3-12"></meta>

    <?php 
    $this->headLink()
//           ->appendStylesheet('/theme/css/style.css')
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
        $this->headScript()->appendFile('/js/jquery/jquery-ui-1.9.0.custom/js/jquery-ui-1.9.0.custom.min.js');
        echo $this->headScript();
    ?>

    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body, #map-canvas {
        margin: 0;
        padding: 0;
        height: 100%;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
</head>
<body>
    <?php  echo $this->layout()->content;?>
</body>
</html>