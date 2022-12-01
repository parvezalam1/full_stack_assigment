<?php
include "connection.php";
if(key_exists('email',$_REQUEST)){
    $email=$_REQUEST['email'];
    $sel="delete from logtable where email='$email'";
    if($conn->query($sel)){
        echo json_encode("account delete successfully");
    }
    else{
        echo json_encode("Something went wrong");
    }
}
else{
$delid=$_REQUEST['delid'];
$sel="delete from students where sid=$delid";
if($conn->query($sel)){
    echo json_encode("record delete successfully");
}
else{
    echo json_encode("Something went wrong");
}
}
?>