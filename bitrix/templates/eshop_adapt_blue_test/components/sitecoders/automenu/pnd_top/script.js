
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
	$lvl2MnW = 240;
	$zIndex = 1500;
	jQuery('.pnd-vm-top > li').each(function() {
		jQuery(this).children('ul').each(function(index) {
			if (index > 0) {
				$left = $lvl2MnW * index;
				$zIndex = $zIndex - 100;
				jQuery(this).css({'margin-left': $left+'px', 'z-index': $zIndex});
			}
		});
	});
	jQuery('.pnd-vm-top .sublevel li').each(function() {
		jQuery(this).children('ul').each(function(index) {
			$lvl = parseInt(jQuery(this).attr('data-level')) - 2;
			if (index > 0) {
				$left = $lvl2MnW * index + $lvl * $lvl2MnW;
				$zIndex = $zIndex + 100;
				jQuery(this).css({'margin-left': $left+'px', 'z-index': $zIndex});
			}
		});
	});
});
