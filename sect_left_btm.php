<table>
<tbody>
<tr>
	<td colspan="2">
		<p>
 <span style="color: #c15c1f;"><span style="font-size: 18px;">Популярные фабрики</span></span>
		</p>
	</td>
</tr>
<tr>
	<td>
 <img alt="Kerama marazzi" title="Kerama marazzi" src="/upload/iblock/files/russia359.jpg">
	</td>
	<td>
 <a title="Kerama marazzi" href="/collections/rossiiskaya-plitka/kerama-marazzi">Kerama marazzi</a>
	</td>
</tr>
<tr>
	<td>
 <img title="Шахтинская плитка" alt="Шахтинская плитка" src="/upload/iblock/files/russia359.jpg">
	</td>
	<td>
 <a title="Шахтинская плитка" href="/collections/rossiiskaya-plitka/alma-ceramica">Alma Ceramica</a>
	</td>
</tr>
	<? /*
<tr>
	<td>
 <img title="Шахтинская плитка" alt="Шахтинская плитка" src="/upload/iblock/files/russia359.jpg"><br>
	</td>
	<td>
 <a title="Шахтинская плитка" href="/collections/rossiiskaya-plitka/uralkeramika">Уралкерамика</a>
	</td>
</tr>
*/ ?>
<tr>
	<td>
 <img title="Керамин" alt="Керамин" src="https://www.plitkanadom.ru/upload/iblock/files/belarus359.jpg"><br>
	</td>
	<td>
 <a title="Керамин" href="/collections/belorusskaya-plitka/keramin">Керамин</a>
	</td>
</tr>
<tr>
	<td>
 <img title="Cersanit" alt="Cersanit" src="/upload/iblock/files/russia359.jpg">
	</td>
	<td>
 <a title="Cersanit" href="/collections/rossiiskaya-plitka/cersanit">Cersanit</a>
	</td>
</tr>
<tr>
	<td>
 <img title="Equipe" alt="Equipe" src="https://www.plitkanadom.ru/upload/iblock/files/ispanskaya359.jpg"><br>
	</td>
	<td>
 <a title="Equipe" href="/collections/ispanskaya-plitka/equipe">Equipe</a>
	</td>
</tr>
<tr>
	<td>
 <img title="Atlas Concorde Russia" alt="Atlas Concorde Russia" src="/upload/iblock/files/russia359.jpg">
	</td>
	<td>
 <a title="Atlas Concorde Russia" href="/collections/rossiiskaya-plitka/atlas-concorde-russia">Atlas Concorde Russia</a>
	</td>
</tr>
<tr>
	<td>
 <img title="Atlas Concorde Russia" alt="Atlas Concorde Russia" src="/upload/iblock/files/russia359.jpg">
	</td>
	<td>
 <a title="Atlas Concorde Russia" href="/collections/rossiiskaya-plitka/italon">Italon</a>
	</td>
</tr>
<tr>
	<td>
		<p>
		</p>
	</td>
	<td>
 <a title="Еще фабрики" href="/hit.php">Еще фабрики</a>
	</td>
</tr>
</tbody>
</table>
 <br>
 <?/* Если мы находимся не на главной, то скрываем сертификаты*/?> <? if ($APPLICATION->GetCurPage(false) === '/'): ?>
<div class="sertifiates">
	 <!--<img style="max-width: 168px" alt="tnt"  src="/upload/clients/blagodarnost-ot-tnt3.jpg">--> <?
		//$SiteTempPath = $APPLICATION->GetTemplatePath();
		$APPLICATION->AddHeadString('<link rel="stylesheet" href="'.SITE_TEMPLATE_PATH.'/lightbox/dist/css/lightbox.min.css" />',true);
		
		$sertificatesList = scandir($_SERVER["DOCUMENT_ROOT"]."/upload/clients/certificates");
        $bigPath = '/upload/clients/certificates/';
        $smallPath = '/upload/clients/certificates_small/';
        $sertW = 168; $sertH = 2000;
		for ($i = 2; $i < count($sertificatesList); $i++){
			$sertificate = $sertificatesList[$i];
            //создадим миниатюры
            $sourceFile = $_SERVER['DOCUMENT_ROOT'].$bigPath.$sertificate;
            $destinationFile = $_SERVER['DOCUMENT_ROOT'].$smallPath.$sertificate;
            if (!file_exists($_SERVER['DOCUMENT_ROOT'].$smallPath.$sertificate)) {
                CFile::ResizeImageFile($sourceFile, $destinationFile, array('width'=>$sertW, 'height'=>$sertH));
            }
			?><a class="example-image-link" href="/upload/clients/certificates/<?=$sertificate;?>" data-lightbox="example-1"><img alt="tnt" src="/upload/clients/certificates_small/<?=$sertificate;?>" class="example-image"></a><?
		}
		
		\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/lightbox/dist/js/lightbox.min.js");
		/*
		?><script src="<?=$SiteTempPath; ?>lightbox/dist/js/lightbox-plus-jquery.min.js"></script><?*/?>
        <script>
            lightbox.option({
                'albumLabel': '%1/%2'
            });
        </script>
</div>
 <br>
<? endif; ?>