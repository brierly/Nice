<?php
include("connect.php");
include("head.php");
$signup = @$_POST['signup'];
error_reporting(E_ALL); ini_set('display_errors', 1);
?>

<body>
<!-- Login Form -->
<div class="wrapper">
<div class="loginform">

<span style="color:red">
<?php 
if($signup) {
$un = strip_tags(@$_POST['username']);
$pw = strip_tags(@$_POST['password']);
$pw2 = strip_tags(@$_POST['password2']);
		if(ctype_alnum ($un)){
			$uncheck = $conn->query("SELECT * FROM users WHERE username='$un'");
			$uncount = $uncheck->num_rows;
		if($uncount == 0){
		if($pw == $pw2){
		if(strlen($pw) > 3){
			$crypass = password_hash($pw, PASSWORD_BCRYPT);
			$conn->query("INSERT INTO users (`username`, `password`, `theme`, `avatardb`) VALUES ('$un', '$crypass', 'light', 'default.png')")or die(mysqli_error($conn));
			header("location:index.php");
		}else{echo "password must be more than 3 chars long";}
		}else{echo "passwords do not match";}
		}else{echo "username is taken";}
		}else{echo "username must be alphanumeric";}
}
?>

</span>
	<div class="title">sign up</div>
	<form action="./signup.php" method="POST">
	<input class="input" type="text" placeholder="username" name="username"><br/>
	<input class="input" type="password" placeholder="password" name="password"><br/>
	<input class="input" type="password" placeholder="password again..." name="password2"><br/>
	<input class="button" id="create" type="submit" name="signup" value="sign up">
	</form>
	<br/>
	or <a href="./login.php">log in</a>
	</div>
</div>

</body>
</html>
