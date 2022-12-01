<?php
session_start();
if(!isset($_SESSION['permit'])){
    header("location:logfile.php");
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Form</title>
    <link rel="stylesheet" href="../style/studentform.css">
    <style>
 
    </style>
</head>
<body>
<?php
include "dashboard.php";
?>

<div class="container">
<form action="" name="frm2" id="frm">
<h2 id="title">Insert New Record</h2>
<div class="message">
  <div class="success"></div>
  <div class="error"></div>
</div>
<div class="input_field">
    <label for="id">Enter Student Id</label>
<input type="number" placeholder="Enter Student Id" id="id">
</div>
<div class="input_field">
    <label for="name">Enter Student Name</label>
<input type="text" placeholder="Enter Student Name" name="name" id="name">
</div>
<div class="input_field">
    <label for="age">Enter Student Age</label>
<input type="number" placeholder="Enter Student Age" id="age">
</div>
<div class="input_field">
    <label for="dob">Date Of Birth</label>
    <input type="date" name="dob" id="dob"></td>
</div>
<div class="input_field">
    <label for="school">School</label>
<select name="" id="school">
<option value="">Select...</option>
<option value="Lead School Karmala">Lead School Karmala</option>
</select>
</div>
<div class="input_field">
    <label for="school">Class</label>
<select name="" id="Class">
<option value="">Select Class ...</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
</select>
</div>
<div class="input_field">
    <label for="school">Division</label>
<select name="" id="division">
<option value="">Select ...</option>
<option value="S">S</option>
<option value="A">A</option>
<option value="B">B</option>
<option value="C">C</option>
<option value="D">D</option>
<option value="Fail">Fail</option>
</select>
</div>
<!-- <div class="input_field">
    <label for="dob">Choose Picture</label>
    <input type="file" name="sphoto" id="photo"></td>
</div> -->
<div class="input_field">
    <label for="school">Status</label>
    <div class="radio">
    <input type="radio" id="active" name="stu"  value="active"><label for="active"> Active</label>
<input type="radio" id="inactive" name="stu" value="inactive"> <label for="inactive"> Inactive</label>
</div>
</div>
<button id="save_data">Save Data</button>
</form>
</div> 
</body>
</html>

<script>
document.getElementById("save_data").addEventListener("click",fun1);
function fun1(e){
    e.preventDefault();
   let id=document.getElementById("id").value;
   let name=document.getElementById("name").value;
   let age=document.getElementById("age").value;
   let dob=document.getElementById("dob").value;
   let school=document.getElementById("school").value;
    let Class=document.getElementById("Class").value;
    let division=document.getElementById("division").value;

    active=document.querySelector("#active");
    inactive=document.querySelector("#inactive");
    if(active.checked==true){
        status="Active";
    }
    else if(inactive.checked==true){
        status="Inactive";
    }
    else{
        status="";
    }
    var formData={
        "id":id,
        "name":name,
        "age":age,
        "dob":dob,
        "Class":Class,
        "school":school,
        "division":division,
        "status":status
    }
    if(id=="" || name=="" || age=="" || dob=='' || school=='' ||dob=='' || Class=='' || division=='' || status==''){
        alert("All Fields Are Required");
    }else{
        document.querySelector(".message").style.height="30px";
        fetch("studentform.php",{
            method:"POST",
            body:JSON.stringify(formData),
            headers:{
                'Content-Type':'application/text',
            },
        })
        .then((resp)=>resp.text())
        .then((res)=>{
            if(res=="Record Save Successfully"){
        document.querySelector(".success").innerHTML=res;
        
    document.getElementById("frm").reset();
    setTimeout(hide,3000);
       function hide(){
        document.querySelector(".success").innerHTML="";
        document.querySelector(".message").style.height="0";
       }
    }else{
        document.querySelector(".error").innerHTML=res;
       setTimeout(hide,3000);
       function hide(){
        document.querySelector(".error").innerHTML="";
        document.querySelector(".message").style.height="0";
       }
    }
        })
        .catch((err)=>{
            document.querySelector(".error").innerHTML=res;
        })
    }
}
</script>