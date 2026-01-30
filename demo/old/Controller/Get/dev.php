<?php
// require_once "../dbConfig.php";
require_once("../dbLocal.php");
// if(isset($_POST['get'])){
$id=$_POST['perf_id'];
$sql="SELECT * FROM  `performance`,`user` WHERE performance.perf_id=user.user_id AND user.user_id=$id";

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