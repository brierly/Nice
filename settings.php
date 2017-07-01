<?php
include("connect.php");
include("head.php");
include("imager.php");

if (!$_SESSION['id']){
	header("location:login.php");
} else {
	$id = $_SESSION['id'];
	$check = $conn->query("SELECT * FROM users WHERE id='$id'");
	$row = mysqli_fetch_assoc($check);
	$id = $row['id'];
	$un = $row['username'];
	$avi = $row['avatardb'];
	$theme = $row['theme'];
}

?>
<body>

<div class='wrapper'>
<?php 
$darkmode = @$_POST['darkmode'];
$lightmode = @$_POST['lightmode'];
$avatarupload = @$_POST['avatarupload'];

if($darkmode){
	$conn->query("UPDATE users SET theme='dark' WHERE id='$id'");
	header("location:settings.php");
}
if($lightmode){
	$conn->query("UPDATE users SET theme='light' WHERE id='$id'");
	header("location:settings.php");
}
	if (isset($_FILES['avatar'])) {
		$userlower = strtolower($un);
		if (((@$_FILES["avatar"]["type"]=="image/jpeg") || (@$_FILES["avatar"]["type"]=="image/png") || (@$_FILES["avatar"]["type"]=="image/gif"))&&(@$_FILES["avatar"]["size"] < 1024288)){ 
				if (!file_exists("avatars/$userlower")) {
					mkdir("avatars/$userlower");
				}
	$manipulator = new ImageManipulator($_FILES['avatar']['tmp_name']);
        $width  = $manipulator->getWidth();
        $height = $manipulator->getHeight();
        $centreX = round($width / 2);
        $centreY = round($height / 2);
        if ($width > $height) {
        	$x1 = $centreX - $centreY; 
	        $y1 = $centreY - $centreY; 
	 
	        $x2 = $centreX + $centreY; 
	        $y2 = $centreY + $centreY; 
        }
         if ($width < $height) {
        	$x1 = $centreX - $centreX; 
	        $y1 = $centreY - $centreX; 
	 
	        $x2 = $centreX + $centreX; 
	        $y2 = $centreY + $centreX; 
        }
        if ($width == $height) {
        	$x1 = 0; 
	        $y1 = 0; 
	 
	        $x2 = $width; 
	        $y2 = $height; 
        }
        
        $manipulator->crop($x1, $y1, $x2, $y2);
        $manipulator->resample(100, 100);
        $manipulator->save("avatars/$userlower/".$_FILES["avatar"]["name"]);
	    $avatar_name = @$_FILES["avatar"]["name"];
	    $conn->query("UPDATE users SET avatardb='$userlower/$avatar_name' WHERE id='$id'");

			echo "<div class='notification is-primary'>Your avatar has been updated!</div>";
		} else {
			echo "<div class='notification is-danger'>Avatar is not a supported filetype, or the file is too large. We accept PNG, JPG and GIF formats. 1MB maximum file size.</div>";
		}
	}








/*echo "<div class='notification is-primary'>bitch</div>"*/

?>
	<div class="content">
		<div class="title">Settings</div>

		<form class="avatarupload" action="settings.php" method="POST">
		<p class="control has-addons">
		<div class="subtitle">Theme</div>
		<?php 
		if ($theme == "light") {
			echo "<input type='submit' class='button' name='darkmode' value='activate dark mode'>";
		}
		if ($theme == "dark") {
			echo "<input type='submit' class='button' name='lightmode' value='activate light mode'>";
		}
		?>

		</p>
		</form><br/>

		<form class="avatarupload" method="post" enctype="multipart/form-data">
		<br/>
		<div class="subtitle">Avatar</div>
		<p class="control has-addons">
		<input type="file" class="input" name="avatar" alt="input image">
		<input type="submit" class="button" name="avatarupload">
		</p>
		</form>

		<br/><br/>
		<a href="./index.php"><div class="button is-primary">Back to timeline</div></a>
	</div>
</div>

</body>
</html>
