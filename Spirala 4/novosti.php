<?php
  session_start();
  
	$naslovErr = $tekstErr = "";
	$naslov = $tekst = "";

	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
		if (empty($_POST["novi_naslov"]) && isset($_POST["novi_naslov"]))
		{
			$naslovErr = "Naslov ne može biti prazan";
		}
		else if (!empty($_POST["novi_naslov"]))
		{
			$naslov = test_input($_POST["novi_naslov"]);
			if (!preg_match("/.{10,}/",$naslov)) 
			{
				$naslovErr = "Naslov mora imati minimalno 10 karaktera"; 
			}
		}
		
	if ($_SERVER["REQUEST_METHOD"] == "POST")
		if (empty($_POST["novi_tekst"]) && isset($_POST["novi_tekst"]))
		{
			$tekstErr = "Tekst ne može biti prazan";
		}
		else if (!empty($_POST["novi_tekst"]))
		{
			$tekst = test_input($_POST["novi_tekst"]);
			if (!preg_match("/.{20,}/",$tekst)) 
			{
				$tekstErr = "Tekst mora imati minimalno 20 karaktera"; 
			}
		}

	function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}  
  
$veza = new PDO("mysql:dbname=baza;host=localhost;charset=utf8", "root", "");
$veza->exec("set names utf8");

if(isset($_POST['obrisi']))
{
	  $upit = $veza->query("SELECT * FROM novost;");

	  $i = $_POST['obrisi'];
	  foreach($upit as $nov)
	  {
		if ($nov["id"] == $i)
		{
			$upit2 = $veza->prepare("DELETE FROM novost WHERE id=?;");
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
			$uspjeh_string = "Uspješno izbrisana novost.";
		}
		}
	  }
}
  
  if(isset($_POST['sacuvaj_naslov']) && $naslovErr == "")
  {
	  $novo = $_POST['novi_naslov'];
	  $i = $_POST['sacuvaj_naslov'];
  	  $upit = $veza->query("SELECT * FROM novost;");
	  
	  foreach($upit as $nov)
	  {
		if ($nov["id"] == $i)
		{			
			$upit2 = $veza->prepare("UPDATE novost SET naslov=? WHERE id=?;");
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
			$uspjeh_string = "Uspješno editovan naslov novosti.";
		}
		}
	  }
  }
  
  if(isset($_POST['sacuvaj_tekst']) && $tekstErr == "")
  {
	  $novo = $_POST['novi_tekst'];
	  $i = $_POST['sacuvaj_tekst'];
	  
	  $upit = $veza->query("SELECT * FROM novost;");
	  
	  foreach($upit as $nov)
	  {
		if ($nov["id"] == $i)
		{			
			$upit2 = $veza->prepare("UPDATE novost SET tekst=? WHERE id=?;");
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
			$uspjeh_string = "Uspješno editovan tekst novosti.";
		}
		}
	  }

  }

  
  	if ($_SERVER["REQUEST_METHOD"] == "POST")
		if (empty($_POST["unos_naslov"]) && isset($_POST["unos_naslov"]))
		{
			$naslovErr = "Naslov ne može biti prazan";
		}
		else if (!empty($_POST["unos_naslov"]))
		{
			$naslov = test_input($_POST["unos_naslov"]);
			if (!preg_match("/.{10,}/",$naslov)) 
			{
				$naslovErr = "Naslov smije sadržavati samo slova, brojeve i razmake, i mora imati minimalno 10 karaktera"; 
			}
		}
		
	if ($_SERVER["REQUEST_METHOD"] == "POST")
		if (empty($_POST["unos_tekst"]) && isset($_POST["unos_tekst"]))
		{
			$tekstErr = "Tekst ne može biti prazan";
		}
		else if (!empty($_POST["unos_tekst"]))
		{
			$tekst = test_input($_POST["unos_tekst"]);
			if (!preg_match("/.{20,}/",$tekst)) 
			{
				$tekstErr = "Tekst smije sadržavati samo slova, brojeve i razmake, i mora imati minimalno 20 karaktera"; 
			}
		}
  
  
  
  if(isset($_POST['unos_novog']) && $naslovErr == "" && $tekstErr == "")
  {
	  $naslov = $_POST['unos_naslov'];
	  $tekst = $_POST['unos_tekst'];
	  
	  $upit = $veza->prepare("INSERT INTO novost (naslov, tekst) VALUES (?, ?);");
	  $upit->bindValue(1, $naslov, PDO::PARAM_STR);
	  $upit->bindValue(2, $tekst, PDO::PARAM_STR);
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


<form action='novosti.php' method='post'>
	<button type="submit" name="dodaj_novi">Dodaj novu novost</button>
</form>
<?php
	if(isset($_POST['dodaj_novi']))
	{ ?>
		<table border="2px solid black" align="center" style="width:80%">
		<tr>
			<th>Naslov</th>
			<th>Tekst</th>
		</tr>
		<form action='novosti.php' method='post'>
		<tr>
			<td>
				<input type="text" name="unos_naslov">
										<?php
					if(isset($_POST['unos_naslov']) && $naslovErr != "")
					{
				?>
				<p class="greska"> <?php echo $tekstErr; ?> </p>
			    <?php } ?>	
			</td>
			<td>
				<textarea rows="10" cols="30" type="text" name="unos_tekst"></textarea>
										<?php
					if(isset($_POST['unos_tekst']) && $tekstErr != "")
					{
				?>
				<p class="greska"> <?php echo $tekstErr; ?> </p>
			    <?php } ?>	
			</td>
			<td>
				<button type="submit" name="unos_novog">Unesi novu novost</button>
			</td>
		</tr>
		</form>
	<?php
	}
else if (isset($_POST['unos_naslov']) || isset($_POST['unos_tekst']))
	
{ ?>
		<table border="2px solid black" align="center" style="width:80%">
		<tr>
			<th>Naslov</th>
			<th>Tekst</th>
		</tr>
		<form action='novosti.php' method='post'>
		<tr>
			<td>
				<input type="text" name="unos_naslov">
										<?php
					if(isset($_POST['unos_naslov']) && $naslovErr != "")
					{
				?>
				<p class="greska"> <?php echo $naslovErr; ?> </p>
			    <?php } ?>	
			</td>
			<td>
				<textarea rows="10" cols="30" type="text" name="unos_tekst"></textarea>
										<?php
					if(isset($_POST['unos_tekst']) && $tekstErr != "")
					{
				?>
				<p class="greska"> <?php echo $tekstErr; ?> </p>
			    <?php } ?>	
			</td>
			<td>
				<button type="submit" name="unos_novog">Unesi novu novost</button>
			</td>
		</tr>
		</form>
	<?php
	}



	?>


<table border="2px solid black" align="center" style="width:80%">
<tr>
	<th>Naslov</th>
	<th>Tekst</th>
</tr>

<?php


$veza = new PDO("mysql:dbname=baza;host=localhost;charset=utf8", "root", "");

$veza->exec("set names utf8");

$upit = $veza->query("SELECT * FROM novost;");

$x = 0;
foreach ($upit as  $novost) { ?>
<tr>
		<td align="center"> <?php echo $novost["naslov"] ?> 
		<form action='novosti.php' method='post'>
			<button type="submit" name="edituj_naslov" value = "<?php echo $novost["id"];?>">Edituj</button>
			<?php
					if(isset($_POST['sacuvaj_naslov']) && $_POST['sacuvaj_naslov'] == $novost["id"] && $naslovErr != "")
					{
				?>
				<p class="greska"> <?php echo $naslovErr; ?> </p>
			    <?php } ?>		
			<?php
				if(isset($_POST['edituj_naslov']) && $_POST['edituj_naslov'] == $novost["id"])
				{ ?>
					<form action='novosti.php' method='post'>
						<input type="text" name="novi_naslov">
						<button type="submit" name="sacuvaj_naslov" value = "<?php echo $novost["id"];?>">Sačuvaj</button>
					</form>
			<?php
				} ?>
		</form>
		</td>
		<td align="center"> <?php echo $novost["tekst"] ?> 
		<form action='novosti.php' method='post'>
			<button type="submit" name="edituj_tekst" value = "<?php echo $novost["id"];?>">Edituj</button>
						<?php
					if(isset($_POST['sacuvaj_tekst']) && $_POST['sacuvaj_tekst'] == $novost["id"] && $tekstErr != "")
					{
				?>
				<p class="greska"> <?php echo $tekstErr; ?> </p>
			    <?php } ?>				
			<?php
				if(isset($_POST['edituj_tekst']) && $_POST['edituj_tekst'] == $novost["id"])
				{ ?>
					<form action='novosti.php' method='post'>
						<input type="text" name="novi_tekst">
						<button type="submit" name="sacuvaj_tekst" value = "<?php echo $novost["id"];?>">Sačuvaj</button>
					</form>
			<?php
				} ?>
		</form>
		</td>
		<td align="center"> 
			<form action='novosti.php' method='post'>
				<button type="submit" name="obrisi" value = "<?php echo $novost["id"];?>">Obriši</button>
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