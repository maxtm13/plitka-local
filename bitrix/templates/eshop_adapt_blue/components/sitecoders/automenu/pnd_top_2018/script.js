
var jsvhover = function()
{
	var menuDiv = document.getElementById("vertical-multilevel-menu");
	if (!menuDiv)
		return;

  var nodes = menuDiv.getElementsByTagName("li");
  for (var i=0; i<nodes.length; i++) 
  {
    nodes[i].onmouseover = function()
    {
      this.className += " jsvhover";
    }
    
    nodes[i].onmouseout = function()
    {
      this.className = this.className.replace(new RegExp(" jsvhover\\b"), "");
    }
  }
}

jQuery( document ).ready(function() {
	//jQuery('.pnd-vm-top-2018 ul.level-2').wrap('<div class="sublevels-wrapper"></div>');
	//оборачиваем списки начиная со второй колонки
	jQuery('.pnd-vm-top-2018 ul.level-2 .sublevels-wrapper').each(function() {
		jQuery(this).children('ul').slice(1).wrapAll('<div class="sub-wrapper"></div>');
	});
	
	//переносим подгруженную информацию в нужное место
	jQuery('.pnd-vm-top-2018 .sub-wrapper').each(function() {
		$inc = jQuery(this).find('.include-wrapper');
		jQuery($inc).appendTo(jQuery($inc).closest('.sub-wrapper'));
	});
	
	//смещаем колонки
	$lvl2MnW = 25;
	$zIndex = 1500;
	/*jQuery('.pnd-vm-top-2018 > li').each(function() {
		jQuery(this).children('.sublevels-wrapper').each(function(index) {
			if (index > 0) {
				$left = $lvl2MnW * index;
				$zIndex = $zIndex - 100;
				jQuery(this).css({'left': $left+'%', 'z-index': $zIndex});
			}
		});
	});*/
	jQuery('.pnd-vm-top-2018 .sublevel li').each(function() {
		jQuery(this).children('.sublevels-wrapper').each(function(index) {
			$realLvl = parseInt(jQuery(this).attr('data-level'));
			$lvl = /*parseInt(jQuery(this).attr('data-level'))*/ $realLvl - 2;
			//if (index > 0) {
				if ($realLvl > 3) {
					$left = 33.33;
				} else {
					$left = $lvl2MnW * index + $lvl * $lvl2MnW;
				}
				$zIndex = $zIndex + 100;
				jQuery(this).css({'top': 0, 'left': $left+'%', 'z-index': $zIndex});
			//}
		});
	});
	
	jQuery('.pnd-vm-top-2018 ul.level-2 > li').mouseenter(function() {
		if (jQuery(this).children('.sublevels-wrapper').length > 0) {
			$prntH = jQuery(this).closest('.sublevels-wrapper').height();
			$h = jQuery(this).children('.sublevels-wrapper').height();
			if ($h > $prntH) {
				jQuery(this).closest('.sublevels-wrapper').height($h);
			} else {
				jQuery(this).children('.sublevels-wrapper').css('height', '100%');
			}
		}
	});
	jQuery('.pnd-vm-top-2018 ul.level-2 > li').mouseleave(function() {
		if (jQuery(this).children('.sublevels-wrapper').length > 0) {
			jQuery(this).closest('.sublevels-wrapper').removeAttr('style');
			jQuery(this).children('.sublevels-wrapper').css('height', '');
		}
	});
});
