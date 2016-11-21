# DFuBiH

Društvo fizičara u Bosni i Hercegovini - Emir Baručija

## Spirala 1

### I  - Šta je urađeno?

Urađene su sve stavke:

a- Urađeni mockupi, istina nacrtani rukom, ali prikazuju sasvim fino kako bi stranica trebala da izgleda, šta će gdje biti raspoređeno i slično.

b- Svih pet tabova koji imaju, su responzivni, pri smanjivanju stranice ne dolazi do prelaska elemenata jednih preko drugih, nego korisnik ima mogućnost da skrola horizontalno (i vertikalno), ukoliko želi da vidi nešto što je nestalo iz glavnog pogleda. Takođe su izvalidirani svi .html i .css fajlovi, te je ustanovljeno da nema nikakvih grešaka u njima.

c- Pošto na mom telefonu, sve mi je izgledalo sasvim ok, i stranica se sasvim uredno prikazivala, onda sam ovdje samo promijenio veličine fonta, čisto kako bih pokazao da znam raditi sa media queries-ima, te još malo promijenio dizajn stranice "O nama". Mockupe za ovaj dio nisam radio jer bi bili praktično isti kao i oni pod a), pošto nisam pravio nikakvu suštinsku razliku u odnosu na obični slučaj, te sam stoga smatrao da nema potrebe da ponovo pravim mockupe (koji bi izgledali skoro pa identično kao prethodni).

d- Implementirane 3 forme - na "Početna" stavljena forma za ocjenu stranice, na "O nama" stavljena forma za donaciju Društvu ili za prijavu za pomoć u radu Društva, te na "Kontakt" stavljena forma kojom se može poslati upit Društvu uz ostavljanje maila na koji se može vratiti odgovor.

e- Implementiran meni, sastavljen od 5 podstranica, koji se vidi na svakoj od podstranica, i na svakoj isto izgleda.

f- Stranica nema glitcheva, urađena kao grid view, nema problema sa skaliranjima i ostalo.



### II  - Šta nije urađeno?

Svi traženi dijelovi su urađeni, takođe vođeno računa o responzivnosti web stranice i ostalim potrebnim stvarima.



### III - Bug-ovi koje ste primijetili ali niste stigli ispraviti, a znate rješenje (opis rješenja)

Nisam primijetio da u commitanoj verziji ima ijedan bug u dizajnu stranice.



### IV  - Bug-ovi koje ste primijetili ali ne znate rješenje

Postojao je jedan bug o kojem smo raspravljali na tutorijalu, da se meni na podstranici "O nama" pri manjim dimenzijama misteriozno i bez ikakvog razloga uveća, dok na ostalim ostane sasvim OK, i problem je bio baš sa tom podstranicom. Međutim, kod kuće poslije je sve bilo sasvim OK, nije bilo tih problema, tako da je vjerovatno bio neki problem sa Chrome-om.



### V  - Lista fajlova u formatu NAZIVFAJLA - Opis u vidu jedne rečenice šta se u fajlu nalazi

Mockups - Folder gdje se nalaze mockupi podstranica (5 slika za 5 podstranica)

2011_fed - slika sa Federalnog takmičenja 2011. godine za srednje škole

2012_fed_osn - slika sa Federalnog takmičenja 2012. godine za osnovne škole

2013_fed - slika sa Federalnog takmičenja 2013. godine za srednje škole

2014 - slika BH olimpijskog tima sa olimpijade 2014. godine u Kazahstanu

2014_oli - slika BH olimpijskog tima 2014. godine napravljena nakon slijetanja na Međunarodni aerodrom Sarajevo

2016 - slika BH olimpijskog tima sa olimpijade 2016. godine u Švicarskoj i Lihtenštajnu

2016_kan_osn - slika sa Kantonalnog takmičenja 2016. godine za osnovne škole

IPhO_i_RMPh - html fajl za 3. podstranicu

Kontakt - html fajl za 5. podstranicu

O_nama - html fajl za 2. podstranicu

Pocetna - html fajl za 1. podstranicu

Stil - css fajl za čitavu stranicu

Takmicenja - html fajl za 4. podstranicu







## Spirala 2

### I  - Šta je urađeno?

Urađene su sve stavke:

a- Urađene validacije svih formi, validacija forme na tabu Historijat, i na tabu Kontakt, u potpunosti izvalidirane od grešaka

b- Urađen dropdown meni na tabu O nama, koji nudi dvije opcije, Historijat i Slike, tako da kada se klikne na Historijat otvori historijat Društva, sa formom za slanje donacije i pomoć u radu Društva, dok klikom na tab slike se otvaraju slike sa prethodnih olimpijada

c- Urađeno da se klikom na sliku (inače se to radi u tabu Slike), povećava slika na širinu ekrana, i onda se može zatvoriti jedino klikom na esc dugme

d- Iskorišten ajax kako bi se reload-ao jedino donji dio stranice, dakle ispod menija, a ostalo ostaje isto i ne reload-a se



### II  - Šta nije urađeno?

Svi traženi dijelovi su urađeni, dakle u dijelu B urađen dropdown meni i povećanje slike klikom na nju, te uklanjanje klikom na esc dugme (1 + 3 = 4 boda)



### III - Bug-ovi koje ste primijetili ali niste stigli ispraviti, a znate rješenje (opis rješenja)

Nisam primijetio da u commitanoj verziji ima ijedan bug u dizajnu stranice.



### IV  - Bug-ovi koje ste primijetili ali ne znate rješenje

Nisam primijetio da u commitanoj verziji ima ijedan bug u dizajnu stranice.



### V  - Lista fajlova u formatu NAZIVFAJLA - Opis u vidu jedne rečenice šta se u fajlu nalazi

2011_fed - slika sa Federalnog takmičenja 2011. godine za srednje škole

2012_fed_osn - slika sa Federalnog takmičenja 2012. godine za osnovne škole

2013_fed - slika sa Federalnog takmičenja 2013. godine za srednje škole

2014 - slika BH olimpijskog tima sa olimpijade 2014. godine u Kazahstanu

2014_oli - slika BH olimpijskog tima 2014. godine napravljena nakon slijetanja na Međunarodni aerodrom Sarajevo

2016 - slika BH olimpijskog tima sa olimpijade 2016. godine u Švicarskoj i Lihtenštajnu

2016_kan_osn - slika sa Kantonalnog takmičenja 2016. godine za osnovne škole

index - glavni html fajl gdje se nalaze sve deklaracije, head tag, meni, zaglavlje i ostalo

IPhO_i_RMPh - html kostur za 3. tab

Kontakt - html kostur za 5. tab

O_nama_Historijat - html kostur za 1. podstranicu 2. taba

O_nama_Slike - html kostur za 2. podstranicu 2. taba

Pocetna - html kostur za 1. tab

Skripta - javascript fajl, gdje se nalazi kod za validaciju, prikaz uvećane slike, njeno uklanjanje klikom na esc dugme, te dio vezan za ajax

Stil - css fajl za čitavu stranicu

Takmicenja - html kostur za 4. tab