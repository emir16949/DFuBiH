// funkcija koja se poziva klikom na dugme pošalji, i vrši validaciju čitave forme na tabu O nama - Historijat
function validacijaONama() {
	var x, text, izlaz = 1;

	x = document.getElementById("imeiprezime_2");
	if(validacijaImena(x)) {
		text = "";
	} else {
		text = "Morate unijeti ime i prezime u formatu: Ime(razmak)Prezime";
		document.getElementById("par1_2").innerHTML = text;
		izlaz = 0;
	}
	
	x = document.getElementById("mail_2");
	if(validacijaMaila(x)) {
		text = "";
	} else {
		text = "Morate unijeti mail u formatu: mail@host.domena"; // mail i host minimalno po 1 karakter, domena minimalno 2 
		document.getElementById("par2_2").innerHTML = text;
		izlaz = 0;
	}
	
	x = document.getElementById("pomoc_2");
	y = document.getElementById("donacija_2");
	if(validacijaCheckboxa(x) || validacijaCheckboxa(y)) {
		text = "";
	} else {
		text = "Morate označiti barem jedno od ova dva polja";
		document.getElementById("par3_2").innerHTML = text;
		izlaz = 0;
	}

	if (izlaz == 0) return false;
	else if (izlaz == 1) return true;
}



// funkcija koja se poziva klikom na dugme pošalji, i vrši validaciju čitave forme na tabu Kontakt
function validacijaKontakt() {
	var x, text, izlaz = 1;

	x = document.getElementById("imeiprezime_5");
	if(validacijaImena(x)) {
		text = "";
	} else {
		text = "Morate unijeti ime i prezime u formatu: Ime(razmak)Prezime";
		document.getElementById("par1_5").innerHTML = text;
		izlaz = 0;
	}
	
	x = document.getElementById("mail_5");
	if(validacijaMaila(x)) {
		text = "";
	} else {
		text = "Morate unijeti mail u formatu: mail@host.domena"; // mail i host minimalno po 1 karakter, domena minimalno 2 
		document.getElementById("par2_5").innerHTML = text;
		izlaz = 0;
	}
	
	x = document.getElementById("poruka_5");
	if(validacijaPoruke(x)) {
		text = "";
	} else {
		text = "Morate unijeti neki tekst u ovo polje";
		document.getElementById("par3_5").innerHTML = text;
		izlaz = 0;
	}
	
	if (izlaz == 0) return false;
	else if (izlaz == 1) return true;
}




function validacijaImena(ime) {
	var slova = /^[A-Za-z]+\s?[A-Za-z]+$/; // Dakle treba da ide ImeRazmakPrezime
	if(ime.value.match(slova)) {ime.style.backgroundColor = "white"; return true;}
	else {ime.style.backgroundColor = "red";  return false; }
}

function validacijaMaila(mail) {
	var slova = /^[A-Za-z0-9]+@[a-z]+\.[a-z]{2,}$/; // Dakle treba da ide mail@host.ekstenzija
	if(mail.value.match(slova)) {mail.style.backgroundColor = "white"; return true;}
	else {mail.style.backgroundColor = "red";  return false; }
}

function validacijaPoruke(poruka) {
	if(poruka.value != "") {poruka.style.backgroundColor = "white"; return true;}
	else {poruka.style.backgroundColor = "red";  return false; }
}

function validacijaCheckboxa(checkboks) {
	if(checkboks.checked) return true;
	else return false;
}




// funkcija koja provjerava svaki od objekata za validaciju
function provjeraObjekti(object)
{
	if(object.name == "ime")
	{	if(!validacijaImena(object)) {
			if (object.id == "imeiprezime_5") document.getElementById("par1_5").innerHTML = "Morate unijeti ime i prezime u formatu: Ime(razmak)Prezime";
			else if (object.id == "imeiprezime_2") document.getElementById("par1_2").innerHTML = "Morate unijeti ime i prezime u formatu: Ime(razmak)Prezime";
			return false;
		} else {
			if (object.id == "imeiprezime_5") document.getElementById("par1_5").innerHTML = "";
			else if (object.id == "imeiprezime_2") document.getElementById("par1_2").innerHTML = "";
			return true;
		}
	}
	
	if(object.name == "mail")
	{	if(!validacijaMaila(object)) {
			if (object.id == "mail_5") document.getElementById("par2_5").innerHTML = "Morate unijeti mail u formatu: mail@host.domena";
			else if (object.id == "mail_2") document.getElementById("par2_2").innerHTML = "Morate unijeti mail u formatu: mail@host.domena";
			return false;
		} else {
			if (object.id == "mail_5") document.getElementById("par2_5").innerHTML = "";
			else if (object.id == "mail_2") document.getElementById("par2_2").innerHTML = "";
			return true;
		}
	}
	
	if(object.name == "poruka")
	{	if(!validacijaPoruke(object)) {
			document.getElementById("par3_5").innerHTML = "Morate unijeti neki tekst u ovo polje";
			return false;
		} else {
			document.getElementById("par3_5").innerHTML = "";
			return true;
		}
	}
	
	if(object.name == "pomoc" || object.name == "donacija")
	{
		x = document.getElementById("pomoc_2");
		y = document.getElementById("donacija_2");	
		if(!validacijaCheckboxa(x) && !validacijaCheckboxa(y)) {
			document.getElementById("par3_2").innerHTML = "Morate označiti barem jedno od ova dva polja";
			return false;
		} else {
			document.getElementById("par3_2").innerHTML = "";
			return true;
		}
	}
}






// funkcija za prikaz slike u uvećanoj verziji
function prikazSlike(naziv)
{
    document.getElementById("divProsirena").style.display = "block"; 
    setTimeout(function () {
        document.getElementById("slikaProsirena").src = naziv;
        }, 1)
}

// funkcija za sklanjanje slike klikom na esc dugme
window.onkeyup = function (event) {
    if (event.keyCode == 27) {  // kod za esc dugme
        document.getElementById("divProsirena").style.display = "none";
		document.getElementById("slikaProsirena").src = "";
    }
}