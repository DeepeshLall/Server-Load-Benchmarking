<?php
try{
	// if($dbc==NULL){
	// 	$dbc = new PDO('sqlite:database/student_search.sqlite',NULL,NULL,array(
 //                PDO::ATTR_PERSISTENT => true ,
 //                PDO::ERRMODE_EXCEPTION => TRUE ));	
	// }
	class MyDB extends SQLite3
	{
	    function __construct()
	    {
	        $this->open('../database/student_search.sqlite');
	    }
	}
	$dbc = new MyDB;

	include('user.inc.php');
	session_start();
	return $dbc;
}catch(PDOException $e){
	echo $e->getMessage();
}
?>