<?php
  session_start();
  // korišten dom document jer nisam našao da se preko simplexml može potpuno obrisati čvor u xmlu
  $xml = new DOMDocument();
  $xml->load('novosti.xml');

  if(isset($_POST['obrisi']))
  {
	  $podaci = $xml->getElementsByTagName('novost');

	  $obrisati = null;
	  $i = $_POST['obrisi'];
	  $obrisati = $podaci->item($i);
	  
	  if($obrisati != null) $obrisati->parentNode->removeChild($obrisati);

	  file_put_contents('novosti.xml', $xml->saveXML());
  }
  
  if(isset($_POST['sacuvaj_naslov']))
  {
	  $novo = $_POST['novi_naslov'];
	  $i = $_POST['sacuvaj_naslov'];
	  
	  $xml->getElementsByTagName('novost')->item($i)->getElementsByTagName('naslov')->item(0)->nodeValue = $novo;

	  file_put_contents('novosti.xml', $xml->saveXML());
  }
  
  if(isset($_POST['sacuvaj_tekst']))
  {
	  $novo = $_POST['novi_tekst'];
	  $i = $_POST['sacuvaj_tekst'];
	  
	  $xml->getElementsByTagName('novost')->item($i)->getElementsByTagName('tekst')->item(0)->nodeValue = $novo;
	  
	  file_put_contents('novosti.xml', $xml->saveXML());
  }

  if(isset($_POST['unos_novog']))
  {
	  $naslov = $_POST['unos_naslov'];
	  $tekst = $_POST['unos_tekst'];

	  $node = $xml->createElement("novost");

	  $el = $xml->createElement("naslov");
	  $node->appendChild($el);
	  $el = $xml->createElement("tekst");
	  $node->appendChild($el);

	  $node->getElementsByTagName('naslov')->item(0)->nodeValue = $naslov;
	  $node->getElementsByTagName('tekst')->item(0)->nodeValue = $tekst;	  
	  
	  $novosti = $xml->getElementsByTagName('novost');
	  
	  
	  $takmicari->item(0)->parentNode->insertBefore($node, $takmicari->item(0));
	  
	  file_put_contents('novosti.xml', $xml->saveXML());	  
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
			</td>
			<td>
				<textarea rows="10" cols="30" type="text" name="unos_tekst"></textarea>
			</td>
			<td>
				<button type="submit" name="unos_novog">Unesi novu novost</button>
			</td>
		</tr>
		</form>
	<?php
	} ?>


<table border="2px solid black" align="center" style="width:80%">
<tr>
	<th>Naslov</th>
	<th>Tekst</th>
</tr>

<?php
    $xml = simplexml_load_file('novosti.xml');
    $x = 0;
    foreach ($xml->novosti->novost as  $nov) { ?>
	<tr>
		<td align="center"> <?php echo $nov->naslov ?> 
		<form action='novosti.php' method='post'>
			<button type="submit" name="edituj_naslov" value = "<?php echo $x;?>">Edituj</button>
			<?php
				if(isset($_POST['edituj_naslov']) && $_POST['edituj_naslov'] == $x)
				{ ?>
					<form action='novosti.php' method='post'>
						<input type="text" name="novi_naslov">
						<button type="submit" name="sacuvaj_naslov" value = "<?php echo $x;?>">Sačuvaj</button>
					</form>
			<?php
				} ?>
		</form>
		</td>
		<td align="center"> <?php echo $nov->tekst ?> 
		<form action='novosti.php' method='post'>
			<button type="submit" name="edituj_tekst" value = "<?php echo $x;?>">Edituj</button>
			<?php
				if(isset($_POST['edituj_tekst']) && $_POST['edituj_tekst'] == $x)
				{ ?>
					<form action='novosti.php' method='post'>
						<input type="text" name="novi_tekst">
						<button type="submit" name="sacuvaj_tekst" value = "<?php echo $x;?>">Sačuvaj</button>
					</form>
			<?php
				} ?>
		</form>
		</td>
		<td align="center"> 
			<form action='novosti.php' method='post'>
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