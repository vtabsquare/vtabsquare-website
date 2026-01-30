<?php
// require_once "../dbConfig.php";
require_once("../dbLocal.php");
if(isset($_POST['Submit'])){
    $process=$_POST['process'];
    $step=$_POST['step'];
    $status=$_POST['status'];
    $completedOn=$_POST['completedOn'];
    $dueDate=$_POST['dueDate'];
    $person=$_POST['person'];
    $comment=$_POST['comment'];
        if(mysqli_connect_error()){
            die('Connect Error ('.mysqli_connect_error().')'.mysqli_connect_error());
        }
        else{
                $sql="INSERT INTO performance (process,step,completedOn,dueDate,person,comment) values ('$process','$step','$status','$completedOn','$dueDate','$person','$comment')";
                if($conn->query($sql)=== TRUE){
                        ob_clean();
                        echo "New record is inserted successfully";
                        header("./index1.html");
                        exit();
                }
                else{
                       echo "Error: ".$sql ."<br>".$conn->error;
                    }
                    $conn->close();
                }
    }
?>

