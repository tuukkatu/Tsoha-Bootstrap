<?php

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/olut/esittely', function() {
    BeerController::esittely();
});

$routes->get('/olut/listaussivu', function() {
    BeerController::listaussivu();
});

$routes->get('/olut/etusivu', function() {
    BeerController::etusivu();
});

$routes->get('/olut/edit', function($id) {
    BeerController::edit($id);
});

$routes->get('/beer_list', function() {
    BeerController::index();
});

//$routes->get('/olut/login', function() {
//BeerController::login();
//});

$routes->get('/olut/olutlista', function() {
    BeerController::index();
});

$routes->get('/olut', function() {
    BeerController::index();
});

$routes->post('/olut', function() {
    BeerController::store();
});

$routes->get('/olut/new', function() {
    BeerController::create();
});

$routes->get('/olut/:id/edit', function($id) {
    BeerController::edit($id);
});

$routes->get('/olut/:id', function($id) {
    BeerController::show($id);
});


$routes->post('/olut/:id/edit', function($id) {
    BeerController::update($id);
});

$routes->post('/olut/:id/destroy', function($id) {
    BeerController::destroy($id);
});

$routes->get('/login', function() {
    UserController::login();
});

$routes->post('/login', function() {
    UserController::handle_login();
});

$routes->get('/', function() {
    BeerController::index();
});

$routes->post('/logout', function() {
    UserController::logout();
});

$routes->get('/arvostelut/uusi', function() {
    ArvosteluController::create();
});

$routes->post('/arvostelut/', function(){
    ArvosteluController::store();
});

$routes->get('/arvostelut', function() {
    ArvosteluController::index();
});

$routes->get('/register', function(){
    UserController::register();
});

$routes->post('/register', function(){
    UserController::handle_register();
});