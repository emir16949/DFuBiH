function pretrazi() {
	var zahtjev = new XMLHttpRequest();

	zahtjev.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200) 
		{
			document.getElementById('pretraga_rezultati').innerHTML = this.responseText;
		}
	}
  	var upit1 = document.getElementById('pretraga_godina').value;
  	var upit2 = document.getElementById('pretraga_ime').value;
    zahtjev.open("GET","pretrage.php?godina=" + upit1 + "&ime=" + upit2, true);
	zahtjev.send();
}

function trazi_sve()
{
	var zahtjev = new XMLHttpRequest();

	zahtjev.onreadystatechange = function() 
	{
	    if (this.readyState == 4 && this.status == 200) 
		{
			document.getElementById('pretraga_rezultati').innerHTML = this.responseText;	      
    	}
  	}
	var upit1 = document.getElementById('pretraga_godina').value;
  	var upit2 = document.getElementById('pretraga_ime').value;
    zahtjev.open("GET","pretrage.php?sve=1&godina=" + upit1 + "&ime=" + upit2, true);
	zahtjev.send();	
}