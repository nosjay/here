<?php
/**
 * route definition in here
 *
 * @package   Here
 * @author    Jayson Wang <jayson@laboys.org>
 * @copyright Copyright (C) 2016-2018 Jayson Wang
 */
namespace Here\Config;


use Phalcon\Di;
use Phalcon\Mvc\Router;


/* dependency management */
$di = Di::getDefault();


/* @var Router $router */
$di->setShared('router', function() {
    /* create an router and using custom route table */
    $router = new Router(false);

    // get backend status
    $router->add('/init', array(
        'controller' => 'frontend',
        'action' => 'init'
    ))->via('GET');

    // create session
    $router->add('/session', array(
        'controller' => 'session',
        'action' => 'create'
    ))->via('PUT');

    return $router;
});
