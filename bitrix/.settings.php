<?php
return array (
  'crypto' => 
  array (
    'value' => 
    array (
      'crypto_key' => '5d862fa318a32019c2b487ccf762ceb276befc8de76bbfdb9cb13f790aa99d21',
    ),
    'readonly' => true,
  ),
  'session' => 
  array (
    'value' => 
    array (
      'lifetime' => 14400,
      'mode' => 'default',
      'handlers' => 
      array (
        'general' => 
        array (
          'type' => 'file',
        ),
      ),
    ),
  ),
  'utf_mode' => 
  array (
    'value' => true,
    'readonly' => true,
  ),
  'cache_flags' => 
  array (
    'value' => 
    array (
      'config_options' => 3600,
      'site_domain' => 3600,
    ),
    'readonly' => false,
  ),
  'cookies' => 
  array (
    'value' => 
    array (
      'secure' => false,
      'http_only' => true,
    ),
    'readonly' => false,
  ),
  'exception_handling' => 
  array (
    'value' => 
    array (
      'debug' => true,
      'handled_errors_types' => 4437,
      'exception_errors_types' => 4437,
      'ignore_silence' => false,
      'assertion_throws_exception' => true,
      'assertion_error_type' => 256,
      'log' => 
      array (
        'settings' => 
        array (
          'file' => 'bitrix/php_interface/error.log',
          'log_size' => '1000000',
        ),
      ),
    ),
    'readonly' => false,
  ),
  'connections' => 
  array (
    'value' => 
    array (
      'default' => 
      array (
        'className' => '\\Bitrix\\Main\\DB\\MysqliConnection',
        'host' => 'localhost',
        'database' => 'maxtm1_plitka',
        'login' => 'maxtm1_plitka',
        'password' => 'Cntgkth21',
        'options' => 2,
      ),
    ),
    'readonly' => true,
  ),
);
