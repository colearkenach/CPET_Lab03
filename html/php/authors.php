<?php

/*
CREDITS:
http://dsc.sun.com/databases/articles/mysql_php3.html
http://stackoverflow.com/questions/5428262/php-pdo-get-the-columns-name-of-a-table
*/

$displayMe = "Undefined"; 

function getColumnFields($database, $table, $user = 'root', $password = 'root'){
	
	$sql = 'SHOW COLUMNS FROM '.$table; 
	$target = 'mysql:host=localhost;port=3306;dbname='.$database; 

	$columns = array(); 

	try{
		// open database connection 
		$handle = new PDO($target, $user, $password); 
	}catch(PDOException $ex){
		return $columns; // empty array
	}

	$stmt = $handle->prepare($sql); // prepare has other uses, to be seen later
	
	try{
		if( $stmt->execute() ){ // execute prepared sql statement

			$raw_col_data = $stmt->fetchAll(PDO::FETCH_ASSOC); 
			
			var_dump($raw_col_data); 

			foreach($raw_col_data as $outer_key => $array){
				foreach($array as $inner_key => $value){
					if($inner_key == 'Field')
					{
						// KDG: Not sure... 
						if( ! (int)$inner_key )
						{
							$columns[] = $value; 
						}

					}

				}

			}// end for each raw_col_data
		}// end if
	}catch(Exeception $ex){
		printf("EXCEPTION!\n"); 
	}// end try/catch
	
	// close connection to database
	$handle = null; 

	return $columns; 

}

if($_POST){
	
	$tbl = $_POST["table_name"]; 
	$sql = 'SELECT * FROM '.$tbl; // authors'; 

	$dsn = 'mysql:host=localhost;port=3306;dbname=pubs'; 
	$user = 'student';
	$password = 'nhti'; 

	try{
		// open database connection 
		$handle = new PDO($dsn, $user, $password); 

	}catch(PDOException $ex){
		printf("FAILED %s\n",mysqli_connect_error() . "\n"); 
	}

	$handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // throw exceptions 
    	$handle->setAttribute(PDO::ATTR_AUTOCOMMIT, false); // false = no implicit transactions
							    // this attribute not available for SQL Server
 
	$rs = $handle->query($sql); // result set = sql query 

	$displayMe = "<table border='1'>"; // start HTML table 

	$columns = getColumnFields('pubs', $tbl); 
	
	$displayMe .= "<tr>"; // start column headers 

	foreach($columns as $field) 
	{
		// fill in column headers 
		$displayMe .= "<th>".$field."</th>"; 
	}

	$displayMe .= "</tr>"; // end column headers

	while($row = $rs->fetch()){
		
		$displayMe .= "<tr>"; // start row

		foreach($columns as $field)
		{
			// fill in row
			$displayMe .= "<td>".$row[$field]."</td>"; 
		}

		$displayMe .= "</tr>"; // end row
	}

	$handle = null; // close database connection

	$displayMe .= "</table>";  // end HTML table 

}else{ // not post
	$displayMe = "[Initial Load]"; 
}// end if/else POST
?>


<html>
<head>
<title> Author List </title>
</head>

<body>
<form action="pdo_test_1.php" method="POST">
<div>Table Name</div>
<input type="text" name="table_name"></input>
<input type="submit" value="Print Table Data" name="table_to_get"> </input>
<?php echo $displayMe; ?>

</form>
</body>

</html>

