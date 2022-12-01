<?php
include "connection.php";
if(key_exists('ukey',$_REQUEST)){
    $ukey=$_REQUEST['ukey'];
    $input_data=file_get_contents("php://input");
    $json_decode=json_decode($input_data,true);
    $Id=$json_decode['id'];
    $Name=$json_decode['name'];
    $Age=$json_decode['age'];
    $Dob=$json_decode['dob'];
    $School=$json_decode['school'];
    $Class2=$json_decode['uclass'];
    $Division=$json_decode['division'];
    $Status=$json_decode['status'];
    $conn=new PDO("sqlite:assigment.db");
    $dt=time();
        $update="update students set
    status='$Status',
    sid=$Id,
    name='$Name',
    age=$Age,
    dob='$Dob',
    school='$School',
    Class=$Class2,
    division='$Division',
    adate=$dt
     where sid=$ukey";
    $query=$conn->query($update);
    if($query){
        echo "Record Update Successfully";
    }else{
        echo "Something went wrong";
    }

}
else if(key_exists('email',$_REQUEST)){
    $email=$_REQUEST['email'];
$sql="select * from logtable where email='$email'";
$query=$conn->query($sql);
$fetch=$query->fetch(PDO::FETCH_ASSOC);
$out=[];
if(count($fetch)>0){
   $out[]=$fetch;
}else{
    $out['empty']=['empty'];
}
echo json_encode($out);
}
else if(key_exists('editkey',$_REQUEST)){
    $editkey=$_REQUEST['editkey'];
    $input_data=file_get_contents("php://input");
    $json_decode=json_decode($input_data,true);
    $Email=$json_decode['email'];
    $Number=$json_decode['phone'];
    $Password=$json_decode['password'];
    $conn=new PDO("sqlite:assigment.db");
        $update="update logtable set
    email='$Email',
    phone=$Number,
    password='$Password'
     where email='$editkey'";
    $query=$conn->query($update);
    if($query){
        echo "Account Update Successfully";
    }else{
        echo "Something went wrong";
    } 
}
else{
$editid=$_REQUEST['editid'];
$sql="select * from students where sid=$editid";
$query=$conn->query($sql);
$fetch=$query->fetch(PDO::FETCH_ASSOC);
$out=[];
if(count($fetch)>0){
   $out[]=$fetch;
}else{
    $out['empty']=['empty'];
}
echo json_encode($out);
}
?>