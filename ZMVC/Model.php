<?php
	class Model
	{
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

			if(file_exists($this->ZMVC->GetConfig("RootDir").$this->ZMVC->GetConfig("ApplicationModelsPath")."/".$_ModelAlias.".php"))
			{
				require_once($this->ZMVC->GetConfig("RootDir").$this->ZMVC->GetConfig("ApplicationModelsPath")."/".$_ModelAlias.".php");
				$this->Data = get_defined_vars();
			}
		}

		public function GetData()
		{
			return $this->Data;
		}
	}