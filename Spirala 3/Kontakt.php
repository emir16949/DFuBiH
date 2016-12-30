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
				<a id="tab3" href="O_nama_Historijat.php">Historijat</a>
				<a id="tab4" href="O_nama_Slike.php">Slike</a>
			</div>
		</li>	
		<li> <a href="IPhO_i_RMPh.php">IPhO &amp; RMPh</a></li>
		<li> <a href="Login.php">Login/Registracija</a></li>
		<li> <a href="Kontakt.php" class="selektovan">Kontakt</a></li>
	</ul>
</div>

<div id="container">

 
<div class="tekst_5">
	<h2> Kontakt informacije: </h2>
	<h4> Ulica: Zmaja od Bosne 35, 71 000 Sarajevo (zgrada Prirodno-matematičkog fakulteta)</h4>
	<h4> E-mail: dfubih@gmail.com</h4>
	<h4> Kontakt telefon: 033-854-296</h4>
</div>

<div class="ocjenjivanje_5">
	<h3> Pošaljite nam pitanje:</h3>
	<form action="mailto:dfubih@gmail.com" method="post" onsubmit="return validacijaKontakt()">
		Vaše ime i prezime:<br>
		<input type="text" id="imeiprezime_5" name="ime" onblur="return provjeraObjekti(this)">
		<p id="par1_5" class="greska"></p>
		E-mail na koji ćemo Vam poslati odgovor:<br>
		<input type="text" id="mail_5" name="mail" onblur="return provjeraObjekti(this)">
		<p id="par2_5" class="greska"></p>
		Pitanje, komentar, kritika, pohvala:<br>
		<textarea id="poruka_5" rows="7" cols="25" name="poruka" onblur="return provjeraObjekti(this)"></textarea>
		<p id="par3_5" class="greska"></p>
		<input type="submit" value="Pošalji"><br>
	</form>
</div>

</div>


</body>

</html>