<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "fotografia@darekwozniak.pl";
    $email_subject = "Test";
 
    function errorWraper($error) {
		$text = '';
        $text .= "Przepraszamy, ale w wiadomości znalazły się następujące błędy: <br /><br />";
        $text .= $error."<br /><br />";
        $text .= "Prosimy poprawić błędy i spróbować ponownie.<br /><br />";
		return $text;
    }
	
	$feedback = "";
 
 
    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['message'])) {
        $feedback = "Pola 'Imię', 'E-mail' i 'Wiadomość' są obowiązkowe.";
		$feedback = errorWraper($feedback);
    }
	else {     
 
    $name = $_POST['name']; // required
    $email = $_POST['email']; // required
    $phone = $_POST['phone']; // not required
    $message = $_POST['message']; // required
	
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email)) {
    $feedback .= 'Podany adres e-mail jest niepoprawny.<br />';
  }
  
  if(strlen($name) == 0) {
	$feedback .= "Musisz podać swoje imię.<br />";
  }
 
  if(strlen($message) < 2) {
    $feedback .= "Wiadomość jest niepoprawna (wymagane co najmniej dwa znaki).<br />";
  }
 
  if(strlen($feedback) == 0) { 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }  

	$email_message = "";
 
    $email_message .= "Imię: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email)."\n";
    $email_message .= "Telefon: ".clean_string($phone)."\n";
    $email_message .= "Treść wiadomości: ".clean_string($message)."\n";
 
	// create email headers
	$headers = 'From: '.$email."\r\n".
	'Reply-To: '.$email."\r\n" .
	'X-Mailer: PHP/' . phpversion();
	@mail($email_to, $email_subject, $email_message, $headers);
	$feedback = 'Twoja wiadomość została wysłana!';
	}
	else {$feedback = errorWraper($feedback);}
	}
}
?>
 
<!-- include your own success html here -->
 
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
		<div class="aboutMe">
			<div class="amHalf">
				<p><?= $feedback?></br></p>
				<a href="index.php">
					<div class="arrowBtn">
						<img src="resources/next.svg" height="50px">
							POWRÓT DO STRONY GŁÓWNEJ
					</div>
				</a>
			</div>
		</div>		
	</div>
</body>
</html>