<?php
	class View
	{
		public $Variables = array();

		public function __construct($Application, $Page)
		{
			$this->Application = $Application;
			$this->Page = $Page;
		}

		public function BuildHTML($Vars)
		{
			extract($Vars);
			unset($Vars);

			if(file_exists(ROOT_DIR."/".$this->Application."/models/".$this->Page.".php"))
				require(ROOT_DIR."/".$this->Application."/models/".$this->Page.".php");

			ob_get_contents();
			require(ROOT_DIR."/".$this->Application."/views/".$this->Page.".php");
			$HTML = ob_get_clean();

			return $HTML;
		}
	}