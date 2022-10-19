<?php
	# configuration for default Time
	$acadyear = 2565;
	$acadsemester = 1;
	
	# configuration for database
	$_config['database']['hostname'] = "localhost";
	$_config['database']['username'] = "root";
	$_config['database']['password'] = "12345678";
	// $_config['database']['password'] = "meroot";
	$_config['database']['database'] = "pnk";
		
	# configuration for module grade
	$_config['grade'] = array("tc004","admin","tc208");
	
	# connect the database server
	$link = new mysqldb();
	$link->connect($_config['database']);
	$link->selectdb($_config['database']['database']);
	$link->query("SET NAMES 'utf8'");
	
	@session_start();
?>
