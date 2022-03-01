<?php

$user = 'student';
$password = 'nhti'; 
$target = 'mysql:host=localhost;port=3306;dbname=pubs'; 

// open database connection
$handle = new PDO($target, $user, $password); 

return $handle; 

?>