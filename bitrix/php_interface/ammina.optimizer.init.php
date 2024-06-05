<?
if (!function_exists("AMOPTStartComponentTemplate")) {
	function AMOPTStartComponentTemplate()
	{
		if (class_exists("\\Ammina\\Optimizer\\Core2\\Application")) {
			\Ammina\Optimizer\Core2\Application::getInstance()->doStartComponentTemplate();
		}
	}
}

if (!function_exists("AMOPTEndComponentTemplate")) {
	function AMOPTEndComponentTemplate()
	{
		if (class_exists("\\Ammina\\Optimizer\\Core2\\Application")) {
			\Ammina\Optimizer\Core2\Application::getInstance()->doEndComponentTemplate();
		}
	}
}

if (!function_exists("AMOPTResetComponentTemplate")) {
	function AMOPTResetComponentTemplate()
	{
		if (class_exists("\\Ammina\\Optimizer\\Core2\\Application")) {
			\Ammina\Optimizer\Core2\Application::getInstance()->doResetComponentTemplate();
		}
	}
}