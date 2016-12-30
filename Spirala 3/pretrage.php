<?php
	session_start();
	$xml = simplexml_load_file("ipho.xml");
	
	$rezultat = "";

	$rezultat = $rezultat . 
	"<table>
		<tr>
			<th>Godina</th>
			<th>Ime i prezime</th>
			<th>Rezultat</th>
		</tr>";

    if ((!isset($_GET["godina"]) || ($_GET["godina"] == "")) && (!isset($_GET["ime"]) || ($_GET["ime"] == "")))
	{
		$rezultat = $rezultat . "";
	}
	else
	{
		$takmicari = $xml->takmicari->takmicar;
		$pretraga_godina = strtolower($_GET["godina"]);
		$pretraga_ime = strtolower($_GET["ime"]);
		$broj_rezultata = 0;

		foreach ($takmicari as $takmicar)
		{
			if ($pretraga_godina == "") $pretraga_godina = "aaa";
			if ($pretraga_ime == "") $pretraga_ime = "111";
			if ((substr_count(strtolower($takmicar->godina), $pretraga_godina) != 0) || (substr_count(strtolower($takmicar->ime), $pretraga_ime) != 0))
			{
				$rezultat = $rezultat . "<tr>
											<td>$takmicar->godina</td>
											<td>$takmicar->ime</td>
											<td>$takmicar->rezultat</td>
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