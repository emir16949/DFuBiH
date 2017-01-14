<?php
require('./fpdf181/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
		$this->SetFont('Times', 'B', 20);
		$this->Cell(20, 20, 'Izvjestaj u .pdf formatu za stranicu DFuBiH');
    }

    function Footer()
    {
		$this->SetY(-20);
		$this->SetFont('Arial', '', 12);
		$this->Cell(0, 10, 'Stranica '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }
}

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times', '', 14);
	$naslov = array('Naziv', 'Ime i prezime', 'Plasman');

	$pdf->SetX(10);
	$pdf->SetFont('Times', 'B', 14);
	$pdf->Cell(30, 50, $naslov[0], 0);
	$pdf->Cell(50, 50, $naslov[1], 0);
	$pdf->Cell(40, 50, $naslov[2], 0);

	$pdf->Ln();

    $pdf->SetY(45);
	$pdf->SetFont('Times', '', 14);
	
	$veza = new PDO('mysql:host=' . getenv('MYSQL_SERVICE_HOST') . ';port=3306;dbname=baza', 'admin', 'adminpass');
	//$veza = new PDO("mysql:dbname=baza;host=localhost;charset=utf8", "root", "");
	$veza->exec("set names utf8");
	$upit = $veza->query("SELECT * FROM takmicar t, takmicenje tak WHERE t.id_takmicenja = tak.id;");
    foreach($upit as $tak)
    {
		$pdf->Cell(30, 8, $tak["naziv"]);
		$pdf->Cell(50, 8, $tak["ime"]);
		$pdf->Cell(40, 8, $tak["plasman"]);
		
		$pdf->Ln(); 
	}
	$pdf->Ln();

    $pdf->SetX(15);
    $pdf->SetY(40);
    $pdf->Output();
?>