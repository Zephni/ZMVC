<?php
	class View
	{
		public $PagePath = "";
		public $PageTemplate = "";

		private $Model = null;

		public function __construct($_Model)
		{
			$this->Model = $_Model;
		}

		public function Output()
		{
			extract($this->Model->GetData());
			
			$this->PagePath = $this->Model->ZMVC->GetConfig("RootDir").$this->Model->ZMVC->GetConfig("ApplicationViewsPath")."/".$this->Model->ModelAlias.".php";

			ob_start();
			require_once($this->Model->ZMVC->GetConfig("RootDir").$this->Model->ZMVC->GetConfig("ApplicationTemplatesPath")."/".$this->Model->PageTemplate.".php");
			$Content = ob_get_contents();
			ob_end_clean();

			echo $Content;
		}
	}