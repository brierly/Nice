<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.0.17/css/bulma.min.css" crossorigin="anonymous">
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<title>Not A Twitter Clone</title>
<?php 
session_start();
if (isset($_SESSION['id'])){
	$id = $_SESSION['id'];
	$check = $conn->query("SELECT * FROM users WHERE id='$id'");
	$row = mysqli_fetch_assoc($check);
	$theme = $row['theme'];
	if ($theme == "light") {
		echo "<link rel='stylesheet' type='text/css' href='style.css'>";
	}
	elseif ($theme == "dark") {
		echo "<link rel='stylesheet' type='text/css' href='darkstyle.css'>";
	}
	else{
		echo "<link rel='stylesheet' type='text/css' href='style.css'>";
	}
}else{
	echo "<link rel='stylesheet' type='text/css' href='style.css'>";
}
?>

</head>