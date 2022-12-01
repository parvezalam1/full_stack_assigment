<?php
// session_start();
if(!isset($_SESSION['permit'])){
    header("location:logfile.php");
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/dashboard.css">
    <title>main page</title>
    <style>
   
    </style>
</head>
<body>
<section>
<div class="header">
<span>Leam</span>
<a href="sqlite.php?logout=1">LogOut</a>
</div>
</section>
<section>
<div class="dashboard">
<a href='' id="student">Show Student Record</a>
<a href='' id="showAccount">Show User Account</a>
<a href='' id="showForm">+ Add New Record</a>
</div>

</body>
</html>

<script>
    document.getElementById("student").addEventListener('click',showStudent);
function showStudent(e){
    e.preventDefault();
    window.location.href=("showstudent.php");
}
document.getElementById("showAccount").addEventListener('click',showAccount);
function showAccount(e){
    e.preventDefault();
    window.location.href=("usertable.php");
}
document.getElementById("showForm").addEventListener('click',showForm);
function showForm(e){
    e.preventDefault();
    window.location.href=("student_form.php");
}
</script>

