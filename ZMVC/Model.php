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

		private $Data = array();

		public function __construct($_ZMVC, $_ModelAlias, $PassData)
		{
			$this->ZMVC = $_ZMVC;
			$this->ModelAlias = $_ModelAlias;
			$this->PageTemplate = $this->ZMVC->GetConfig("DefaultTemplate");

			$_GET = array();
			for($I = 1; $I <= count($PassData); $I++)
				$_GET["param_".$I] = $PassData[$I-1];

			if(file_exists($this->ZMVC->Route("Root").$this->ZMVC->Route("ApplicationModels")."/".$_ModelAlias.".php"))
			{
				require_once($this->ZMVC->Route("Root").$this->ZMVC->Route("ApplicationModels")."/".$_ModelAlias.".php");
				$this->Data = get_defined_vars();
			}
		}

		public function GetData()
		{
			return $this->Data;
		}
	}