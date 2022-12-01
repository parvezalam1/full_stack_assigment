<?php
include "connection.php";


$sql=$conn->query("select * from logtable");
$output=[];
$found=0;
while($row=$sql->fetch(PDO::FETCH_ASSOC)){
    $output[]=$row;
    $found=1;
}
if($found!=1){
$output['empty']=['empty'];
}
echo json_encode($output);




?>