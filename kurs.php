<!DOCTYPE html>
<html>
<head>

	<title> Elveplattform - Kurs </title>
		<meta http-equiv="content-Type" content="text/html;charset=utf-8" />
			<link rel= "stylesheet" type="text/css" href="stylesheet.css"/>

</head>
<body>

<div class="headlines">
<h1> Kurs </h1>
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
</br>

<div class="courses">
	<nav>
<?php

 	$host="localhost";
	$dbname="studentplattform";
	$username="studentplattform";
	$password="123456";
	$dsn="mysql:host=$host;dbname=$dbname;charset=utf8mb4";
	$attr=array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
	$pdo = new PDO($dsn, $username,$password, $attr);
	?>
	
	<?php

		echo "<ul>";
			foreach ($pdo->query("SELECT id, kursnamn FROM kurs ORDER BY kursnamn") as $row){
				echo "<li><a href=\"?kurs_id={$row['id']}\">{$row['kursnamn']}</a></li></br>";
			}
		echo "</ul>";
?>

<div class="text">
<?php 

		if(!empty($_GET))
	{
		// om user klickat på ett namn, visa dess inlägg
		$_GET = null;
		$kurs_id = filter_input(INPUT_GET, 'kurs_id', FILTER_VALIDATE_INT);
		$statement = $pdo->prepare("SELECT * FROM sammanfattning WHERE kurs_id = :kurs_id");
								   //"SELECT posts.*,users.name FROM posts JOIN users ON users.id=posts.user_id WHERE user_id=:user_id ORDER BY date"
		$statement->bindParam(':kurs_id', $kurs_id, PDO::PARAM_INT);
	
		if($statement->execute())
		{
			$kurs_statement = $pdo->prepare("SELECT kursnamn FROM kurs WHERE id = :id");
			$kurs_statement->bindParam(":id", $kurs_id, PDO::PARAM_INT);
			$kurs_statement->execute();
			$kurs = $kurs_statement->fetchColumn();
			echo "<h3>Sammanfattning.</h3>";
			while($row = $statement->fetch())
			{
				echo "<p><i>{$kurs}</font></i> <br />{$row['content']}</div></p>";
				//echo "<p>{$row['date']} by {$row['name']} <br /> {$row['post']}</p>";
			}
		}	
		else 
			print_r($statement->errorInfo());
 
	}
?>
</div>
</nav>
</div>
</body> 
</html>