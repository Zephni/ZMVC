<?php
	class Controller
	{
		private $ZMVC = null;

		public function __construct($_ZMVC)
		{
			$this->ZMVC = $_ZMVC;
		}

		public function Invoke($Alias, $PassData)
		{
			$Model = new Model($this->ZMVC, $Alias, $PassData);
			$View = new View($Model);
			$View->Output();
		}
	}