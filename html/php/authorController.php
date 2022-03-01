<?php

// your path will be different 
require_once(__DIR__ . '/authorRepo.php'); 

class authorController
{
    public static function author($id)
    {
        $h = require (__DIR__ . '/pubs_connect.php');

        $auRepo = new authorRepo($h);

        $au = $auRepo->find($id); 

        echo json_encode($au);
    }

    public static function authors()
    {
        $h = require(__DIR__ . '/pubs_connect.php');

        $auRepo = new authorRepo($h);

        $authors = $auRepo->findAll();

        echo json_encode($authors);
    }

    
};

//echo authorController::authors();

?> 