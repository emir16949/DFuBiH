<?php

session_start();

if (isset($_SESSION["username"]))
{
//	$veza = new PDO('mysql:host=' . getenv('MYSQL_SERVICE_HOST') . ';port=3306;dbname=baza', 'admin', 'adminpass');
	$veza = new PDO("mysql:dbname=baza;host=localhost;charset=utf8", "root", "");

	$veza->exec("set names utf8");

	$username = $_SESSION["username"];

	$upit = $veza->query("SELECT * FROM korisnik WHERE username='$username';");	

	if (isset($_POST['dugme']))
	{
		foreach($upit as $tak)
			$id_korisnika = $tak["id"];
		$mail = $_POST["mail"];
		$poruka = $_POST["poruka"];
		if (isset($_POST["pomoc"]) && $_POST["pomoc"] == "Pomoc za drustvo")
			$pomoc = 1;
		else
			$pomoc = 0;
		if (isset($_POST["donacija"]) && $_POST["donacija"] == "Donacija za drustvo")
			$donacija = 1;
		else
			$donacija = 0;

		$upit = $veza->prepare("INSERT INTO kontakt (id_korisnika, email, komentar, pomoc_u_radu, donacija) VALUES (?, ?, ?, ?, ?);");
		$upit->bindValue(1, $id_korisnika, PDO::PARAM_INT);
		$upit->bindValue(2, $mail, PDO::PARAM_STR);
		$upit->bindValue(3, $poruka, PDO::PARAM_STR);
		$upit->bindValue(4, $pomoc, PDO::PARAM_INT);
		$upit->bindValue(5, $donacija, PDO::PARAM_INT);
		$uspjelo = $upit->execute();

		if (!$uspjelo) {
			$greska = $veza->errorInfo();
			print "Nastala je SQL greška: " . $greska[2];
	        exit();
	    }
	}
}

?>


<!DOCTYPE html>

<html>

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="Stil.css">
	<meta name="viewport" content="width=device-width" />
	<script type="text/javascript" src="Skripta.js"></script>
	<title>DFuBiH</title>
</head>

<body>

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
		<li> <a href="Login.php">Login/Registracija</a></li>
		<li> <a href="Kontakt.php" class="selektovan">Kontakt</a></li>
	</ul>
</div>

<div id="container">

 
<div class="tekst_5">
	<h2> Kontakt informacije: </h2>
	<h4> Ulica: Zmaja od Bosne 35, 71 000 Sarajevo (zgrada Prirodno-matematičkog fakulteta)</h4>
	<h4> E-mail: dfubih@gmail.com</h4>
	<h4> Kontakt telefon: 033-854-296</h4>
</div>

<?php

if (isset($_SESSION["username"]))
{ ?>

<div class="kontaktiranje_5">
	<h3> Ako želite pomoći u radu društva, donirati novac, ili poslati nam poruku, kritiku, pitanje, unesite podatke:</h3>
	<form action="Kontakt.php" method="post" onsubmit="return validacijaKontakt()">
		E-mail na koji ćemo Vas kontaktirati:<br>
		<input type="text" id="mail_5" name="mail" onblur="return provjeraObjekti(this)">
		<p id="par1_5" class="greska"></p>
		Pitanje, komentar, kritika, pohvala:<br>
		<textarea id="poruka_5" rows="7" cols="25" name="poruka" onblur="return provjeraObjekti(this)"></textarea>
		<p id="par2_5" class="greska"></p>
		<input type="checkbox" id="pomoc_5" value="Pomoc za drustvo" name="pomoc" onchange="return provjeraObjekti(this)"> Želim pomoći u radu društva<br>
		<input type="checkbox" id="donacija_5" value="Donacija za drustvo" name="donacija" onchange="return provjeraObjekti(this)"> Želim donirati sredstva za društvo <br>
		<p id="par3_5" class="greska"></p>
		<input type="submit" value="Pošalji" name="dugme"><br>
	</form>
</div>

<?php } ?>

</div>


</body>

</html>