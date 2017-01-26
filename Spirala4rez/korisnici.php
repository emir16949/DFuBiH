<?php
  session_start();

	$usernameErr = "";
	$username = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST")
		if (empty($_POST["novi_username"]))
		{
			$usernameErr = "Morate unijeti username";
		}
		else
		{
			$username = test_input($_POST["novi_username"]);
			if (!preg_match("/^[a-zA-Z0-9]{5,}$/",$username)) 
			{
				$usernameErr = "Samo su slova i brojevi dozvoljeni u username-u, i ono mora imati barem 5 znakova"; 
			}
		}

	function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
$veza = new PDO('mysql:host=' . getenv('MYSQL_SERVICE_HOST') . ';port=3306;dbname=baza', 'emiremir', 'emiremir');
//$veza = new PDO("mysql:dbname=baza;host=localhost;charset=utf8", "root", "");

$veza->exec("set names utf8");


  if(isset($_POST['obrisi']))
  {
	  $upit = $veza->query("SELECT * FROM korisnik;");
	  $upitKontakt = $veza->query("SELECT * FROM kontakt;");

	  $obrisati = null;
	  $i = $_POST['obrisi'];
	  foreach($upit as $kor)
	  {
		if ($kor["id"] == $i && $i == 1)
			$usernameErr = "Ne možete obrisati admina.";
		else if ($kor["id"] == $i)
		{
			$upit2 = $veza->prepare("DELETE FROM korisnik WHERE id=?;");
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
			$uspjeh_string = "Uspješno izbrisan korisnik.";
			
			foreach($upitKontakt as $kon)
			{
				if ($kon["id_korisnika"] == $i)
				{
					$upitKontakt2 = $veza->prepare("DELETE FROM kontakt WHERE id=?;");
					$upitKontakt2->bindValue(1, $kon["id"], PDO::PARAM_INT);
					$rezultat2 = $upitKontakt2->execute();
					
					if (!$rezultat2)
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
						$uspjeh_string = "Uspješno izbrisan korisnik zajedno sa svim kontaktima.";
					}
					
					
				}
			}
			
		}
		}
	  }
  }
  
  if(isset($_POST['sacuvaj']) && $usernameErr == "")
  {
	  $novo = $_POST['novi_username'];
  	  $upit = $veza->query("SELECT * FROM korisnik;");
	  
  	  $i = $_POST['sacuvaj'];
	  
	  foreach($upit as $kor)
	  {
		if ($kor["id"] == $i)
		{			
			$upit2 = $veza->prepare("UPDATE korisnik SET username=? WHERE id=?;");
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
			$uspjeh_string = "Uspješno editovan korisnik.";
		}
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

<table border="2px solid black" align="center" style="width:80%">
<tr>
	<th>ID</th>
	<th>Username</th>
	<th>Password</th>
	<th>Ime</th>
	<th>Ocjena stranice</th>
	<th>Editovanje</th>
</tr>

<?php

$veza = new PDO('mysql:host=' . getenv('MYSQL_SERVICE_HOST') . ';port=3306;dbname=baza', 'emiremir', 'emiremir');
//$veza = new PDO("mysql:dbname=baza;host=localhost;charset=utf8", "root", "");

$veza->exec("set names utf8");

$upit = $veza->query("SELECT * FROM korisnik;");

$x = 0;
foreach ($upit as  $user) { ?>
<tr>
	<td align="center"> <?php echo $user["id"] ?> </td>
	<td align="center"> <?php echo $user["username"] ?> </td>
	<td align="center"> <?php echo $user["password"] ?> </td>
	<td align="center"> <?php echo $user["ime"] ?> </td>
	<td align="center"> <?php echo $user["ocjena_stranice"] ?> </td>
    <td align="center">
			<form action='korisnici.php' method='post'>
				<button type="submit" name="edituj" value = "<?php echo $user["id"];?>">Edituj</button>
				<?php
					if(isset($_POST['sacuvaj']) && $_POST['sacuvaj'] == $user["id"])
					{
				?>
				<p class="greska"> <?php echo $usernameErr; ?> </p>
			    <?php } ?>				
				
				<button type="submit" name="obrisi" value = "<?php echo $user["id"];?>">Obriši</button>
				
								<?php
					if(isset($_POST['obrisi']) && $_POST['obrisi'] == $user["id"])
					{
				?>
				<p class="greska"> <?php echo $usernameErr; ?> </p>
			    <?php } ?>				
				
				
				
				
				<?php
					if(isset($_POST['edituj']) && $_POST['edituj'] == $user["id"])
					{
				?>
			<form action='korisnici.php' method='post'>
				<input type="text" name="novi_username">
				<button type="submit" name="sacuvaj" value = "<?php echo $user["id"];?>">Sačuvaj</button>
			</form>

<?php
  }
		?>
			</form>
        </td>
    </tr>
<?php $x++; }  ?>
</table>

</div>

</body>

</html>