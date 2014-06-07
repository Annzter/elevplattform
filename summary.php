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

	<title> Elveplattform - Sammanfattning </title>
		<meta http-equiv="content-Type" content="text/html;charset=utf-8" />
			<link rel= "stylesheet" type="text/css" href="stylesheet.css"/>

</head>
<body>

<div class="headlines">
<h1> Sammanfattning </h1>
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

<div class="summaryheadline">
<h2> Skriv din sammanfattning! </h2>
</div>

<?php
	
	if(!empty($_POST))
	{
		$_POST = null;
		$kurs_id = filter_input(INPUT_POST, 'kurs_id', FILTER_VALIDATE_INT); 
		$sammanfattning = filter_input(INPUT_POST, 'sammanfattning', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
		$statement = $pdo->prepare("INSERT INTO sammanfattning (kurs_id, content) VALUES (?, ?)");
		$statement->bindParam(1, $kurs_id);
		$statement->bindParam(2, $sammanfattning);
		if($statement->execute())			
			echo $sammanfattning;
		else
			print_r($statement->errorInfo());
	}
?>

<!-- Här ska man skriva in sammanfattningen  -->
<div class="summaryform">
<form action="summary.php" method="POST">
<div class="subjectchoice">
<select name ="kurs_id" value="$kurs_id">
	<?php
		foreach ($pdo->query("SELECT * FROM kurs ORDER BY kursnamn") as $row){
			echo "<option value=\"{$row['id']}\">{$row['kursnamn']}</option></div>";
		}
		?>
</div>
	<div class="summarybox">
		<textarea name="sammanfattning" value="$summary" rows="10" cols="50" placeholder="Skriv din sammanfattning här!" ></textarea>
		</br>
				<div id="button">
				<input type="submit" value="Post"/>
				</div>
				</form>
				
	</div>
		
</div>
			
</body> 
</html>