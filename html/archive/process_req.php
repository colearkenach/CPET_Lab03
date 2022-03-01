<?php

include 'pubs_dal.php'; 

$result = "UNDEFINED"; 

session_start(); 

if($_SERVER['REQUEST_METHOD'] == 'POST')
{

	$req = $_POST['request']; 

	switch($req)
	{
	case "set_au_key":
		
		$_SESSION['last_au_key'] = $_POST['au_id']; 

		break; 

	case "get_last_au":

		// return author as JSON here instead of just author

		$result = $_SESSION['last_au_key']; 

		if (isset($_SESSION['last_au_key'])) {
		  $result = $_SESSION['last_au_key'];
		} else {
		  $result = "NO Record";
		}

		// clear ID
		unset($_SESSION['last_au_key']);

		break; 

	case "get_authors":
		$result = get_all_authors(); 
		break; 

	case "get_au_books":
		$result = get_books_by_author($_POST['author']); 
		break; 

	default: 
		$result = "unknown request: " . $req; 

	}// end switch on request

}else if($_SERVER['REQUEST_METHOD'] == 'GET'){



}

echo $result; 

?>
