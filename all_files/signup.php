<?php
$input=file_get_contents("php://input");
$decode=json_decode($input,true);
$email=$decode['email'];
$number=$decode['number'];
$password=$decode['password'];
$newArray=array(
"Email"=>$email,
"Number"=>$number,
"Password"=>$password
);
$data_file="data.json";
if(file_exists($data_file)){
    $file=file_get_contents($data_file);
    $json_decode=json_decode($file,true);
    if($json_decode!=null){
        $emailkey=array_search($email,array_column($json_decode,'Email'));
        $passwordkey=array_search($password,array_column($json_decode,'Password'));
        $numberkey=array_search($number,array_column($json_decode,'Number'));
        if($json_decode[$emailkey]['Email']==$email){
            echo json_encode("Email Id Already Exit");
        }
        else if($json_decode[$passwordkey]['Password']==$password){
            echo json_encode("Password Already Exit");
        }
        else if($json_decode[$numberkey]['Number']==$number){
            echo json_encode("Phone Number Already Exit");
        }
        else{
            $json_decode[]=$newArray;
            file_put_contents($data_file,json_encode($json_decode,JSON_PRETTY_PRINT));
            $out=json_encode(array("success"=>"Record Save Successfully"));
            echo $out;
        }
    }
    else{
        $json_decode[]=$newArray;
        file_put_contents($data_file,json_encode($json_decode,JSON_PRETTY_PRINT));
        $out=json_encode(array("success"=>"Record Save Successfully"));
        echo $out;
    }
   
   
}else{
    echo json_encode("file not exits");
}
?>