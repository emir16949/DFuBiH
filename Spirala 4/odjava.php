<?php
	session_start();
?>

<!DOCTYPE html>

<html>

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="Stil.css"/>
	<meta name="viewport" content="width=device-width"/>
	<script type="text/javascript" src="Skripta.js"></script>
	<title>DFuBiH</title>
</head>

<body>

<?php

session_unset();

if(isset($_POST['loginuj_se'])) {
	header('Refresh: 1; URL = Login.php');	
}
?>

<div id="naslov">
	<h1>Društvo fizičara u Bosni i Hercegovini</h1>
</div>


<div id="meni">
	<ul class="lista">
		<li> <a href="Pocetna.php">Početna</a></li>
		<li class="dropdown">
			<a id="tab2" href="#" class="dropbtn">O nama</a>
			<div class="dropdown-content">
				<a id="tab3" href="O_nama_Historijat.php">Historijat</a>
				<a id="tab4" href="O_nama_Slike.php">Slike</a>
			</div>
		</li>
		<li> <a href="IPhO_i_RMPh.php">IPhO &amp; RMPh</a></li>
		<li> <a href="Login.php" class="selektovan">Login/Registracija</a></li>
		<li> <a href="Kontakt.php">Kontakt</a></li>
	</ul>
</div>

<div id="container">

<div class="login_4">
	<a id="za_reg" href="Registracija.php">Registracija</a><br>
	<h3> Login:</h3>
	<form method="post" action="Login.php">
		Username:<br>
		<input type="text" id="username2_4" name="username" onblur="return provjeraObjekti(this)">
		<p id="par3_4" class="greska"></p>
		Password:<br>
		<input name="password" id="password2_4" type="password"><br>
		<p id="par4_4" class="greska"></p>
		<input type="submit" value="Pošalji" name="loginuj_se"><br>
	</form>
</div>

</div>

</body>

</html>