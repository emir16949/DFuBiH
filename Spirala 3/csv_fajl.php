<?php
    
    if (file_exists('ipho.xml'))
    {
        $xml = simplexml_load_file('ipho.xml'); 

        $vrh = array('Godina', 'Ime i prezime', 'Rezultat');

        $csv = fopen('izvjestaj.csv', 'w');
        fputcsv($csv, $vrh);
        fclose($csv);
		$niz = [];

        foreach ($xml->takmicari->takmicar as $takmicar) 
        {			
            $godina = $takmicar->godina;
			$ime = $takmicar->ime;
			$rezultat = $takmicar->rezultat;			

			$niz[] = $godina . "," . $ime . "," . $rezultat . "\n";

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
    }
	else echo "GREŠKA. Ne postoji baza za povlačenje podataka";
?>