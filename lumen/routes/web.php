<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/hello', function () {
    return "HelloWorld";
});

$router->get('/redis', function () {
    $obj = new redisProxy();
    $rs = $obj->connect("redis");
    $obj->select(0);
    $obj->incr("test");
    $result = [
        'test' => $obj->get("test")
    ];
    $obj->release();

    return response($result);
});

$router->get('/postgres', function () {
    $obj = new pdoProxy("pgsql:host=postgre;port=5432;dbname=db","postgres","");
    $obj->query("INSERT INTO hello(name) VALUES('Isaac')");
    $rs = $obj->query("SELECT count(*) FROM hello");
    $obj->release();
        
    $result = $rs->fetchAll();

    return response($result);
});