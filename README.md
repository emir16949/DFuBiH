# DFuBiH

Društvo fizičara u Bosni i Hercegovini - Emir Baručija

## Spirala 3

### I  - Šta je urađeno?

Urađene su sve stavke:

a) Urađena serijalizacija podataka u XML, i to serijalizirani korisnici (username, password, ocjena stranice), zatim takmičari na olimpijadama (godina, ime i prezime, rezultat), te novosti (naslov, tekst).
Skoro sve je izvalidirano u phpu i stranica je zaštićena od XSS-a, korištenjem html special chars.
Samo admin može raditi editovanje, unos i brisanje podataka. Ostali korisnici mogu da gledaju podatke na stranici.
Adminov username je admin, password je pass.

b) Adminu omogućen download podataka o učesnicima olimpijada, u .csv formatu, dakle svi podaci koji se čuvaju u XMLu su ubačeni u csv fajl.

c) Takođe, omogućeno i kreiranje pdf izvještaja, na osnovu podataka o učesnicima na olimpijadama. Korištena fpdf biblioteka.

d) Malkice je nejasan zadatak, tako da sam ja to protumačio ovako:
Pretraga se vrši po dva polja (godina i ime takmičara). Ukoliko ima bilo kakvog podudaranja za bilo koje od polja (dakle ILI a ne I - OR forma), rezultat pretrage se smatra uspješnim.
Stranica se ne reloada, urađeno uz pomoć javascripta te GET metode u phpu.
Kada korisnik pritisne dugme traži, tada se učitavaju svi rezultati pretrage, a ne samo prvih 10.

e) Urađen openshift, link na stranicu - http://wtprojekat-wtspirala.44fs.preview.openshiftapps.com/Spirala%203/Pocetna.php



### II  - Šta nije urađeno?

Svi traženi dijelovi su urađeni.



### III - Bug-ovi koje ste primijetili ali niste stigli ispraviti, a znate rješenje (opis rješenja)

Nisam primijetio da u commitanoj verziji ima ijedan bug.



### IV  - Bug-ovi koje ste primijetili ali ne znate rješenje

Jedino što mi je ostalo da uradim je validacija unosa i editovanja takmičara, dakle treba validirati unos i editovanje godine (staviti u regeksu da godina treba biti u intervalu od 1995 (prvo učešće BiH) - 2016), zatim da ime i prezime imaju minimalno po 2 slova (mada mislim da je kod nas najkraće prezime sa 3 slova, moguće da ima neko ime sa 2 slova), dok za rezultat treba staviti isključivo zlatna, srebrena, bronzana medalja i pohvala.
Dakle regeksi bi izgledali ovako:
1 - godina) /1995|1996|1997|1998|1999|2000|2001|2002|2003|2004|2005|2006|2007|2008|2009|2010|2011|2012|2013|2014|2015|2016/
2 - ime i prezime) /^[a-zA-z]{2,}\s[a-zA-z]{3,}/
3 - plasman) /zlatna medalja|srebrena medalja|bronzana medalja|počasna pohvala/

Dakle, ostalo je dodati provjere tih regeksa u zaglavlju, i u zavisnosti od toga kako provjere završe ispisivati greške u kodu, na isti način kao što se uradilo kod korisnik.php i novosti.php

### V  - Lista fajlova u formatu NAZIVFAJLA - Opis u vidu jedne rečenice šta se u fajlu nalazi

Mislim da su sami nazivi fajlova dovoljno intuitivni da se zaključi šta se u njima radi, dakle korisnici.php vrši editovanje korisnika, recimo Login.php je fajl koji upravlja loginovanjem na stranicu i sl.














## Spirala 4

### I  - Šta je urađeno?

Urađene su sve stavke:

a) Kreirana baza sa 5 tabela: korisnik (id, ime, username, password), kontakt (foreign key na korisnik, poruka, email...), takmicar (id_takmicenja - foreign key, ime, plasman), takmičenje (naziv, lokacija), te novost (naslov, tekst).
Veze dakle postoje između takmičara i takmičenja, te između kontakta i korisnika.

b) U admin panelu, postoji dugme, na osnovu kojeg će se adminu snimiti ili updateovati svi podaci koji se nalaze u xmlovima a ne nalaze se u bazi. Isto tako, postoji mogućnost da ako je baza incijalno prazna, da se tada iz xmlova premjeste podaci u tu bazu.

c) Sva učitavanja i spašavanja na stranici su urađena sa bazom, dakle sve se čita iz baze, biše, updatea u bazu itd. Pošto openshift nije uspio da proradi ispravno, onda je ostavljen localhost, kako bi se mogle isprobati funkcionalnosti aplikacije.

d) Pokušaj urađenog openshifta, sve urađeno po uputama, kreirana baza i sve: http://pokit.org/get/?91f940f0fd36ccff591cf9ba3f634e44.jpg
link na projekat: http://dfubihstranica-wtspirala4emirbarucija.44fs.preview.openshiftapps.com/Spirala%204/Kontakt.php .
Međutim, iz nekog razloga, bio je problem sa chmod komandom (http://pokit.org/get/?1280811baaa4225be8be84f64e634e14.jpg ), te se nije uspjelo fino commitati na openshift.
Tako da, sve u svemu, ovaj dio nije urađen, međutim, na njega je potrošeno možda i najviše vremena od svega, jer je i za treću spiralu ovo bilo urađeno, samo tada nisam znao da nakon linka treba dodati /Spirala 3/Kontakt.php, kao i ovdje što treba.

e) Web servis je urađen, web servisu se šalje GET zahtjev, i šalje se id korisnika, novosti ili takmičara, dok servis vraća sve podatke koji su vezani za navedeni ID.

f) Urađeno nekoliko primjera, primjeri upotrebe se nalaze u POSTMAN folderu (pozvan servis da vrati korisnika, novost, te dva različita takmičara).


### II  - Šta nije urađeno?

Faktički nije urađen openshift.


### III - Bug-ovi koje ste primijetili ali niste stigli ispraviti, a znate rješenje (opis rješenja)

Nisam primijetio da u commitanoj verziji ima ijedan bug.


### IV  - Bug-ovi koje ste primijetili ali ne znate rješenje

Kao što se vidi na slikama, potrudio sam se maksimalno, probavao naći na internetu šta je problem, dao sve od sebe, ali openshift i pored dvih uputstava koje sam našao, iz nekog razloga nije proradio ispravno.

### V  - Lista fajlova u formatu NAZIVFAJLA - Opis u vidu jedne rečenice šta se u fajlu nalazi

Mislim da su sami nazivi fajlova dovoljno intuitivni da se zaključi šta se u njima radi, dakle korisnici.php vrši editovanje korisnika, recimo Login.php je fajl koji upravlja loginovanjem na stranicu i sl.