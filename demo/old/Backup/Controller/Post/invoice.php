<?php
// require_once "../dbConfig.php";
require_once("../dbLocal.php");
if(isset($_POST['Submit'])){
    $name=$_POST['name'];
    $dob=$_POST['dob'];
    $address=$_POST['address'];
    $email=$_POST['email'];
    $contact=$_POST['contact'];
    $linkedIn=$_POST['linkedIn'];
    $position=$_POST['position'];
    $about=$_POST['about'];
    $cv=$_POST['cv'];
    echo"LEVEL 2";
        if(mysqli_connect_error()){
            die('Connect Error ('.mysqli_connect_error().')'.mysqli_connect_error());
        }
        else{
                $sql="INSERT INTO Job (Name,DOB,Address,Email,Contact,LinkedIn,Position,About) values ('$name','$dob','$address','$email','$contact','$linkedIn','$position','$about')";
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

