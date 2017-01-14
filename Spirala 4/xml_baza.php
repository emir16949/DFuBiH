<?php

$veza = new PDO('mysql:host=' . getenv('MYSQL_SERVICE_HOST') . ';port=3306;dbname=baza', 'admin', 'adminpass');
//$veza = new PDO("mysql:dbname=baza;host=localhost;charset=utf8", "root", "");

$veza->exec("set names utf8");

$korisnici = simplexml_load_file('korisnici.xml');
$takmicari = simplexml_load_file('takmicari.xml');
$takmicenja = simplexml_load_file('takmicenja.xml');
$novosti = simplexml_load_file('novosti.xml');
$kontakti = simplexml_load_file('kontakti.xml');

$veza->exec("CREATE TABLE IF NOT EXISTS korisnik 
		(
			id int NOT NULL AUTO_INCREMENT,
			username varchar(50) NOT NULL,
			password varchar(50) NOT NULL,
			ime varchar(50) NOT NULL,
			ocjena_stranice int, 
			PRIMARY KEY (id)
		)
		CHARACTER SET utf8 COLLATE utf8_slovenian_ci ENGINE=InnoDB;");

$veza->exec("CREATE TABLE IF NOT EXISTS kontakt 
		(
			id int NOT NULL AUTO_INCREMENT,
			id_korisnika NOT NULL,
			email varchar(50) NOT NULL,
			komentar text NOT NULL,
			pomoc_u_radu tinyint(1) NOT NULL,
			donacija tinyint(1) NOT NULL,
			PRIMARY KEY (id)
			FOREIGN KEY (id_korisnika) REFERENCES tabela(korisnik)
		    ON DELETE CASCADE
	       	ON UPDATE CASCADE
		)
		CHARACTER SET utf8 COLLATE utf8_slovenian_ci ENGINE=InnoDB;");

$veza->exec("CREATE TABLE IF NOT EXISTS novost
		(
			id int NOT NULL AUTO_INCREMENT,
			naslov varchar(50) NOT NULL,
			tekst text NOT NULL,
			PRIMARY KEY (id)
		)
		CHARACTER SET utf8 COLLATE utf8_slovenian_ci ENGINE=InnoDB;");
		
$veza->exec("CREATE TABLE IF NOT EXISTS takmicenje 
		(
			id int NOT NULL AUTO_INCREMENT,
			naziv varchar(50) NOT NULL,
			lokacija varchar(50) NOT NULL,
			PRIMARY KEY (id)
		)
		CHARACTER SET utf8 COLLATE utf8_slovenian_ci ENGINE=InnoDB;");
		
$veza->exec("CREATE TABLE IF NOT EXISTS takmicar 
		(
			id int NOT NULL AUTO_INCREMENT,
			id_takmicenja NOT NULL,
			ime varchar(50) NOT NULL,
			plasman varchar(50) NOT NULL,
			PRIMARY KEY (id)
			FOREIGN KEY (id_takmicenja) REFERENCES tabela(takmicenje)
		    ON DELETE CASCADE
	       	ON UPDATE CASCADE
		)
		CHARACTER SET utf8 COLLATE utf8_slovenian_ci ENGINE=InnoDB;");


print "Počinje prebacivanje podataka u bazu<br><br>";

foreach($korisnici->korisnici->user as $kor)
{
	$id = $kor->id;
	$username = $kor->username;
	$password = $kor->password;
	$ime = $kor->ime;
	$ocjena_stranice = $kor->ocjena_stranice;
	
	// koristimo prepared statements, radi zaštite od sql injectiona
	$upit = $veza->prepare("SELECT COUNT(*) FROM korisnik WHERE id=?;");
	$upit->bindValue(1, $id, PDO::PARAM_INT);

	$postoji = $upit->execute();
	
	if (!$postoji) {
	  $greska = $veza->errorInfo();
      print "Nastala je SQL greška: " . $greska;
      exit();
 	}
 	else
 	{
		// vraća 1 ako je korisnik već u bazi, a 0 ako nije
 		$da_li_je_u_bazi = intval($upit->fetchColumn());
		
 		if ($da_li_je_u_bazi == 0)
 		{
			$upit = $veza->prepare("INSERT INTO korisnik (id, username, password, ime, ocjena_stranice) VALUES (?, ?, ?, ?, ?);");
			$upit->bindValue(1, $id, PDO::PARAM_INT);
			$upit->bindValue(2, $username, PDO::PARAM_STR);
			$upit->bindValue(3, $password, PDO::PARAM_STR);
			$upit->bindValue(4, $ime, PDO::PARAM_STR);
			$upit->bindValue(5, $ocjena_stranice, PDO::PARAM_INT);
			$uspjelo = $upit->execute();

			if (!$uspjelo) {
				$greska = $veza->errorInfo();
				print "Nastala je SQL greška: " . $greska[2];
		        exit();
		    }
 		}
		else    // u slučaju da je korisnik samo u xmlu a nije upisan u bazu, treba ga upisati u bazu
 		{
 			$upit = $veza->prepare("UPDATE korisnik SET username=?, password=?, ime=?, ocjena_stranice=? WHERE id=?;");
 			$upit->bindValue(1, $username, PDO::PARAM_STR);
 			$upit->bindValue(2, $password, PDO::PARAM_STR);
 			$upit->bindValue(3, $ime, PDO::PARAM_STR);
 			$upit->bindValue(4, $ocjena_stranice, PDO::PARAM_INT);
 			$upit->bindValue(5, $id, PDO::PARAM_INT);
 			$uspjeh = $upit->execute();
			if (!$uspjeh) {
				$greska = $veza->errorInfo();
				print "Nastala je SQL greška: " . $greska[2];
		        exit();
		    }
 		}
	}
 		
}


print "Korisnici su upisani i updateovani<br>Sada ide upis takmičenja<br><br>";


foreach($takmicenja->takmicenja->takmicenje as $t)
{	
	$id = $t->id;
	$naziv = $t->naziv;
	$lokacija = $t->lokacija;
	
	// koristimo prepared statements, radi zaštite od sql injectiona
	$upit = $veza->prepare("SELECT COUNT(*) FROM takmicenje WHERE id=?;");
	$upit->bindValue(1, $id, PDO::PARAM_INT);

	$postoji = $upit->execute();

	if (!$postoji) {
	  $greska = $veza->errorInfo();
      print "Nastala je SQL greška: " . $greska[2];
      exit();
 	}
 	else
 	{
		// vraća 1 ako je takmičenje već u bazi, a 0 ako nije
 		$da_li_je_u_bazi = intval($upit->fetchColumn());

 		if ($da_li_je_u_bazi == 0)
 		{
			$upit = $veza->prepare("INSERT INTO takmicenje (id, naziv, lokacija) VALUES (?, ?, ?);");
			$upit->bindValue(1, $id, PDO::PARAM_INT);
			$upit->bindValue(2, $naziv, PDO::PARAM_STR);
			$upit->bindValue(3, $lokacija, PDO::PARAM_STR);
			$uspjelo = $upit->execute();

			if (!$uspjelo) {
				$greska = $veza->errorInfo();
				print "Nastala je SQL greška: " . $greska[2];
		        exit();
		    }
 		}
		else    // u slučaju da je takmičenje samo u xmlu a nije upisano u bazu, treba ga upisati u bazu
 		{
 			$upit = $veza->prepare("UPDATE takmicenje SET naziv=?, lokacija=? WHERE id=?;");
 			$upit->bindValue(1, $naziv, PDO::PARAM_STR);
 			$upit->bindValue(2, $lokacija, PDO::PARAM_STR);
 			$upit->bindValue(3, $id, PDO::PARAM_INT);
 			$uspjeh = $upit->execute();
			if (!$uspjeh) {
				$greska = $veza->errorInfo();
				print "Nastala je SQL greška: " . $greska[2];
		        exit();
		    }
 		}
	}
}


print "Takmičenja su upisana i updateovana<br>Sada ide upis takmičara<br><br>";


foreach($takmicari->takmicari->takmicar as $t)
{
	$id = $t->id;
	$id_takmicenja = $t->id_takmicenja;
	$ime = $t->ime;
	$plasman = $t->plasman;
	
	// koristimo prepared statements, radi zaštite od sql injectiona
	$upit = $veza->prepare("SELECT COUNT(*) FROM takmicar WHERE id=? and id_takmicenja=?;");
	$upit->bindValue(1, $id, PDO::PARAM_INT);
	$upit->bindValue(2, $id_takmicenja, PDO::PARAM_INT);

	$postoji = $upit->execute();

	if (!$postoji) {
	  $greska = $veza->errorInfo();
      print "Nastala je SQL greška: " . $greska[2];
      exit();
 	}
 	else
 	{
		// vraća različito od 0 ako je takmičar već u bazi, a 0 ako nije
 		$da_li_je_u_bazi = intval($upit->fetchColumn());

 		if ($da_li_je_u_bazi == 0)
 		{
			$upit = $veza->prepare("INSERT INTO takmicar (id, id_takmicenja, ime, plasman) VALUES (?, ?, ?, ?);");
			$upit->bindValue(1, $id, PDO::PARAM_INT);
			$upit->bindValue(2, $id_takmicenja, PDO::PARAM_INT);
			$upit->bindValue(3, $ime, PDO::PARAM_STR);
			$upit->bindValue(4, $plasman, PDO::PARAM_STR);
			$uspjelo = $upit->execute();

			if (!$uspjelo) {
				$greska = $veza->errorInfo();
				print "Nastala je SQL greška: " . $greska[2];
		        exit();
		    }
 		}
		else    // u slučaju da je takmičar samo u xmlu a nije upisan u bazu, treba ga upisati u bazu
 		{   
 			$upit = $veza->prepare("UPDATE takmicar SET ime=?, plasman=? WHERE id=? and id_takmicenja=?;");
 			$upit->bindValue(1, $ime, PDO::PARAM_STR);
 			$upit->bindValue(2, $plasman, PDO::PARAM_STR);
 			$upit->bindValue(3, $id, PDO::PARAM_INT);
 			$upit->bindValue(4, $id_takmicenja, PDO::PARAM_INT);
 			$uspjeh = $upit->execute();
			if (!$uspjeh) {
				$greska = $veza->errorInfo();
				print "Nastala je SQL greška: " . $greska[2];
		        exit();
		    }
 		}
	}		
}


print "Takmičari su upisani i updateovani<br>Sada ide upis novosti<br><br>";


foreach($novosti->novosti->novost as $n)
{	
	$id = $n->id;
	$naslov = $n->naslov;
	$tekst = $n->tekst;
	
	// koristimo prepared statements, radi zaštite od sql injectiona
	$upit = $veza->prepare("SELECT COUNT(*) FROM novost WHERE id=?;");
	$upit->bindValue(1, $id, PDO::PARAM_INT);

	$postoji = $upit->execute();
	
	if (!$postoji) {
	  $greska = $veza->errorInfo();
      print "Nastala je SQL greška: " . $greska[2];
      exit();
 	}
 	else
 	{
		// vraća 1 ako je novost već u bazi, a 0 ako nije
 		$da_li_je_u_bazi = intval($upit->fetchColumn());

 		if ($da_li_je_u_bazi == 0)
 		{
			$upit = $veza->prepare("INSERT INTO novost (id, naslov, tekst) VALUES (?, ?, ?);");
			$upit->bindValue(1, $id, PDO::PARAM_INT);
			$upit->bindValue(2, $naslov, PDO::PARAM_STR);
			$upit->bindValue(3, $tekst, PDO::PARAM_STR);
			$uspjelo = $upit->execute();

			if (!$uspjelo) {
				$greska = $veza->errorInfo();
				print "Nastala je SQL greška: " . $greska[2];
		        exit();
		    }
 		}
		else    // u slučaju da je novost samo u xmlu a nije upisana u bazu, treba je upisati u bazu
 		{   
 			$upit = $veza->prepare("UPDATE novost SET naslov=?, tekst=? WHERE id=?;");
 			$upit->bindValue(1, $naslov, PDO::PARAM_STR);
 			$upit->bindValue(2, $tekst, PDO::PARAM_STR);
 			$upit->bindValue(3, $id, PDO::PARAM_INT);
 			$uspjeh = $upit->execute();
			if (!$uspjeh) {
				$greska = $veza->errorInfo();
				print "Nastala je SQL greška: " . $greska[2];
		        exit();
		    }
 		}
	}		
}


print "Novosti su upisane i updateovane<br>Sada ide upis kontakt podataka<br><br>";


foreach($kontakti->kontakti->kontakt as $k)
{
	$id = $k->id;
	$id_korisnika = $k->id_korisnika;
	$email = $k->email;
	$komentar = $k->komentar;
	$pomoc_u_radu = $k->pomoc_u_radu;
	$donacija = $k->donacija;
	
	// koristimo prepared statements, radi zaštite od sql injectiona
	$upit = $veza->prepare("SELECT COUNT(*) FROM kontakt WHERE id=? and id_korisnika=?;");
	$upit->bindValue(1, $id, PDO::PARAM_INT);
	$upit->bindValue(2, $id_korisnika, PDO::PARAM_INT);

	$postoji = $upit->execute();
	
	if (!$postoji) {
	  $greska = $veza->errorInfo();
      print "Nastala je SQL greška: " . $greska[2];
      exit();
 	}
 	else
 	{
		// vraća različito od 0 ako je kontakt već u bazi, a 0 ako nije
 		$da_li_je_u_bazi = intval($upit->fetchColumn());

 		if ($da_li_je_u_bazi == 0)
 		{
			$upit = $veza->prepare("INSERT INTO kontakt (id, id_korisnika, email, komentar, pomoc_u_radu, donacija) VALUES (?, ?, ?, ?, ?, ?);");
			$upit->bindValue(1, $id, PDO::PARAM_INT);
			$upit->bindValue(2, $id_korisnika, PDO::PARAM_INT);
			$upit->bindValue(3, $email, PDO::PARAM_STR);
			$upit->bindValue(4, $komentar, PDO::PARAM_STR);
			$upit->bindValue(5, $pomoc_u_radu, PDO::PARAM_INT);
			$upit->bindValue(6, $donacija, PDO::PARAM_INT);
			$uspjelo = $upit->execute();

			if (!$uspjelo) {
				$greska = $veza->errorInfo();
				print "Nastala je SQL greška: " . $greska[2];
		        exit();
		    }
 		}
		else    // u slučaju da je kontakt samo u xmlu a nije upisan u bazu, treba ga upisati u bazu
 		{   
 			$upit = $veza->prepare("UPDATE kontakt SET email=?, komentar=?, pomoc_u_radu=?, donacija=? WHERE id=? AND id_korisnika=?;");
			$upit->bindValue(1, $email, PDO::PARAM_STR);
			$upit->bindValue(2, $komentar, PDO::PARAM_STR);
			$upit->bindValue(3, $pomoc_u_radu, PDO::PARAM_INT);
			$upit->bindValue(4, $donacija, PDO::PARAM_INT);
			$upit->bindValue(5, $id, PDO::PARAM_INT);
			$upit->bindValue(6, $id_korisnika, PDO::PARAM_INT);
 			$uspjeh = $upit->execute();
			if (!$uspjeh) {
				$greska = $veza->errorInfo();
				print "Nastala je SQL greška: " . $greska[2];
		        exit();
		    }
 		}
	}		
}

print "Kontakti su upisani i updateovani<br><br>Upis svih podataka iz xmlova je završen";

//header ('Location: Login.php');

?>