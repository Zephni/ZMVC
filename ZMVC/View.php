<?php
	class View
	{
		/*
			The view:
				1. Extracts the model data
				2. Sets $this->PagePath for use in the view markup (eg. require_once($this->PagePath))
				3. Requires the template for this model, which in turn would usually call the view found at step 2
		*/

		public $PagePath = "";
		public $PageTemplate = "";

		private $Model = null;

		public function __construct($_Model, $ViewPath)
		{
			$this->Model = $_Model;

			extract($this->Model->GetData());
			$ZMVC = $this->Model->ZMVC;
			
			$this->PagePath = $ZMVC->Route("Root").$ZMVC->Route("ApplicationViews")."/".$ViewPath.".php";

			ob_start();
			require_once($ZMVC->Route("Root").$ZMVC->Route("ApplicationTemplates")."/".$this->Model->PageTemplate.".php");
			$Content = ob_get_contents();
			ob_end_clean();

			echo $Content;
		}
	}