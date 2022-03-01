<?php

class booksRepo
{
    public function findAll()
    {
        $handle = require (__DIR__ . '/pubs_connect.php');

        $sql = 'SELECT * FROM titles';
    
        $stmt = $handle->query($sql);
    
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC); // get array
    
        return $books;
     }
    
     public function update($item){}
     public function remove($id){}
}

?>