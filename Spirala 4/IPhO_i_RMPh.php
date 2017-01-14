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
		<li> <a href="IPhO_i_RMPh.php" class="selektovan">IPhO &amp; RMPh</a></li>
		<li> <a href="Login.php">Login/Registracija</a></li>
		<li> <a href="Kontakt.php">Kontakt</a></li>
	</ul>
</div>

<div id="container">

<h3 id="h3_3"> Predstavnici BiH na IPhO-u:</h3>
<div id="tabela_3">
<table>
<tr>
	<th>Naziv takmičenja</th>
	<th>Ime i prezime</th>
	<th>Plasman</th>
</tr>

<?php

$veza = new PDO('mysql:host=' . getenv('MYSQL_SERVICE_HOST') . ';port=3306;dbname=baza', 'admin', 'adminpass');
//$veza = new PDO("mysql:dbname=baza;host=localhost;charset=utf8", "root", "");
$veza->exec("set names utf8");

$upit = $veza->query("SELECT * FROM takmicar t, takmicenje tak WHERE t.id_takmicenja = tak.id;");

$klasa = 1;

foreach ($upit as $takmicar)
{ ?>

	<tr class=<?php echo "klasa" . $klasa; ?>>
		<td> <?php echo $takmicar["naziv"] ?> </td>
		<td> <?php echo $takmicar["ime"] ?> </td>
		<td> <?php echo $takmicar["plasman"] ?> </td>
    </tr>

<?php

$klasa = ($klasa + 1) % 2;
} 
?>
</table>
</div>

</div>


</body>

</html>