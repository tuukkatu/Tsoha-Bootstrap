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
    HelloWorldController::listaussivu();
  });
  
  $routes->get('/login', function() {
    HelloWorldController::login();
  });
  
  $routes->get('/frontpage', function() {
    HelloWorldController::frontpage();
  });