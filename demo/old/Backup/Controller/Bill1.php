<?php 
require_once('./dbLocal.php');
include_once "./lib/fpdf.php"; 

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('../View/assets/Images/VTabicon.jpg',10,6,25,25,'jpg');
    // Arial bold 25
    $this->SetFont('times','B',25);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'VTAB SQUARE PVT LTD',0,1,'C');
    $this->Ln(10);
    $this->SetFont('times', 'B', 14);
    // $this->Cell(0, 5, ' ISO 9001:2005 Certified Company', 0, 1,'C');
    // $this->Cell(0, 5, 'BUSSINESS SOLUTIONS - SOFTWARE DEVOLPMENT & IT SUPPORT', 0, 1,'C');
    $this->Cell(25);
     $this->Cell(0,8,'17/99, 2nd Floor, 5th Street, lyyappa Nagar, N.S.Puram, Vijayalakshmi Mills,',0,1,'C', false, 'https://goo.gl/maps/EwhHPfbyDb1Y7qXG6');
    $this->Cell(0, 8, 'Kuniyamuthur, Coimbatore - 641 008', 0, 1,'C',false, 'https://goo.gl/maps/EwhHPfbyDb1Y7qXG6');
    $this->Ln(15);

}

}
// Instanciation of inherited class
$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Image('../View/assets/Images/logo.jpg', 50,80, 110, 110);
$pdf->SetAutoPageBreak(true, 20);
$sql= "SELECT * FROM `mock_data`";
$res= mysqli_query($conn,$sql);
if($res){
    //User Details
    $pdf->SetFillColor(122, 171, 62);
    $pdf->SetFont('times','B',17);
    $pdf->Cell(0, 4, 'PaySlip for month of APR,2021', 0, 1,'C');
    $pdf->ln(5);
    $pdf->Cell(0, 0.6, '', 0, 1,'C',true);
    $pdf->ln(5);
    $pdf->SetFont('times','',14);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 1,"L",true);
    $pdf->Cell(40,10,'NAME', 0, 0,"L");
    $pdf->Cell(40,10,'Sachin Tendulkar', "", 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'EMPLOYEE ID', "", 0,"L");
    $pdf->Cell(40,10,'BPTL/001', "", 1,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 1,"L",true);
    $pdf->Cell(40,10,'DESTINATION', "", 0, "L");
    $pdf->Cell(40,10,'Co-founder', "", 0, "L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'BANK NAME', 0, 0, "L");
    $pdf->Cell(40,10,'Andra Bank', 0, 1, "L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 1,"L",true);
    $pdf->Cell(40,10,'DEPARTMENT', 0, 0, "L");
    $pdf->Cell(40,10,'Co-Founder', 0, 0, "L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'BANK A/C NO', 0, 0, "L");
    $pdf->Cell(40,10,'401210000987', 0, 1, "L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 1,"L",true);
    $pdf->Cell(40,10,'LOCATION', 0, 0, "L");
    $pdf->Cell(40,10,'Bangaluru', 0, 0, "L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'PAN', 0, 0, "L");
    $pdf->Cell(40,10,'BPTL46575MO', 0, 1, "L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 1,"L");
    $pdf->Cell(40,10,'L.O.P', 0, 0, "L");
    $pdf->Cell(40,10,'0.0', 0, 0, "L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'', 0, 0, "R");
    $pdf->Cell(40,10,'', 0, 1, "R");
    $pdf->ln(15);
    
    //Salary Details
    $pdf->SetFillColor(122, 171, 62);
    $pdf->Cell(0, 0.6, '', 0, 1,'C',true);
    $pdf->ln(5);
    $pdf->SetFont('times','',14);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 1,"L",true);
    $pdf->Cell(40,10,'Earnings', 0, 0,"L");
    $pdf->Cell(40,10,'Amount', "", 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'Deduction', "", 0,"L");
    $pdf->Cell(40,10,'Amount', "", 1,"L");
    $pdf->ln(5);
    $pdf->Cell(0, 0.6, '', 0, 1,'C',true);
    $pdf->ln(5);
    $pdf->SetFont('times','',14);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 1,"L",true);
    $pdf->Cell(40,10,'Basic', 0, 0,"L");
    $pdf->Cell(40,10,'83,333.50', "", 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'Income Tax', "", 0,"L");
    $pdf->Cell(40,10,'31,444.75', "", 1,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 1,"L",true);
    $pdf->Cell(40,10,'HRA', "", 0, "L");
    $pdf->Cell(40,10,'41,666.75', "", 0, "L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'Provident Fund', 0, 0, "L");
    $pdf->Cell(40,10,'1,800', 0, 1, "L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 1,"L",true);
    $pdf->Cell(40,10,'Telephone', 0, 0, "L");
    $pdf->Cell(40,10,'0.83', 0, 0, "L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'Professional Tax', 0, 0, "L");
    $pdf->Cell(40,10,'200', 0, 1, "L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 1,"L");
    $pdf->Cell(40,10,'Bonus', 0, 0, "L");
    $pdf->Cell(40,10,'0.00', 0, 0, "L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'', 0, 0, "L");
    $pdf->Cell(40,10,'', 0, 1, "L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 1,"L");
    $pdf->Cell(40,10,'LTA', 0, 0, "L");
    $pdf->Cell(40,10,'0.00', 0, 0, "L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'', 0, 0, "L");
    $pdf->Cell(40,10,'', 0, 1, "L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 1,"L");
    $pdf->Cell(40,10,'Special Allowance', 0, 0,"L");
    $pdf->Cell(40,10,'29,667.00', "", 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'', "", 0,"L");
    $pdf->Cell(40,10,'', "", 1,"L");
    $pdf->ln(8);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(10,0.3,'', 0, 0,"L");
    $pdf->Cell(40,0.3,'', 0, 0,"L",true);
    $pdf->Cell(40,0.3,'', 0, 1,"L",true);
    $pdf->Cell(40,10,'Total Earnings', 0, 0,"L");
    $pdf->Cell(40,10,'154,668.04', "", 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(10,10,'', 0, 0,"L");
    $pdf->Cell(40,10,'Total Deductions', "", 0,"L");
    $pdf->Cell(40,10,'33,444.84', "", 1,"L");
    $pdf->ln(8);
    $pdf->Cell(250,10,'Net Pay for the month: 119,423.24', "", 1,"L");
    $pdf->ln(5);
    $pdf->Cell(250,0.3,'', 0, 1,"L",true);

}
$pdf->Output();
?>
