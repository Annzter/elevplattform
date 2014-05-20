<!DOCTYPE html>
<html>
<head>

	<title> Elveplattform - Kurs </title>
		<meta http-equiv="content-Type" content="text/html;charset=utf-8" />
			<link rel= "stylesheet" type="text/css" href="stylesheetcontent.css"/>

</head>
<body>

<div class="headlines">
<h1> Kurs </h1>
</div>
<nav>
	<ul>
		<li><a href="index.php"> Framsida </a></li>
		<li><a href="kurs.php"> Kurs </a></li> 
		<li><a href="klass.php"> Klass </a></li> 
		<li><a href="user.php"> Profil </a></li>
	</ul>
</nav>

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
			foreach ($pdo->query("SELECT kursnamn FROM kurs ORDER BY kursnamn") as $row){
				echo "<li><a href=\"?user_id=\">{$row['kursnamn']}</a></li>";
			}
		echo "</ul>";
?>

<?php 

		if(!empty($_GET))
	{
		// om user klickat på ett namn, visa dess inlägg
		$_GET = null;
		$kurs_id = filter_input(INPUT_GET, 'kurs_id', FILTER_VALIDATE_INT);
		$statement = $pdo->prepare("SELECT sammanfattning.*,kurs.id FROM sammanfattning JOIN kurs ON sammanfattning.kurs.id=sammafattning.user_id WHERE user_id=:user_id ORDER BY date");
		$statement->bindParam(":kurs_id", $kurs_id);
	
		if($statement->execute())
		{
			echo "<h3>This users post(s).</h3>";
			while($row = $statement->fetch())
			{
				echo "<p>{$row['date']} by {$row['name']} <br /> {$row['post']}</p>";
			}
		}
	}
?>
</nav>
</div>
</body> 
</html>