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
		public $ApplicationPath = null;
		public $URLParts = null;

		private $Routes	= array();

		public function __construct($_Config = array())
		{
			// Default config
			$this->Config["ZMVCPath"]				= "/ZMVC";
			$this->Config["Applications"]			= array();
			$this->Config["DefaultApplication"]		= "/Application";
			$this->Config["ApplicationTemplates"]	= "/Templates";
			$this->Config["ApplicationModels"]		= "/Models";
			$this->Config["ApplicationViews"]		= "/Views";
			$this->Config["ApplicationControllers"]	= "/Controllers";
			$this->Config["PageRequestVariable"]	= "page";
			$this->Config["DefaultTemplate"]		= "main";
			$this->Config["DefaultPage"]			= "home";

			// Insert/Update config
			foreach($_Config as $K => $V)
				$this->Config[$K] = $V;

			// Routes
			$this->Routes["Root"]					= substr(dirname(__FILE__), 0, -strlen($this->Config["ZMVCPath"]));
			$this->Routes["Page"]					= ltrim($_SERVER["REQUEST_URI"], rtrim($_SERVER["SCRIPT_NAME"], "/index.php"));
			$this->Routes["Local"]					= rtrim(rtrim($_SERVER["REQUEST_URI"], $this->Route("Page")), "/");

			// Application routes
			$this->URLParts = (strlen($this->Route("Page")) > 0) ? explode("/", $this->Route("Page")) : array();
			if(count($this->URLParts) > 0 && $this->URLParts[count($this->URLParts)-1] == "") unset($this->URLParts[count($this->URLParts)-1]);

			$this->ApplicationPath = $this->Config["DefaultApplication"];
			if(isset($this->URLParts[0]) && in_array($this->URLParts[0], $this->Config["Applications"]))
			{
				$this->ApplicationPath = "/".$this->URLParts[0];
				$this->URLParts = array_slice($this->URLParts, 1);
			}
			
			$this->Routes["ApplicationTemplates"]	= $this->ApplicationPath.$this->Config["ApplicationTemplates"];
			$this->Routes["ApplicationModels"]		= $this->ApplicationPath.$this->Config["ApplicationModels"];
			$this->Routes["ApplicationViews"]		= $this->ApplicationPath.$this->Config["ApplicationViews"];
			$this->Routes["ApplicationControllers"]	= $this->ApplicationPath.$this->Config["ApplicationControllers"];
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