<?php

function connect_to_pubs()
{
	$dsn = 'mysql:host=localhost;port=3306;dbname=pubs'; 
	$user = 'root';
	$password = 'root'; 

	$handle = new PDO($dsn, $user, $password); 
	$handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

	return $handle; 
}

function get_all_authors()
{
	$conn; 

	try{

		$conn = connect_to_pubs(); 

	}catch(PDOException $ex){
		return "open error: " . mysqli_connect_error() ; 
	}


	$sql = 'SELECT * FROM authors'; // stored procedure 

	$proc_get_authors = $conn->prepare($sql);
	
	try{

		$rs = $proc_get_authors->execute(); // result set = sql query 
	}catch(PDOException $ex){
		$conn = null; // close connection 
		return "Bad sql";
	}

	$rows = array(); 

	while($row = $proc_get_authors->fetch(PDO::FETCH_ASSOC)){
		$rows[] = $row; // add row to array
	}

	$retVal = json_encode($rows); 
	$conn = null; // close connection 

	return $retVal; 

}// end get_all_authors
	
function get_books_by_author($au_id)
{

	$conn; 

	try{

		$conn = connect_to_pubs(); 

	}catch(PDOException $ex){
		return "open error: " . mysqli_connect_error() ; 
	}

	$conn->exec("SET CHARACTER SET utf8"); 

	$sql = "SELECT * FROM titles T JOIN titleauthor TA ON T.title_id = TA.title_id WHERE TA.au_id = ?"; 

	$stmt = $conn->prepare($sql);

       	try{

		$stmt->execute(array($au_id)); 

		// exception not thrown - send as JSON

		$rows = array(); 

		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$rows[] = $row; // add each row to array
		}

		$retVal = json_encode($rows); 

	}catch(PDOException $e) {

		$retVal = "error getting books: " . $e->getMessage();
	}
	 
	// close connection 
	$stmt->closeCursor(); 
	$stmt = null; 
	$conn = null; // close connection

	return $retVal; 
		
	}// end function get author info

?> 
