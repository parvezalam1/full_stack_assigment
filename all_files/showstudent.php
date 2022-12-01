
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
        .pre{
         
        }
    #prev{
        display:inline-block;
        width:50px;
        height:26px;
        line-height:26px;
        text-align:center;
        margin-top:55px;
        cursor: pointer;
        background:red;
        color:#fff;
        margin:18px 0px 0px 8px;
    }
    #next{
        display:inline-block;
        cursor: pointer;
        width:50px;
        height:26px;
        line-height:26px;
        background:green;
        color:#fff;
        cursor: pointer;
        text-align:center;
        margin:18px 0px 0px 8px;
    }
   ul .active{
        background:green;
    }
    @media only screen and (min-width:360px) and (max-width:960px){
        #next,#prev{
            margin:100px 0px 0px 8px;
        }
        .box{
            position: relative;
            top:100px;
        }
    }
    </style>
</head>
<body>
<input type="hidden" id="page">
<form action="" name="frm2" id="efrm">
    <div class="crose"></div>
<h2 id="title">Edit Record</h2>
<div class="message">
  <div class="success"></div>
  <div class="error"></div>
</div>
<div class="input_field">
    <label for="id">Enter Student Id</label>
<input type="number" placeholder="Enter Student Id" id="eid">
<input type="hidden" id="hidden" value="">
</div>
<div class="input_field">
    <label for="name">Enter Student Name</label>
<input type="text" placeholder="Enter Student Name" name="name" id="ename">
</div>
<div class="input_field">
    <label for="age">Enter Student Age</label>
<input type="number" placeholder="Enter Student Age" id="eage">
</div>
<div class="input_field">
    <label for="dob">Date Of Birth</label>
    <input type="date" name="dob" id="edob"></td>
</div>
<div class="input_field">
    <label for="school">School</label>
<select name="" id="eschool">
<option value="">Select...</option>
<option value="Lead School Karmala">Lead School Karmala</option>
</select>
</div>
<div class="input_field">
    <label for="school">Class</label>
<select name="" id="eclass">
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
<select name="" id="edivision">
<option value="">Select ...</option>
<option value="S">S</option>
<option value="A">A</option>
<option value="B">B</option>
<option value="C">C</option>
<option value="D">D</option>
<option value="Fail">Fail</option>
</select>
</div>
<div class="input_field">
    <label for="school">Status</label>
    <div class="radio">
    <input type="radio" id="eactive" name="stu"  value="Active"><label for="eactive"> Active</label>
<input type="radio" id="einactive" name="stu" value="Inactive"> <label for="einactive"> Inactive</label>
</div>
</div>

<button id="save_data">Update</button>

</form>




<?php
include "dashboard.php";
?>


<div class="container">








<div class="box">
<input type="search" id="search" placeholder="Search Item With Name" onkeyup="search()">
<table class="table1">
<tr><th id='message' align="center" colspan="10"></th></tr>
<tr>
<th>Id</th>
<th>Name</th>
<th>Age</th>
<th>Dob</th>
<th>School</th>
<th>Class</th>
<th>Division</th>
<th>Status</th>

<th>Action</th>
</tr>
<tbody id="tbody">

</tbody>
</table>

<ul>
<div class="pre"></div>
<?php
include "connection.php";

$sql=$conn->query("select * from students");
$fetchAll=$sql->fetchAll(PDO::FETCH_ASSOC);
$size=count($fetchAll);
$total_record=ceil($size/5);
?>
<input type='hidden' id='total' value='<?php echo $total_record;?>'>
<?php
$i=1;
?>
<script>
function prev(prePage){
    prevActive(prePage);
    if(prePage>1){
        
    var prePage="<a onclick='pageDecrement()' id='prev'>Prev</a>";
    document.querySelector('.pre').innerHTML=prePage;
        
}
else{
    document.querySelector('.pre').innerHTML='';
}
}


</script>
<?php    
for($i;$i<=$total_record;$i++){


    echo "<li><a onClick='pageLoad({$i})' class='page'>".$i."</a></li>";
}
?>
<script>
function next(pageNum){
    var total_page=document.getElementById('total').value;
    if(total_page>pageNum){
        
    var nextPage="<a onclick='pageIncrement()' id='next'>Next</a>";
    document.querySelector('.next').innerHTML=nextPage;

}
else{
    document.querySelector('.next').innerHTML='';
}
}


</script>
<div class="next"></div>
</ul>
</div>  
</div>
</body>
</html>

<script>
function prevActive(te){
   
        let allList=document.querySelectorAll("ul li a");
        allList.forEach(function(li){
            if(li.innerHTML==te){
                li.classList.add('active');
            }else{
                li.classList.remove('active');
            }
        })
}

function pageDecrement(){
   
    let page=document.getElementById("page").value;
    loadData(page--);
    pageLoad(page--);
}
function pageIncrement(){
    let page=document.getElementById("page").value;
    loadData(page++);
    pageLoad(page++);
}
function pageLoad(page){
document.getElementById("page").value=page;
loadData(page);
prev(page);
next(page);
}
    function loadData(page){
        jsonData={
            "page":page
        };
fetch("fetchstudent.php",{
    method:"POST",
    body:JSON.stringify(jsonData),
    headers:{
        'Content-Type':'application/json',
    },
})
.then((resp)=>resp.json())
.then((data)=>{
tbody=document.getElementById('tbody');
if(data['empty']=='empty'){
tbody.innerHTML='<tr><th>No Record Found</th></tr>';
}else{
tr="";
for(var i in data.output){
tr+=`
    <tr>
    <td>${data.output[i]['sid']}</td>
    <td>${data.output[i]['name']}</td>
    <td>${data.output[i]['age']}</td>
    <td>${data.output[i]['dob']}</td>
    <td>${data.output[i]['school']}</td>
    <td>${data.output[i]['Class']}</td>
    <td>${data.output[i]['division']}</td>
    <td>${data.output[i]['status']}</td>
    <td><a href="#" onclick="confirmDel('${data.output[i]['sid']}')" id='delete'>Delete</a>&nbsp;&nbsp;  
    <a href="#" onClick="edit('${data.output[i]['sid']}')" id='edit'>Edit</a></td>
    </tr>
    `;
}
tbody.innerHTML=tr;
}
});
    }

loadData();
pageLoad(1);

//fetch record 
document.querySelector(".crose").addEventListener("click",function(){
    document.getElementById("efrm").style.visibility="hidden";
    document.getElementById("efrm").reset();
});
function edit(id){
    document.getElementById("efrm").style.visibility="visible";
   eid= document.getElementById("eid");
   ename= document.getElementById("ename");
   eage= document.getElementById("eage");
   edob= document.getElementById("edob");
   eschool= document.getElementById("eschool");
   eclass= document.getElementById("eclass");
   edivision= document.getElementById("edivision");
   eactive=document.getElementById("eactive");
   einactive= document.getElementById("einactive");
   hidden=document.getElementById("hidden").value=id;
    fetch("edit.php?editid="+id)
    .then((response)=>response.json())
    .then((data)=>{
        if(data['empty']){

        }else{
          for(var i in data){
            eid.value=data[i].sid;
            ename.value=data[i].name;
            eage.value=data[i].age;
            edob.value=data[i].dob;
            eschool.value=data[i].school;
            eclass.value=data[i].Class;
            edivision.value=data[i].division;
            if(eactive.value==data[i].status){
            eactive.checked=true;
            }else{
                einactive.checked=true;
            }
          }
        }
        
    })
}
document.getElementById("save_data").addEventListener('click',fun1);
function fun1(e){
    e.preventDefault();
   eid= document.getElementById("eid").value;
   ename= document.getElementById("ename").value;
   eage= document.getElementById("eage").value;
   edob= document.getElementById("edob").value;
   eschool= document.getElementById("eschool").value;
   eclass= document.getElementById("eclass").value;
   edivision=document.getElementById("edivision").value;
   eactive=document.getElementById("eactive");
   einactive= document.getElementById("einactive");
   ekey= document.getElementById("hidden").value;
   if(eactive.checked==true){
    status="Active";
   }else if(einactive.checked==true){
    status="Inactive";
   }else{
    status="";
   }
   var uData={
    "id":eid,
    "name":ename,
    "age":eage,
    "dob":edob,
    "school":eschool,
    "uclass":eclass,
    "division":edivision,
    "status":status
   }
if(eid==''){
alert("All Fields Are Required");
}else{
fetch("edit.php?ukey="+ekey,{
    method:"UPDATE",
            body:JSON.stringify(uData),
            headers:{
                'Content-Type':'application/text',
            },
})
.then((resp)=>resp.text())
.then((res)=>{
    loadData();
document.querySelector(".success").innerHTML=res;
})
}
}

//delete record code here
function confirmDel(id){
    if(confirm("do you want to delete this record :"+id)){
        fetch("delete.php?delid="+id)
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

//serach code here

function search(){
    let search=document.getElementById("search").value;
  if(search==''){
    loadData()
  }else{
    fetch("fetchstudent.php?search="+search)
.then((resp)=>resp.json())
.then((data)=>{
tbody=document.getElementById('tbody');
if(data['empty']=='empty'){
tbody.innerHTML='<tr><th align="center" colspan="10">No Record Found</th></tr>';
}else{
tr="";
for(var i in data){
    tr+=`
    <tr>
    <td>${data[i].sid}</td>
    <td>${data[i].name}</td>
    <td>${data[i].age}</td>
    <td>${data[i].dob}</td>
    <td>${data[i].school}</td>
    <td>${data[i].Class}</td>
    <td>${data[i].division}</td>
    <td>${data[i].status}</td>
   
    <td><a href="#" onclick="confirmDel('${data[i].sid}')" id='delete'>Delete</a>&nbsp;&nbsp;  
    <a href="#" onClick="edit('${data[i].sid}')" id='edit'>Edit</a></td>
    </tr>
    `;
}
tbody.innerHTML=tr;
}
});
  }
}
</script>