<?php
$input_data=file_get_contents("php://input");
$json_decode=json_decode($input_data,true);
$Id=$json_decode['id'];
$Name=$json_decode['name'];
$Age=$json_decode['age'];
$Dob=$json_decode['dob'];
$School=$json_decode['school'];
$Class2=$json_decode['Class'];
$Division=$json_decode['division'];
$Status=$json_decode['status'];
$conn=new PDO("sqlite:assigment.db");
$select=$conn->query("select * from students");
$fetch=$select->fetchAll(PDO::FETCH_ASSOC);
if(count($fetch)>0){
    $match="";
    foreach($fetch as $value){
        if($value['sid']==$Id){
            $match="found";
            break;
        }
    }
    if($match=="found"){
        echo "Student Id Already Exit";
    }else{
        $dt=time();
        $insert="insert into students (sid,name,age,dob,school,Class,division,status,adate)values($Id,'$Name',$Age,$Dob,'$School',$Class2,'$Division','$Status',$dt)";
        $query=$conn->query($insert);
        if($query){
            echo "Record Save Successfully";
        }else{
            echo "Something went wrong";
        }
    }
}
else{
    $dt=time();
    $insert="insert into students (sid,name,age,dob,school,Class,division,status,adate)values($Id,'$Name',$Age,$Dob,'$School',$Class2,'$Division','$Status',$dt)";
    $query=$conn->query($insert);
    if($query){
        echo "Record Save Successfully";
    }else{
        echo "Something went wrong";
    }
} 

?>