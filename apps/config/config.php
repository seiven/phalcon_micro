<?php
return new \Phalcon\Config(array(
	'database'=> array(
		'adapter'=> 'Mysql',
		'host'=> '10.10.20.202',
		'username'=> 'web_devuser',
		'password'=> 'chen18li',
		'dbname'=> 'customer_skymoons_com',
		'charset'=> 'utf8',
		'tablePrex'=> 'cu_' 
	),
	'application'=> array(
		'controllersDir'=> APP_PATH . '/controllers/',
		'modelsDir'=> APP_PATH . '/models/',
		'modulesDir'=> APP_PATH . '/',
		'migrationsDir'=> APP_PATH . '/migrations/',
		'viewsDir'=> APP_PATH . '/views/',
		'pluginsDir'=> APP_PATH . '/plugins/',
		'libraryDir'=> APP_PATH . '/library/',
		'baseUri'=> '/' 
	),
	'adminViewAutoAssgin'=> array(
		'siteName'=> 'back manage',
	),
    'debug'=>true,
));
