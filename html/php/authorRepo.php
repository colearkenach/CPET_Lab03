<?php

class authorRepo
{
    public function findAll()
    {
        $handle = require (__DIR__ . '/pubs_connect.php');

        $sql = 'SELECT * FROM authors';
    
        $stmt = $handle->query($sql);
    
        $authors = $stmt->fetchAll(PDO::FETCH_ASSOC); // get array
    
        return $authors;
     }
    
     public function update($item){}
     public function remove($id){}
}

?>