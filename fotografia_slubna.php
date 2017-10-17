<?php

	function categoryName($category){
		if($category === "fotografia_slubna"){
		 $x = "FOTOGRAFIA ŚLUBNA";
	 }
	 else if($category === "sesje_rodzinne"){
		 $x = "SESJE RODZINNE";
	 }
	 else if($category === "zdjecia_reklamowe"){
		 $x = "ZDJĘCIA REKLAMOWE";
	 }
	 else if($category === "reportaze_wydarzenia"){
		 $x = "REPORTAŻE / WYDARZENIA";
	 }
	 return $x;
	}

	$category = "fotografia_slubna";
	$dir = "photos/".$category;
	$arr = scandir($dir);
	
	$dict = [];
	$output = "";
	
	foreach($arr as $x) {
		if($x === "." || $x === "..") continue;
		else {
			$fileDir = "photos/".$category."/".$x."/name.txt";
			$handle = fopen($fileDir, "r");
			$dict[$x] = fgets($handle);
			fclose($handle);
		}
	}
	
	$left = true;
	
	foreach($dict as $file => $name) {
		$output .= "<div class=\"galleryTeaser";
		if($left){
			$output .= " left";
			$left = false;
		} else $left = true;
		$output .= "\"><div class=\"title\"><h2>".categoryName($category)."</h2><h1>".$name."</h1><a href=\"galeria.php?cat=".$category."&id=".$file."\"><div class=\"arrowBtn\"><img src=\"resources/next.svg\" height=\"50px\">ZOBACZ ZDJĘCIA</div></a><div class=\"gtPhoto\" style=\"background-image:url(photos/".$category."/".$file."/cover.jpg)\"></div></div></div>";
	}


?>



<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&amp;subset=latin-ext" rel="stylesheet">
	<link rel="stylesheet" href="resources/style.css" type="text/css">
	<link rel="stylesheet" href="resources/media.css" type="text/css">
	<title><?= categoryName($category)?></title>
</head>
<body id="body">
	<header class="fixed">	
		<div id="myNav" class="overlay">
		  <div class="overlay-content">
			<a href="index.php">Strona główna</a>
			<a href="fotografia_slubna.php">Fotografia ślubna</a>
			<a href="sesje_rodzinne.php">Sesje rodzinne</a>
			<a href="zdjecia_reklamowe.php">Zdjęcia reklamowe</a>
			<a href="reportaze_wydarzenia.php">Reportaże / Wydarzenia</a>
			<a href="o_mnie.html">O mnie</a>
			<a href="kontakt.html">Kontakt</a>
			<a target="_blank" href="https://www.facebook.com/Darek-Wo%C5%BAniak-Fotografia-288546344501086/">Facebook</a>
		  </div>
		</div>
	
		<a id="logo" href="index.php">
			<img src="resources/logo.png" alt="logo">
		</a>
		<div class="menu">
			<div id="menuBtnWr" class="menuButton">
				<div id="menuBtn" class="menuContainer" onclick="openNav(this)">
				  <div class="bar1"></div>
				  <div class="bar2"></div>
				  <div class="bar3"></div>
				</div>
				
				<script>
					function openNav(x) {
						document.getElementById("myNav").style.height = "100%";
						document.getElementById("menuBtn").onclick = function (){closeNav(this);};
						x.classList.toggle("change");
					}

					function closeNav(x) {
						document.getElementById("myNav").style.height = "0%";
						document.getElementById("menuBtn").onclick = function (){openNav(this);};
						x.classList.toggle("change");
					}
				</script>
				
			</div>
			<a target="_blank" href="https://www.facebook.com/Darek-Wo%C5%BAniak-Fotografia-288546344501086/" class="fa fa-facebook"></a>
		</div>
		<div class="phone">
			<img src="resources/phone.svg">
			+48 609 165 751
		</div>
	</header>
	<div class="mainContainer">
		<div class="bottomContainer paddingTop2em">
			<?= $output?>
		</div>
	</div>

</body>
</html>