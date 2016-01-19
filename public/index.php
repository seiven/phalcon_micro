<?php
error_reporting(E_ALL & ~E_NOTICE);

use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Micro;

define('APP_PATH', dirname(dirname(__FILE__)) . '/apps');

/**
 * Read the configuration
 */
$config = require APP_PATH . '/config/config.php';

if($config['debug']){
    $debug = new \Phalcon\Debug();
    $debug->listen();
}

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();
$app = new Micro($di);

// 日志
$di->setShared('logger', function (){
    return new \Phalcon\Logger\Adapter\File(APP_PATH . '/logs/' . date('Ymd') . '.log');
});
// api 规则路由
$apiRegister = require_once APP_PATH . '/config/register.php';
// 注册命名空间
$loader = new \Phalcon\Loader();
$loader->registerNamespaces($apiRegister['namespace'])->register();
foreach($apiRegister['list'] as $class => $conf){
    $index = new Micro\Collection();
    $index->setHandler(new $class());
    $index->setPrefix($conf['prefix']);
    foreach($conf['router'] as $router){
        $index->$router[0]($router[1], $router[2]);
    }
    $app->mount($index);
}
// 设置数据库连接
$di->set('db', function () use($config){
    $config = $config->get('database')->toArray();
    $dbAdapter = '\Phalcon\Db\Adapter\Pdo\\' . $config['adapter'];
    $connection = new $dbAdapter($config);
    return $connection;
});
// 设置配置
$di->set('config', function () use($config){
    return $config;
});
// 未找到配置
$app->notFound(function () use($app){
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo json_encode(array(
        'ret'=> 404,
        'message'=> 'not found' 
    ));
});
$app->handle();