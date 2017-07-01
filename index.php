<?php
include("connect.php");
include("head.php");


if (!$_SESSION['id']){
	header("location:login.php");
} else {
	$id = $_SESSION['id'];
	$check = $conn->query("SELECT * FROM users WHERE id='$id'");
	$row = mysqli_fetch_assoc($check);
	$id = $row['id'];
	$un = $row['username'];
	$avi = $row['avatardb'];

	$post = @$_POST['post'];
}

if($post && ($_POST['postcontent'] != "")){

	$check = $conn->query("SELECT * FROM users WHERE id='$id'");
	$row = mysqli_fetch_assoc($check);
	$topostun = $row['username'];
	$topostcontentpre = @$_POST['postcontent'];
	$topostcontent = htmlentities($topostcontentpre);
	$topostcontent2 = str_replace("'", "&#39;", $topostcontent);
	$topostcontent3 = str_replace('"', "&quot;", $topostcontent2);
	$conn->query("INSERT INTO posts (`body`, `user`) VALUES ('$topostcontent3', '$topostun')")or die(mysqli_error($conn));
	header("Location: index.php");
}


?>

<script type="text/javascript">
$(document).ready( function() {
    $("#refresh").on("click", function() {
        $("#timeline").load("timeline.php");
        document.getElementById("refresh").innerHTML = '<i class="fa fa-spinner" aria-hidden="true"> refreshing...';
    });
});
		function favourite(y) {
	    var x = y.getAttribute("data-postid");
	    var isfav = y.getAttribute("data-faved");
	    if (isfav == 'yes'){
	    	y.style = "color:#ccc; animation: none;";
	    	y.setAttribute("data-faved", "no");
	    }
	    if (isfav == 'no'){
	    	y.style = "color:gold; animation: bounce 0.5s linear;";
	    	y.setAttribute("data-faved", "yes");
	    }
	    $("#data").load("favourite.php?postid=" + x);
	    
	}
</script>
<body>
<!-- Login Form -->
<div id="data"></div>

<div class='wrapper'>
	<div class='box profile'>
		<article class='media'>
		    <div class='media-left'>
		      <figure class='image profileicon'>
		        <?php 
		        echo "<img src='./avatars/$avi' alt='your avatar' class='profileicon'>";
		        ?>
		      </figure>
		    </div>
		    <div class='media-content'>
		      <div class='content'>
		        <p class="settings">
			        logged in as <strong><?php echo $un; ?></strong><br/>
			        <a id="refresh"><i class="fa fa-refresh" aria-hidden="true"> refresh</i></a><br/>
			        <a href="./settings.php"><i class="fa fa-bars" aria-hidden="true"> settings</i></a><br/>
					<a href="./logout.php"><i class="fa fa-sign-out" aria-hidden="true"> log out</i></a><br/>
		        </p>
		      </div>
		    </div>
		</article><br/>
	<form action="index.php" method="post">
	<textarea class="input postcontent" name="postcontent" placeholder="compose a post"></textarea><br/>
	<input type="submit" class="button is-primary" name="post" value="post">
	</form>
	</div>


	<div id="timeline">
	<?php 
	include("timeline.php");
	?>
	</div>
</div>
</body>
</html>
