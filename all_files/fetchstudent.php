<?php
include "connection.php";
if(key_exists("search",$_REQUEST)){
    $output=[];
$found=0;
$search=$_REQUEST['search'];
$sql=$conn->query("select * from students where name LIKE '%{$search}%'");
while($row=$sql->fetch(PDO::FETCH_ASSOC)){
    $output[]=$row;
    $found=1;
}
if($found!=1){
$output['empty']=['empty'];
}

echo json_encode($output);
}else{
    $limit=5;
    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);
    if(isset($decode['page'])){
        $page=$decode['page'];

    }else{
        $page=1;
    }
    $offset=($page- 1)*$limit;
   

$sql=$conn->query("select * from students limit $offset,$limit");
$output=[];
$found=0;
while($row=$sql->fetch(PDO::FETCH_ASSOC)){
    $output[]=$row;
    $out=array("output"=>$output,"page"=>$page);
    $found=1;
}
if($found!=1){
$output['empty']=['empty'];
}

echo json_encode($out);

}

?>