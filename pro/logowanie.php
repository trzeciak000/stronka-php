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
				echo "<a href='rejestracja.php'>Zarejestruj konto</a>";
			}
			
			else if(!empty($_SESSION['zalogowany'])){
				echo "Zalogowany jako ".$_SESSION['login']." <form method='post' action='logowanie.php'><input type='submit' value='Wyloguj' name='wyloguj'></form>";
			}
		
			if(isset($_POST['wyloguj'])){ 
			session_unset();
			session_destroy();
			header('Location: logowanie.php');
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
			<h1>Logowanie</h1><center>
			<p><?php
			if(empty($_SESSION['zalogowany'])){
			echo "<form method='post' action='logowanie.php'>
			<b>Login:</b><input type='text' name='login'><br /><br />
			<b>Hasło:</b><input type='password' name='haslo'><br /><br />
			<input type='submit' value='Zaloguj' name='loguj'>
			</form><br /><br />";
			}
			else if(!empty($_SESSION['zalogowany'])){
				echo "<br /><br />Jesteś już zalogowany.";
			}
			?>
			<?php
				function filtruj($zmienna){
					
					global $connect;
					if(get_magic_quotes_gpc()) $zmienna = stripslashes($zmienna);
					
				return mysqli_real_escape_string(mysqli_connect("localhost","root",""),htmlspecialchars(trim($zmienna)));
				}
				
				if(isset($_POST['loguj'])){
					$login = filtruj($_POST['login']);
					$haslo = filtruj($_POST['haslo']);
					$ip = filtruj($_SERVER['REMOTE_ADDR']);
					
					if(!empty($login) && !empty($haslo)){
					if(mysqli_num_rows(mysqli_query($connect,"SELECT login, haslo FROM uzytkownicy WHERE login = '".$login."' AND haslo = '".md5($haslo)."';")) > 0)
					{
						mysqli_query($connect,"UPDATE uzytkownicy SET (logowanie = '".time().", ip = '".$ip."'') WHERE login = '".$login."';");
						
					$_SESSION['zalogowany'] = true;
					$_SESSION['login'] = $login;
					
					header('Location: logowanie.php');
					
					}
					else echo "Podano złe dane.";
					}
					else echo "Podaj dane.";
			
				}
			?>
			<?php
			if(empty($_SESSION['zalogowany'])){
			echo "<br /><br />Nie posiadasz konta? <a href='rejestracja.php'>Zarejestruj</a>
			</p></center>";
			}
			?>
		</section>
		
		<footer>
			<p>DW © 2018</p>
		</footer>
		
</div>

</body>
</html>