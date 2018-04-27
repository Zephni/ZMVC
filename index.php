<?php
	/* -----------------------------------
	Constants
	----------------------------------- */
	define("ROOT_DIR", __DIR__);

	/* -----------------------------------
	Error reporting
	----------------------------------- */
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	/* -----------------------------------
	Include ZMVC and dependant classes and initiate
	----------------------------------- */
	require(__DIR__."/ZMVC/ZMVC.php");
	require(__DIR__."/ZMVC/View.php");
	$ZMVC = new ZMVC();

	/* -----------------------------------
	ZMVC config
	----------------------------------- */
	$ZMVC->SetConfig("Applications",		array("application", "admin"));
	$ZMVC->SetConfig("Application",			"application");
	$ZMVC->SetConfig("LocalPath",			ltrim(__DIR__, $_SERVER["DOCUMENT_ROOT"]));
	$ZMVC->SetConfig("RequestPath",			substr($_SERVER["REQUEST_URI"], strlen("/".$ZMVC->GetConfig("LocalPath")."/")));
	$ZMVC->SetConfig("PagePath",			$ZMVC->GetPagePath($ZMVC->GetConfig("RequestPath")));

	/* -----------------------------------
	Load view
	----------------------------------- */
	$View = new View($ZMVC->GetConfig("Application"), $ZMVC->GetConfig("PagePath"));
	echo $View->BuildHTML(get_defined_vars());