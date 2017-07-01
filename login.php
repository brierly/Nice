<?php
include("connect.php");
include("head.php");
$login = @$_POST['login'];
?>

<body>
<!-- Login Form -->
<div class="wrapper">
<div class="loginform">

<span style="color:red">
<?php 
if($login) {

$un = strip_tags(@$_POST['username']);
$pw = strip_tags(@$_POST['password']);


$uncheck = $conn->query("SELECT * FROM users WHERE username='$un'");
$row = mysqli_fetch_assoc($uncheck);
$id = $row['id'];
$hashpass = $row['password'];

$uncount = $uncheck->num_rows;

	if($uncount == 1){
		if(password_verify($pw, $hashpass)){
			$_SESSION["id"] = $id;
			header("location:updates.php");
		}else{
			echo "Invalid information";
		}
	} else {
		echo "Invalid information";
	}
}
?>

</span>
	
	<div class="title">log in</div>
	<form action="./login.php" method="POST">
	<input class="input" type="text" placeholder="username" name="username"><br/>
	<input class="input" type="password" placeholder="password" name="password"><br/>
	<input class="button" id="create" type="submit" name="login" value="log in">
	</form>
	<br/>
	or <a href="./signup.php">sign up</a>
	</div>
</div>

</body>
</html>
