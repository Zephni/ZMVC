<html>
	<head>
		<title>Main Template</title>
		<link rel="stylesheet" type="text/css" href="<?php echo $ZMVC->Route(array("Local", "ApplicationPath"), "CSS/style.css"); ?>">
	</head>
	<body>
		<b>LOADED MAIN TEMPLATE</b>

		<?php require_once($this->PagePath); ?>
	</body>
</html>