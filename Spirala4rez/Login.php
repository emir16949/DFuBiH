<?php
	session_start();

	$usernameErr = $passwordErr = "";
	$username = $password = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST")
		if (empty($_POST["username"]))
		{
			$usernameErr = "Morate unijeti username";
		}
		else
		{
			$username = test_input($_POST["username"]);
			if (!preg_match("/^[a-zA-Z0-9]{5,}$/",$username)) 
			{
				$usernameErr = "Samo su slova i brojevi dozvoljeni u username-u, i ono mora imati barem 5 znakova"; 
			}
		}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
		if (empty($_POST["password"]))
		{
			$passwordErr = "Morate unijeti password";
		}
		else
		{
			$password = test_input($_POST["password"]);
			if (!preg_match("/^[a-zA-Z0-9]{6,}$/",$username)) 
			{
				$passwordErr = "Samo su slova i brojevi dozvoljeni u passwordu, i on mora imati barem 6 znakova"; 
			}
		}

	function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
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
	$poruka = "";
	$stari_password = "";
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
				
				$stari_password = $password;
				$password = md5($password);

				//$veza = new PDO('mysql:host=' . getenv('MYSQL_SERVICE_HOST') . ';port=3306;dbname=baza', 'admin', 'adminpass');
				$veza = new PDO("mysql:dbname=baza;host=localhost;charset=utf8", "root", "");

				$veza->exec("set names utf8");
				
				$upit = $veza->query("SELECT * FROM korisnik;");

				$nasao = 0;
				foreach($upit as $kor)
				{
					if($kor["username"] == $username && $kor["password"] == $password)
					{
						$_SESSION['username'] = $username;
						$_SESSION['password'] = $password;
						header('Refresh: 1; URL = Login.php');
						$nasao = 1;
					}
				}
					
				if ($nasao == 0 && $poruka == "")
					$poruka = "Username i/ili password nisu ispravni ili ne postoje. Pokušajte ponovo.";
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
//$veza = new PDO('mysql:host=' . getenv('MYSQL_SERVICE_HOST') . ';port=3306;dbname=baza', 'admin', 'adminpass');
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
		<li><a href="xml_baza.php">Prebacite sve iz xmla u bazu</a></li>
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
		<input type="text" id="username_4" name="username" onblur="return provjeraObjekti(this)" value="<?php echo $username;?>"> <br>
		<p class="greska"> <?php echo $usernameErr; ?> </p>
		Password:<br>
		<input name="password" id="password_4" type="password" onblur="return provjeraObjekti(this)" value="<?php echo $stari_password;?>"><br>
		<p class="greska"> <?php echo $passwordErr; ?> </p>
		<input type="submit" value="Pošalji" name="loginuj_se"><br>
		<p id="par1_4" class="greska"><?php echo $poruka; ?></p>
	</form>
</div>

<?php
}
}
?>


</div>


</body>

</html>