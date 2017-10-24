<?php

require '../app/config/Config.php';

try {

    // Autoloader
    $loader = new \Phalcon\Loader();
    $loader->registerDirs([
        '../app/controllers/',
        '../app/models/',
        '../app/config/'
    ]);

    $loader->registerClasses([
        'Component\User' => '../app/components/User.php',
        'Component\Helper' => '../app/components/Helper.php',
    ]);

    $loader->register();

    // Dependency Injection
    $di = new \Phalcon\DI\FactoryDefault();

    $di->setShared('config', function () use ($config) {
        return $config;
    });

    $di->setShared('api', function () use ($api) {
        return $api;
    });

    // Session
    $di->setShared('session', function () {
        $session = new \Phalcon\Session\Adapter\Files();
        $session->start();
        return $session;
    });

    $di->setShared('component', function () {
        $obj = new stdClass();
        $obj->helper = new \Component\Helper;
        $obj->user = new \Component\User;
        return $obj;
    });

    $di->set('db', function () use ($di) {
        $dbConfig = (array)$di->get('config')->get('db');
        $db = new \Phalcon\Db\Adapter\Pdo\Mysql($dbConfig);

        return $db;
    });

    // View
    $di->set('view', function () {
        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir('../app/views');
        $view->registerEngines([".volt" => 'Phalcon\Mvc\View\Engine\Volt']);
        return $view;
    });

    // GlobalRoutes
    $di->set('router', function () {
        $router = new \Phalcon\Mvc\Router();
        $router->mount(new GlobalRoutes());
        return $router;
    });


    $di->set('flash', function () {
        $flash = new \Phalcon\Flash\Session([
            'error' => 'alert alert-danger',
            'success' => 'alert alert-sucess',
            'notice' => 'alert alert-info',
            'warning' => 'alert alert-warning'
        ]);
        return $flash;
    });

    $di->set('url', function () {
        $url = new Phalcon\Mvc\Url();
        $url->setBaseUri('/');
        return $url;
    });

    // Meta-Data
    $di['modelsMetadata'] = function () {
        $metaData = new \Phalcon\Mvc\Model\MetaData\Apc([
            "lifetime" => 86400,
            "prefix" => "metaData"
        ]);
        return $metaData;
    };

    $di->set('dispatcher', function () use ($di) {
        $eventsManager = $di->getShared('eventsManager');

        $permission = new Permission();
        $eventsManager->attach('dispatch', $permission);

        $dispatcher = new \Phalcon\Mvc\Dispatcher();
        $dispatcher->setEventsManager($eventsManager);

        return $dispatcher;
    });

    // Deploy the App
    $app = new \Phalcon\Mvc\Application($di);
    echo $app->handle()->getContent();

} catch (\Phalcon\Exception $e) {
    echo $e->getMessage();
}