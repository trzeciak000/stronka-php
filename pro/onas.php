<?php
session_start();
$connect = mysqli_connect("localhost","root","");
mysqli_select_db($connect,"database");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Strona testowa</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	
	<div class="kontener">
		<div id="rej">
			<?php
			if(empty($_SESSION['zalogowany'])){
				echo "<a href='logowanie.php'>Zaloguj się</a> lub <a href='rejestracja.php'>zarejestruj konto</a>";
			}
			
			else if(!empty($_SESSION['zalogowany'])){
				echo "Zalogowany jako ".$_SESSION['login']." <form method='post' action='onas.php'><input type='submit' value='Wyloguj' name='wyloguj'></form>";
			}
		
			if(isset($_POST['wyloguj'])){ 
			session_unset();
			session_destroy();
			header('Location: onas.php');
			}
			?>
		</div>
		
		<header>
			<a href="index.php"><img src="gokussj3.jpg" alt=""/></a>
		</header>
	
		<aside>
			<nav>
				<ul>
					<li><a href="index.php">Strona Główna</a></li>
					<li><a href="onas.php">O nas</a></li>
					<li><a href="cos.php">Coś</a></li>
					<li><a href="kontakt.php">Kontakt</a></li>
				</ul>
			</nav>
		</aside>
		
		<section id="main">
			<h1>O nas</h1>
			<p>jakiś tam tekst o nas.</p>
		</section>
		
		<footer>
			<p>DW © 2018</p>
		</footer>
		
</div>

</body>
</html>