<?php

$handle = require 'pubs_connect.php';

// must add a job first
$sql = 'SELECT * FROM jobs'; 

$jobId = 16; // job created for testing 

$stmt = $handle->prepare($sql); 

$stmt = $handle->query($sql); // execute SQL

// FETCH_ASSOC = index by column name 
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC); // get array 

if($jobs)
{
    foreach($jobs as $job)
    {
        echo $job['job_desc'] . '<br>'; 
    }
}

$handle = null; // close handle 

?> 