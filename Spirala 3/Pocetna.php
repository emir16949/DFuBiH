<?php
	session_start();

	$xml = new DOMDocument();
	$xml->load('korisnici.xml');
	$poruka = "";
  
	if(isset($_GET['posalji']))
	{
		$podaci = $xml->getElementsByTagName('user');

		if(isset($_GET['ocjena']))
		{
			$novo = $_GET['ocjena'];
		
			$korisnici = $xml->getElementsByTagName('user');
	  
			$brojac = 0;
			foreach($korisnici as $kor)
			{
				$username = $kor->getElementsByTagName('username')->item(0)->nodeValue;
				if ($username == $_SESSION['username']) break;
				$brojac++;
			}
				  
			$xml->getElementsByTagName('user')->item($brojac)->getElementsByTagName('ocjena')->item(0)->nodeValue = $novo;
			$poruka = "Hvala Vam što ste ocijenili stranicu";

			file_put_contents('korisnici.xml', $xml->saveXML());
		}
	}
?>


<!DOCTYPE html>

<html>

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="Stil.css">
	<meta name="viewport" content="width=device-width"/>
	<script type="text/javascript" src="Skripta.js"></script>
	<title>DFuBiH</title>
</head>

<body>

<div id="naslov">
	<h1>Društvo fizičara u Bosni i Hercegovini</h1>
</div>

<div id="meni">
	<ul class="lista">
		<li> <a href="Pocetna.php" class="selektovan">Početna</a></li>
		<li class="dropdown">
			<a id="tab2" href="#" class="dropbtn">O nama</a>
			<div class="dropdown-content">
				<a id="tab3" href="O_nama_Historijat.php">Historijat</a>
				<a id="tab4" href="O_nama_Slike.php">Slike</a>
			</div>
		</li>	
		<li> <a href="IPhO_i_RMPh.php">IPhO &amp; RMPh</a></li>
		<li> <a href="Login.php">Login/Registracija</a></li>
		<li> <a href="Kontakt.php">Kontakt</a></li>
	</ul>
</div>

<div id="container">

<?php
	if(isset($_SESSION['username']))
	{
?>

<div class="tekst_1">
	<h1>Dobro došli na web stranicu Društva fizičara u Bosni i Hercegovini. Ovdje ćemo objavljivati novosti vezane za društvo.</h1>
</div>

<div class="novosti_1">
<?php
    $xml = simplexml_load_file('novosti.xml');
    $x = 0;
    foreach ($xml->novosti->novost as  $nov) { ?>
	<br><br>
	<h3> <?php echo $nov->naslov ?> </h3>
	<p> <?php echo $nov->tekst ?>  </p>
	<br>
<?php $x++; }  ?>
</div>

<div class="ocjenjivanje_1">
	<h3>Ocijenite web stranicu</h3>
	<form  action="Pocetna.php" method="get">
		<input type="radio" name="ocjena" value="1"> 1<br>
		<input type="radio" name="ocjena" value="2"> 2<br>
		<input type="radio" name="ocjena" value="3"> 3<br>
		<input type="radio" name="ocjena" value="4"> 4<br>
		<input type="radio" name="ocjena" value="5" checked> 5<br><br>
		<input type="submit" value="Pošalji" name="posalji">
		<p><?php echo $poruka ?></p>
	</form>
</div>


<?php
}
else
{
?>

<div class="tekst_1">
	<h1>Dobro došli na web stranicu Društva fizičara u Bosni i Hercegovini. Molimo Vas da se potpuno besplatno registrujete, kako biste mogli čitati novosti, ocijeniti stranicu i mnoge druge stvari.</h1>
</div>

<?php
}

?>

</div>

</body>

</html>