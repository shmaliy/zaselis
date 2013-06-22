<?php echo $this->doctype('XHTML1_TRANSITIONAL'); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $this->headTitle('Zaselis')->setSeparator(' | '); ?>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&language=en"></script>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta name="google-translate-customization" content="4f5d1c2430126e0d-221a6bc2049dbb09-gefb7b869fc9c90a3-12"></meta>

<?php $this->headLink()
           ->appendStylesheet('/theme/css/style.css')
           ->appendStylesheet('/theme/css/userpanel.css')
           ->appendStylesheet('/theme/css/index.slider.css')
//	   ->appendStylesheet('/theme/css/swf.css')
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
<link rel="stylesheet/css" type="text/css" href="/theme/css/style.css">
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
    $this->headScript()->appendFile('/js/forms-ajax.js');
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
    <div id="footer">
	<div class="top-bg"></div>
	<div class="footer-wrapper cf">
		<div class="geo">
			<div class="title">Гео настройки</div>
			<ul class="cf">
				<li class="border"><a href="#" class="globe"><span class="simple-arrow">Русский</span></a></li>
				<li class="border"><a href="#" class="currency"><span class="simple-arrow">USD</span></a></li>
			</ul>
		</div>
		<div class="company">
			<div class="title">Компания</div>
			<ul>
				<li><a href="#"><span>О нас</span></a></li>
				<li><a href="#"><span>Помощь</span></a></li>
				<li><a href="#"><span>Условия и конфиденцияльность</span></a></li>
				<li><a href="#"><span>Наши контакты</span></a></li>
			</ul>
		</div>
		<div class="social">
			<div class="title">Присоединяйтесь к нам</div>
			<ul>
				<li><a href="#" class="shadow"><span><img src="/theme/img/vk-logo.png"></span></a></li>
				<li><a href="#" class="shadow"><span><img src="/theme/img/tv-logo.png"></span></a></li>
				<li><a href="#" class="shadow"><span><img src="/theme/img/fb-logo.png"></span></a></li>
			</ul>
		</div>
		<div class="pay">
			<div class="title">Мы принимаем к оплате Visa и Master Card</div>
			<img src="/theme/img/card-banner.png" class="shadow">
		</div>
	</div>
    </div>
<?php echo $this->Common()->header(); ?>
    
<div class="body-index">
	<div class="push1"></div>
	<?php echo $this->Common()->indexSlider(); ?>
	
	<div class="main-wrapper">
		<div class="big-container">
                    <?php  echo $this->layout()->content;?>
			<div class="items-wrp cf">
				<a class="item border-item-big left" href="#">
					<img src="/contents/flat-item-big.png" class="img">
					<span class="description">
						<span class="title shadow-text">Нужный текст: или еще чё</span>
						<span class="geo shadow-text">Хто зна где!!!</span>
					</span>
					<span class="price">
						<span class="dig">
							<span class="num shadow-text">155</span>
							<span class="about shadow-text">за сутки</span>
						</span>
					</span>
				</a>
				<a class="item border-item-big right" href="#">
					<img src="/contents/flat-item-big.png" class="img">
					<span class="description">
						<span class="title shadow-text">Нужный текст: или еще чё</span>
						<span class="geo shadow-text">Хто зна где!!!</span>
					</span>
					<span class="price">
						<span class="dig">
							<span class="num shadow-text">155</span>
							<span class="about shadow-text">за сутки</span>
						</span>
					</span>
				</a>
			</div>
		</div>
		
		<div class="small-container">
			<div class="items-wrp cf">
				<div class="small-item">
					<div class="photo border-item-big">
						<img src="/contents/flat-item-small.png" class="img">
					</div>
					<div class="description border-flat cf">
						<div class="description-wrp">
							<a class="border-dsc" href="#"><img src="/contents/slider-user-avatar.png"></a>
							<div class="text">
								<a href="#">Нужный текст</a>
								<span>Фамилия Имя</span>
							</div>
						</div>						
					</div>
				</div>
				<div class="small-item">
					<div class="photo border-item-big">
						<img src="/contents/flat-item-small.png" class="img">
					</div>
					<div class="description border-flat cf">
						<div class="description-wrp">
							<a class="border-dsc" href="#"><img src="/contents/slider-user-avatar.png"></a>
							<div class="text">
								<a href="#">Нужный текст</a>
								<span>Фамилия Имя</span>
							</div>
						</div>						
					</div>
				</div>
				<div class="small-item">
					<div class="photo border-item-big">
						<img src="/contents/flat-item-small.png" class="img">
					</div>
					<div class="description border-flat cf">
						<div class="description-wrp">
							<a class="border-dsc" href="#"><img src="/contents/slider-user-avatar.png"></a>
							<div class="text">
								<a href="#">Нужный текст</a>
								<span>Фамилия Имя</span>
							</div>
						</div>						
					</div>
				</div>
			</div>
		</div>
		
		<div class="big-container">
			<div class="items-wrp cf">
				<a class="item border-item-big left" href="#">
					<img src="/contents/flat-item-big.png" class="img">
					<span class="description">
						<span class="title shadow-text">Нужный текст: или еще чё</span>
						<span class="geo shadow-text">Хто зна где!!!</span>
					</span>
					<span class="price">
						<span class="dig">
							<span class="num shadow-text">155</span>
							<span class="about shadow-text">за сутки</span>
						</span>
					</span>
				</a>
				<a class="item border-item-big right" href="#">
					<img src="/contents/flat-item-big.png" class="img">
					<span class="description">
						<span class="title shadow-text">Нужный текст: или еще чё</span>
						<span class="geo shadow-text">Хто зна где!!!</span>
					</span>
					<span class="price">
						<span class="dig">
							<span class="num shadow-text">155</span>
							<span class="about shadow-text">за сутки</span>
						</span>
					</span>
				</a>
			</div>
		</div>
		
		<div class="small-container">
			<div class="items-wrp cf">
				<div class="small-item">
					<div class="photo border-item-big">
						<img src="/contents/flat-item-small.png" class="img">
					</div>
					<div class="description border-flat cf">
						<div class="description-wrp">
							<a class="border-dsc" href="#"><img src="/contents/slider-user-avatar.png"></a>
							<div class="text">
								<a href="#">Нужный текст</a>
								<span>Фамилия Имя</span>
							</div>
						</div>						
					</div>
				</div>
				<div class="small-item">
					<div class="photo border-item-big">
						<img src="/contents/flat-item-small.png" class="img">
					</div>
					<div class="description border-flat cf">
						<div class="description-wrp">
							<a class="border-dsc" href="#"><img src="/contents/slider-user-avatar.png"></a>
							<div class="text">
								<a href="#">Нужный текст</a>
								<span>Фамилия Имя</span>
							</div>
						</div>						
					</div>
				</div>
				<div class="small-item">
					<div class="photo border-item-big">
						<img src="/contents/flat-item-small.png" class="img">
					</div>
					<div class="description border-flat cf">
						<div class="description-wrp">
							<a class="border-dsc" href="#"><img src="/contents/slider-user-avatar.png"></a>
							<div class="text">
								<a href="#">Нужный текст</a>
								<span>Фамилия Имя</span>
							</div>
						</div>						
					</div>
				</div>
			</div>
		</div>
		
		<ul class="banners-container cf">
			<li><a href="#"><img src="/contents/banners/banner1.png"></a></li>
			<li><a href="#"><img src="/contents/banners/banner2.png"></a></li>
			<li><a href="#"><img src="/contents/banners/banner3.png"></a></li>		
		</ul>
	</div>
	<div class="push2"></div>
</div>
<div class="footer">
	
</div>	
</body>
</html>