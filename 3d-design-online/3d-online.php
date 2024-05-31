<?php 
	header("Content-type: text/html; charset=uft-8");
	$titlepage   = "Дизайн 3D плитки в Москве | «Плитка на дом»";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
		<title><?php echo $titlepage; ?></title>
	</head>
	<body onload="servise_();" >
		<div id="div_dhtml_up"   style="display:none; z-index:10000; position:fixed; top:0px; bottom:0px; left:0%; width:100%;   background-color:#EDEDED; " >
			<div id="div_dhtml" align="left" style="border:none; height:100%; overflow:hidden; background-color:#EDEDED;" ></div>
		</div> <!-- #Область сервиса -->   
		<script type="text/javascript">
			(function() {
				var _sw = document.createElement("script");
				_sw.type = "text/javascript";
				_sw.async = true;
				_sw.src = "https://www.tile3d.com/tile3dcom/js/v6.js"; //
				var _sh = document.getElementsByTagName("head")[0]; 
				_sh.appendChild(_sw);})();
		</script> <!-- #Вызов сервиса -->   
	</body>
</html>
