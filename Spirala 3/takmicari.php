<?php
  session_start();
  // korišten dom document jer nisam našao da se preko simplexml može potpuno obrisati čvor u xmlu
  $xml = new DOMDocument();
  $xml->load('ipho.xml');

  if(isset($_POST['obrisi']))
  {
	  $podaci = $xml->getElementsByTagName('takmicar');

	  $obrisati = null;
	  $i = $_POST['obrisi'];
	  $obrisati = $podaci->item($i);
	  
	  if($obrisati != null) $obrisati->parentNode->removeChild($obrisati);

	  file_put_contents('ipho.xml', $xml->saveXML());
  }
  
  if(isset($_POST['sacuvaj_godinu']))
  {
	  $novo = $_POST['nova_godina'];
	  $i = $_POST['sacuvaj_godinu'];
	  
	  $xml->getElementsByTagName('takmicar')->item($i)->getElementsByTagName('godina')->item(0)->nodeValue = $novo;

	  file_put_contents('ipho.xml', $xml->saveXML());
  }
  
  if(isset($_POST['sacuvaj_ime']))
  {
	  $novo = $_POST['novo_ime'];
	  $i = $_POST['sacuvaj_ime'];
	  
	  $xml->getElementsByTagName('takmicar')->item($i)->getElementsByTagName('ime')->item(0)->nodeValue = $novo;
	  
	  file_put_contents('ipho.xml', $xml->saveXML());
  }
  
  if(isset($_POST['sacuvaj_rezultat']))
  {
	  $novo = $_POST['novi_rezultat'];
	  $i = $_POST['sacuvaj_rezultat'];
	  
	  $xml->getElementsByTagName('takmicar')->item($i)->getElementsByTagName('rezultat')->item(0)->nodeValue = $novo;
	  
	  file_put_contents('ipho.xml', $xml->saveXML());
  }

  if(isset($_POST['unos_novog']))
  {
	  $godina = $_POST['unos_godina'];
	  $ime = $_POST['unos_ime'];
	  $rezultat = $_POST['unos_rezultat'];

	  $node = $xml->createElement("takmicar");

	  $el = $xml->createElement("godina");
	  $node->appendChild($el);
	  $el = $xml->createElement("ime");
	  $node->appendChild($el);
	  $el = $xml->createElement("rezultat");
	  $node->appendChild($el);

	  $node->getElementsByTagName('godina')->item(0)->nodeValue = $godina;
	  $node->getElementsByTagName('ime')->item(0)->nodeValue = $ime;
	  $node->getElementsByTagName('rezultat')->item(0)->nodeValue = $rezultat;
	  
	  
	  $takmicari = $xml->getElementsByTagName('takmicar');
	  
	  $brojac = 0;
	  foreach($takmicari as $tak)
	  {
		  $god = $tak->getElementsByTagName('godina')->item(0)->nodeValue;
		  if ($godina > $god) break;
		  $brojac++;
	  }
	  
	  
	  $takmicari->item($brojac)->parentNode->insertBefore($node, $takmicari->item($brojac));
	  
	  file_put_contents('ipho.xml', $xml->saveXML());	  
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

<?php
   if(!isset($_SESSION['username']))
   {
	   if(isset($_POST['loginuj_se']))
	   {
		   if(isset($_POST['username']) && isset($_POST['password']))
		   {
			   $username = $_POST['username'];
			   $password = md5($_POST['password']);
			   
			   if(file_exists('korisnici.xml'))
			   {
				   $xml = simplexml_load_file('korisnici.xml');
				   
				   foreach($xml->korisnici->user as $kor)
				   {
					   if($kor->username == $username && $password == $kor->password)
					   {
						   $_SESSION['username'] = $username;
						   $_SESSION['password'] = $password;
						   header('Refresh: 1; URL = Login.php');
						}
					}
				}
			}
		}
   }
   if(isset($_POST['odjava']))
   {
	   session_unset();
	   header('Refresh: 1; URL = prijava.php');
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

<?php
	$xml = simplexml_load_file('korisnici.xml');
	$admin_username = $xml->korisnici[0]->user->username;
	$admin_pass = $xml->korisnici[0]->user->password;
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
		Pretraga godine:
		<input type="text" id="pretraga_godina" oninput="pretrazi();" name="pretraga_godina">
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
	if(isset($_POST['dodaj_novi']))
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
				<input type="text" name="unos_godina">
			</td>
			<td>
				<input type="text" name="unos_ime">
			</td>
			<td>
				<input type="text" name="unos_rezultat">
			</td>
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
    $xml = simplexml_load_file('ipho.xml');
    $x = 0;
    foreach ($xml->takmicari->takmicar as  $tak) { ?>
	<tr>
		<td align="center"> <?php echo $tak->godina ?> 
		<form action='takmicari.php' method='post'>
			<button type="submit" name="edituj_godina" value = "<?php echo $x;?>">Edituj</button>
			<?php
				if(isset($_POST['edituj_godina']) && $_POST['edituj_godina'] == $x)
				{ ?>
					<form action='takmicari.php' method='post'>
						<input type="text" name="nova_godina">
						<button type="submit" name="sacuvaj_godinu" value = "<?php echo $x;?>">Sačuvaj</button>
					</form>
			<?php
				} ?>
		</form>
		</td>
		<td align="center"> <?php echo $tak->ime ?> 
		<form action='takmicari.php' method='post'>
			<button type="submit" name="edituj_ime" value = "<?php echo $x;?>">Edituj</button>
			<?php
				if(isset($_POST['edituj_ime']) && $_POST['edituj_ime'] == $x)
				{ ?>
					<form action='korisnici.php' method='post'>
						<input type="text" name="novo_ime">
						<button type="submit" name="sacuvaj_ime" value = "<?php echo $x;?>">Sačuvaj</button>
					</form>
			<?php
				} ?>
		</form>
		</td>
		<td align="center"> <?php echo $tak->rezultat ?> 
		<form action='takmicari.php' method='post'>
			<button type="submit" name="edituj_rezultat" value = "<?php echo $x;?>">Edituj</button>
			<?php
				if(isset($_POST['edituj_rezultat']) && $_POST['edituj_rezultat'] == $x)
				{ ?>
					<form action='korisnici.php' method='post'>
						<input type="text" name="novi_rezultat">
						<button type="submit" name="sacuvaj_rezultat" value = "<?php echo $x;?>">Sačuvaj</button>
					</form>
			<?php
				} ?>
		</form>
		</td>
		<td align="center"> 
			<form action='takmicari.php' method='post'>
				<button type="submit" name="obrisi" value = "<?php echo $x;?>">Obriši</button>
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
		<input type="text" id="pretraga_godina" oninput="pretrazi();" name="pretraga_godina">
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

?>


</div>


</body>

</html>