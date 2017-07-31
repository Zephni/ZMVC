<?php
	// Nav
	$TemplateNavHTML = "";
	foreach(array(
		"" => "HOME",
		"guide" => "GUIDE"
	) as $K => $V){
		$TemplateNavHTML .= "<a href='/".$ZMVC->Route(array("Local"), $K)."' class='".(($K == $ZMVC->Route(array("Page")) || ($K == "home" && isset($ZMVC->URLParts[0]) && $ZMVC->URLParts[0] == "home")) ? "selected" : "")."'>".$V."</a> ";
	}

	// Breadcrumbs
	$TemplateBreadcrumbsHTML = "";
	if(isset($ZMVC->URLParts[0]) && $ZMVC->URLParts[0] != "home")
	{
		$TemplateBreadcrumbsHTML .= "<br />";
		$Arr = array("home");
		foreach($ZMVC->URLParts as $Item)
			$Arr[] = $Item;

		foreach($Arr as $K => $V)
			$TemplateBreadcrumbsHTML .= ($K < count($Arr)-1) ? "<a href='".$V."'>".$V."</a> &rarr; " : $V;

	} unset($Arr);
	?>
