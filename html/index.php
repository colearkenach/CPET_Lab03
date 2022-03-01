<?php

// require_once  'index.html'; // this loads the index.html file 

require_once(__DIR__ . '/router.php');
require_once(__DIR__ . '/php/authorController.php');
require_once(__DIR__ . '/php/booksController.php');

$router = new router(); 

// register routes

$router->get("/", function()
{
   require_once "index.html";
});

$router->get('/author', function($id)
{
    require_once 'html/authors.html';
});

$router->get('/authors', function()
{
    authorController::authors();
});

$router->get('/books', function()
{
    booksController::books();
});

$router->run();

?>