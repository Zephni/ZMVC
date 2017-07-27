<?php
	class ZMVC
	{
		public $Config = array();

		public function Initialise($_Config = array())
		{
			// Default config
			$this->Config["ZMVCPath"]					= "/ZMVC";
			$this->Config["ApplicationPath"]			= "/Application";
			$this->Config["ApplicationTemplatesPath"]	= $this->Config["ApplicationPath"]."/Templates";
			$this->Config["ApplicationModelsPath"]		= $this->Config["ApplicationPath"]."/Models";
			$this->Config["ApplicationViewsPath"]		= $this->Config["ApplicationPath"]."/Views";
			$this->Config["ApplicationControllersPath"]	= $this->Config["ApplicationPath"]."/Controllers";
			$this->Config["PageRequestVariable"]		= "page";
			$this->Config["DefaultTemplate"]			= "main";
			$this->Config["DefaultPage"]				= "home";

			// Insert/Update config
			foreach($_Config as $K => $V)
				$this->Config[$K] = $V;

			// Forced config
			$this->Config["RootDir"] = substr(dirname(__FILE__), 0, -strlen($this->Config["ZMVCPath"]));
		}

		public function SetConfig($Key, $Value)
		{
			$this->Config[$Key] = $Value;
		}

		public function GetConfig($Key)
		{
			return $this->Config[$Key];
		}
	}