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

<div id="divProsirena">
	<img id="slikaProsirena" alt="" src="empty"/>
</div>

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
				<a id="tab4" href="O_nama_Slike.php" class="selektovan">Slike</a>
			</div>
		</li>	
		<li> <a href="IPhO_i_RMPh.php">IPhO &amp; RMPh</a></li>
		<li> <a href="Login.php">Login/Registracija</a></li>
		<li> <a href="Kontakt.php">Kontakt</a></li>
	</ul>
</div>

<div id="container">


<div class="drugiRed_2">
<div class="slika1_2">
	<img class="slike_2" src="2016.jpg" alt="IPhO 2016 BiH" onclick="prikazSlike('2016.jpg');">
	<h4> BH tim na IPhO-u 2016, slijeva nadesno: Damjan Ilišković, Haris Popovac, Selver Pepić (vođa tima), Dženan Devedžić (počasna pohvala),
	Nermedin Džeković (srebrena medalja), Bahrudin Trbalić (srebrena medalja), Rajfa Musemić (vođa tima), Nudžeim Selimović (posmatrač) </h4>
</div>

<div class="slika2_2">
	<img class="slike_2" src="2014.jpg" alt="IPhO 2014 BiH" onclick="prikazSlike('2014.jpg');">
	<h4> BH tim na IPhO-u 2014, slijeva nadesno: Nudžeim Selimović (srebrena medalja), Naida Dedić, EMIR BARUČIJA (počasna pohvala),
	Muaz Kasumović, Zoran Šukurma (počasna pohvala), Saniya Malikbayeva (lokalni vodič na olimpijadi)</h4>
</div>
</div>

</div>


</body>

</html>