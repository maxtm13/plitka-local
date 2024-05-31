function setCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	var expires = "expires=" + d.toUTCString();
	document.cookie = cname + "=" + cvalue + "; " + expires;
}
function getCookie(cname) {
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') c = c.substring(1);
		if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
	}
	return "";
}

function eshopOpenNativeMenu() {
	var native_menu = BX("bx_native_menu");
	var is_menu_active = BX.hasClass(native_menu, "active");

	if (is_menu_active) {
		BX.removeClass(native_menu, "active");
		BX.removeClass(BX('bx_menu_bg'), "active");
		BX("bx_eshop_wrap").style.position = "";
		BX("bx_eshop_wrap").style.top = "";
		BX("bx_eshop_wrap").style.overflow = "";
	}
	else {
		BX.addClass(native_menu, "active");
		BX.addClass(BX('bx_menu_bg'), "active");
		var topHeight = document.body.scrollTop;
		BX("bx_eshop_wrap").style.position = "fixed";
		BX("bx_eshop_wrap").style.top = -topHeight + "px";
		BX("bx_eshop_wrap").style.overflow = "hidden";
	}

	var easing = new BX.easing({
		duration: 300,
		start: { left: (is_menu_active) ? 0 : -100 },
		finish: { left: (is_menu_active) ? -100 : 0 },
		transition: BX.easing.transitions.quart,
		step: function (state) {
			native_menu.style.left = state.left + "%";
		}
	});
	easing.animate();
}

window.addEventListener('resize',
	function () {
		if (window.innerWidth >= 640 && BX.hasClass(BX("bx_native_menu"), "active"))
			eshopOpenNativeMenu();
	},
	false
);

function rem(ele) {
	var str = jQuery(ele).html();
	jQuery("form .bx_filter_block span label").each(function (i, e) {
		if (jQuery(e).html() == str) {
			jQuery(e).parent().find("input[type='checkbox']").each(function (i, e) {
				jQuery(e).trigger('click');
			});
		}
	});
	jQuery(ele).parent().remove();
}

//пересчёт единиц измерения
function recalcUnits($obj, $startTypeUnit) {
	if (jQuery('.calc-measures').length > 0) {
		//если есть преключатели ед. изм.
		$decimal = 10000; //кол-во знаков после запятой
		$inpt = '#' + jQuery('.calc-measures').attr('data-inpt');
		$curVal = jQuery('#unit-quantity').val();
		$sqr = parseFloat(jQuery('.calc-measures').attr('data-sqr'));
		$pac = parseInt(jQuery('.calc-measures').attr('data-pac'));
		if (typeof ($obj) == 'object' && !jQuery($obj).hasClass('active')) {
			//щёлкнули не по активной единице
			$wasUnit = jQuery('.calc-measures a.active').attr('data-unit');
			$curUnit = jQuery($obj).attr('data-unit');
			jQuery('.calc-measures a.active').removeClass('active');
			jQuery($obj).addClass('active');
			if ($curUnit == $startTypeUnit) {
				return;
			}
			else if ($curUnit == 'm') {
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
		} else if (typeof ($obj) == 'boolean') {
			//щёлкали по кнопкам + и -, просто пересчитываем
			$curUnit = jQuery('.calc-measures a.active').attr('data-unit');
			if ($curUnit == $startTypeUnit) {
				$curVal = parseInt($curVal * $decimal, 10) / $decimal;
				jQuery($inpt).val($curVal);
			}
			else if ($curUnit == 'm') { //кв.м.
				$curVal = parseInt($curVal / $sqr * $decimal, 10) / $decimal;
				jQuery($inpt).val(Math.ceil($curVal));
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
function recalcUnitsInList($obj, $key, $startTypeUnit) {
	if (jQuery('[class^="calc-measures"]').length > 0) {
		//если есть преключатели ед. изм.
		$decimal = 10000; //кол-во знаков после запятой
		$cm_cls = '.calc-measures-' + $key;
		$uq_cls = '.unit-quantity-' + $key;
		$inpt = '#' + jQuery($cm_cls).attr('data-inpt');
		$curVal = jQuery($uq_cls).val();
		$sqr = parseFloat(jQuery($cm_cls).attr('data-sqr'));
		$pac = parseInt(jQuery($cm_cls).attr('data-pac'));
		if (typeof ($obj) == 'object' && !jQuery($obj).hasClass('active')) {
			//щёлкнули не по активной единице
			$wasUnit = jQuery($cm_cls + ' a.active').attr('data-unit');
			$curUnit = jQuery($obj).attr('data-unit');
			jQuery($cm_cls + ' a.active').removeClass('active');
			jQuery($obj).addClass('active');
			if ($curUnit == 'm') {
				//переключились на кв.м.
				$newVal = $curVal * $sqr;
				if ($wasUnit == 'p') {
					//из упак., домножаем на кол-во в упак.
					$newVal = $newVal * $pac;
				}
				$newVal = parseInt($newVal * $decimal, 10) / $decimal; //берём только 4-е знака после запятой, без округления
				jQuery($uq_cls).val($newVal);
				if ($curUnit == $startTypeUnit) {
					jQuery($inpt).val($newVal);
				}
			} else if ($curUnit == 'i') {
				//переключились на шт.
				if ($wasUnit == 'm') {
					//из кв.м.
					$newVal = Math.ceil($curVal / $sqr);
					jQuery($uq_cls).val($newVal);
					if ($curUnit == $startTypeUnit) {
						jQuery($inpt).val($newVal);
						return;
					}
				} else {
					//из упак.
					$newVal = $curVal * $pac;
					jQuery($uq_cls).val($newVal);
				}
				$newM = parseInt(($newVal * $sqr) * $decimal, 10) / $decimal;
				jQuery($inpt).val($newM);
			} else if ($curUnit == 'p') {
				//переключились на упак.
				if ($wasUnit == 'm') {
					//из кв.м.
					$newVal = Math.ceil($curVal / ($pac * $sqr));
					jQuery($uq_cls).val($newVal);
				} else {
					//из шт.
					$newVal = Math.ceil($curVal / $pac);
					jQuery($uq_cls).val($newVal);
				}
				$newM = parseInt(($newVal * $pac * $sqr) * $decimal, 10) / $decimal;
				jQuery($inpt).val($newM);
			}
		} else if (typeof ($obj) == 'boolean') {
			//щёлкали по кнопкам + и -, просто пересчитываем
			$curUnit = jQuery($cm_cls + ' a.active').attr('data-unit');
			if ($curUnit == $startTypeUnit) {
				$curVal = parseInt($curVal * $decimal, 10) / $decimal;
				jQuery($inpt).val($curVal);
			}
			else if ($curUnit == 'm') { //кв.м.
				$curVal = parseInt($curVal / $sqr * $decimal, 10) / $decimal;
				jQuery($inpt).val(Math.ceil($curVal));
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

function inputCommaReplace($obj) {
	$val = jQuery($obj).val();
	$val = $val.replace(',', '.');
	jQuery($obj).val($val);
}

/*function topMenuColImgAlgn() {
	if (jQuery('.pnd-vm-top-2018 .include-wrapper-1').length > 0) {
		jQuery('.pnd-vm-top-2018 .include-wrapper-1').each(function() {
			jQuery(this).children('img').css('margin-top', 'auto');
			$h = jQuery(this).height();
			$imgH = jQuery(this).children('img').height();
			$pUl = jQuery(this).parent().children('ul');
			if ($pUl.length > 1) {
				$ulH = $pUl.last().height();
			} else {
				$ulH = 0;
			}
			$mrgT = $h - $ulH - $imgH;
			if ($mrgT > 0) {
				jQuery(this).children('img').css('margin-top', $mrgT+'px');
			}
		});
	}
}*/

jQuery(document).ready(function () {
/*
	jQuery(".bx_filter_block input[type='checkbox']").change(function () {
		var str = jQuery(this).next().html();
		var contains = jQuery("#con-choosen .bx_filter_block").html();
		var g_i = -1;
		if (contains.indexOf(str) == -1) {
			jQuery("#con-choosen .bx_filter_block").append("<div style='padding-top:3px;text-decoration:underline;'><input type='checkbox' name='remove' class='remove' /><label for='remove' onclick='rem(this)'>" + str + "</label></div>");
		} else {
			jQuery(this).parent().parent().find("input[type='checkbox']:checked").each(function (i, e) {
				g_i = i;
			});
		}
	});
*/
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
		function () {
			var ele = jQuery(this);
			ele.find("li.parent.manufacturer").show();
		},
		function () {
			jQuery(this).find("li.parent.manufacturer").hide();
		});

	//����������� ��������� ������ �������� ����
	jQuery('.topper-wrap .mobile-menu-show').click(function () {
		jQuery('.topper-wrap > ul').toggle();
	});
	//����������� ��������� ������ ���� ������ � ��.
	jQuery('.header_inner_bottom_line .mobile-menu-show').click(function () {
		jQuery(this).toggleClass('active');
		jQuery('.header_inner_bottom_line .pnd-tree-menu').toggle();
	});
	//����������� ��������� ������ �������
	jQuery('.header_inner_bottom_line .mobile-cart-show').click(function () {
		jQuery(this).toggleClass('active');
		jQuery('.header_inner_bottom_line_container .header_top_section').toggle();
	});
	//����������� ��������� ������ ������ �� ����������
	jQuery('.header_inner_bottom_line .mobile-param-show').click(function () {
		jQuery(this).toggleClass('active');
		jQuery('.sidebar').toggle();
	});
	//����������� ��������� ������ ���� � �������
	jQuery('.wrp_footer .mobile-ftr-menu-show').click(function () {
		jQuery(this).toggleClass('active');
		jQuery('.footer_inner_bottom_line').toggle();
	});

	//������ ������� �� �����
	jQuery(['.comma-replace', 'input[name="quantity"]', 'input[class*="unit-quantity-"]', 'input[id*="quantity"]', 'input[name*="QUANTITY_INPUT_"]']).each(function ($ind, $el) {
		jQuery($el).keyup(function () {
			inputCommaReplace(this);
		});
	});

	//������������ �������
	jQuery('.tabs-switch a').click(function () {
		if (!jQuery(this).hasClass('active')) {
			jQuery(this).parent().children('a.active').removeClass('active');
			jQuery(this).addClass('active');
			jQuery(this).closest('.tabs-wrapper').find('.tab').hide();
			jQuery(this).closest('.tabs-wrapper').find(jQuery(this).attr('href')).show();
		}
		return false;
	});
});

jQuery(window).resize(function () {
	//jQuery('.topper-wrap > ul').removeAttr('style');
	//jQuery('.header_inner_bottom_line .pnd-tree-menu').removeAttr('style');
	//jQuery('.header_inner_bottom_line .mobile-menu-show').removeClass('active');
	jQuery('.header_inner_bottom_line_container .header_top_section').removeAttr('style');
	//jQuery('.header_inner_bottom_line .mobile-cart-show').removeClass('active');
	//jQuery('.sidebar').removeAttr('style');
	//jQuery('.header_inner_bottom_line .mobile-param-show').removeClass('active');
	jQuery('.footer_inner_bottom_line').removeAttr('style');
	jQuery('.wrp_footer .mobile-ftr-menu-show').removeClass('active');
	if (window.innerWidth > 1000) {
		jQuery('.header_inner_bottom_line .mobile-cart-show').removeClass('active');
		jQuery('.header_inner_bottom_line .mobile-menu-show').removeClass('active');
		jQuery('.header_inner_bottom_line .mobile-param-show').removeClass('active');
		jQuery('.sidebar').removeAttr('style');
		jQuery('.header_inner_bottom_line .pnd-tree-menu').removeAttr('style');
	}
	if (window.innerWidth > 940) {
		jQuery('.topper-wrap > ul').removeAttr('style');
	}
});
$(".checkbox-custom").on("click", function () {
	$(".main-user-consent-request-popup").css('display', "block");
});

$("#check_yes").on('click', function () {
	$(".checkbox-cart").prop('checked', true);
	$(".main-user-consent-request-popup").css('display', "none");
	// $('.checkout').removeClass("checkout-disabled");
});
$("#check_no").on('click', function () {
	$(".checkbox-cart").prop('checked', false);
	$(".main-user-consent-request-popup").css('display', "none");

	// $('.checkout').addClass("checkout-disabled");
});

//МЕНЮ 
(function ($) {
	"use strict";
	$(function () {

		$(".depth-2")
			.mouseenter(function () {
				var heights = $(this)
					.find(".sublevels-wrapper")
					.map(function () {
						return $(this).height();
					})
					.get();

				var maxHeight = Math.max.apply(null, heights);

				$(this)
					.closest(".sublevels-wrapper").addClass('selected')
					//.css("max-height", maxHeight);
			})
			.mouseleave(function () {
				$(this)
					.closest(".sublevels-wrapper").removeClass('selected')
					.css("max-height", "");
			});

				
/*
		$(document).click(function (e) {
			var $currItem = $(e.target).closest(".pnd-vm-top-2018>li>a");
			var cl = $currItem.html();
			if(cl){
				var cl = cl.trim();
			}
			if(cl!='Акции'){
				if (
					$currItem.length &&
					$currItem
						.closest("li")
						.find(".pnd__arr")
						.width() > 0
				) {
					$currItem
						.closest("li")
						.siblings()
						.removeClass("js-open");
					$(".depth-2.js-open").removeClass("js-open");
					$currItem.closest("li").toggleClass("js-open");

					e.preventDefault();
				}
			}
		});
*/
/*
		$(document).click(function (e) {
			var $currItem = $(e.target).closest(".pnd__arr");
			if ($currItem.length) {
				$currItem
					.closest("li")
					.siblings()
					.removeClass("js-open");
				$(".depth-2.js-open").removeClass("js-open");
				$currItem.closest("li").toggleClass("js-open");

				e.stopPropagation();
			}
		});
*/
		/*
		$(document).click(function (e) {
			var $currItem = $(e.target).closest(".pnd__triangle");
			if ($currItem.length) {
				$currItem
					.closest("li")
					.siblings()
					.removeClass("js-open");
				$currItem.closest("li").toggleClass("js-open");

				e.stopPropagation();
			}
		});
		$(document).click(function (e) {
			var $currItem = $(e.target).closest(".pnd-vm-top-2018 .depth-2>a span");
			if ($currItem.length) {
				$currItem.closest("li").toggleClass("js-open");
				e.stopPropagation();
			}
		});
		*/
	});
})(jQuery);

//Новый футер 29.05.2020
$(document).ready(function () {
	if ( $(window).width() < 1200 ) {

		$('.new-footer .block_sections .footer_menu:last-child ul li:last-child span').html(
			'Приём заказов:<br />круглосуточно<br />без выходных!'
		);

		if ( $(window).width() <= 500 ) {

			$('.new-footer .block_sections .footer_menu > h4').on('click', function () {
				$(this).toggleClass("on off");
			});

			$('.new-footer .block_sections .footer_menu:last-child > h4').on('click', function () {
				$(this).closest('.footer_menu').toggleClass("border_b");
			});

			if ( $(window).width() < 480 ) {

				$('.new-footer .block_sections .footer_menu:last-child ul li:nth-child(3) span').html(
					'Москва,<br />2-й Вязовский<br />пр-д, 10, стр.2'
				);

				$('.new-footer .block_sections .footer_menu:last-child ul li:nth-child(4) span').html(
					'Офис и склад:<br />Пн-Пт -<br />с 9:30 до 18:30;<br />Сб - с 9:30 до 15:00<br />без перерывов;'
				);
			}
		}
	}
});

$(window).resize(function () {
	if ( $(window).width() > 479 ) {

		$('.new-footer .block_sections .footer_menu:last-child ul li:nth-child(3) span').html(
			'Москва, 2-й Вязовский<br />пр-д, 10, стр.2'
		);

		$('.new-footer .block_sections .footer_menu:last-child ul li:nth-child(4) span').html(
			'Офис и склад:<br />Пн-Пт - с 9:30 до 18:30;<br />Сб - с 9:30 до 15:00<br />без перерывов;'
		);

		if ( $(window).width() > 1199 ) {

			$('.new-footer .block_sections .footer_menu:last-child ul li:last-child span').html(
				'Приём заказов:<br />круглосуточно без выходных!'
			);
		} else {

			$('.new-footer .block_sections .footer_menu:last-child ul li:last-child span').html(
				'Приём заказов:<br />круглосуточно<br />без выходных!'
			);
		}

	} else {

		$('.new-footer .block_sections .footer_menu:last-child ul li:nth-child(3) span').html(
			'Москва,<br />2-й Вязовский<br />пр-д, 10, стр.2'
		);

		$('.new-footer .block_sections .footer_menu:last-child ul li:nth-child(4) span').html(
			'Офис и склад:<br />Пн-Пт -<br />с 9:30 до 18:30;<br />Сб - с 9:30 до 15:00<br />без перерывов;'
		);
	}
});
