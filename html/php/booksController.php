<?php

// your path will be different 
require_once(__DIR__ . '/booksRepo.php'); 

class booksController
{
    public static function book($id)
    {
        $h = require (__DIR__ . '/pubs_connect.php');

        $bRepo = new booksRepo($h);

        $book = $bRepo->find($id); 

        echo json_encode($book);
    }

    public static function books()
    {
        $h = require(__DIR__ . '/pubs_connect.php');

        $bRepo = new booksRepo($h);

        $books = $bRepo->findAll();

        echo json_encode($books);
    }    
};

// echo booksController::books();

?> 