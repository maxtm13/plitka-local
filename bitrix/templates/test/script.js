function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}

function eshopOpenNativeMenu()
{
	var native_menu = BX("bx_native_menu");
	var is_menu_active = BX.hasClass(native_menu, "active");

	if (is_menu_active)
	{
		BX.removeClass(native_menu, "active");
		BX.removeClass(BX('bx_menu_bg'), "active");
		BX("bx_eshop_wrap").style.position = "";
		BX("bx_eshop_wrap").style.top = "";
		BX("bx_eshop_wrap").style.overflow = "";
	}
	else
	{
		BX.addClass(native_menu, "active");
		BX.addClass(BX('bx_menu_bg'), "active");
		var topHeight = document.body.scrollTop;
		BX("bx_eshop_wrap").style.position = "fixed";
		BX("bx_eshop_wrap").style.top = -topHeight+"px";
		BX("bx_eshop_wrap").style.overflow = "hidden";
	}

	var easing = new BX.easing({
		duration : 300,
		start : { left : (is_menu_active) ? 0 : -100 },
		finish : { left : (is_menu_active) ? -100 : 0 },
		transition : BX.easing.transitions.quart,
		step : function(state){
			native_menu.style.left = state.left + "%";
		}
	});
	easing.animate();
}

window.addEventListener('resize',
	function() {
		if (window.innerWidth >= 640 && BX.hasClass(BX("bx_native_menu"), "active"))
			eshopOpenNativeMenu();
	},
	false
);

function rem(ele){
	var str = jQuery(ele).html();
	jQuery("form .bx_filter_block span label").each(function(i,e){
		if(jQuery(e).html() == str){
			jQuery(e).parent().find("input[type='checkbox']").each(function(i,e){
				jQuery(e).trigger('click');
			});
		}
	});
	jQuery(ele).parent().remove();
}

//пересчёт единиц измерения
function recalcUnits($obj) {
	if (jQuery('.calc-measures').length > 0) {
		//если есть преключатели ед. изм.
		$decimal = 10000; //кол-во знаков после запятой
		$inpt = '#'+jQuery('.calc-measures').attr('data-inpt');
		$curVal = jQuery('#unit-quantity').val();
		$sqr = parseFloat(jQuery('.calc-measures').attr('data-sqr'));
		$pac = parseInt(jQuery('.calc-measures').attr('data-pac'));
		if (typeof($obj) == 'object' && !jQuery($obj).hasClass('active')) {
			//щёлкнули не по активной единице
			$wasUnit = jQuery('.calc-measures a.active').attr('data-unit');
			$curUnit = jQuery($obj).attr('data-unit');
			jQuery('.calc-measures a.active').removeClass('active');
			jQuery($obj).addClass('active');
			if ($curUnit == 'm') {
				//переключились на кв.м.
				/*if (!jQuery('.calc-measures div').hasClass('hidden')) {
					jQuery('.calc-measures div').addClass('hidden');
				}*/
				$newVal = $curVal * $sqr;
				if ($wasUnit == 'p') {
					//из упак., домножаем на кол-во в упак.
					$newVal = $newVal * $pac;
				}
				$newVal = parseInt($newVal * $decimal, 10) / $decimal; //берём только 4-е знака после запятой, без округления
				jQuery('#unit-quantity').val($newVal);
				jQuery($inpt).val($newVal);
			} else if ($curUnit == 'i') {
				//переключились на шт.
				/*if (!jQuery('.calc-measures div').hasClass('hidden')) {
					jQuery('.calc-measures div').addClass('hidden');
				}*/
				if ($wasUnit == 'm') {
					//из кв.м.
					$newVal = Math.ceil($curVal / $sqr);
					jQuery('#unit-quantity').val($newVal);
				} else {
					//из упак.
					$newVal = $curVal * $pac;
					jQuery('#unit-quantity').val($newVal);
				}
				$newM = parseInt(($newVal * $sqr) * $decimal, 10) / $decimal;
				jQuery($inpt).val($newM);
			} else if ($curUnit == 'p') {
				//переключились на упак.
				//jQuery('.calc-measures div').removeClass('hidden');
				if ($wasUnit == 'm') {
					//из кв.м.
					$newVal = Math.ceil($curVal / ($pac * $sqr));
					jQuery('#unit-quantity').val($newVal);
				} else {
					//из шт.
					$newVal = Math.ceil($curVal / $pac);
					jQuery('#unit-quantity').val($newVal);
				}
				$newM = parseInt(($newVal * $pac * $sqr) * $decimal, 10) / $decimal;
				jQuery($inpt).val($newM);
			}
		} else if (typeof($obj) == 'boolean') {
			//щёлкали по кнопкам + и -, просто пересчитываем
			$curUnit = jQuery('.calc-measures a.active').attr('data-unit');
			if ($curUnit == 'm') { //кв.м.
				$curVal = parseInt($curVal * $decimal, 10) / $decimal;
				jQuery($inpt).val($curVal);
			} else if ($curUnit == 'i') { //шт.
				$newM = parseInt(($curVal * $sqr) * $decimal, 10) / $decimal;
				jQuery($inpt).val($newM);
			} else if ($curUnit == 'p') { //упак.
				$newM = parseInt(($curVal * $pac * $sqr) * $decimal, 10) / $decimal;
				jQuery($inpt).val($newM);
			}
		}
	}
}

jQuery(document).ready(function(){

	jQuery(".bx_filter_block input[type='checkbox']").change(function(){
		var str = jQuery(this).next().html();
		var contains = jQuery("#con-choosen .bx_filter_block").html();
		var g_i = -1;
		if(contains.indexOf(str) == -1){
			jQuery("#con-choosen .bx_filter_block").append("<div style='padding-top:3px;text-decoration:underline;'><input type='checkbox' name='remove' class='remove' /><label for='remove' onclick='rem(this)'>"+ str + "</label></div>");
		}else{
			jQuery(this).parent().parent().find("input[type='checkbox']:checked").each(function(i,e){
				g_i = i;
			});
		}
	});
/***********************************************************************************************/	
/*	jQuery(".parent.manufacturer > a").click(function(){
		col = jQuery(this).parent().find('.collection');
		if(col.css('display') == 'none'){
			jQuery(".parent.manufacturer .collection").each(function(){
				jQuery(this).hide();
			});
			col.fadeIn(300);
		}else{
			col.fadeOut(300);
		}		
		return false;
	});	*/
	jQuery("li.ceramic-tile").hover(
		function(){
			var ele = jQuery(this);
			ele.find("li.parent.manufacturer").show();
		},
		function(){
			jQuery(this).find("li.parent.manufacturer").hide();
	});
  if (getCookie("RememberedUser") != "Yes") {
    jQuery("#vertical-multilevel-menu > li:first > ul.root-item").show("slow").hover(function(){jQuery(this).css("display", "");console.log(this)});
    //console.log(getCookie("RememberedUser"));
    setCookie("RememberedUser", "Yes");  
  } else {
    console.log("no");
  }
	
	//отображение мобильной версии верхнего меню
	jQuery('.topper-wrap .mobile-menu-show').click(function() {
		jQuery('.topper-wrap > ul').toggle();
	});
	//отображение мобильной версии меню плитки и пр.
	jQuery('.header_inner_bottom_line .mobile-menu-show').click(function() {
		jQuery(this).toggleClass('active');
		jQuery('.header_inner_bottom_line .pnd-tree-menu').toggle();
	});
	//отображение мобильной версии корзины
	jQuery('.header_inner_bottom_line .mobile-cart-show').click(function() {
		jQuery(this).toggleClass('active');
		jQuery('.header_inner_bottom_line_container .header_top_section').toggle();
	});
	//отображение мобильной версии поиска по параметрам
	jQuery('.header_inner_bottom_line .mobile-param-show').click(function() {
		jQuery(this).toggleClass('active');
		jQuery('.sidebar').toggle();
	});
	//отображение мобильной версии меню в подвале
	jQuery('.wrp_footer .mobile-ftr-menu-show').click(function() {
		jQuery(this).toggleClass('active');
		jQuery('.footer_inner_bottom_line').toggle();
	});
});

jQuery(window).resize(function() {
	jQuery('.topper-wrap > ul').removeAttr('style');
	jQuery('.header_inner_bottom_line .pnd-tree-menu').removeAttr('style');
	jQuery('.header_inner_bottom_line .mobile-menu-show').removeClass('active');
	jQuery('.header_inner_bottom_line_container .header_top_section').removeAttr('style');
	jQuery('.header_inner_bottom_line .mobile-cart-show').removeClass('active');
	jQuery('.sidebar').removeAttr('style');
	jQuery('.header_inner_bottom_line .mobile-param-show').removeClass('active');
	jQuery('.footer_inner_bottom_line').removeAttr('style');
	jQuery('.wrp_footer .mobile-ftr-menu-show').removeClass('active');
});