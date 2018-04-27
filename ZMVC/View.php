<?php
	class View
	{
		public function __construct($Application, $Page)
		{
			$this->Application = $Application;
			$this->Page = $Page;
		}

		public function BuildHTML($Vars)
		{
			extract($Vars);

			if(file_exists(ROOT_DIR."/".$this->Application."/models/".$this->Page.".php"))
				require(ROOT_DIR."/".$this->Application."/models/".$this->Page.".php");

			ob_get_contents();
			require(ROOT_DIR."/".$this->Application."/views/".$this->Page.".php");
			return ob_get_clean();
		}
	}