<?php
	session_start();
	
	$veza = new PDO('mysql:host=' . getenv('MYSQL_SERVICE_HOST') . ';port=3306;dbname=baza', 'admin', 'adminpass');
//	$veza = new PDO("mysql:dbname=baza;host=localhost;charset=utf8", "root", "");
	$veza->exec("set names utf8");

	$rezultat = "";

	$rezultat = $rezultat . 
	"<table>
		<tr>
			<th>Naziv</th>
			<th>Ime i prezime</th>
			<th>Plasman</th>
		</tr>";

    if ((!isset($_GET["naziv"]) || ($_GET["naziv"] == "")) && (!isset($_GET["ime"]) || ($_GET["ime"] == "")))
	{
		$rezultat = $rezultat . "";
	}
	else
	{
		$upit = $veza->query("SELECT * FROM takmicar t, takmicenje tak WHERE t.id_takmicenja = tak.id;");
		$pretraga_naziv = strtolower($_GET["naziv"]);
		$pretraga_ime = strtolower($_GET["ime"]);
		$broj_rezultata = 0;

		foreach ($upit as $takmicar)
		{
			if ($pretraga_naziv == "") $pretraga_naziv = "aaa";
			if ($pretraga_ime == "") $pretraga_ime = "111";
			if ((substr_count(strtolower($takmicar["naziv"]), $pretraga_naziv) != 0) || (substr_count(strtolower($takmicar["ime"]), $pretraga_ime) != 0))
			{
				$a = $takmicar["naziv"];
				$b = $takmicar["ime"];
				$c = $takmicar["plasman"];				
				$rezultat = $rezultat . "<tr>
											<td>$a</td>
											<td>$b</td>
											<td>$c</td>
										</tr>";

				$broj_rezultata++;

				if (!isset($_GET["sve"]) && $broj_rezultata == 10)
				{
					break;
				}
			}
		}
	}
	
	$rezultat = $rezultat . "</table>";
	echo $rezultat;
?>