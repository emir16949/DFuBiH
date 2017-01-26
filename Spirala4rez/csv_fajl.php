<?php

//$veza = new PDO('mysql:host=' . getenv('MYSQL_SERVICE_HOST') . ';port=3306;dbname=baza', 'admin', 'adminpass');
$veza = new PDO("mysql:dbname=baza;host=localhost;charset=utf8", "root", "");

$veza->exec("set names utf8");

$upit = $veza->query("SELECT * FROM takmicar t, takmicenje tak WHERE t.id_takmicenja = tak.id;");

$vrh = array('Naziv takmicenja', 'Ime i prezime', 'Rezultat');

$csv = fopen('izvjestaj.csv', 'w');
fputcsv($csv, $vrh);
fclose($csv);
$niz = [];

foreach ($upit as $takmicar)
{
	$naziv = $takmicar["naziv"];
	$ime = $takmicar["ime"];
	$plasman = $takmicar["plasman"];			

	$niz[] = $naziv . "," . $ime . "," . $plasman . "\n";

    $csv = fopen('izvjestaj.csv', 'a');
    fputcsv($csv, $niz);      
	fclose($csv);  

    $niz = [];
}

$contenttype = "application/force-download";
header("Content-Type: " . $contenttype);
header("Content-Disposition: attachment; filename=\"" . basename('izvjestaj.csv') . "\";");
readfile('izvjestaj.csv');
exit();

?>