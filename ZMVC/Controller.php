<?php
	class Controller
	{
		/*
			The controller:
				1. Finds the page and any parameters passed through the URL
				2. Launches the model for the page and passed through the parameters
				3. Passes the model to the view and launches the view
		*/
		public function __construct($ZMVC)
		{
			$PageParts = explode("/", ($ZMVC->Route("Page") != "") ? $ZMVC->Route("Page") : $ZMVC->GetConfig("DefaultPage"));

			if(!file_exists($ZMVC->Route("Root").$ZMVC->Route("ApplicationModels")."/".$PageParts[0].".php"))
				array_unshift($PageParts, "home");

			$Model = new Model($ZMVC, $PageParts[0], array_slice($PageParts, 1));
			$View = new View($Model);
			$View->Output();
		}
	}