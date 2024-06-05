<?
if (!function_exists('logVar')){
	function logVar($var, $string="", $filename="log.txt") {
		define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/".$filename);
		if (is_array($var)) {
			AddMessage2Log($string." = ".var_export($var,true));
		} else {
			AddMessage2Log($string." = ".$var);
		}
	}
}

if (!function_exists('console')) {
	function console($var, $label = '', $useBackTrace = true, $toString = false) {
	    if ($useBackTrace) {
	        $backTrace = debug_backtrace();
	    }
	    $js = '<script type="text/javascript">
	      console.log(' . (empty($label) ? '' : '\'' . $label . '\',') . json_encode($var) . ');
	      ' . ($useBackTrace ? 'console.log("line: ' . $backTrace[0]['line'] . ', file: ' . $backTrace[0]['file'] . '")' : '') . ';
	    </script>';
	    if (!$toString) {
	        echo $js;
	        return '';
	    } else {
	        return $js;
	    }
	}
}


if (!function_exists('alert')){
	function alert($var) {
		echo "<script>alert('".$var."')</script>";
	}
}

if (!function_exists('pre')) {
	function pre($var) {
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}
}

class Timer
{
    /**
     * @var float время начала выполнения скрипта
     */
    private static $start = .0;

    /**
     * Начало выполнения
     */
    static function start()
    {
        self::$start = microtime(true);
    }

    /**
     * Разница между текущей меткой времени и меткой self::$start
     * @return float
     */
    static function finish()
    {
        return microtime(true) - self::$start;
    }
}
