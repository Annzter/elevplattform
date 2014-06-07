<?php 

$host="localhost";
	$dbname="studentplattform";
	$username="studentplattform";
	$password="123456";
	$dsn="mysql:host=$host;dbname=$dbname;charset=utf8mb4";
	$attr=array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
	$pdo = new PDO($dsn, $username,$password, $attr);
	?>

<!DOCTYPE html>
<html>
<head>

	<title> Elveplattform - Profil </title>
		<meta http-equiv="content-Type" content="text/html;charset=utf-8" />
			<link rel= "stylesheet" type="text/css" href="stylesheet.css"/>

</head>
<body>

<div class="headlines">
<h1> Profil </h1>
</div>
<div class="nav">
<nav>
	<ul>
		<li><a href="index.php"> Framsida </a></li>
		<li><a href="kurs.php"> Kurs </a></li> 
		<li><a href="user.php"> Profil </a></li>
		<li><a href="summary.php"> Skriv din sammanfattning här! </a></li>
	</ul>
</nav>
</div>

<nav>
<div class ="allUsers"> 
<?php

		echo "<ul>";
		echo "<li><a href=\"index.php\"> All users </a></li>";
			foreach ($pdo->query("SELECT username FROM user") as $row){
				echo "<li><a href=\"?user_id=\">{$row['username']}</a></li>";
			}
		echo "</ul>";
?>
</nav>
</div>
</body> 
</html>