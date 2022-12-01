
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/logfile.css">
    <title>log page</title>
</head>
<body>
<div class="container">
<form action="" id="frm">
<h2 id="title">Sign Up</h2>
<div class="input_field message">
  <div class="success"></div>
  <div class="error"></div>
</div>
<div class="input_field">
    <label for="email"> <ion-icon name="mail-outline"></ion-icon></label>
<input type="email" placeholder="Enter New Email" id="email">
</div>
<div class="input_field" id="phone">
   <label for="number"> <ion-icon name="calendar-number-outline"></ion-icon></label>
<input type="number" placeholder="Enter You Number" id="number">
</div>
<div class="input_field">
    <label for="password"><ion-icon name="lock-closed-outline"></ion-icon></label>
<input type="password" placeholder="Enter New Password" id="password">
</div>
<div class="input_field" id='ac'>
<b style='color:#fff;'>No Account Create One</b>
</div>
<div class="input_field">
<button id="signup">Sign Up</button><button id="signin" class="disabled">Sign In</button>
</div>
<div class="input_field">
    <button id="save_data" value="" name="btn">Save Data</button>
    </div>
</form>
</div>
</body>
</html>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

<script>
let signInBtn=document.getElementById("signin");
let signUpBtn=document.getElementById("signup");
let phone=document.getElementById("phone");
let title=document.getElementById("title");

signInBtn.onclick=function(e){
    e.preventDefault();
    document.querySelector('#ac').innerHTML='';
    document.getElementById("save_data").innerHTML="Login";
    phone.style.maxHeight="0";
    title.innerHTML="Sign In";
    this.classList.remove("disabled");
    this.classList.add("logindata");
    signUpBtn.classList.add("disabled");
    document.getElementById("email").value="";
    document.getElementById("number").value="";
    document.getElementById("password").value="";
    document.getElementById("password").placeholder="Enter Your Password";
    document.getElementById("email").placeholder="Enter Email Or Phone";
}
signUpBtn.onclick=function(e){
    e.preventDefault();
    ac=document.querySelector('#ac');
    ac.innerHTML='No Account Create One';
    ac.style.color='#fff';
    document.getElementById("save_data").innerHTML="Save Data";
    phone.style.maxHeight="35px";
    title.innerHTML="Sign Up";
    this.classList.remove("disabled");
    signInBtn.classList.add("disabled");
    signInBtn.classList.remove("logindata");
    document.getElementById("email").value="";
    document.getElementById("number").value="";
    document.getElementById("password").value="";
    document.getElementById("password").placeholder="Enter New Password";
    document.getElementById("email").placeholder="Enter New Email";
    document.getElementById("number").placeholder="Enter Your Number";
}
document.getElementById("save_data").addEventListener('click',fun1);
function fun1(e){
e.preventDefault();
var email=document.getElementById("email").value;
var number=document.getElementById("number").value;
var password=document.getElementById("password").value;

var formData={
"email":email,
"number":number,
"password":password
}
if(title.innerHTML=='Sign Up'){
if(email=='' || number=='' || password==''){
    alert("All Fields Are Required");
}
else{
    document.querySelector(".message").style.height="30px";
   fetch("sqlite.php?key=1",{
    method:"POST",
    body:JSON.stringify(formData),
    headers:{
        'Content-Type':"application/text",
    }
   }).then((resp)=>{
    return resp.text();
   })
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
}
}
else{
    if(email=='' || password==''){
    alert("All Fields Are Required");
}
else{
    document.querySelector(".message").style.height="30px";
    fetch("sqlite.php?log=1",{
            method:"POST",
            body:JSON.stringify(formData),
            headers:{
                'Content-Type':'application/text',
            }
    })
    .then((resp)=>{
        return resp.text();
    })
    .then((res)=>{
        if(res=="login success"){
            window.location.href="showstudent.php";
            alert("Login Successfully");
        }
        else{
            document.querySelector(".error").innerHTML=res;
    setTimeout(hide,3000);
       function hide(){
        document.querySelector(".message").style.height="0";
        document.querySelector(".error").innerHTML="";
       }
        }
     
    })

}
}
}
</script>