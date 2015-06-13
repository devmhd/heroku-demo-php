<?php

	echo "Hello Heroku!";

	$pg_connection_string = "dbname=dc95fs2dc1uq5r host=ec2-54-83-17-8.compute-1.amazonaws.com port=5432 user=apvuqaquwggarx password=NVjMlNLyjpPe3QQeBdMApaxcZA sslmode=require";

	 $db = pg_connect($pg_connection_string);
	if (!$db) {
	    echo "Database connection error.";
	    exit;
	}
	 
	$result = pg_query($db, "CREATE TABLE Student(id int,name varchar(255),address varchar(255),sex varchar(1));");

?>