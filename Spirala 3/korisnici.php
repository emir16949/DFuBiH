<?php
  session_start();
  // korišten dom document jer nisam našao da se preko simplexml može potpuno obrisati čvor u xmlu
  $xml = new DOMDocument();
  $xml->load('korisnici.xml');

  if(isset($_POST['obrisi']))
  {
	  $podaci = $xml->getElementsByTagName('user');

	  $obrisati = null;
	  $i = $_POST['obrisi'];
	  $obrisati = $podaci->item($i);
	  
	  if($obrisati != null) $obrisati->parentNode->removeChild($obrisati);

	  file_put_contents('korisnici.xml', $xml->saveXML());
  }
  
  if(isset($_POST['sacuvaj']))
  {
	  $novo = $_POST['novi_username'];
	  $i = $_POST['sacuvaj'];
	  
	  $xml->getElementsByTagName('user')->item($i)->getElementsByTagName('username')->item(0)->nodeValue = $novo;

	  file_put_contents('korisnici.xml', $xml->saveXML());
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
	<th>Username</th>
</tr>

<?php
    $xml = simplexml_load_file('korisnici.xml');
    $x = 0;
    foreach ($xml->korisnici->user as  $user) { ?>
	<tr>
		<td align="center"> <?php echo $user->username ?> </td>
        <td align="center"> 
			<form action='korisnici.php' method='post'>
				<button type="submit" name="edituj" value = "<?php echo $x;?>">Edituj</button>
				<button type="submit" name="obrisi" value = "<?php echo $x;?>">Obriši</button>
				<?php
					if(isset($_POST['edituj']) && $_POST['edituj'] == $x)
					{
				?>
	<form action='korisnici.php' method='post'>
		<input type="text" name="novi_username">
		<button type="submit" name="sacuvaj" value = "<?php echo $x;?>">Sačuvaj</button>
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