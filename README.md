# DFuBiH

Društvo fizičara u Bosni i Hercegovini - Emir Baručija

## Spirala 3

### I  - Šta je urađeno?

Urađene su sve stavke:

a) Urađena serijalizacija podataka u XML, i to serijalizirani korisnici (username, password, ocjena stranice), zatim takmičari na olimpijadama (godina, ime i prezime, rezultat), te novosti (naslov, tekst).
Sve je izvalidirano u phpu i stranica je zaštićena od XSS-a.
Samo admin može raditi editovanje, unos i brisanje podataka. Ostali korisnici mogu da gledaju podatke na stranici.
Adminov username je admin, password je pass.

b) Adminu omogućen download podataka o učesnicima olimpijada, u .csv formatu, dakle svi podaci koji se čuvaju u XMLu su ubačeni u csv fajl.

c) Takođe, omogućeno i kreiranje pdf izvještaja, na osnovu podataka o učesnicima na olimpijadama. Korištena fpdf biblioteka.

d) Malkice je nejasan zadatak, tako da sam ja to protumačio ovako:
Pretraga se vrši po dva polja (godina i ime takmičara). Ukoliko ima bilo kakvog podudaranja za bilo koje od polja (dakle ILI a ne I - OR forma), rezultat pretrage se smatra uspješnim.
Stranica se ne reloada, urađeno uz pomoć javascripta te GET metode u phpu.
Kada korisnik pritisne dugme traži, tada se učitavaju svi rezultati pretrage, a ne samo prvih 10.



### II  - Šta nije urađeno?

Svi traženi dijelovi su urađeni.



### III - Bug-ovi koje ste primijetili ali niste stigli ispraviti, a znate rješenje (opis rješenja)

Nisam primijetio da u commitanoj verziji ima ijedan bug.



### IV  - Bug-ovi koje ste primijetili ali ne znate rješenje

Nisam primijetio da u commitanoj verziji ima ijedan bug.



### V  - Lista fajlova u formatu NAZIVFAJLA - Opis u vidu jedne rečenice šta se u fajlu nalazi

Mislim da su sami nazivi fajlova dovoljno intuitivni da se zaključi šta se u njima radi, dakle korisnici.php vrši editovanje korisnika, recimo Login.php je fajl koji upravlja loginovanjem na stranicu i sl.