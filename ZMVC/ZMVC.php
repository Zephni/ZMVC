<?php
	class ZMVC
	{
		/* -----------------------------------
		Config
		----------------------------------- */
		private $Config = array();

		/* -----------------------------------
		SetConfig
		----------------------------------- */
		public function SetConfig($Key, $Value)
		{
			$this->Config[$Key] = $Value;
		}

		/* -----------------------------------
		GetConfig
		----------------------------------- */
		public function GetConfig($Key)
		{
			if(isset($this->Config[$Key]))
				return $this->Config[$Key];
			else
				return null;
		}

		/* -----------------------------------
		GetApplication
		----------------------------------- */
		public function GetApplication($RequestPath)
		{
			$RequestParts = array_filter(explode("/", $RequestPath), "strlen");
		}

		/* -----------------------------------
		GetPagePath
		----------------------------------- */
		public function GetPagePath($RequestPath)
		{
			$RequestParts = array_filter(explode("/", $RequestPath), "strlen");
			$IteratedFoundDirectory = array();
			$IteratedPathParts = array();
			$IteratedPath = "";

			if(count($RequestParts) == 0)
			{
				return "home";
			}
			else
			{
				for($I = 0; $I < count($RequestParts); $I++)
				{
					$IteratedPathParts[] = $RequestParts[$I];
					$IteratedPath = implode("/", $IteratedPathParts);
					
					if(is_dir(ROOT_DIR."/".$this->GetConfig("Application")."/views/".$IteratedPath))
						$IteratedFoundDirectory[] = $RequestParts[$I];
				}

				$FinalPage = implode("/", $IteratedFoundDirectory)."/".((count($IteratedFoundDirectory) == count($RequestParts)) ? "home" : $RequestParts[count($RequestParts)-1]);
				return (file_exists($this->GetConfig("Application")."/views/".$FinalPage.".php")) ? $FinalPage : "404";

			}

			return "home";
		}
	}