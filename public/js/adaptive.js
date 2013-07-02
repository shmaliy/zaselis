function smartColumns() { //функция, подсчитывающая ширину колонок
	
	var display = $('html').width();
	var footer = $('#footer');
	
	var minWidth = 852;
	
	var siteWidth = display - 100;
	if (siteWidth < minWidth) {siteWidth = minWidth;}
	
	/*	Отработка хидера	*/
	$(".header-resize, .footer-resize, .body, .wrapper, .footer-wrapper").css({ 'width' : siteWidth + 'px'});
	$(".header-resize > .header-resize-controls").css({ 'width' : siteWidth - 205 + 'px'});
	
	/*	Отработка футера	*/
	$(".footer").html(footer.html());
	$(".footer, .footer-resize, .push2").css({'height' : footer.height()/2 + 'px'});
	$(".footer").css({'margin-top' : '-' + footer.height()/2 + 'px'});
	var footerDiv = $('.footer-wrapper > div');
//	console.log(footerDiv);
	$(footerDiv).css({'width' : Math.floor((siteWidth - 60) / 4) + 'px'});
	
	
	var cRightWidth = siteWidth - 253;
        var uRightWidth = siteWidth - 270;
        $(".userpanel-content").css({ 'width' : uRightWidth - 40 + 'px'});
	$(".column-right").css({ 'width' : cRightWidth + 'px'});
	$(".column-right-wrapper").css({ 'width' : cRightWidth + 10 + 'px'});
	$(".fullwidth > ul").css({ 'width' : siteWidth - 45 + 'px'});
	
	$(".fullwidth > ul > .border-left").css({ 'width' : (siteWidth - 45 - 151) / 4 - 22 + 'px'});
	$(".fullwidth > ul > .border-left > input").css({ 'width' : (siteWidth - 45 - 151) / 4 - 40 + 'px'});
	
	/*	Блоки главной страницы	*/
	
	var slider = $('#index-slider') || null;
	
	if (slider != null) {
		
		var sliderHeight = Math.floor($('html').height() / 3);
		
		if(sliderHeight < 400) {sliderHeight = 400;}
		
		$(slider).css({ 'width' : display + 'px', 'height' : sliderHeight + 'px'});	
		
		$('#slider-image').css({ 'width' : display + 'px'});
		
		var slImgHeight = $('#slider-image').height();
		
		var slImgMargin = (slImgHeight/2 - sliderHeight/2) * -1;
		
//		console.log(slImgHeight);
		$('#slider-image').css({ 'margin-top' : slImgMargin + 'px'});
		
		$(".arrows-wrapper").css({ 'margin-top' : sliderHeight/2 - 15 + 'px'});
		
		var sfWrapper = $('.search-form-wrapper');
		$(sfWrapper).css({'margin-top' : Math.floor(sliderHeight/2) - Math.floor(sfWrapper.height()/2) + 'px' });
		$(sfWrapper).css({'margin-left' : Math.floor(display/2) - 475 + 'px' });
	}
	
	var underSlider = $('.underslider-menu') || null;
	if (underSlider != null) {
		var uMenuWidth = 0;
		
		var items = $('.underslider-menu > ul > li');
		
		$(items).each(
			function() {
				uMenuWidth += $(this).width();
			}
		);
		
//		console.log(uMenuWidth);
		 $('.underslider-menu > ul').css({'width' : uMenuWidth + 'px'});
	}
}
	
		