function pndTopMenuSetHeight($iKey) {
	//pndTopMenuResetHeight();
	if ($iKey != '' || $iKey != 'undefined') {
		$sel = '.pnd-vm-top-2018 li[data-key="' + $iKey + '"]';
		if (jQuery($sel).children('.sublevels-wrapper').length > 0) {
			jQuery($sel).closest('.sublevels-wrapper').removeAttr('style');
			jQuery($sel).children('.sublevels-wrapper').css('height', '');
			$prntH = jQuery($sel).closest('.sublevels-wrapper').height();
			$h = jQuery($sel).children('.sublevels-wrapper').height();
			if ($h > $prntH) {
				jQuery($sel).closest('.sublevels-wrapper').height($h);
			}
			jQuery($sel).children('.sublevels-wrapper').css('height', '100%');
		}
	}
}

function pndTopMenuResetHeight() {
	jQuery('.pnd-vm-top-2018 ul.level-2 > li').each(function() {
		if (jQuery(this).children('.sublevels-wrapper').length > 0) {
			jQuery(this).closest('.sublevels-wrapper').removeAttr('style');
			jQuery(this).children('.sublevels-wrapper').css('height', '');
		}
	});
}

function pndTopMenuSetSelected() {
	jQuery.ajax({
		url: $pndTopMenuParams.TPL_PATH+'/ajax.php',
		data: {'ajax_menu': 'Y', 'curPageURL': '"'+window.location.pathname+'"'},
		method: 'POST',
		dataType: 'json'
	}).done(function($res) {
		jQuery('.pnd-vm-top-2018 .sublevel a.item-selected').removeClass('item-selected');
		for($i = 0; $i < $res.length; $i++) {
			jQuery('.pnd-vm-top-2018 .sublevel a[href="'+$res[$i]+'"]').addClass('item-selected');
		}
		if (jQuery('.pnd-vm-top-2018 .sublevel a.item-selected').closest('li').hasClass('depth-3')) {
			jQuery('.pnd-vm-top-2018 .sublevel a.item-selected').closest('li.depth-2').children('a:not(.item-selected)').addClass('item-selected');
		}
	});
}

jQuery( document ).ready(function() {
	$hasL3 = false;
	jQuery('.pnd-vm-top-2018').on('mouseenter', 'li.parent', function() {
		$pKey = jQuery(this).attr('data-key');
		$sublvl = jQuery(this).attr('data-loadsublvl');
		$sublvlKey = 'level' + $sublvl;
		$closeColsWrapper = false;
		$arInclude = new Array();

		if (!jQuery(this).hasClass('hasSublvl')) {
			$html = '<div class="sublevels-wrapper" data-level="' + $sublvl + '">';
				$html = $html + '<div class="pnd__return">' + BX.message('MSG_RETURN') + '</div>';
				$html = $html + '<ul class="sublevel level-' + $sublvl + '" data-level="' + $sublvl + '">';
				if ($sublvl == 2) {
					$levelItems = $pndTopMenu[$sublvlKey][$pKey];
					for ($itmKey in $levelItems) {
						$cls = '';
						$attrData = '';
						if ($levelItems[$itmKey].CLASS != '' || $levelItems[$itmKey].CLASS != 'undefined') {
							$cls = $cls + ' ' + $levelItems[$itmKey].CLASS;
						}
						if ($levelItems[$itmKey].IS_PARENT) {
							$cls = $cls + ' parent';
							$attrData = ' data-key="' + $itmKey + '" data-loadsublvl="' + (parseInt($sublvl) + 1) + '"';
						}
						$html = $html + '<li class="depth-' + $sublvl + $cls + '"' + $attrData + '>';
						if ($levelItems[$itmKey].IS_PARENT) {
							$html = $html + '<div class="pnd__triangle"></div>';
							$html = $html + '<a class="parent" href="' + $levelItems[$itmKey].LINK + '">' + $levelItems[$itmKey].TEXT + ' <span>&rsaquo;</span></a>';
						} else {
							$html = $html + '<a href="' + $levelItems[$itmKey].LINK + '">' + $levelItems[$itmKey].TEXT + '</a>';
						}
						$html = $html + '</li>';
					}
				} else {
					$levelCols = $pndTopMenu[$sublvlKey][$pKey];
					for ($colKey in $levelCols) {
						if ($colKey != 'col0') {
							$html = $html + '</ul>';
							if ($colKey == 'col1') {
								$html = $html + '<div class="sub-wrapper">';
								$closeColsWrapper = true;
							}
							$html = $html + '<ul class="sublevel level-' + $sublvl + '" data-level="' + $sublvl + '">';
						}
						for($itmKey in $levelCols[$colKey]) {
							$cls = '';
							$attrData = '';
							if ($levelCols[$colKey][$itmKey].CLASS != '' || $levelCols[$colKey][$itmKey].CLASS != 'undefined') {
								$cls = $cls + ' ' + $levelCols[$colKey][$itmKey].CLASS;
							}
							if ($levelCols[$colKey][$itmKey].IS_PARENT) {
								$cls = $cls + ' parent';
								$attrData = ' data-key="' + $itmKey + '" data-loadsublvl="' + (parseInt($sublvl) + 1) + '"';
							}
							$html = $html + '<li class="depth-' + $sublvl + $cls + '"' + $attrData + '>';
							if ($levelCols[$colKey][$itmKey].IS_PARENT) {
								$html = $html + '<div class="pnd__triangle"></div>';
								$html = $html + '<a class="parent" href="' + $levelCols[$colKey][$itmKey].LINK + '">' + $levelCols[$colKey][$itmKey].TEXT + ' <span>&rsaquo;</span></a>';
							} else {
								if ($levelCols[$colKey][$itmKey].CLASS.indexOf('title') != -1) {
									$html = $html + '<span>' + $levelCols[$colKey][$itmKey].TEXT + '</span>';
								} else if ($levelCols[$colKey][$itmKey].CLASS.indexOf('include') != -1) {
									$html = $html + '<div class="include-wrapper clear"></div>';
									$arInclude.push($levelCols[$colKey][$itmKey].LINK);
								} else if ($levelCols[$colKey][$itmKey].CLASS.indexOf('include1') != -1) {
									$html = $html + '<div class="include-wrapper-1"></div>';
									$arInclude.push($levelCols[$colKey][$itmKey].LINK);
								} else {
									$html = $html + '<a href="' + $levelCols[$colKey][$itmKey].LINK + '">' + $levelCols[$colKey][$itmKey].TEXT + '</a>';
								}
							}
							$html = $html + '</li>';
						}
					}
				}
				$html = $html + '</ul>';
				if ($closeColsWrapper) {
					$html = $html + '</div>';
				}
			$html = $html + '</div>';

			jQuery(this).append($html);

			jQuery(this).addClass('hasSublvl');

			pndTopMenuSetSelected();

			//смещаем колонки
			$lvl2MnW = 25;
			$zIndex = 1500;
			jQuery('.pnd-vm-top-2018 .sublevel li').each(function() {
				jQuery(this).children('.sublevels-wrapper').each(function(index) {
					$realLvl = parseInt(jQuery(this).attr('data-level'));
					$lvl = $realLvl - 2;
					if ($realLvl > 3) {
						$left = 33.33;
					} else {
						$left = $lvl2MnW * index + $lvl * $lvl2MnW;
					}
					$zIndex = $zIndex + 100;
					jQuery(this).css({'top': 0, 'left': $left+'%', 'z-index': $zIndex});
				});
			});

			//include
			if ($arInclude.length > 0) {
				//переносим подгруженную информацию в нужное место
				jQuery(this).find('.sub-wrapper').each(function () {
					$inc = jQuery(this).find('[class*="include-wrapper"]');
					jQuery($inc).appendTo(jQuery($inc).closest('.sub-wrapper'));
				});
				//подгрузим информацию
				jQuery(this).find('[class*="include-wrapper"]').each(function($ind) {
					jQuery(this).load($arInclude[$ind], function() {
						jQuery(this).append('<div class="clear"></div>');
						if ($sublvl == 3) {
							pndTopMenuSetHeight($pKey);
						}
					});
				});
			}

			//получим 3-й уровень, если ещё не получили
			if ($sublvl == 2 && !$hasL3) {
				jQuery.ajax({
					url: $pndTopMenuParams.TPL_PATH+'/ajax.php',
					data: {'ajax_menu': 'Y'},
					method: 'POST',
					dataType: 'json'
				}).done(function($res) {
					$pndTopMenu.level3 = $res.level3;
					$hasL3 = true;
				});
			}
		}

		//устанавливаем высоту
		if ($sublvl == 3) {
		 	pndTopMenuSetHeight($pKey);
		}
	});
});
