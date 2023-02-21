<?php
require('/app/api/fpdf185/fpdf.php');

class testData{
    public $name;
    public $price;
    public $time;
    function set_name($name) {
        $this->name = $name;
      }
      function set_price($price) {
        $this->price = $price;
      }
      function set_time($time) {
        $this->time = $time;
      }
}

$data = new testData();
$data->set_name("jazz");
$data->set_price(12);
$data->set_time("12:00");


class PDF extends FPDF
{
function Header()
{
    $this->SetFont('Times','B',15);
    $this->SetTextColor(155, 28, 49);
    $this->SetDrawColor(155, 28, 49);
    $this->Cell(100,10,'Your personal program', 1, 0,'C');
    
    $this->Ln(20);
}

function Footer()
{
    $this->Ln(7);
    $this->Cell(0, 0,"Have fun at the festival!", 0, 0, 'C');
    $this->Ln(7);
    $this->SetY(-15);
    $this->SetFont('Arial','I',8);
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}



$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetTextColor(30, 47, 84);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 0,"Thank you for ordering tickets for The Festival.", 0, 1,'C');
$pdf->Ln(7);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 0,"Find your tickets below.", 0, 1,'C');

$pdf->Ln(7);
$pdf->Cell(0, 1, 'Jazz', 0, 1);
$pdf->Ln(5);
$padding = 7;

$qr_width = 60;
$qr_height = 60;

// Set name, time, and amount cell width
$nta_width = ($pdf->GetPageWidth() - $qr_width - 3 * $padding) / 3;

$pdf->SetFillColor(204, 219, 220);
$pdf->SetDrawColor(204, 219, 220);
$pdf->SetTextColor(0,0,0);

$string = "https://www.youtube.com/watch?v=dQw4w9WgXcQ";

for ($i=0; $i < 3; $i++) { 
    $pdf->Cell($nta_width, $qr_height, 'Name', 1, 0, 'C', true);
    $pdf->Cell($nta_width, $qr_height, 'Time', 1, 0, 'C', true);
    $pdf->Cell($nta_width, $qr_height, 'Amount', 1, 0, 'C',true);
    $pdf->Cell($qr_width, $qr_height, '', 1, 0, 'C', true);
    $pdf->Image('https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl="'.$string.'"&choe=UTF-8', $qr_width*2.5, $pdf->GetY() + $padding, $qr_width - 2 * $padding, $qr_height - 2 * $padding, 'PNG');
    $pdf->Ln(65);
}



$pdf->Output();
?>
