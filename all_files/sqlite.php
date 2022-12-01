<?php
session_start();
if(key_exists("logout",$_REQUEST)){
session_destroy();
header("location:logfile.php");
}
if(key_exists("key",$_REQUEST)){
$input_data=file_get_contents("php://input");
$json_decode=json_decode($input_data,true);
$email=$json_decode['email'];
$pnumber=$json_decode['number'];
$password=$json_decode['password'];
$conn=new PDO("sqlite:assigment.db");
$select=$conn->query("select * from logtable");
$row=$select->fetchAll(PDO::FETCH_ASSOC);
if(count($row)>0){
    $match="";
foreach($row as $value){
    if($value['email']==$email){
        echo "User Email Id Already Exit";
        $match="find";
        break;
    }
    else if($value['phone']==$pnumber){
        echo "User Contect Number Already Exit";
        $match="find";
        break;
    }
    else if($value['password']==$password){
        echo "User Password Already Exit";
        $match="find";
        break;
    }
}
if($match==""){
    $query=$conn->query("insert into logtable values('{$email}',$pnumber,'{$password}')"); 
    if($query){
        echo "Account Created Successfully";
    }  else{
        echo "something went wrong";
    }
}
}
else{
    $query=$conn->query("insert into logtable values('$email',$pnumber,'$password')"); 
    if($query){
        echo "Account Created Successfully";
    }  else{
        echo "something went wrong";
    }
}
}


//login code here

if(key_exists("log",$_REQUEST)){
    $match="";
    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);
    $email_phone=$decode['email'];
    $password=$decode['password'];
    $conn=new PDO("sqlite:assigment.db");
    $select_data=$conn->query("select * from logtable");
    $fetch=$select_data->fetchAll(PDO::FETCH_ASSOC);
    if(count($fetch)>0){
        foreach($fetch as $value){
            if($email_phone==$value['email'] || $email_phone==$value['phone']){
                $user_email="";
            if($password==$value['password']){
                    $user_password="";
                    break;
            }else{
                $user_password="not match";
                break;
            }
            }else{
                $user_email="not match";
            }
        }
        if($user_email=="not match"){
            echo "email or number not match";
        }else if($user_password=="not match"){
            echo "password not match";
        }
        else{
                echo "login success";
                $_SESSION['permit']="login";
        }
    }else{
        echo "Record Not Exit In Table";
    }
}
?>