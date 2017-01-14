<?php
  session_start();
  
  $veza = new PDO("mysql:dbname=baza;host=localhost;charset=utf8", "root", "");

$veza->exec("set names utf8");

	function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}  

  	$imeErr = $plasmanErr = $nazivErr = $ime2Err = $plasman2Err = "";
	$ime = $plasman = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
		if (empty($_POST["novo_ime"]) && isset($_POST["novo_ime"]))
		{
			$imeErr = "Ime ne može biti prazno";
		}
		else if (!empty($_POST["novo_ime"]))
		{
			$ime = test_input($_POST["novo_ime"]);
			if (!preg_match("/^[a-zA-Z]{2,}\s[a-zA-Z]{2,}$/", $ime)) 
			{
				$imeErr = "I ime i prezime moraju sadržavati minimalno po 2 karaktera"; 
			}
		}
		
	if ($_SERVER["REQUEST_METHOD"] == "POST")
		if (empty($_POST["novi_plasman"]) && isset($_POST["novi_plasman"]))
		{
			$plasmanErr = "Plasman ne može biti prazan";
		}
		else if (!empty($_POST["novi_plasman"]))
		{
			$plasman = test_input($_POST["novi_plasman"]);
			if (!preg_match("/pocasna pohvala|zlatna medalja|srebrena medalja|bronzana medalja/", $plasman)) 
			{
				$plasmanErr = "Plasman može biti: zlatna medalja, srebrena medalja, bronzana medalja, počasna pohvala"; 
			}
		}
		

	if ($_SERVER["REQUEST_METHOD"] == "POST")
		if (empty($_POST["unos_ime"]) && isset($_POST["unos_ime"]))
		{
			$ime2Err = "Ime ne može biti prazno";
		}
		else if (!empty($_POST["unos_ime"]))
		{
			$ime2 = test_input($_POST["unos_ime"]);
			if (!preg_match("/^[a-zA-Z]{2,}\s[a-zA-Z]{2,}$/", $ime2)) 
			{
				$ime2Err = "I ime i prezime moraju sadržavati minimalno po 2 karaktera"; 
			}
		}
		
	if ($_SERVER["REQUEST_METHOD"] == "POST")
		if (empty($_POST["unos_plasman"]) && isset($_POST["unos_plasman"]))
		{
			$plasman2Err = "Plasman ne može biti prazan";
		}
		else if (!empty($_POST["unos_plasman"]))
		{
			$plasman2 = test_input($_POST["unos_plasman"]);
			if (!preg_match("/pocasna pohvala|zlatna medalja|srebrena medalja|bronzana medalja/", $plasman2)) 
			{
				$plasman2Err = "Plasman može biti: zlatna medalja, srebrena medalja, bronzana medalja, počasna pohvala"; 
			}
		}

  if(isset($_POST['obrisi']))
  {
	  $upit = $veza->query("SELECT * FROM takmicar;");

	  $i = $_POST['obrisi'];
	  foreach($upit as $tak)
	  {
		if ($tak["id"] == $i)
		{
			$upit2 = $veza->prepare("DELETE FROM takmicar WHERE id=?;");
			$upit2->bindValue(1, $i, PDO::PARAM_INT);
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
			$uspjeh_string = "Uspješno izbrisan takmicar.";
			
		}
		}
	  }
  }
  
   if(isset($_POST['sacuvaj_ime']) && $imeErr == "")
  {
	  $novo = $_POST['novo_ime'];
	  $i = $_POST['sacuvaj_ime'];
  	  $upit = $veza->query("SELECT * FROM takmicar;");
	  
	  foreach($upit as $tak)
	  {
		if ($tak["id"] == $i)
		{			
			$upit2 = $veza->prepare("UPDATE takmicar SET ime=? WHERE id=?;");
			$upit2->bindValue(1, $novo, PDO::PARAM_STR);
			$upit2->bindValue(2, $i, PDO::PARAM_INT);
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
			$uspjeh_string = "Uspješno editovano ime takmicara.";
		}
		}
	  }
  }
  
    if(isset($_POST['sacuvaj_plasman']) && $plasmanErr == "")
  {
	  $novo = $_POST['novi_plasman'];
	  $i = $_POST['sacuvaj_plasman'];
  	  $upit = $veza->query("SELECT * FROM takmicar;");
	  
	  foreach($upit as $tak)
	  {
		if ($tak["id"] == $i)
		{			
			$upit2 = $veza->prepare("UPDATE takmicar SET plasman=? WHERE id=?;");
			$upit2->bindValue(1, $novo, PDO::PARAM_STR);
			$upit2->bindValue(2, $i, PDO::PARAM_INT);
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
			$uspjeh_string = "Uspješno editovan plasman takmicara.";
		}
		}
	  }
  }  
  
  if(isset($_POST['unos_novog']) && $ime2Err == "" && $plasman2Err == "")
  {
	  $naziv = $_POST['unos_naziv'];
      $id_takmicenja = 0;
	  $ime = $_POST['unos_ime'];
	  $plasman = $_POST['unos_plasman'];
	  
	  $upit2 = $veza->query("SELECT * FROM takmicenje;");
	  
	  $nasao = 0;
	  foreach($upit2 as $takmicenje)
	  {
		  if ($takmicenje["naziv"] == $naziv)
		  {
			  $nasao = 1;
			  $id_takmicenja = $takmicenje["id"];
		  }
	  }
	  if ($nasao == 0)
		  $nazivErr = "To takmicenje trenutno ne postoji, morate ga prvo dodati.";

      if ($nazivErr == "")
	  {		  
	  $upit = $veza->prepare("INSERT INTO takmicar (id_takmicenja, ime, plasman) VALUES (?, ?, ?);");
	  $upit->bindValue(1, $id_takmicenja, PDO::PARAM_STR);
	  $upit->bindValue(2, $ime, PDO::PARAM_STR);
	  $upit->bindValue(3, $plasman, PDO::PARAM_STR);
	  $rezultat = $upit->execute();
	  	  
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
			$uspjeh_string = "Uspješno dodana novost.";
		}
	  }
  }  
?>

<!DOCTYPE html>

<html>

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="Stil.css"/>
	<meta name="viewport" content="width=device-width"/>
	<script type="text/javascript" src="Skripta.js"></script>
	<script type="text/javascript" src="Pretrage.js"></script>
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
		<li> <a href="Login.php" class="selektovan">Login/Registracija</a></li>
		<li> <a href="Kontakt.php">Kontakt</a></li>
	</ul>
</div>

<div id="container">

<?php

$veza = new PDO("mysql:dbname=baza;host=localhost;charset=utf8", "root", "");
$veza->exec("set names utf8");
				
$upit = $veza->query("SELECT * FROM korisnik WHERE id=1;");

$nasao = 0;
foreach($upit as $kor)
{
	$admin_username = $kor["username"];
	$admin_pass = $kor["password"];
	if(isset($_SESSION['username']) && $admin_username == $_SESSION['username'] && $admin_pass == $_SESSION['password'])
	{
?>

<div class = "za_admina">
	<ul id = "adminovo">
		<li><a href="novosti.php">Novosti</a></li>
	    <li><a href="takmicari.php">Takmičari</a></li>
        <li><a href="korisnici.php">Korisnici</a></li>
		<li><a href="csv_fajl.php">Download svih podataka o takmičarima (csv)</a></li>
		<li><a href="pdf_fajl.php">Download svih podataka o takmičarima (pdf)</a></li>
		<li><a href="odjava.php">Odjava</a></li>
    </ul>
</div>


<div id="pretraga">
	<form onsubmit="trazi_sve(); return false;">
		Pretraga naziva:
		<input type="text" id="pretraga_naziv" oninput="pretrazi();" name="pretraga_naziv">
		Pretraga imena:
		<input type="text" id="pretraga_ime" oninput="pretrazi();" name="pretraga_ime">
		<input type="submit" value="Traži">
	</form>
</div>


<br>

<div id="pretraga_rezultati">
</div>

<br><br><br><br>







<form action='takmicari.php' method='post'>
	<button type="submit" name="dodaj_novi">Dodaj novog takmičara</button>
</form>
<?php
	if(isset($_POST['dodaj_novi']) || isset($_POST['unos_novog']))
	{ ?>
		<table border="2px solid black" align="center" style="width:80%">
		<tr>
			<th>Godina</th>
			<th>Ime i prezime</th>
			<th>Rezultat</th>
		</tr>
		<form action='takmicari.php' method='post'>
		<tr>
			<td>
				<input type="text" name="unos_naziv">
			</td>
								<?php
					if(isset($_POST['unos_novog']) && $nazivErr != "")
					{
				?>
				<p class="greska"> <?php echo $nazivErr; ?> </p>
			    <?php } ?>	
			<td>
				<input type="text" name="unos_ime">
			</td>
											<?php
					if(isset($_POST['unos_novog']) && $ime2Err != "")
					{
				?>
				<p class="greska"> <?php echo $ime2Err; ?> </p>
			    <?php } ?>	
			<td>
				<input type="text" name="unos_plasman">
			</td>
					<?php
					if(isset($_POST['unos_novog']) && $plasman2Err != "")
					{
				?>
				<p class="greska"> <?php echo $plasman2Err; ?> </p>
			    <?php } ?>
			<td>
				<button type="submit" name="unos_novog">Unesi novog takmičara</button>
			</td>
		</tr>
		</form>
	<?php
	} ?>


<table border="2px solid black" align="center" style="width:80%">
<tr>
	<th>Godina</th>
	<th>Ime i prezime</th>
	<th>Rezultat</th>
</tr>

<?php

$veza = new PDO("mysql:dbname=baza;host=localhost;charset=utf8", "root", "");
$veza->exec("set names utf8");

$upit = $veza->query("SELECT t.id, tak.naziv, t.ime, t.plasman FROM takmicar t, takmicenje tak WHERE t.id_takmicenja=tak.id;");

    $x = 0;
    foreach ($upit as  $tak) { ?>
	<tr>
		<td align="center"> <?php echo $tak["naziv"] ?>
		</td>
		<td align="center"> <?php echo $tak["ime"] ?> 
		<form action='takmicari.php' method='post'>
			<button type="submit" name="edituj_ime" value = "<?php echo $tak["id"];?>">Edituj</button>
			<?php
				if(isset($_POST['edituj_ime']) && $_POST['edituj_ime'] == $tak["id"])
				{ ?>
					<form action='korisnici.php' method='post'>
						<input type="text" name="novo_ime">
						<button type="submit" name="sacuvaj_ime" value = "<?php echo $tak["id"];?>">Sačuvaj</button>
					</form>
			<?php
				} ?>
				<?php
					if(isset($_POST['sacuvaj_ime']) && $imeErr != "" && $_POST['sacuvaj_ime'] == $tak["id"])
					{
				?>
				<p class="greska"> <?php echo $imeErr; ?> </p>
			    <?php } ?>	
		</form>
		</td>
		<td align="center"> <?php echo $tak["plasman"] ?> 
		<form action='takmicari.php' method='post'>
			<button type="submit" name="edituj_plasman" value = "<?php echo $tak["id"];?>">Edituj</button>
			<?php
				if(isset($_POST['edituj_plasman']) && $_POST['edituj_plasman'] == $tak["id"])
				{ ?>
					<form action='korisnici.php' method='post'>
						<input type="text" name="novi_plasman">
						<button type="submit" name="sacuvaj_plasman" value = "<?php echo $tak["id"];?>">Sačuvaj</button>
					</form>
			<?php
				} ?>
					<?php
					if(isset($_POST['sacuvaj_plasman']) && $plasmanErr != "" && $_POST['sacuvaj_plasman'] == $tak["id"])
					{
				?>
				<p class="greska"> <?php echo $plasmanErr; ?> </p>
			    <?php } ?>	
		</form>
		</td>
		<td align="center">
			<form action='takmicari.php' method='post'>
				<button type="submit" name="obrisi" value = "<?php echo $tak["id"];?>">Obriši</button>
			</form>
        </td>
    </tr>
<?php $x++; }  ?>
</table>





<?php
}
elseif(isset($_SESSION['username'])) 
{
?>

<div class = "za_admina">
	<ul id = "adminovo">
		<li><a href="Pocetna.php">Pogledaj novosti</a></li>
		<li><a href="takmicari.php">Pretraži učesnike na olimpijadama</a></li>
		<li><a href="odjava.php">Odjava</a></li>
    </ul>
</div>



<div id="pretraga">
	<form onsubmit="trazi_sve(); return false;">
		Pretraga godine:
		<input type="text" id="pretraga_naziv" oninput="pretrazi();" name="pretraga_naziv">
		Pretraga imena:
		<input type="text" id="pretraga_ime" oninput="pretrazi();" name="pretraga_ime">
		<input type="submit" value="Traži">
	</form>
</div>


<br>

<div id="pretraga_rezultati">
</div>

<br><br><br><br>



<?php
}
else
{
?>

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

<?php
}
}
?>


</div>


</body>

</html>