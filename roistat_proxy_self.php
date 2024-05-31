<?php

/**
 * @param string $url
 * @param string $rs
 * @return string
 */
function patchUrl($url, $rs) {
    $paramsPosition = strpos($url, '?');
    $anchorPosition = strpos($url, '#');
    if ($paramsPosition === false) {
        $anchoredParts = explode('#', $url, 2);
        if (count($anchoredParts) === 1) {
            return $url . '?' . $rs;
        } else {
            return $anchoredParts[0] . '?' . $rs . '#' . $anchoredParts[1];
        }
    }

    $anchor = ($anchorPosition !== false) ? substr($url, $anchorPosition) : '';
    $params = substr($url, $paramsPosition, ($anchorPosition !== false) ? $anchorPosition-$paramsPosition-1 : strlen($url)-$paramsPosition);
    $link   = substr($url, 0, $paramsPosition);

    if (strpos($params, '?rs=') !== false || strpos($params, '&amp;rs=') !== false) {
        $params = preg_replace('~(\?|&amp;)rs=[^&]*~', '${1}' . $rs, $params);
    } else {
        $params .= '&amp;'.$rs;
    }

    return $link.$params.$anchor;
}

header("Content-type: application/xml");
$urls = 'https://www.plitkanadom.ru/bitrix/catalog_export/export_Kerama_Marazzi.xml,https://www.plitkanadom.ru/bitrix/catalog_export/export_italon.xml,https://www.plitkanadom.ru/bitrix/catalog_export/export_laparet_market.xml,https://www.plitkanadom.ru/bitrix/catalog_export/export_equipe_market.xml,https://www.plitkanadom.ru/bitrix/catalog_export/export_azori_market.xml,https://www.plitkanadom.ru/bitrix/catalog_export/export_41zero42_market.xml';
$preparedUrls = explode(',', $urls);
$channelId = '1';
$campaignId = '21372645';
$listId = isset($_GET['list']) ? $_GET['list'] : 0;
$listId = $listId > 0 ? $listId - 1 : 0;
$rsTag = (isset($_GET["rs_channel"]) && $_GET["rs_channel"] !== 'yamarket') ? $_GET["rs_channel"] : "yamarket{$channelId}";

$url = $preparedUrls[$listId];
$priceListFileHandler = fopen($url, 'r');
$endOfPreviousString = '';
$offersStarted = false;
$offerPos = false;
$offerId = null;
while (true) {
    $buffer = fgets($priceListFileHandler, 1024);
    if ($buffer === false) {
        echo $endOfPreviousString;
        break;
    }

    $string = $endOfPreviousString . $buffer;

    if (!$offersStarted) {
        $offersPos = strpos($string, '<offers');
        if ($offersPos === false) {
            echo $buffer;
            continue;
        }
        $offersStarted = true;
        echo substr($string, 0, $offersPos + 7);
        $string = substr($string, $offersPos + 7);
    }

    do {
        if ($offerId !== null) {
            $urlPos = strpos($string, '<url');
            if ($urlPos === false) {
                if (strlen($string) < 4) {
                    $endOfPreviousString = $string;
                } else {
                    $endOfPreviousString = substr($string, -4);
                    echo substr($string, 0, -4);
                }
                break;
            } else {
                echo substr($string, 0, $urlPos);
                $string = substr($string, $urlPos);
                $urlEndPos = strpos($string, '</url>');
                if ($urlEndPos === false) {
                    $endOfPreviousString = $string;
                    break;
                } else {
                    $url = substr($string, 0, $urlEndPos + 6);
                    $string = substr($string, $urlEndPos + 6);
                    $matches = null;
                    preg_match('~(<url[^>]*>)([^<]+)(</url>)~iU', $url, $matches);
                    if (is_array($matches) && count($matches) === 4) {
                        $urlAddress = $matches[2];
                        $rs = "rs={$rsTag}_{$campaignId}_{$offerId}";
                        $urlAddress = patchUrl($urlAddress, $rs);
                        echo $matches[1] . $urlAddress . $matches[3];
                    }
                    $offerId = null;
                }
            }
        }
        $offerPos = strpos($string, '<offer');
        if ($offerPos === false) {
            if (strlen($string) < 10) {
                $endOfPreviousString = $string;
            } else {
                $endOfPreviousString = substr($string, -10);
                echo substr($string, 0, -10);
            }
            break;
        } else {
            echo substr($string, 0, $offerPos);
            $string = substr($string, $offerPos);
            $matches = null;
            preg_match('~<offer[^>]+id="([^"]+)"[^>]*>~iU', $string, $matches);
            if (is_array($matches) && array_key_exists(1, $matches)) {
                $offerId = $matches[1];
            } else {
                $endOfPreviousString = $string;
                break;
            }
        }
    } while (true);
}
fclose($priceListFileHandler);