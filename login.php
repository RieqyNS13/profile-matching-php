<?php 
session_start();

if(isset($_SESSION["role"]) && isset($_SESSION["username"])){
	header("Location: index.php");
	exit();
}
if(isset($_POST["username"]) && isset($_POST["password"])){
	require_once "koneksi.php";
	$username=mysqli_real_escape_string($koneksi, trim($_POST["username"]));
	$password=md5(mysqli_real_escape_string($koneksi, trim($_POST["password"])));
	$query=mysqli_query($koneksi,"select a.id as id_user,a.user,a.id_role,b.nama_role from user a inner join role b on a.id_role=b.id where a.user='$username' and a.password='$password'" ) or die(mysqli_error($koneksi));
	if(mysqli_num_rows($query)>0){
		$fetch=mysqli_fetch_object($query);
		$_SESSION["role"]=$fetch->nama_role;
		$_SESSION["id_user"]=$fetch->id_user;
		$_SESSION["username"]=$fetch->user;
		header("Location: index.php");
		exit();
	}
}
?>
<html>
  <head>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<!------ Include the above in your HEAD tag ---------->
<style type="text/css">
body#LoginForm{ background-image:url("touken-ranbu-wallpapers-57004-4184793.jpg"); background-repeat:no-repeat; background-position:center; background-size:cover; padding:10px;}

.form-heading { color:#fff; font-size:23px;}
.panel h2{ color:#444444; font-size:18px; margin:0 0 8px 0;}
.panel p { color:#777777; font-size:14px; margin-bottom:30px; line-height:24px;}
.login-form .form-control {
  background: #f7f7f7 none repeat scroll 0 0;
  border: 1px solid #d4d4d4;
  border-radius: 4px;
  font-size: 14px;
  height: 50px;
  line-height: 50px;
}
.main-div {
  background: #ffffff none repeat scroll 0 0;
  border-radius: 2px;
  margin: 10px auto 30px;
  max-width: 38%;
  padding: 50px 70px 70px 71px;
}

.login-form .form-group {
  margin-bottom:10px;
}
.login-form{ text-align:center;}
.forgot a {
  color: #777777;
  font-size: 14px;
  text-decoration: underline;
}
.login-form  .btn.btn-primary {
  background: #f0ad4e none repeat scroll 0 0;
  border-color: #f0ad4e;
  color: #ffffff;
  font-size: 14px;
  width: 100%;
  height: 50px;
  line-height: 50px;
  padding: 0;
}
.forgot {
  text-align: left; margin-bottom:30px;
}
.botto-text {
  color: #ffffff;
  font-size: 14px;
  margin: auto;
}
.login-form .btn.btn-primary.reset {
  background: #ff9900 none repeat scroll 0 0;
}
.back { text-align: left; margin-top:10px;}
.back a {color: #444444; font-size: 13px;text-decoration: none;}

</style>
  </head>
<body id="LoginForm">
<div class="container">
<h1 class="form-heading">login Form</h1>
<div class="login-form">
<div class="main-div">
    <div class="panel">
   <h2>Halaman Login</h2>
   <p>Masukkan username dan password anda.</p>
   </div>
    <form id="Login" method="POST">

        <div class="form-group">


            <input type="username" name="username" class="form-control" id="inputUsername" placeholder="Username">

        </div>

        <div class="form-group">

            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">

        </div>
        <div class="forgot">
        <a href="reset.html">Forgot password?</a>
</div>
        <button type="submit" class="btn btn-primary">Login</button>

    </form>
    </div>
<p class="botto-text">Wibu</p>
</div></div></div>
</body>
</html>
