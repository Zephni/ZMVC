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
				<?php
					foreach(array(
						"" => "HOME",
						"guide" => "GUIDE"
					) as $K => $V){
						echo "<a href='/".$ZMVC->Route(array("Local"), $K)."' class='".(($K == $ZMVC->Route(array("Page")) || ($K == "home" && isset($ZMVC->URLParts[0]) && $ZMVC->URLParts[0] == "home")) ? "selected" : "")."'>".$V."</a> ";
					}
				?>
			</div>
		</div>
		<div id="Header">
			<div class="InnerContainer">

			</div>
		</div>
		<div id="Body">
			<div class="InnerContainer">
				<div class="MobilePadding">
					<?php
						// Breadcrumbs
						if(isset($ZMVC->URLParts[0]) && $ZMVC->URLParts[0] != "home")
						{
							echo "<br />";
							$Arr = array("home");
							foreach($ZMVC->URLParts as $Item)
								$Arr[] = $Item;

							foreach($Arr as $K => $V)
								echo ($K < count($Arr)-1) ? "<a href='".$V."'>".$V."</a> &rarr; " : $V;

						} unset($Arr);
					?>

					<?php require_once($this->PagePath); ?>
				</div>
			</div>
		</div>
	</body>
</html>