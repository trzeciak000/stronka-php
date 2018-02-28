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
				echo "Zalogowany jako ".$_SESSION['login']." <form method='post' action='index.php'><input type='submit' value='Wyloguj' name='wyloguj'></form>";
			}
		
			if(isset($_POST['wyloguj'])){ 
			session_unset();
			session_destroy();
			echo "Zostałeś wylogowany";
			header('Location: index.php');
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
			<h1>Strona Główna</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
			Cras condimentum tempus mi, maximus volutpat urna sollicitudin vitae.
			Vivamus rutrum mi sit amet commodo rutrum. Suspendisse potenti.
			Sed a ullamcorper eros. Maecenas dapibus erat mi, a egestas ipsum cursus volutpat.
			Aliquam posuere mi at consectetur convallis.
			Cras vitae ligula eget leo ultrices hendrerit nec sed ex.
			Morbi at ipsum rhoncus, dictum elit in, consectetur lorem.
			Aliquam suscipit diam sit amet mauris luctus, a egestas magna pharetra.
			Donec laoreet viverra risus nec fermentum.
			Maecenas gravida lectus vel ante commodo bibendum.
			Donec ac pellentesque mi.</p>
		</section>
		
		<footer>
			<p>DW © 2018</p>
		</footer>
		
</div>

</body>
</html>