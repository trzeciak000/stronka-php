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
				echo "<a href='logowanie.php'>Zaloguj się</a>";
			}
			
			else if(!empty($_SESSION['zalogowany'])){
				echo "Zalogowany jako ".$_SESSION['login']." <form method='post' action='rejestracja.php'><input type='submit' value='Wyloguj' name='wyloguj'></form>";
			}
		
			if(isset($_POST['wyloguj'])){ 
			session_unset();
			session_destroy();
			header('Location: rejestracja.php');
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
			<h1>Rejestracja</h1>
			<?php
			if(empty($_SESSION['zalogowany'])){
			echo "<center><p><form action='rejestracja.php' method='post'>
			<b>Login:</b><input type='text' name='login'><br /><br />
			<b>Hasło:</b><input type='password' name='haslo1'><br /><br />
			<b>Powtórz hasło:</b><input type='password' name='haslo2'><br /><br />
			<b>Email:</b><input type='text' name='email'><br /><br />
			<input type='submit' value='Utwórz konto' name='rejestruj'>
			</form><br /><br />";
			}
			else if(!empty($_SESSION['zalogowany'])){
				echo "<br /><br /><center>Jesteś już zalogowany. Nie możesz stworzyć konta.</center>";
			}
			?>
			<?php
				$connect = mysqli_connect("localhost","root","");
				mysqli_select_db($connect,"database");
				
				function filtruj($zmienna)
				{
					global $connect;
					if(get_magic_quotes_gpc())
						$zmienna = stripslashes($zmienna);
					
					return mysqli_real_escape_string(mysqli_connect("localhost","root",""),htmlspecialchars(trim($zmienna)));
				}
				
				if(isset($_POST['rejestruj']))
				{
					$login = filtruj($_POST['login']);
					$haslo1 = filtruj($_POST['haslo1']);
					$haslo2 = filtruj($_POST['haslo2']);
					$email = filtruj($_POST['email']);
					$ip = filtruj($_SERVER['REMOTE_ADDR']);
				if(!empty($login) && !empty($haslo1) && !empty($haslo2) && !empty($email)){	
					if(mysqli_num_rows(mysqli_query($connect,"SELECT login FROM uzytkownicy WHERE login = '".$login."';")) == 0)
					{
						if($haslo1 == $haslo2)
						{
							mysqli_query($connect,"INSERT INTO uzytkownicy (login, haslo, email, rejestracja, logowanie, ip)
								VALUES ('".$login."', '".md5($haslo1)."', '".$email."', '".time()."', '".time()."', '".$ip."');");
								
							echo "Konto zostało utworzone!";
						}
						else echo "Podane hasła różnią się.";
					}
					else echo "Podany login jest zajęty.";
				}
				else echo "Wypełnij wszystkie pola.";
				}
			?>
			
			<?php mysqli_close($connect); ?>
			<?php
			if(empty($_SESSION['zalogowany'])){
			echo "<br /><br />Posiadasz konto? <a href='logowanie.php'>Zaloguj się</a>
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