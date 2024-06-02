<?
class ChigovMeta {
  public static function MetaForPager(&$content) {
      global $APPLICATION;
      $curPage1 = (int) $_GET["PAGEN_1"];
      $curPage2 = (int) $_GET["PAGEN_2"];
      $strPage = $curPage1 ? "PAGEN_1=" : "PAGEN_2=";
      $curPage = $curPage1 ? $curPage1 : $curPage2;

      if($curPage > 1) {

        $content = str_replace("</title>", " — Cтраница ".$curPage."</title>", $content);
		  
	    $content = str_replace("</h1>", " — Cтраница ".$curPage."</h1>", $content);
        // description
        $pattern = '#<meta name="description" content="(.*?)" />#s';
        preg_match($pattern, $content, $matches);
        if($matches[1]) {
          $content = str_replace($matches[1], $matches[1]." - Страница ".$curPage.".", $content);
        }
   /*   
        // canonical
        $pattern = '#(<link[^>]*rel="canonical"[^>]*href="([^"]*)"[^>]*>)#s';
        preg_match($pattern, $content, $matches);
        $canonical = "https://www.plitkanadom.ru".$APPLICATION->GetCurPage(false);
            
        if($matches[1]) {
          $canonical = $matches[2];
          $content = str_replace($matches[1], "", $content);
        } else {
          $pattern = '#(<link[^>]*href="([^"]*)"[^>]*rel="canonical"[^>]*>)#s';
          preg_match($pattern, $content, $matches);
          if($matches[1]) {
            $canonical = $matches[2];
            $content = str_replace($matches[1], "", $content);
          }
        }

        $content = str_replace("</head>", '<link rel="canonical" href="'.$canonical.'?'.$strPage.$curPage.'"/></head>', $content);
     */
	 }

      $pattern = '#(<meta[^>]*name="robots"[^>]*content="index, follow"[^>]*>)#s';
      preg_match($pattern, $content, $matches);
            
      if($matches[1]) {
        $content = str_replace($matches[1], "", $content);
      }
  
  }
}

function sitemaprun() {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://".$_SERVER["HTTP_HOST"]."/local/php_interface/include/seo_sitemap_run.php?action=sitemap_run&ID=2&lang=ru");
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $output = curl_exec($ch);
  curl_close($ch);
  return ('sitemaprun();');
}
