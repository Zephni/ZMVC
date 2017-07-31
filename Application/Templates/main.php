<html>
	<head>
		<title>ZMVC PHP Framework</title>
		<link rel="stylesheet" type="text/css" href="/<?php echo $ZMVC->Route(array("Local", "Application"), "CSS/style.css"); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<div id="TopBar">
			<div class="InnerContainer">
				<div id="LogoBlock"></div>
				<?php echo $TemplateNavHTML; ?>
			</div>
		</div>
		<div id="Header">
			<div class="InnerContainer">

			</div>
		</div>
		<div id="Body">
			<div class="InnerContainer">
				<div class="MobilePadding">
					<?php echo $TemplateBreadcrumbsHTML; ?>

					<?php require_once($this->PagePath); ?>
				</div>
			</div>
		</div>
	</body>
</html>