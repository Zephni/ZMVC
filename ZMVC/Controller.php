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
			// Find page and params
			for($I = count($ZMVC->URLParts)-1; $I >= -1; $I--)
			{
				$CheckView = ($I >= 0) ? implode("/", array_slice($ZMVC->URLParts, 0, $I+1)) : "";

				if(file_exists($ZMVC->Route(array("Root", "ApplicationViews"), $CheckView).".php"))
				{
					$FinalPage = $CheckView;
					$PassParams = array_slice($ZMVC->URLParts, $I+1);
					break;
				}
				else if(file_exists($ZMVC->Route(array("Root", "ApplicationViews"), $CheckView."/".$ZMVC->GetConfig("DefaultPage")).".php"))
				{
					$FinalPage = $CheckView."/".$ZMVC->GetConfig("DefaultPage");
					$PassParams = array_slice($ZMVC->URLParts, $I+1);
					break;
				}
			}

			if(!isset($FinalPage))
				$FinalPage = $ZMVC->GetConfig("DefaultPage");
			if(!isset($PassParams))
				$PassParams = array();
			// Find page and params

			// Include common classes / functions for application
			if(is_dir($ZMVC->Route(array("Root"), $ZMVC->ApplicationPath."/Common")))
				foreach(glob($ZMVC->Route(array("Root"), $ZMVC->ApplicationPath."/Common/*.php")) as $File)
					include_once($File);

			// Initiate model
			$Model = new Model($ZMVC, $FinalPage, $PassParams);

			// Initiate view
			if(count($PassParams) > 0 && !$Model->AcceptParams)
				$View = new View(new Model($ZMVC, "404", array()), "404");
			else
				$View = new View($Model, $FinalPage);
		}
	}