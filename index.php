<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	// Include Dependance
	foreach(array("ZMVC", "Model", "View", "Controller") as $Item)
		require_once("ZMVC/".$Item.".php");

	// Initialise ZMVC
	$ZMVC = new ZMVC(array(
		// Custom configuration
		"Applications" => array(/*"admin" => "Admin"*/)
	));
	
	// Check if application is valid
	if($ZMVC->IsValidApplication($ApplicationError))
		$Controller = new Controller($ZMVC); // Invoke controller
	else
		die($ApplicationError); // Die and display error