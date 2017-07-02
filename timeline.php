<?php
include("serverconfig.php");
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if(@!$_SESSION['id']){
session_start();
}
if ($_SESSION['id']){
	$id = $_SESSION['id'];
	$check = $conn->query("SELECT * FROM users WHERE id='$id'");
	$row = mysqli_fetch_assoc($check);
	$id = $row['id'];
	$un = $row['username'];
	$avi = $row['avatardb'];
	$post = @$_POST['post'];
}

$check = $conn->query("SELECT * FROM posts ORDER BY id DESC");
	
	while ($row = mysqli_fetch_assoc($check)) {
	$postid = $row['id'];
	$postbody = $row['body'];
	$postbody = str_replace("\n", "<br/>", $postbody);
	$postedby = $row['user'];
	$favs = $row['favs'];
	$favarray = explode(";", $favs);
	$favno = count($favarray) - 1;
	if($favno == 0){
		$favno = "";
	}
	$check2 = $conn->query("SELECT avatardb FROM users WHERE username='$postedby'");
	$row2 = mysqli_fetch_assoc($check2);
	$avidb = $row2['avatardb'];

	echo 	"<div class='box'>
			  <article class='media'>
			    <div class='media-left'>
			      <figure class='image is-64x64'>
			        <img src='./avatars/$avidb' alt='$postedby&#39;s avatar' class='timelineicon'>
			      </figure>
			    </div>
			    <div class='media-content'>
			      <div class='content'>
			        <p>
			          <strong class='postuser'>$postedby</strong>
			          <br>
			          $postbody
			        </p>
			        <nav class='level'>
				        <div class='level-left'>
				        	<a class='level-item favourite' ";
				        	if (strpos($favs, "$id;")!==FALSE){
				        		echo "style='color:gold' data-faved='yes'";
				        	}else{
				        		echo "data-faved='no'";
				        	}
				        	echo "data-postid='$postid' onclick='favourite(this)'>
				        		<span class='icon is-small'><i class='fa fa-star'></i></span><span id='favnum'>$favno</span>
				          	</a>
				        </div>
				      </nav>
			      </div>
			    </div>
			  </article>
			</div>";
		}
		?>
		<script type="text/javascript">
		document.getElementById("refresh").innerHTML = "<i class='fa fa-refresh' aria-hidden='true'> refresh</i>";
		</script>