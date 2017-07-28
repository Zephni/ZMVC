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
	));

	// Include common classes / functions
	if(is_dir($ZMVC->Route(array("Root"), "Common")))
		foreach(glob($ZMVC->Route(array("Root"), "Common/*.php")) as $File)
			include_once($File);

	// Invoke controller
	$Controller = new Controller($ZMVC);