<!DOCTYPE html>

<html>

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="Stil.css">
	<meta name="viewport" content="width=device-width" />
	<script type="text/javascript" src="Skripta.js"></script>
	<title>DFuBiH</title>
</head>


<body>

<div id="divProsirena">
	<img id="slikaProsirena" alt="" src="empty"/>
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
				<a id="tab3" href="O_nama_Historijat.php" class="selektovan">Historijat</a>
				<a id="tab4" href="O_nama_Slike.php">Slike</a>
			</div>
		</li>	
		<li> <a href="IPhO_i_RMPh.php">IPhO &amp; RMPh</a></li>
		<li> <a href="Login.php">Login/Registracija</a></li>
		<li> <a href="Kontakt.php">Kontakt</a></li>
	</ul>
</div>

<div id="container">

<div class="prviRed_2">
<div class="tekst_2">
	<p> Društvo fizičara u BiH je sa radom počelo 1996. godine. Primarni zadatak društva je organizacija takmičenja za srednje škole,
	te slanje učesnika na međunarodne olimpijade iz fizike (IPhO - International Physics Olympiad, te RMPh - Romanian Master of Physics). <br><br>
	Od 1996. godine do danas, reprezentativci Bosne i Hercegovine su osvojili veliki broj medalja. Riječ je o 8 srebrenih medalja,
	5 bronzanih, te 19 pohvala. Svake godine se vrše pripreme takmičara za međunarodnu olimpijadu iz fizike, koja se ove školske godine održava u Indoneziji, na Baliju. <br><br>
	Predsjednik društva je prof. dr. Rajfa Musemić, profesorica na Mašinskom fakultetu Univerziteta u Sarajevu, koja već dugi niz godina sa uspjehom rukovodi radom društva.
	Raniji takmičari pomažu u radu društva, učešćem u komisijama za takmičenja, davanjem zadataka, te pripremanjem učesnika za olimpijadu. <br><br>
	Na prošlogodišnjoj olimpijadi, koja se održala u Cirihu u Švicarskoj, te Lihtenštajnu, BH tim je osvojio 2 srebrene medalje, te 1 pohvalu, što je najbolji rezultat BH tima
	u dosadašnjim učešćima. <br><br>
	Sam autor ove stranice je takođe bio učesnik na Olimpijadi, i to onoj 2014. godine koja se održala u Astani, u Kazahstanu, te je osvojio počasnu pohvalu. <br><br>
	Svi članovi društva daju nesebičnu podršku njegovom radu, te se nadamo da će naši predstavnici i ove godine s uspjehom predstaviti Bosnu i Hercegovinu na
	Međunarodnoj olimpijadi iz fizike, IPhO 2017, i ŽELIMO IM PUNO USPJEHA U RADU. </p>
</div>

<div class="popunjavanje_2">
	<h3> Ukoliko želite da pomognete u radu društva ili donirate novac javite nam se na mail:</h3>
	<form action="mailto:dfubih@gmail.com" method="post" onsubmit="return validacijaONama()">
		Vaše ime i prezime:<br>
		<input type="text" id="imeiprezime_2" name="ime" onblur="return provjeraObjekti(this)">
		<p id="par1_2" class="greska"></p>
		E-mail na koji ćemo Vam se javiti:<br>
		<input type="text" id="mail_2" name="mail" onblur="return provjeraObjekti(this)">
		<p id="par2_2" class="greska"></p>
		<input type="checkbox" id="pomoc_2" value="Pomoc za drustvo" name="pomoc" onchange="return provjeraObjekti(this)"> Želim pomoći u radu društva<br>
		<input type="checkbox" id="donacija_2" value="Donacija za drustvo" name="donacija" onchange="return provjeraObjekti(this)"> Želim donirati sredstva za društvo <br>
		<p id="par3_2" class="greska"></p>
		<input type="submit" value="Pošalji"><br>
	</form>
</div>

</div>


</div>


</body>

</html>