<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	// Include Dependance
	foreach(array("ZMVC", "Model", "View", "Controller") as $Item)
		require_once("ZMVC/".$Item.".php");

	// Initialise ZMVC
	$ZMVC = new ZMVC();
	$ZMVC->Initialise(array(
		// Custom configuration
	));

	// Get page alias
	$PageParts = explode("/", (ltrim($_SERVER["REQUEST_URI"], rtrim($_SERVER["SCRIPT_NAME"], "/index.php")) != "") ? ltrim($_SERVER["REQUEST_URI"], rtrim($_SERVER["SCRIPT_NAME"], "/index.php")) : $ZMVC->GetConfig("DefaultPage"));

	if(!file_exists($ZMVC->GetConfig("RootDir").$ZMVC->GetConfig("ApplicationModelsPath")."/".$PageParts[0].".php"))
		array_unshift($PageParts, "home");

	// Invoke controller
	$Controller = new Controller($ZMVC);
	$Controller->Invoke($PageParts[0], array_slice($PageParts, 1));