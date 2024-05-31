function OpenMenuNode(oThis)
{
	/*if (oThis.parentNode.className == '')
		oThis.parentNode.className = 'closed';
	else
		oThis.parentNode.className = '';*/
	jQuery(oThis).parent().toggleClass('closed');
	return false;
}