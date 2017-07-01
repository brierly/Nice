<?php
include("serverconfig.php");

session_start();

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if ($_SESSION['id']){

	$userid = $_SESSION['id'];
	$postid = $_GET['postid'];
	$result = $conn->query("SELECT * FROM posts WHERE id='$postid'");
	$row = mysqli_fetch_assoc($result);
	$favstring = $row['favs'];
	if (strpos($favstring, "$userid;")!==FALSE){
		$conn->query("UPDATE posts SET favs=REPLACE(favs, '$userid;', '') WHERE id='$postid'");
	}else{
		$conn->query("UPDATE posts SET favs=CONCAT(favs, '$userid',';') WHERE id='$postid'");
	}
}

?>
