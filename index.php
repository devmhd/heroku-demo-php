<?php

	echo "Hello Heroku!";

	$pg_connection_string = "dbname=dc95fs2dc1uq5r host=ec2-54-83-17-8.compute-1.amazonaws.com port=5432 user=apvuqaquwggarx password=NVjMlNLyjpPe3QQeBdMApaxcZA sslmode=require";

	 $db = pg_connect($pg_connection_string);
	if (!$db) {
	    echo "Database connection error.";
	    exit;
	}
	 
	// CREATE TABLE Student(id int,name varchar(255),address varchar(255),sex varchar(1));
	// INSERT INTO Student (id, name, address, sex) VALUES (63,'Shamim Shuvo','Room-3002','m');

	$result = pg_query($db, "SELECT * FROM Student");

	print_r($result);

	while ($row = pg_fetch_row($result)) {
	 print_r($row);
	}

?>