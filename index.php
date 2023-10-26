<?php

include_once "router.php";
$router = new Router();

include "src/Controller/Controller.php";

$router->addRoute('GET', '/', function () {
    $controller = new Controller();
    return $controller->homepage();
    exit;
});

$router->addRoute('GET', '/scrape', function () {
    $controller = new Controller();
    return $controller->scrape();
    exit;
});

$router->addRoute('GET', '/create-table/:table_name', function ($table_name) {
    $controller = new Controller();
    return $controller->createTable($table_name);
    exit;
});

$router->addRoute('GET', '/drop-table/:table_name', function ($table_name) {
    $controller = new Controller();
    return $controller->dropTable($table_name);
    exit;
});

$router->addRoute('GET', '/admin', function () {
    $controller = new Controller();
    return $controller->adminPage();
    exit;
});

$router->addRoute('GET', '/results', function () {
    $controller = new Controller();
    return $controller->getResults();
    exit;
});

$router->addRoute('GET', '/register', function () {
    $controller = new Controller();
    return $controller->register();
    exit;
});

$router->addRoute('POST', '/registration', function () {
    $controller = new Controller();
    return $controller->register();
    exit;
});

$router->addRoute('GET', '/login', function () {
    $controller = new Controller();
    return $controller->login();
    exit;
});

$router->addRoute('POST', '/login', function () {
    $controller = new Controller();
    return $controller->login();
    exit;
});


$router->addRoute('GET', '/post-content', function () {
    $controller = new Controller();
    return $controller->postContent();
    exit;
});

$router->addRoute('POST', '/post-content', function () {
    $controller = new Controller();
    return $controller->postContent();
    exit;
});

$router->addRoute('GET', '/logout', function () {
    session_start();
    session_destroy();
    header('Location: /login');
    exit;
});

$router->matchRoute();