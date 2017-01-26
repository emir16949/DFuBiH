<?php
	session_start();
	
  $veza = new PDO('mysql:host=' . getenv('MYSQL_SERVICE_HOST') . ';port=3306;dbname=baza', 'emiremir', 'emiremir');
//	$veza = new PDO("mysql:dbname=baza;host=localhost;charset=utf8", "root", "");
	$veza->exec("set names utf8");
	$poruka = "";
  
	if(isset($_GET['posalji']))
	{
		if(isset($_GET['ocjena']))
		{
			$novo = $_GET['ocjena'];
			
			$upit = $veza->query("SELECT * FROM korisnik;");
			
			foreach($upit as $k)
			{
				$upit2 = $veza->prepare("UPDATE korisnik SET ocjena_stranice=? WHERE username=?;");
				$upit2->bindValue(1, $novo, PDO::PARAM_INT);
				$upit2->bindValue(2, $_SESSION["username"], PDO::PARAM_STR);
				$rezultat = $upit2->execute();
				
				if (!$rezultat)
				{
				$greska_info = $veza->errorInfo();
				$uspjeh = 0;
				$greska = 2;
				$greska_string = "Greška baze podataka: " . $greska_info[2];
				}
				else
				{
				$greska = 0;
				$uspjeh = 2;
				$uspjeh_string = "Uspješno editovan naslov novosti.";
				}
			}

			$poruka = "Hvala Vam što ste ocijenili stranicu";
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

  $veza = new PDO('mysql:host=' . getenv('MYSQL_SERVICE_HOST') . ';port=3306;dbname=baza', 'emiremir', 'emiremir');
//	$veza = new PDO("mysql:dbname=baza;host=localhost;charset=utf8", "root", "");
	$veza->exec("set names utf8");	
	
	$upit = $veza->query("SELECT * FROM novost;");
	
    $x = 0;
    foreach ($upit as  $novost) { ?>
	<br><br>
	<h3> <?php echo $novost["naslov"] ?> </h3>
	<p> <?php echo $novost["tekst"] ?>  </p>
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

<div class="tekst2_1">
	<h1>Dobro došli na web stranicu Društva fizičara u Bosni i Hercegovini. Molimo Vas da se potpuno besplatno registrujete, kako biste mogli čitati novosti, ocijeniti stranicu i mnoge druge stvari.</h1>
</div>

<?php
}

?>

</div>

</body>

</html>