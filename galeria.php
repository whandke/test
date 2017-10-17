<?php
	function errorRedirect() {
		header("Location: error.html");
		exit();
	}
	
	function dropdownGalleriesList($category) {
		$dir = "photos/".$category;
		$files = scandir($dir);
		
		$dict = [];
		
		foreach ($files as $file) {
			if($file === "." || $file === "..") continue;
			else {
				$fileDir = "photos/".$category."/".$file."/name.txt";
				$handle = fopen($fileDir, "r");
				$dict[$file] = fgets($handle);
				fclose($handle);
			}			
		}
		
		$linksList = "";
		
		foreach ($dict as $id => $name){
			$linksList .= "<a href=\"galeria.php?cat=".$category."&id=".$id."\">".$name."</a>";
		}
		
		
		return $linksList;
	}
	
	function pictureWraper($link, $number) {
		
		if($link == NULL) {
			return "";
		}		
		return "<div class=\"picture cursor\" style=\"background-image:url(".$link.")\" onclick=\"openModal();currentSlide(".$number.")\"></div>";
	}

	function galleryCreate($category, $id) {
		
		$gallery = "";
		
			$galleryRowOdd = array(	"<div class=\"galleryrow\"><div class=\"gallerypicture\"><div class=\"gallerysquarebig galleryleft\">",
									"</div></div><div class=\"gallerypicture\"><div class=\"gallerysquarebig galleryright\"><div class=\"galleryrectangle galleryleft\"><div class=\"gallerysquaresmall upper\">",
									"</div><div class=\"gallerysquaresmall lower\">",
									"</div></div><div class=\"galleryrectangle galleryright\">",
									"</div></div></div></div>");
		
		$galleryRowEven = array(	"<div class=\"galleryrow\"><div class=\"gallerypicture\"><div class=\"gallerysquarebig galleryleft\"><div class=\"galleryrectangle galleryleft\">",
									"</div><div class=\"galleryrectangle galleryright\"><div class=\"gallerysquaresmall upper\">",
									"</div><div class=\"gallerysquaresmall lower\">",
									"</div></div></div></div><div class=\"gallerypicture\"><div class=\"gallerysquarebig galleryright\">",
									"</div></div></div>");
		
		$dir = "photos/".$category."/".$id;
		$files = scandir($dir);
		$arr = [];
		
		foreach ($files as $f) {
			if ($f === "name.txt" || $f === "cover.jpg" || $f === "." || $f === "..") continue;
			else {
				$arr[] = $dir."/".$f;
			}
		}
		
		$i = 0;
		while(count($arr) > 0) {
			
			$gallery .= $galleryRowOdd[0].pictureWraper(array_shift($arr), $i+1).$galleryRowOdd[1].pictureWraper(array_shift($arr), $i+2).$galleryRowOdd[2].pictureWraper(array_shift($arr), $i+3).$galleryRowOdd[3].pictureWraper(array_shift($arr), $i+4).$galleryRowOdd[4];
			$i += 4;			
			if(count($arr) > 0) {
				$gallery .= $galleryRowEven[0].pictureWraper(array_shift($arr), $i+1).$galleryRowEven[1].pictureWraper(array_shift($arr), $i+2).$galleryRowEven[2].pictureWraper(array_shift($arr), $i+3).$galleryRowEven[3].pictureWraper(array_shift($arr), $i+4).$galleryRowEven[4];
				$i += 4;
			}
		}
		
		return $gallery;
	 }
	 
	function modalCreate($category, $id) {
		$dir = "photos/".$category."/".$id;
		$files = scandir($dir);
		$arr = [];
		
		foreach ($files as $f) {
			if ($f === "name.txt" || $f === "cover.jpg" || $f === "." || $f === "..") continue;
			else {
				$arr[] = $dir."/".$f;
			}
		}
		$modal = "";
		foreach ($arr as $picture) {
			$modal .= "<div class=\"mySlides\" style=\"background-image:url(".$picture.")\"></div>";
		}
		return $modal;		
	}
	
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
	
	function randomGallery($category) {
		$categories = array("fotografia_slubna", "sesje_rodzinne", "zdjecia_reklamowe", "reportaze_wydarzenia");
		shuffle($categories);
		
		foreach ($category as $c) {
			array_splice($categories,array_search($c, $categories),1);
		}
		
		$cat = $categories[0];
		
		$dir = "photos/".$cat;
		$files = scandir($dir);
		do {
			shuffle($files);
		}
		while($files[0] === "." || $files[0] === "..");
		
		$gallery = $files[0];
		
		$fileDir = "photos/".$cat."/".$gallery."/name.txt";
		$handle = fopen($fileDir, "r");
		$name = fgets($handle);
		fclose($handle);
		
		return array($cat, $gallery, $name);		
	}
	 
	 $category = $_GET['cat'];
	 $id = $_GET['id'];
	 
	 $dir = "photos/".$category."/".$id."/name.txt";
	 
	 $file = fopen($dir, "r") or errorRedirect();
	 $galleryName = fgets($file);
	 fclose($file);
	 
	 $categoryName = categoryName($category);
	 $linksList = dropdownGalleriesList($category);
	 $gallery = galleryCreate($category, $id);
	 $modal = modalCreate($category, $id);
	 $randomGallery1 = randomGallery(array($category));
	 $randomGallery2 = randomGallery(array($category, $randomGallery1[0]));
	 
	 
?>

<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&amp;subset=latin-ext" rel="stylesheet">
	<link rel="stylesheet" href="resources/style.css" type="text/css">
	<link rel="stylesheet" href="resources/media.css" type="text/css">
	<title><?= $galleryName?></title>
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
		<div class="dropdown">
			<div class="ddTitle">
				<h2><?= $categoryName?></h2>
				<h1><?= $galleryName?></h1>
			</div>
			<div class="dropbtn" onclick="myFunction()">
				<img id="dropdownmenuImg" src="resources/next.svg">
			</div>
			<div id="dropdownmenu" class="dropdown-content">
				<?= $linksList?>
			</div>
		</div>
		<script>
		/* When the user clicks on the button, 
		toggle between hiding and showing the dropdown content */
		function myFunction() {
			document.getElementById("dropdownmenu").classList.toggle("show");
			document.getElementById("dropdownmenuImg").classList.toggle("rotate");
		}
		</script>
		
		<div class="gallery">
			<?= $gallery?>
		</div>
		
		<div id="myModal" class="modal">
		  <span class="close cursor" onclick="closeModal()">&times;</span>
		  <div class="modal-content">

			<?= $modal?>
			
			<a class="prev" onclick="plusSlides(-1)"><img src="resources/next.svg"></a>
			<a class="next" onclick="plusSlides(1)"><img src="resources/next.svg"></a>
		  </div>
		</div>
		
		<script>
		function openModal() {
		  document.getElementById('myModal').style.display = "block";
		}

		function closeModal() {
		  document.getElementById('myModal').style.display = "none";
		}

		var slideIndex = 1;
		showSlides(slideIndex);

		function plusSlides(n) {
		  showSlides(slideIndex += n);
		}

		function currentSlide(n) {
		  showSlides(slideIndex = n);
		}

		function showSlides(n) {
		  var i;
		  var slides = document.getElementsByClassName("mySlides");
		  var dots = document.getElementsByClassName("demo");
		  var captionText = document.getElementById("caption");
		  if (n > slides.length) {slideIndex = 1}
		  if (n < 1) {slideIndex = slides.length}
		  for (i = 0; i < slides.length; i++) {
			slides[i].style.display = "none";
		  }
		  for (i = 0; i < dots.length; i++) {
			dots[i].className = dots[i].className.replace(" active", "");
		  }
		  slides[slideIndex-1].style.display = "block";
		  dots[slideIndex-1].className += " active";
		  captionText.innerHTML = dots[slideIndex-1].alt;
		}
		</script>
		
		<div class="bottomContainer">
			<div class="galleryTeaser left">
				<div class="title">
					<h2><?= categoryName($randomGallery1[0])?></h2>
					<h1><?= $randomGallery1[2]?></h1>
					<a href="galeria.php?cat=<?= $randomGallery1[0]?>&id=<?= $randomGallery1[1]?>">
						<div class="arrowBtn">
							<img src="resources/next.svg" height="50px">
							ZOBACZ ZDJĘCIA
						</div>
					</a>
					<div class="gtPhoto" style="background-image:url(photos/<?= $randomGallery1[0]?>/<?= $randomGallery1[1]?>/cover.jpg)"></div>				
				</div>
			</div>
			<div class="galleryTeaser">
				<div class="title">
					<h2><?= categoryName($randomGallery2[0])?></h2>
					<h1><?= $randomGallery2[2]?></h1>
					<a href="galeria.php?cat=<?= $randomGallery2[0]?>&id=<?= $randomGallery2[1]?>">
						<div class="arrowBtn">
							<img src="resources/next.svg" height="50px">
							ZOBACZ ZDJĘCIA
						</div>
					</a>
					<div class="gtPhoto" style="background-image:url(photos/<?= $randomGallery2[0]?>/<?= $randomGallery2[1]?>/cover.jpg)"></div>
				</div>
			</div>	
		</div>
		
	</div>
</body>
</html>