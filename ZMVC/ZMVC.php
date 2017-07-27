<?php
	class ZMVC
	{
		/*
			ZMVC:
				1. Sets the default config
				2. Applies custom config
				3. Sets routing properties
		*/

		public $Config	= array();

		private $Routes	= array();

		public function __construct($_Config = array())
		{
			// Default config
			$this->Config["ZMVCPath"]				= "/ZMVC";
			$this->Config["ApplicationPath"]		= "/Application";
			$this->Config["PageRequestVariable"]	= "page";
			$this->Config["DefaultTemplate"]		= "main";
			$this->Config["DefaultPage"]			= "home";

			// Insert/Update config
			foreach($_Config as $K => $V)
				$this->Config[$K] = $V;

			// Forced config
			$this->Routes["Root"]					= substr(dirname(__FILE__), 0, -strlen($this->Config["ZMVCPath"]));
			$this->Routes["Page"]					= ltrim($_SERVER["REQUEST_URI"], rtrim($_SERVER["SCRIPT_NAME"], "/index.php"));
			$this->Routes["Local"]					= rtrim(rtrim($_SERVER["REQUEST_URI"], $this->Route("Page")), "/");
			$this->Routes["ApplicationTemplates"]	= $this->Config["ApplicationPath"]."/Templates";
			$this->Routes["ApplicationModels"]		= $this->Config["ApplicationPath"]."/Models";
			$this->Routes["ApplicationViews"]		= $this->Config["ApplicationPath"]."/Views";
			$this->Routes["ApplicationControllers"]	= $this->Config["ApplicationPath"]."/Controllers";
		}

		public function SetConfig($Key, $Value)
		{
			$this->Config[$Key] = $Value;
		}

		public function GetConfig($Key)
		{
			return $this->Config[$Key];
		}

		public function Route($Key, $Append = "")
		{
			if(strlen($Append) > 0)
				$Append = "/".ltrim($Append);

			if(is_string($Key))
			{
				return $this->Routes[$Key].$Append;
			}
			else if(is_array($Key))
			{
				$Path = "";
				foreach($Key as $Item)
					$Path .= $this->Route($Item);

				return str_replace("//", "/", $Path.$Append);
			}
		}
	}