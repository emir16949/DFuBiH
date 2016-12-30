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
	<th>Godina</th>
	<th>Ime i prezime</th>
	<th>Rezultat</th>
</tr>

<?php
    $xml = simplexml_load_file('ipho.xml');
    $x = 0;
	$klasa = 1;
    foreach ($xml->takmicari->takmicar as  $tak) { ?>
	<tr class=<?php echo "klasa" . $klasa; ?>>
		<td> <?php echo $tak->godina ?> </td>
		<td> <?php echo $tak->ime ?> </td>
		<td> <?php echo $tak->rezultat ?> </td>
    </tr>
<?php 
	$x++;
	if ($x % 5 == 0)
	$klasa = ($klasa + 1) % 2;
	} 
?>
</table>
</div>

</div>


</body>

</html>