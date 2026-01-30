<?php
//require_once "../Controller/dbConfig.php";
require_once("../dbLocal.php");
// if(isset($_POST['get'])){

    $sql="SELECT * FROM `Job`";

$res= mysqli_query($conn,$sql);
    if($res){
    ob_clean();
    echo "The fetched data are viewed";
    $response=array();
    while ($row=mysqli_fetch_assoc($res)) {
            $response[]= $row;
    }
    header('Content-Type: application/json');
    echo(json_encode($response)); 
    exit();
    }
    else{
            echo "Error: ".$sql ."<br>".$conn->error;
        }
        $conn->close();
//}
?>
<?php
include_once "./lib/fpdf.php";

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Output();
?>