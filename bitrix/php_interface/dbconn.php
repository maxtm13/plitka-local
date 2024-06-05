<?
define("DBPersistent", false);
$DBType = "mysql";
$DBHost = "localhost";
$DBLogin = "******";
$DBPassword = "******";
$DBName = "******";
$DBDebug = true;
$DBDebugToFile = false;
ini_set("memory_limit", "512M");
/*
define("BX_CACHE_TYPE", "memcache");
define("BX_CACHE_SID", $_SERVER["DOCUMENT_ROOT"]."#01");
define("BX_MEMCACHE_HOST", "127.0.0.1");
define("BX_MEMCACHE_PORT", "11211");
*/
define("BX_USE_MYSQLI", true);
define("DELAY_DB_CONNECT", true);
define("CACHED_b_file", 3600);
define("CACHED_b_file_bucket_size", 10);
define("CACHED_b_lang", 3600);
define("CACHED_b_option", 3600);
define("CACHED_b_lang_domain", 3600);
define("CACHED_b_site_template", 3600);
define("CACHED_b_event", 3600);
define("CACHED_b_agent", 3660);
define("CACHED_menu", 3600);
	define('BX_CRONTAB_SUPPORT', true);

define("BX_UTF", true);
define("BX_FILE_PERMISSIONS", 0664);
define("BX_DIR_PERMISSIONS", 0775);
umask(000);
@umask(~BX_DIR_PERMISSIONS);
define("BX_DISABLE_INDEX_PAGE", true);

if(!(defined("CHK_EVENT") && CHK_EVENT===true))
	define("BX_CRONTAB_SUPPORT", true);

define("MYSQL_TABLE_TYPE", "InnoDB"); 

define("BX_TEMPORARY_FILES_DIRECTORY", "/home/maxtm1/web/plitka.local.my/public_html/plitkanadom/tmp");
?>
