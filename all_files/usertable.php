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
    <title>show student records</title>
    <link rel="stylesheet" href="../style/showstudent.css">
    <style>
        .container{
    width: 80%;
 
    height: 95vh;
    display: flex;
    justify-content:flex-start;
    align-items: center;
    flex-direction: column;
    background: linear-gradient(#904,#340,#010);
}
.container input{
width:200px;
height:30px;
text-align:center;
font-size:18px;
}
        table{
            width:30%;
            border:0.5px solid black;
            /* overflow: auto; */
        }
        table tr th,td{
            white-space:nowrap;
            padding:8px;
            border:0.5px solid black;
            background:green;
            box-shadow:0px 0px 10px #fff;
            text-align:center;
        }
        #efrm{
            visibility:hidden;
        }
        form{
    position:absolute;
    top:0px;
    left:25%;
    z-index: 100;
    width: 50%;
    min-height: 40%;
    background-color: gray;
    display: flex;
    justify-content:flex-start;
    align-items: center;
    flex-direction: column;

}
 form .input_field input{
    width: 60%;
    height: 30px;
    text-align: center;
    font-weight: bold;
    font-size: 16px;
    background:red;
}
 form input[type='radio']{
    width: 15px;
    height: 15px;
    padding: 3px;
    margin-left: 5px;
}
form .input_field{
    width: 80%;
    min-height: 7%;
    margin-top: 5px;
    display: flex;
    justify-content:center;
    align-items: center;
    flex-direction: row;

}
form button{
    width: 110px;
    height: 30px;
    background: #340;
    color: #fff;
    font-size: 16px;
    font-weight: bold;
}
.message{
    position: relative;
    width: 290px;
    height: 20px;
    transition: height 0.5s;
    overflow: hidden;
}
.message .success{
    position: absolute;
    left: 0px;
    top: 0px;
    width: 290px;
    text-align:center;
    text-align: center;
background-color: #091;
}
.message .error{
    position: absolute;
    left: 0px;
    top: 0px;
    text-align:center;
    width: 290px;
    text-align: center;
    background-color: red;
    }
    form .crose{
        position: relative;
        right:-200px;
        top:10px;
        width:30px;
        height:30px;
        border-radius:50%;
        border:2px solid black;

    }
    form .crose:before{
        content:'';
        position:absolute;
        top:50%;
        left:0px;
        width:100%;
        height:5px;
        background:red;
       transform:rotate(45deg);
    }
    form .crose:after{
        content:'';
        position:absolute;
        top:50%;
        left:0px;
        width:100%;
        height:5px;
        background:red;
       transform:rotate(-45deg);
    }
    body{
            overflow-x: hidden;
        }
        #delete{
        display:inline-block;
        width:70px;
        height:25px;
        text-align:center;
        line-height:25px;
        color:black;
        background:red;
        text-decoration:none;
    }
    #edit{
        display:inline-block;
        width:70px;
        height:25px;
        text-align:center;
        line-height:25px;
        color:#fff;
        background:black;
        text-decoration:none;
    }


        @media only screen and (min-width:360px) and (max-width:960px){
    .container{
    position:relative;
    width: 100%;
    height: 95vh;
    display: flex;
    justify-content:flex-start;
    align-items: center;
    flex-direction: column;
    background: linear-gradient(#904,#340,#010);
    
}
.box{
    width:100%;
    height:100vh;
   
    overflow: auto;
}

form{
    width: 100%;
    min-height: 60%;

position:absolute;
top:20px;
left:0px;
    display: flex;
    justify-content:flex-start;
    align-items: center;
    flex-direction: column;

}
 form .input_field input{
    width: 280px;
    height: 30px;
    text-align: center;
    font-weight: bold;
    font-size: 16px;
}
form input[type='radio']{
    width: 15px;
    height: 15px;
    padding: 3px;
    margin-left: 5px;
}
form .input_field{
    width: 100%;
    min-height: 7%;
    margin-top: 3px;
    display: flex;
    justify-content:center;
    align-items: center;
    flex-direction:column;

}
form button{
    width: 110px;
    height: 30px;
    margin-top:5px;
    background: #340;
    color: #fff;
    font-size: 16px;
    font-weight: bold;
}

    form .crose{
        position: relative;
        right:100px;
        top:10px;
        width:30px;
        height:30px;
        border-radius:50%;
        border:2px solid black;

    }


}
    </style>
</head>
<body>

<?php
include "dashboard.php";
?>


<div class="container">


<form action="" id="efrm">
    <div class="crose"></div>
<h2 id="title">Edit Account</h2>
<div class="input_field message">
  <div class="success"></div>
  <div class="error"></div>
</div>
<div class="input_field">
    <label for="email"> <ion-icon name="mail-outline"></ion-icon></label>
<input type="email" placeholder="Enter New Email" id="eemail">
</div>
<div class="input_field" id="phone">
   <label for="number"> <ion-icon name="calendar-number-outline"></ion-icon></label>
<input type="number" placeholder="Enter You Number" id="enumber">
</div>
<div class="input_field">
    <label for="password"><ion-icon name="lock-closed-outline"></ion-icon></label>
<input type="password" placeholder="Enter New Password" id="epassword">
</div>
<input type="hidden" id="hid">
<div class="input_field">
    <button id="save_data" value="" name="btn">Update</button>
    </div>
</form>
<div class="box">
<table class="table1">
<tr><th id='message' align="center" colspan="10"></th></tr>
<tr>
<th>Id</th>
<th>Email</th>
<th>Phone</th>
<th>Password</th>
<th>Action</th>
</tr>
<tbody id="tbody">

</tbody>
</table>
</div>
</div>  
</body>
</html>

<script>


    function loadData(){
fetch("fetchaccount.php")
.then((resp)=>resp.json())
.then((data)=>{
tbody=document.getElementById('tbody');
if(data['empty']=='empty'){
tbody.innerHTML='<tr><th>No Account Found</th></tr>';
}else{
    serial=1;
tr="";
for(var i in data){
console.log(data)
    tr+=`
    <tr>
    <td>${serial}</td>
    <td>${data[i].email}</td>
    <td>${data[i].phone}</td>
    <td>${data[i].password}</td>
    <td><a href="#" onclick="confirmDel('${data[i].email}')" id='delete'>Delete</a>&nbsp;&nbsp;  
    <a href="#" onClick="edit('${data[i].email}')" id='edit'>Edit</a></td>
    </tr>
    `;
    serial++;
}
tbody.innerHTML=tr;
}
});
    }

loadData();


//edit code 
document.querySelector(".crose").addEventListener("click",function(){
    document.getElementById("efrm").style.visibility="hidden";
    document.getElementById("efrm").reset();
    document.querySelector(".success").innerHTML="";
});
function edit(email){
    hidden=document.getElementById("hid").value=email;
    document.getElementById("efrm").style.visibility="visible";
   eemail= document.getElementById("eemail");
   ephone= document.getElementById("enumber");
   epassword= document.getElementById("epassword");
    fetch("edit.php?email="+email)
    .then((response)=>response.json())
    .then((data)=>{
        if(data['empty']){

        }else{
          for(var i in data){
            eemail.value=data[i].email;
            ephone.value=data[i].phone;
            epassword.value=data[i].password;
          }
        }
        
    })
}
document.getElementById("save_data").addEventListener('click',fun1);
function fun1(e){
    e.preventDefault();
    // document.getElementById("efrm").style.display="block";
   email= document.getElementById("eemail").value;
   enumber= document.getElementById("enumber").value;
   epassword= document.getElementById("epassword").value;
   ekey= document.getElementById("hid").value;
   var uData={
    "email":email,
    "phone":enumber,
    "password":epassword
   }
if(email=='' || enumber==''){
alert("All Fields Are Required");
}else{
fetch("edit.php?editkey="+ekey,{
    method:"UPDATE",
            body:JSON.stringify(uData),
            headers:{
                'Content-Type':'application/text',
            },
})
.then((resp)=>resp.text())
.then((res)=>{
document.querySelector(".success").innerHTML=res;
loadData();
})
}
}

//delete record code
function confirmDel(email){
    if(confirm("do you want to delete this record :"+email)){
        fetch("../database_files/delete.php?email="+email)
        .then((resp)=>{
            return resp.json();
        })
        .then((res)=>{
            document.getElementById("message").innerHTML=res;
            setTimeout(fun1,3000);
            function fun1(){
                document.getElementById("message").innerHTML="";
            }
            loadData();
            
        })
    }
}



</script>