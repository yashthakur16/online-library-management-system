?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['alogin']!=''){
$_SESSION['alogin']='';
}
if(isset($_POST['login']))
{
$username=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT UserName,Password FROM admin WHERE UserName=:username and
Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['alogin']=$_POST['username'];
echo "<script type='text/javascript'> document.location ='admin/dashboard.php'; 
</script>";
} else{
echo "<script>alert('Invalid Details');</script>";
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum￾scale=1" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>Online Library Management System</title>
<!-- BOOTSTRAP CORE STYLE -->
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<!-- FONT AWESOME STYLE -->
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<!-- CUSTOM STYLE -->
9
<link href="assets/css/style.css" rel="stylesheet" />
<!-- GOOGLE FONT -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans'
rel='stylesheet' type='text/css' />
</head>
<body>
<!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
<div class="container">
<div class="row pad-botm">
<div class="col-md-12">
<h4 class="header-line">ADMIN LOGIN FORM</h4>
</div>
</div>
<!--LOGIN PANEL START-->
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
<div class="panel panel-info">
<div class="panel-heading">
LOGIN FORM
</div>
<div class="panel-body">
<form role="form" method="post">
<div class="form-group">
<label>Enter Username</label>
<input class="form-control" type="text" name="username" autocomplete="off"
required />
</div>
<div class="form-group">
<label>Password</label>
<input class="form-control" type="password" name="password" autocomplete="off"
required />
</div>
<button type="submit" name="login" class="btn btn-info">LOGIN </button>
</form>
</div>
</div>
</div>
</div>
10
<!---LOGIN PABNEL END-->
</div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->
<?php include('includes/footer.php');?>
<!-- FOOTER SECTION END-->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>
</script>
</body>
</html>
Change Password Code:-
<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
{ 
header('location:index.php');
}
else{ 
if(isset($_POST['change']))
{
$password=md5($_POST['password']);
$newpassword=md5($_POST['newpassword']);
$email=$_SESSION['login'];
$sql ="SELECT Password FROM tblstudents WHERE EmailId=:email and
Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update tblstudents set Password=:newpassword where EmailId=:email";
11
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
$msg="Your Password succesfully changed";
}
else {
$error="Your current password is wrong"; 
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum￾scale=1" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>Online Library Management System | </title>
<!-- BOOTSTRAP CORE STYLE -->
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<!-- FONT AWESOME STYLE -->
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<!-- CUSTOM STYLE -->
<link href="assets/css/style.css" rel="stylesheet" />
<!-- GOOGLE FONT -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans'
rel='stylesheet' type='text/css' />
<style>
.errorWrap {
padding: 10px;
margin: 0 0 20px 0;
background: #fff;
border-left: 4px solid #dd3d36;
-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
padding: 10px;
margin: 0 0 20px 0;
background: #fff;
border-left: 4px solid #5cb85c;
-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
12
box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
</style>
</head>
<script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>
<body>
<!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
<div class="container">
<div class="row pad-botm">
<div class="col-md-12">
<h4 class="header-line">User Change Password</h4>
</div>
</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo 
htmlentities($error); ?> </div><?php } 
else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo 
htmlentities($msg); ?> </div><?php }?>
<!--LOGIN PANEL START-->
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
<div class="panel panel-info">
<div class="panel-heading">
Change Password
</div>
<div class="panel-body">
<form role="form" method="post" onSubmit="return valid();" name="chngpwd">
<div class="form-group">
<label>Current Password</label>
13
<input class="form-control" type="password" name="password" autocomplete="off"
required />
</div>
<div class="form-group">
<label>Enter Password</label>
<input class="form-control" type="password" name="newpassword" autocomplete="off"
required />
</div>
<div class="form-group">
<label>Confirm Password </label>
<input class="form-control" type="password" name="confirmpassword"
autocomplete="off" required />
</div>
<button type="submit" name="change" class="btn btn-info">Chnage </button>
</form>
</div>
</div>
</div>
</div>
<!---LOGIN PABNEL END-->
</div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->
<?php include('includes/footer.php');?>
<!-- FOOTER SECTION END-->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
Check Availability Code:-
<?php
session_start();
14
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
{ 
header('location:index.php');
}
else{ 
if(isset($_POST['change']))
{
$password=md5($_POST['password']);
$newpassword=md5($_POST['newpassword']);
$email=$_SESSION['login'];
$sql ="SELECT Password FROM tblstudents WHERE EmailId=:email and
Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update tblstudents set Password=:newpassword where EmailId=:email";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
$msg="Your Password succesfully changed";
}
else {
$error="Your current password is wrong"; 
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum￾scale=1" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>Online Library Management System | </title>
<!-- BOOTSTRAP CORE STYLE -->
<link href="assets/css/bootstrap.css" rel="stylesheet" />
15
<!-- FONT AWESOME STYLE -->
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<!-- CUSTOM STYLE -->
<link href="assets/css/style.css" rel="stylesheet" />
<!-- GOOGLE FONT -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans'
rel='stylesheet' type='text/css' />
<style>
.errorWrap {
padding: 10px;
margin: 0 0 20px 0;
background: #fff;
border-left: 4px solid #dd3d36;
-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
padding: 10px;
margin: 0 0 20px 0;
background: #fff;
border-left: 4px solid #5cb85c;
-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
</style>
</head>
<script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>
<body>
<!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
<div class="container">
16
<div class="row pad-botm">
<div class="col-md-12">
<h4 class="header-line">User Change Password</h4>
</div>
</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo 
htmlentities($error); ?> </div><?php } 
else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo 
htmlentities($msg); ?> </div><?php }?>
<!--LOGIN PANEL START-->
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
<div class="panel panel-info">
<div class="panel-heading">
Change Password
</div>
<div class="panel-body">
<form role="form" method="post" onSubmit="return valid();" name="chngpwd">
<div class="form-group">
<label>Current Password</label>
<input class="form-control" type="password" name="password" autocomplete="off"
required />
</div>
<div class="form-group">
<label>Enter Password</label>
<input class="form-control" type="password" name="newpassword" autocomplete="off"
required />
</div>
<div class="form-group">
<label>Confirm Password </label>
<input class="form-control" type="password" name="confirmpassword"
autocomplete="off" required />
</div>
<button type="submit" name="change" class="btn btn-info">Chnage </button>
</form>
</div>
</div>
</div>
</div>
<!---LOGIN PABNEL END-->
17
</div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->
<?php include('includes/footer.php');?>
<!-- FOOTER SECTION END-->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
Dashboard:-
<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
{ 
header('location:index.php');
}
else{ 
if(isset($_POST['change']))
{
$password=md5($_POST['password']);
$newpassword=md5($_POST['newpassword']);
$email=$_SESSION['login'];
$sql ="SELECT Password FROM tblstudents WHERE EmailId=:email and
Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update tblstudents set Password=:newpassword where EmailId=:email";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
18
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
$msg="Your Password succesfully changed";
}
else {
$error="Your current password is wrong"; 
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum￾scale=1" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>Online Library Management System | </title>
<!-- BOOTSTRAP CORE STYLE -->
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<!-- FONT AWESOME STYLE -->
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<!-- CUSTOM STYLE -->
<link href="assets/css/style.css" rel="stylesheet" />
<!-- GOOGLE FONT -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans'
rel='stylesheet' type='text/css' />
<style>
.errorWrap {
padding: 10px;
margin: 0 0 20px 0;
background: #fff;
border-left: 4px solid #dd3d36;
-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
padding: 10px;
margin: 0 0 20px 0;
background: #fff;
border-left: 4px solid #5cb85c;
-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
19
</style>
</head>
<script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>
<body>
<!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
<div class="container">
<div class="row pad-botm">
<div class="col-md-12">
<h4 class="header-line">User Change Password</h4>
</div>
</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo 
htmlentities($error); ?> </div><?php } 
else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo 
htmlentities($msg); ?> </div><?php }?>
<!--LOGIN PANEL START-->
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
<div class="panel panel-info">
<div class="panel-heading">
Change Password
</div>
<div class="panel-body">
<form role="form" method="post" onSubmit="return valid();" name="chngpwd">
<div class="form-group">
<label>Current Password</label>
<input class="form-control" type="password" name="password" autocomplete="off"
required />
</div>
20
<div class="form-group">
<label>Enter Password</label>
<input class="form-control" type="password" name="newpassword" autocomplete="off"
required />
</div>
<div class="form-group">
<label>Confirm Password </label>
<input class="form-control" type="password" name="confirmpassword"
autocomplete="off" required />
</div>
<button type="submit" name="change" class="btn btn-info">Chnage </button>
</form>
</div>
</div>
</div>
</div>
<!---LOGIN PABNEL END-->
</div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->
<?php include('includes/footer.php');?>
<!-- FOOTER SECTION END-->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
Index:-
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['login']!=''){
21
$_SESSION['login']='';
}
if(isset($_POST['login']))
{
$email=$_POST['emailid'];
$password=md5($_POST['password']);
$sql ="SELECT EmailId,Password,StudentId,Status FROM tblstudents WHERE
EmailId=:email and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach ($results as $result) {
$_SESSION['stdid']=$result->StudentId;
if($result->Status==1)
{
$_SESSION['login']=$_POST['emailid'];
echo "<script type='text/javascript'> document.location ='dashboard.php'; 
</script>";
} else {
echo "<script>alert('Your Account Has been blocked .Please contact 
admin');</script>";
}
}
} 
else{
echo "<script>alert('Invalid Details');</script>";
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum￾scale=1" />
22
<meta name="description" content="" />
<meta name="author" content="" />
<title>Online Library Management System | </title>
<!-- BOOTSTRAP CORE STYLE -->
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<!-- FONT AWESOME STYLE -->
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<!-- CUSTOM STYLE -->
<link href="assets/css/style.css" rel="stylesheet" />
<!-- GOOGLE FONT -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans'
rel='stylesheet' type='text/css' />
</head>
<body>
<!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
<div class="container">
<!--Slider---->
<div class="row">
<div class="col-md-10 col-sm-8 col-xs-12 col-md-offset-1">
<div id="carousel-example" class="carousel slide slide-bdr"
data-ride="carousel" >
<div class="carousel-inner">
<div class="item active">
<img src="assets/img/1.jpg" alt="" />
</div>
<div class="item">
<img src="assets/img/2.jpg" alt="" />
</div>
<div class="item">
<img src="assets/img/3.jpg" alt="" />
</div>
</div>
<!--INDICATORS-->
<ol class="carousel-indicators">
<li data-target="#carousel-example" data-slide-to="0"
class="active"></li>
<li data-target="#carousel-example" data-slide￾to="1"></li>
<li data-target="#carousel-example" data-slide￾to="2"></li>
</ol>
23
<!--PREVIUS-NEXT BUTTONS-->
<a class="left carousel-control" href="#carousel-example"
data-slide="prev">
<span class="glyphicon glyphicon-chevron-left"></span>
</a>
<a class="right carousel-control" href="#carousel-example" data-slide="next">
<span class="glyphicon glyphicon-chevron-right"></span>
</a>
</div>
</div>
</div>
<hr />
<div class="row pad-botm">
<div class="col-md-12">
<h4 class="header-line">USER LOGIN FORM</h4>
</div>
</div>
<a name="ulogin"></a>
<!--LOGIN PANEL START-->
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
<div class="panel panel-info">
<div class="panel-heading">
LOGIN FORM
</div>
<div class="panel-body">
<form role="form" method="post">
<div class="form-group">
<label>Enter Email id</label>
<input class="form-control" type="text" name="emailid" required
autocomplete="off" />
</div>
<div class="form-group">
<label>Password</label>
<input class="form-control" type="password" name="password" required
autocomplete="off" />
<p class="help-block"><a href="user-forgot-password.php">Forgot Password</a></p>
</div>
24
<button type="submit" name="login" class="btn btn-info">LOGIN </button> | <a
href="signup.php">Not Register Yet</a>
</form>
</div>
</div>
</div>
</div>
<!---LOGIN PABNEL END-->
</div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->
<?php include('includes/footer.php');?>
<!-- FOOTER SECTION END-->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>
</body>
</html>
Issued Book :-
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
{ 
header('location:index.php');
}
else{ 
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
25
<meta name="viewport" content="width=device-width, initial-scale=1, maximum￾scale=1" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>Online Library Management System | Issued Books</title>
<!-- BOOTSTRAP CORE STYLE -->
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<!-- FONT AWESOME STYLE -->
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<!-- DATATABLE STYLE -->
<link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet"
/>
<!-- CUSTOM STYLE -->
<link href="assets/css/style.css" rel="stylesheet" />
<!-- GOOGLE FONT -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans'
rel='stylesheet' type='text/css' />
</head>
<body>
<!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
<div class="container">
<div class="row pad-botm">
<div class="col-md-12">
<h4 class="header-line">Manage Issued Books</h4>
</div>
<div class="row">
<div class="col-md-12">
<!-- Advanced Tables -->
<div class="panel panel-default">
<div class="panel-heading">
Issued Books 
</div>
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered 
table-hover" id="dataTables-example">
<thead>
<tr>
<th>#</th>
26
<th>Book Name</th>
<th>ISBN </th>
<th>Issued Date</th>
<th>Return Date</th>
<th>Fine in(USD)</th>
</tr>
</thead>
<tbody>
<?php
$sid=$_SESSION['stdid'];
$sql="SELECT
tblbooks.BookName,tblbooks.ISBNNumber,tblissuedbookdetails.IssuesDate,tblissuedbo
okdetails.ReturnDate,tblissuedbookdetails.id as rid,tblissuedbookdetails.fine 
from tblissuedbookdetails join tblstudents on
tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on
tblbooks.id=tblissuedbookdetails.BookId where tblstudents.StudentId=:sid order by
tblissuedbookdetails.id desc";
$query = $dbh -> prepare($sql);
$query-> bindParam(':sid', $sid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
<tr class="odd gradeX">
<td class="center"><?php echo 
htmlentities($cnt);?></td>
<td class="center"><?php echo 
htmlentities($result->BookName);?></td>
<td class="center"><?php echo 
htmlentities($result->ISBNNumber);?></td>
<td class="center"><?php echo 
htmlentities($result->IssuesDate);?></td>
<td class="center"><?php if($result-
>ReturnDate=="")
{?>
<span style="color:red">
<?php echo htmlentities("Not 
Return Yet"); ?>
</span>
<?php } else {
echo htmlentities($result-
>ReturnDate);
27
}
?></td>
<td class="center"><?php echo 
htmlentities($result->fine);?></td>
</tr>
<?php $cnt=$cnt+1;}} ?>
</tbody>
</table>
</div>
</div>
</div>
<!--End Advanced Tables -->
</div>
</div>
</div>
</div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->
<?php include('includes/footer.php');?>
<!-- FOOTER SECTION END-->
<!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME -->
<!-- CORE JQUERY -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.js"></script>
<!-- DATATABLE SCRIPTS -->
<script src="assets/js/dataTables/jquery.dataTables.js"></script>
<script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
28
Listed_Book:-
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
{ 
header('location:index.php');
}
else{ 
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum￾scale=1" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>Online Library Management System | Issued Books</title>
<!-- BOOTSTRAP CORE STYLE -->
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<!-- FONT AWESOME STYLE -->
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<!-- DATATABLE STYLE -->
<link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet"
/>
<!-- CUSTOM STYLE -->
<link href="assets/css/style.css" rel="stylesheet" />
<!-- GOOGLE FONT -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans'
rel='stylesheet' type='text/css' />
</head>
<body>
<!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
<div class="container">
<div class="row pad-botm">
29
<div class="col-md-12">
<h4 class="header-line">Manage Issued Books</h4>
</div>
<div class="row">
<div class="col-md-12">
<!-- Advanced Tables -->
<div class="panel panel-default">
<div class="panel-heading">
Issued Books 
</div>
<div class="panel-body">
<?php $sql = "SELECT
tblbooks.BookName,tblcategory.CategoryName,tblauthors.AuthorName,tblbooks.ISBNNum
ber,tblbooks.BookPrice,tblbooks.id as bookid,tblbooks.bookImage,tblbooks.isIssued 
from tblbooks join tblcategory on tblcategory.id=tblbooks.CatId join tblauthors 
on tblauthors.id=tblbooks.AuthorId";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
<div class="col-md-4" style="float:left; height:300px;">
<img src="admin/bookimg/<?php echo htmlentities($result->bookImage);?>"
width="100">
<br /><b><?php echo 
htmlentities($result->BookName);?></b><br />
<?php echo htmlentities($result-
>CategoryName);?><br />
<?php echo htmlentities($result-
>AuthorName);?><br />
<?php echo htmlentities($result-
>ISBNNumber);?><br />
<?php if($result->isIssued=='1'): 
?>
30
<p style="color:red;">Book Already issued</p>
<?php endif;?>
</div>
<?php $cnt=$cnt+1;}} ?>
</div>
</div>
<!--End Advanced Tables -->
</div>
</div>
</div>
</div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->
<?php include('includes/footer.php');?>
<!-- FOOTER SECTION END-->
<!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME -->
<!-- CORE JQUERY -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.js"></script>
<!-- DATATABLE SCRIPTS -->
<script src="assets/js/dataTables/jquery.dataTables.js"></script>
<script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
Logout: -
<?php
session_start(); 
session_destroy(); // destroy session
header("location:index.php"); 
31
?>
My_Profile:-
<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
{ 
header('location:index.php');
}
else{ 
if(isset($_POST['update']))
{ 
$sid=$_SESSION['stdid']; 
$fname=$_POST['fullanme'];
$mobileno=$_POST['mobileno'];
$sql="update tblstudents set FullName=:fname,MobileNumber=:mobileno where 
StudentId=:sid";
$query = $dbh->prepare($sql);
$query->bindParam(':sid',$sid,PDO::PARAM_STR);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->execute();
echo '<script>alert("Your profile has been updated")</script>';
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum￾scale=1" />
<meta name="description" content="" />
<meta name="author" content="" />
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
32
<![endif]-->
<title>Online Library Management System | Student Signup</title>
<!-- BOOTSTRAP CORE STYLE -->
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<!-- FONT AWESOME STYLE -->
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<!-- CUSTOM STYLE -->
<link href="assets/css/style.css" rel="stylesheet" />
<!-- GOOGLE FONT -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans'
rel='stylesheet' type='text/css' />
</head>
<body>
<!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
<div class="container">
<div class="row pad-botm">
<div class="col-md-12">
<h4 class="header-line">My Profile</h4>
</div>
</div>
<div class="row">
<div class="col-md-9 col-md-offset-1">
<div class="panel panel-danger">
<div class="panel-heading">
My Profile
</div>
<div class="panel-body">
<form name="signup" method="post">
<?php
$sid=$_SESSION['stdid'];
$sql="SELECT StudentId,FullName,EmailId,MobileNumber,RegDate,UpdationDate,Status
from tblstudents where StudentId=:sid ";
$query = $dbh -> prepare($sql);
$query-> bindParam(':sid', $sid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
33
{
foreach($results as $result)
{ ?>
<div class="form-group">
<label>Student ID : </label>
<?php echo htmlentities($result->StudentId);?>
</div>
<div class="form-group">
<label>Reg Date : </label>
<?php echo htmlentities($result->RegDate);?>
</div>
<?php if($result->UpdationDate!=""){?>
<div class="form-group">
<label>Last Updation Date : </label>
<?php echo htmlentities($result->UpdationDate);?>
</div>
<?php } ?>
<div class="form-group">
<label>Profile Status : </label>
<?php if($result->Status==1){?>
<span style="color: green">Active</span>
<?php } else { ?>
<span style="color: red">Blocked</span>
<?php }?>
</div>
<div class="form-group">
<label>Enter Full Name</label>
<input class="form-control" type="text" name="fullanme" value="<?php echo 
htmlentities($result->FullName);?>" autocomplete="off" required />
</div>
<div class="form-group">
<label>Mobile Number :</label>
<input class="form-control" type="text" name="mobileno" maxlength="10"
value="<?php echo htmlentities($result->MobileNumber);?>" autocomplete="off"
required />
</div>
34
<div class="form-group">
<label>Enter Email</label>
<input class="form-control" type="email" name="email" id="emailid" value="<?php
echo htmlentities($result->EmailId);?>" autocomplete="off" required readonly />
</div>
<?php }} ?>
<button type="submit" name="update" class="btn btn-primary" id="submit">Update 
Now </button>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->
<?php include('includes/footer.php');?>
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
Signup:-
<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['signup']))
{
//Code for student ID
$count_my_page = ("studentid.txt");
$hits = file($count_my_page);
$hits[0] ++;
$fp = fopen($count_my_page , "w");
fputs($fp , "$hits[0]");
35
fclose($fp); 
$StudentId= $hits[0]; 
$fname=$_POST['fullanme'];
$mobileno=$_POST['mobileno'];
$email=$_POST['email']; 
$password=md5($_POST['password']); 
$status=1;
$sql="INSERT
INTO tblstudents(StudentId,FullName,MobileNumber,EmailId,Password,Status) 
VALUES(:StudentId,:fname,:mobileno,:email,:password,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':StudentId',$StudentId,PDO::PARAM_STR);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo '<script>alert("Your Registration successfull and your student id 
is "+"'.$StudentId.'")</script>';
}
else
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum￾scale=1" />
<meta name="description" content="" />
<meta name="author" content="" />
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->
<title>Online Library Management System | Student Signup</title>
<!-- BOOTSTRAP CORE STYLE -->
36
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<!-- FONT AWESOME STYLE -->
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<!-- CUSTOM STYLE -->
<link href="assets/css/style.css" rel="stylesheet" />
<!-- GOOGLE FONT -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans'
rel='stylesheet' type='text/css' />
<script type="text/javascript">
function valid()
{
if(document.signup.password.value!= document.signup.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match !!");
document.signup.confirmpassword.focus();
return false;
}
return true;
}
</script>
<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#emailid").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
</head>
<body>
<!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
<div class="container">
<div class="row pad-botm">
<div class="col-md-12">
37
<h4 class="header-line">User Signup</h4>
</div>
</div>
<div class="row">
<div class="col-md-9 col-md-offset-1">
<div class="panel panel-danger">
<div class="panel-heading">
SINGUP FORM
</div>
<div class="panel-body">
<form name="signup" method="post" onSubmit="return 
valid();">
<div class="form-group">
<label>Enter Full Name</label>
<input class="form-control" type="text" name="fullanme" autocomplete="off"
required />
</div>
<div class="form-group">
<label>Mobile Number :</label>
<input class="form-control" type="text" name="mobileno" maxlength="10"
autocomplete="off" required />
</div>
<div class="form-group">
<label>Enter Email</label>
<input class="form-control" type="email" name="email" id="emailid"
onBlur="checkAvailability()" autocomplete="off" required />
<span id="user-availability-status" style="font-size:12px;"></span>
</div>
<div class="form-group">
<label>Enter Password</label>
<input class="form-control" type="password" name="password" autocomplete="off"
required />
</div>
<div class="form-group">
<label>Confirm Password </label>
<input class="form-control" type="password" name="confirmpassword"
autocomplete="off" required />
38
</div>
<button type="submit" name="signup" class="btn btn-danger" id="submit">Register 
Now </button>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->
<?php include('includes/footer.php');?>
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>
</body>
</html>
Change_Password:-
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['change']))
{
$email=$_POST['email'];
$mobile=$_POST['mobile'];
$newpassword=md5($_POST['newpassword']);
$sql ="SELECT EmailId FROM tblstudents WHERE EmailId=:email and
MobileNumber=:mobile";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
39
$con="update tblstudents set Password=:newpassword where EmailId=:email and 
MobileNumber=:mobile";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
$chngpwd1-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
echo "<script>alert('Your Password succesfully changed');</script>";
}
else {
echo "<script>alert('Email id or Mobile no is invalid');</script>"; 
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum￾scale=1" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>Online Library Management System | Password Recovery </title>
<!-- BOOTSTRAP CORE STYLE -->
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<!-- FONT AWESOME STYLE -->
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<!-- CUSTOM STYLE -->
<link href="assets/css/style.css" rel="stylesheet" />
<!-- GOOGLE FONT -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans'
rel='stylesheet' type='text/css' />
<script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>
40
</head>
<body>
<!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
<div class="container">
<div class="row pad-botm">
<div class="col-md-12">
<h4 class="header-line">User Password Recovery</h4>
</div>
</div>
<!--LOGIN PANEL START-->
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
<div class="panel panel-info">
<div class="panel-heading">
LOGIN FORM
</div>
<div class="panel-body">
<form role="form" name="chngpwd" method="post" onSubmit="return valid();">
<div class="form-group">
<label>Enter Reg Email id</label>
<input class="form-control" type="email" name="email" required autocomplete="off"
/>
</div>
<div class="form-group">
<label>Enter Reg Mobile No</label>
<input class="form-control" type="text" name="mobile" required autocomplete="off"
/>
</div>
<div class="form-group">
<label>Password</label>
<input class="form-control" type="password" name="newpassword" required
autocomplete="off" />
</div>
<div class="form-group">
<label>ConfirmPassword</label>
<input class="form-control" type="password" name="confirmpassword" required
autocomplete="off" />
41
</div>
<button type="submit" name="change" class="btn btn-info">Chnage 
Password</button> | <a href="index.php">Login</a>
</form>
</div>
</div>
</div>
</div>
<!---LOGIN PABNEL END-->
</div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->
<?php include('includes/footer.php');?>
<!-- FOOTER SECTION END-->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>
</body>
</html>
