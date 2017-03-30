<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/show', function() {
    HelloWorldController::esittely();
  });
  
  $routes->get('/edit', function() {
    HelloWorldController::edit();
  });
  
  $routes->get('/beer_list', function() {
    BeerController::index();
  });
  
  $routes->get('/login', function() {
    HelloWorldController::login();
  });
  
  $routes->get('/suunnitelmat/frontpage', function() {
    BeerController::index();
  });
  
  $routes->get('/suunnitelmat', function(){
  BeerController::index();
  });
  
  $routes->post('/suunnitelmat', function(){
  BeerController::store(); 
  });
  
  $routes->get('/olut/new', function(){
  BeerController::create(); 
  });
  
  $routes->get('/suunnitelmat/:id/edit', function($id){
  BeerController::edit($id);
  });
  
  $routes->get('/suunnitelmat/:id', function($id){
  BeerController::show($id);
  });
  