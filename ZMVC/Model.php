<?php
	class Model
	{
		/*
			The model:
				1. Sets the template to it's default (can be changed with $this->PageTemplate within the model)
				2. Puts the passed data into the $_GET array in a numbered sequence (param_1, param_2 etc)
				3. If the model exists then launch it and collect the data
		*/

		public $PageTemplate = "";
		public $ModelAlias = "";
		public $ZMVC = null;
		public $AcceptParams = true;

		private $Data = array();

		public function __construct($_ZMVC, $_ModelAlias, $PassData)
		{
			$ZMVC = $_ZMVC;
			$this->AcceptParams = $ZMVC->GetConfig("DefaultAcceptParams");

			$this->ModelAlias = $_ModelAlias;
			$this->PageTemplate = $ZMVC->GetConfig("DefaultTemplate");

			$_GET = array();
			for($I = 1; $I <= count($PassData); $I++)
				$_GET["param_".$I] = $PassData[$I-1];

			if(file_exists($ZMVC->Route("Root").$ZMVC->Route("ApplicationModels")."/".$_ModelAlias.".php"))
				require_once($ZMVC->Route("Root").$ZMVC->Route("ApplicationModels")."/".$_ModelAlias.".php");

			if(file_exists($ZMVC->Route("Root").$ZMVC->Route("ApplicationTemplates")."/".$this->PageTemplate."_model.php"))
				require_once($ZMVC->Route("Root").$ZMVC->Route("ApplicationTemplates")."/".$this->PageTemplate."_model.php");

			$this->Data = get_defined_vars();

			$this->ZMVC = $_ZMVC;
		}

		public function GetData()
		{
			return $this->Data;
		}
	}