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
				echo "Zalogowany jako ".$_SESSION['login']." <form method='post' action='kontakt.php'><input type='submit' value='Wyloguj' name='wyloguj'></form>";
			}
		
			if(isset($_POST['wyloguj'])){ 
			session_unset();
			session_destroy();
			header('Location: kontakt.php');
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
			<h1>Kontakt</h1>
				<center>
				<div>
					<h1>Napisz do nas!</h1><br />
					<?php
					if(!empty($_SESSION['zalogowany'])){
						echo "<form action='meil.php' method='post'>
						Temat:<input type='text' name='temat' /><br />
						Treść:<textarea name='content' cols='30' rows='6'></textarea>
						<input type='submit' value='wyślij' />
					</form><br /><br /><br />";
					}
					else if(empty($_SESSION['zalogowany'])){
						echo "<a href='logowanie.php'>Zaloguj się</a>, by wysłać do nas meila.<br /><br />";
					}
					?>
					<h1>Mapa dojazdu</h1><br />
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d39464.554107868404!2d19.265974816983185!3d51.81466339968832!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471bb4852e590f81%3A0x72e6355801d74929!2zOTUtMDcwIEFsZWtzYW5kcsOzdyDFgcOzZHpraQ!5e0!3m2!1spl!2spl!4v1519479970497" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
				
				</div></center>
				
				
		</section>
		
		<footer>
			<p>DW © 2018</p>
		</footer>
		
</div>

</body>
</html>