<?php
	# configuration for default Time
	$acadyear = 2565;
	$acadsemester = 1;
	
	# configuration for database
	$_config['database']['hostname'] = "localhost";
	$_config['database']['username'] = "pnkacth_saais";
	$_config['database']['password'] = "pnkacth_saais";
	// $_config['database']['password'] = "meroot";
	$_config['database']['database'] = "pnkacth_saais";
		
	# configuration for module grade
	$_config['grade'] = array("tc004","admin","tc208");
	
	# connect the database server
	$link = new mysqldb();
	$link->connect($_config['database']);
	$link->selectdb($_config['database']['database']);
	$link->query("SET NAMES 'utf8'");
	
	@session_start();
?>
