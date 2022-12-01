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
    <link rel="stylesheet" href="../style/signup.css">
    <title>sign page</title>
</head>
<body>
<div class="container">

<form>
<h2>Sign</h2>
<a href="../database_files/sqlite.php?unset=1">Logout</a>
<input type="email" id="useremail" placeholder="Enter Email Or Phone">
<input type="password" id="userpassword" placeholder="Enter Password">
<button type="submit">sign</button>
</form>
</div>   
</body>
</html>