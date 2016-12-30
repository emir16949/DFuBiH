<?php
	session_start();
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
	$poruka = "";
	if(!isset($_SESSION['username']))
	{
		if(isset($_POST['loginuj_se']))
		{
			if(isset($_POST['username']) && isset($_POST['password']))
			{
				$username = $_POST['username'];
				$password = $_POST['password'];
				
				if ($username == "" || $password == "")
					$poruka = "Morate unijeti oba polja za prijavu.";
				
				$password = md5($password);
				
				if(file_exists('korisnici.xml'))
				{
					$xml = simplexml_load_file('korisnici.xml');
					
					$nasao = 0;
					foreach($xml->korisnici->user as $kor)
					{
						if($kor->username == $username && $password == $kor->password)
						{
							$_SESSION['username'] = $username;
							$_SESSION['password'] = $password;
							header('Refresh: 1; URL = Login.php');
							$nasao = 1;
						}
					}
					
					if ($nasao == 0 && $poruka == "")
						$poruka = "Username i/ili password nisu ispravni. Pokušajte ponovo.";					
				}
			}
		}
   }
   
   if(isset($_POST['odjava']))
   {
	   session_unset();
	   header('Refresh: 1; URL = Login.php');
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
		<input type="text" id="username2_4" name="username" onblur="return provjeraObjekti(this)"> <br><br>
		Password:<br>
		<input name="password" id="password2_4" type="password" onblur="return provjeraObjekti(this)"><br><br>
		<input type="submit" value="Pošalji" name="loginuj_se"><br>
		<p id="par1_4" class="greska"><?php echo $poruka; ?></p>
	</form>
</div>

<?php
}

?>


</div>


</body>

</html>