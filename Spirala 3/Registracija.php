<?php

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


	if (isset($_POST['dugme']))
	{
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		
		$xml = simplexml_load_file('korisnici.xml');
		
		foreach($xml->korisnici->user as $user)
		{
			if ($user->username == $username)
				$usernameErr = "Takav username već postoji";
		}
		
		if ($usernameErr == "" && $passwordErr == "")
		{
			$korisnik = $xml->korisnici->addChild('user');

			$korisnik->addChild('username', $username);
			$korisnik->addChild('password', $password);

			$xml->asXml('korisnici.xml');
		}
	}
?>

<!DOCTYPE html>

<html>

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="Stil.css"/>
	<meta name="viewport" content="width=device-width" />
	<script type="text/javascript" src="Skripta.js"></script>
	<title>DFuBiH</title>
</head>


<body>

<div id="divProsirena">
	<img id="slikaProsirena"/>
</div>

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

<div class="registracija_4">
	<a id="za_log" href="Login.php">Login</a><br>
	<h3> Registracija:</h3>
	<form method="post" action="Registracija.php">
		Username:<br>
		<input type="text" id="username1_4" name="username" value="<?php echo $username;?>">
		<p class="greska"> <?php echo $usernameErr; ?> </p>
		Password:<br>
		<input name="password" id="password1_4" type="password" value="<?php echo $username;?>"><br>
		<p class="greska"> <?php echo $passwordErr; ?> </p>
		<input type="submit" value="Pošalji" name="dugme"><br>
	</form>
</div>


</div>


</body>

</html>