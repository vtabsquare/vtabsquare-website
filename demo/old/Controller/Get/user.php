<?php
// require_once "../dbConfig.php";
require_once("../dbLocal.php");
// if(isset($_POST['get'])){

$sql="SELECT * FROM `user`";

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