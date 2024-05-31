$(document).ready(function(){
	 
	$('#yaMap').mouseenter(function(){
		addMap('yaMap');
	});
	$('#yaMap').click(function(){
		addMap('yaMap');
	});
	
	var currentDate = new Date();
	var hours = currentDate.getHours();
	var minute = currentDate.getMinutes();
	
	if(Math.round(hours) >= 20 && Math.round(minute) >= 45 || Math.round(hours) <= 8 && Math.round(minute) < 30){
		$('.hasnight .isnigth').show();
		$('.hasnight .isday').hide();
	}else{
		$('.hasnight .isnigth').hide();
		$('.hasnight .isday').show();
	}
	/*
	if($('#is-search').length>0){
		$.ajax({
			url: '/ajax/added_search.php',
			type: 'POST',
			data: {
				ajax : true,
				unbot : '',
			},
			dataType: 'json',
			beforeSend: function () {
				$('body').addClass('wait');
			},
			success: function (data) {
				$('#is-search').html(data);
				$('body').removeClass('wait');
			}
		});
	}
	*/
	
	$('.is-checkbox').on('click', function(){
		if($(this).hasClass('checked')){
			$(this).removeClass('checked');
			$(this).find('input').prop('checked', false);
		}else{
			$(this).addClass('checked');
			$(this).find('input').prop('checked', true);
		}
		$(this).parent('.field-policy').removeClass('error');
	});
	
	$('.is-checkbox a').on('click', function(){
		window.open($(this).attr('href'), '_blank').focus();
		return false;
	});
	
	if($('#show-note').length>0){
		
		setTimeout(function() {
			$('#show-note').addClass('showit');
		}, 2000);
		
		setTimeout(function() {
			$('#show-note').removeClass('showit');
		//	closeNote('show-note');
		}, 10000);
		
		$('#show-note .closeit').on('click', function(){
			$('#show-note').removeClass('showit');
		//	closeNote('show-note');
		});
	}
	
	if($('.reorder').length>0){
		$('.reorder').on('click', function(){
			if(!$('.checknumber-popup').hasClass('show')){
				$('.checknumber-popup').addClass('show');
			}
		});
	}
	
	if($('#is-main__slider').length>0){
		$('#is-main__slider').slick({
			arrows : true,
			dots: true,
			infinite: false,
			autoplay: true,
			speed: 500,
			slidesToShow: 1,
		});
	}
	
	if($('#viewed').length>0){
		$('#viewed').slick({
			arrows : true,
			dots: true,
			infinite: true,
			speed: 500,
			slidesToShow: 1,
			variableWidth: true
		});
	}
	
	$(document).on('keyup', function(e) {
		if ( e.key == "Escape" ) {
			$('body').removeClass('show-menu__catalog');
			$('body').removeClass('show-menu');
			$('body').removeClass('show__filter');
		}
	});
	
	jQuery(function($){
		$(document).mouseup( function(e){ // событие клика по веб-документу
			if($('body').hasClass('show__filter')){
				var div = $( ".sidebar , .filter-burger" ); // тут указываем ID элемента
				if ( !div.is(e.target) // если клик был не по нашему блоку
					 && div.has(e.target).length === 0 ) { // и не по его дочерним элементам
					$('body').removeClass('show__filter'); // скрываем его
				}
			}
			var div = $( ".checknumber-popup" ); // тут указываем ID элемента
			if ( !div.is(e.target) // если клик был не по нашему блоку
				 && div.has(e.target).length === 0 ) { // и не по его дочерним элементам
				$(".checknumber-popup").removeClass('show'); // скрываем его
			}
		});
	});
	
	if($('.isfirst-click').length>0){
		$('.isfirst-click').on('click',function(){
			$('.isfirst-img').trigger('click');
		});
	}
	
	$('.is-burger').on('click', function(){
		$('body').removeClass('show-menu__catalog');
		if(!$('body').hasClass('show-menu')){
			$('body').addClass('show-menu');
		}else{
			$('body').removeClass('show-menu');
		}
	});
	
	$('.catalog-burger').on('click', function(){
		if(!$('body').hasClass('show-menu__catalog')){
			$('body').addClass('show-menu__catalog');
		}else{
			$('body').removeClass('show-menu__catalog');
		}
	});
	
	$('.filter-burger').on('click', function(){
		if(!$('body').hasClass('show__filter')){
			$('body').addClass('show__filter');
		}else{
			$('body').removeClass('show__filter');
		}
	});
	
	$(document).on('click', '#GoUp', function () {
		$('html, body').animate({
			scrollTop: 0
		}, 'slow');
		return false;
	});
	
	var windowTop = $(window).scrollTop();
	if (windowTop > 200){
		$('body').addClass("scrolling");
	} else {
		$('body').removeClass("scrolling");
	}

	$(document).on("scroll", window, function () {
		var windowTop = $(window).scrollTop();
		if (windowTop > 200){
			$('body').addClass("scrolling");
		} else {
			$('body').removeClass("scrolling");
		}
	});
	
	if($('.bx_small_cart').length>0){
		if(!$('body').hasClass('wait')){
			$.ajax({
				url: '/ajax/addtobasket.php',
				type: 'POST',
				dataType: 'json',
				data: {
					ajax : true,
				},
				beforeSend: function () {
					$('body').addClass('wait');
				},
				success: function (data) {
					$('.bx_small_cart').html(data);
				}
			});
		}
		$('body').removeClass('wait');
	}
	
	$('.is-goods__basket').on('click', function(){
		if(!$('body').hasClass('wait')){
			$.ajax({
				url: '/ajax/addtobasket.php',
				type: 'POST',
				dataType: 'json',
				data: {
					ajax : true,
					id : $(this).attr('data-id'),
					type : 'add',
				},
				beforeSend: function () {
					$('body').addClass('wait');
				},
				success: function (data) {
					$('.bx_small_cart').html(data);
				}
			});
		}
		$('body').removeClass('wait');
	});

	$('.addBasketBtn').on('click', function(){
		if(!$('body').hasClass('wait')){
			$.ajax({
				url: '/ajax/addtobasket.php',
				type: 'POST',
				dataType: 'json',
				data: {
					ajax : true,
					id : $(this).attr('data-id'),
					type : 'add',
				},
				beforeSend: function () {
					$('body').addClass('wait');
				},
				success: function (data) {
					$('.bx_small_cart').html(data);
				}
			});
		}
		$('body').removeClass('wait');
	});
	/*
	$("#fast_search").submit(function(e) {
		var art = $("#fast_search").find('[name=search]').val();
		if(art.length>0){
			fastSearch(art);
		}
		e.preventDefault();
	});
	*/
});

function checkpoint(id){
	$('#'+id).val($('#'+id).val().replace(/\,/g, '.'));
}

function checkNumber(id){
	$('.buyit').addClass('wait');
	setTimeout(function(){
		if($('#'+id).val().length>0){
			$.ajax({
				url: '/ajax/checkorder.php',
				type: 'POST',
				data: {
					ajax : true,
					id : $('#'+id).val()
				},
				dataType: 'json',
				success: function (data) {
					if(data != 'oops'){
						location.replace(data);
					}else{
						$('#'+id).val('').attr('placeholder','Заказ не найден');
					}
				}
			});
		}else{
			var ishtml = $('.basket-coupon-block-total-price-current').html();
			ishtml = ishtml.replace("руб.", "");
			ishtml = ishtml.replace(" ", "");

			if(parseInt(ishtml, 0) < 3000){
				$('.note.red').show();
				$('html, body').animate({
					scrollTop: 0
				}, 'slow');
			}else{
				location.replace('/personal/order/make/');
			}
		}		
	}, 1000);
	$('.buyit').removeClass('wait');
}

function addMap(contener){
	if(!$('#'+contener).hasClass('wait') && !$('#'+contener).hasClass('success')){
		$.ajax({
			url: '/ajax/map.php',
			type: 'POST',
			data: {
				ajax : true,
				get : true
			},
			beforeSend: function () {
				$('#'+contener).addClass('wait');
			},
			success: function (data) {
				if (data){
					$('#'+contener).addClass('success').html(data);
				}
			}
		});
	}
	$('#'+contener).removeClass('wait');
}

function addMap(contener){
	if(!$('#'+contener).hasClass('wait') && !$('#'+contener).hasClass('success')){
		$.ajax({
			url: '/ajax/map.php',
			type: 'POST',
			data: {
				ajax : true,
				get : true
			},
			beforeSend: function () {
				$('#'+contener).addClass('wait');
			},
			success: function (data) {
				if (data){
					$('#'+contener).addClass('success').html(data);
				}
			}
		});
	}
	$('#'+contener).removeClass('wait');
}

function subsMe(id){
	if(!$('#' + id).hasClass('wait')){
		$.ajax({
			url: '/ajax/subs.php',
			type: 'POST',
			data: {
				ajax : true,
				unbot : $('#'+id).find('input[name="unbot"]').val(),
				subs : $('#'+id).find('input[name="subs"]').val(),
			},
			dataType: 'json',
			beforeSend: function () {
				$('#'+id).find('.error').removeClass('show').find('.error').html('');
			},
			success: function (data) {
				$('#' + id).removeClass('wait');
				
				if (data.success === true) {
					$('#'+id).addClass('success').html(data.text);
				}
				
				if (data.error === true) {
					$('#'+id).find('.error').addClass('show').html(data.text);
				}
			}
		});
	}
	$('#' + id).addClass('wait');
}
