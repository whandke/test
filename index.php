<?php
	$handle = fopen("photos/fotografia_slubna/cover/name.txt", 'r');
	$FS = fgets($handle);
	fclose($handle);
	$handle = fopen("photos/sesje_rodzinne/cover/name.txt", 'r');
	$SR = fgets($handle);
	fclose($handle);
	$handle = fopen("photos/zdjecia_reklamowe/cover/name.txt", 'r');
	$ZR = fgets($handle);
	fclose($handle);
	$handle = fopen("photos/reportaze_wydarzenia/cover/name.txt", 'r');
	$RW = fgets($handle);
	fclose($handle);

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
	<title>Darek Wozniak Fotografia</title>
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
		<div id="topContent" class="topContent">
			<div class="topContentBackground" style="background-image:url(photos/fotografia_slubna/cover/cover.jpg)"></div>
			<div id="contentContainer">
				<div class="ccPhoto pBigger imgShadow zi2" style="background-image:url(photos/main_page/2.jpg)"></div>
				<div class="ccPhoto pSmaller"><div class="rectangleDown imgShadow zi1" style="background-image:url(photos/main_page/3.jpg)"></div></div>
				<div class="ccPhoto pSmaller"><div class="rectangleDown imgShadow zi4" style="background-image:url(photos/main_page/4.jpg)"></div></div>
				<div class="title imgShadow zi3">
					<h2>FOTOGRAFIA ŚLUBNA</h2>
					<h1><?= $FS?></h1>
					<a href="galeria.php?cat=fotografia_slubna&id=cover">
						<div class="arrowBtn">
							<img src="resources/next.svg" height="50px">
							ZOBACZ ZDJĘCIA
						</div>
					</a>
				</div>
				<div class="wr">
				<a href="fotografia_slubna.php">
					<div class="button">
						WSZYSTKIE GALERIE ŚLUBNE
					</div>
				</a>
				</div>
			</div>	
		</div>
		<div class="middleContent">
			<div class="middlePhoto hiddenMobile" style="background-image:url(photos/sesje_rodzinne/cover/cover.jpg)">
				<div class="title whiteBox">
					<h2>SESJE RODZINNE</h2>
					<h1><?= $SR?></h1>
					<a href="galeria.php?cat=sesje_rodzinne&id=cover">
						<div class="arrowBtn">
							<img src="resources/next.svg" height="50px">
							ZOBACZ ZDJĘCIA
						</div>
					</a>
				</div>
			</div>
			<div class="wr hiddenMobile">
				<a href="sesje_rodzinne.php">
					<div class="button">
						WSZYSTKIE GALERIE RODZINNE
					</div>
				</a>
			</div>
			<div class="galleryTeaser hiddenDesktop">
				<div class="title">
					<h2>SESJE RODZINNE</h2>
					<h1><?= $SR?></h1>
					<a href="galeria.php?cat=sesje_rodzinne&id=cover">
						<div class="arrowBtn">
							<img src="resources/next.svg" height="50px">
							ZOBACZ ZDJĘCIA
						</div>
					</a>
					<div class="gtPhoto" style="background-image:url(photos/sesje_rodzinne/cover/cover.jpg)"></div>
					<div class="wr">
						<a href="sesje_rodzinne.php">
						<div class="button">
							WSZYSTKIE GALERIE RODZINNE
						</div>
						</a>
					</div>					
				</div>
			</div>
		</div>
		
		<div class="bottomContainer">
			<div class="galleryTeaser left">
				<div class="title">
					<h2>ZDJĘCIA REKLAMOWE</h2>
					<h1><?= $ZR?></h1>
					<a href="galeria.php?cat=zdjecia_reklamowe&id=cover">
						<div class="arrowBtn">
							<img src="resources/next.svg" height="50px">
							ZOBACZ ZDJĘCIA
						</div>
					</a>
					<div class="gtPhoto" style="background-image:url(photos/zdjecia_reklamowe/cover/cover.jpg)"></div>
					<div class="wr">
						<a href="zdjecia_reklamowe.php">
						<div class="button">
							WSZYSTKIE GALERIE REKLAMOWE
						</div>
						</a>
					</div>					
				</div>
			</div>
			<div class="galleryTeaser">
				<div class="title">
					<h2>REPORTAŻE / WYDARZENIA</h2>
					<h1><?= $RW?></h1>
					<a href="galeria.php?cat=reportaze_wydarzenia&id=cover">
						<div class="arrowBtn">
							<img src="resources/next.svg" height="50px">
							ZOBACZ ZDJĘCIA
						</div>
					</a>
					<div class="gtPhoto" style="background-image:url(photos/reportaze_wydarzenia/cover/cover.jpg)"></div>
					<div class="wr">
						<a href="reportaze_wydarzenia.php">
						<div class="button">
							WSZYSTKIE GALERIE z WYDARZEŃ
						</div>
						</a>
					</div>
				</div>
			</div>	
		</div>
	</div>
</body>
</html>