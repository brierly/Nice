<?php
include("connect.php");
include("head.php");

if (!$_SESSION['id']){
	header("location:login.php");
} else {
	$id = $_SESSION['id'];
}
?>
<body>

<div class='wrapper'>
<div class="title">updates</div>
<div class="content">
<p>
	<ul>
		<li>addition of <strong>avatars</strong> and avatar uploading. express yourself. but not too much</li>
		<li>avatars now <strong>crop</strong> to create a square from the centre of the image, rather than stretching to a square</li>
		<li>you can now <strong>favourite posts<strong>!!!!!!!</li>
		<li>toggleable <strong>dark mode</strong> because staring at this bright white screen while making this site will be the death of me</li>
		<li>timeline <strong>soft refresh</strong> button, so you dont need to refresh the page when you wanna see new posts</li>
		<li>go into <strong>settings</strong> to change these new options. its right next to the log out button</li>
		</ul>
		<div class="subtitle">Bugfixes</div>
		<ul>
		<li><strong>usernames</strong> could be set to non-alphanumeric characters, posing threat to SQL injection or being called a fuckin emoji or something.</li>
		<li>fixed bugs while submitting posts that contain <strong>quotes</strong> or anything like that</li>
		<li>if you uploaded a perfectly square avatar then the entire website would freak out. thats been fixed</li>
		</ul>
	
</p>
</div>
<br/>
<a href="./index.php"><div class="button is-primary">ok cool whatever who cares</div></a>
</div>

</body>
</html>
