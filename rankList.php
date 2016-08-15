<?php
	$hostname = 'localhost';
	$username = 'root';
	$password = '';
	$dbname   = 'snake';
	$mysqli   = new mysqli($hostname, $username, $password, $dbname);
	if ($mysqli->connect_errno) {
		die("Error! Failed to connect to MySQL");
	}
	$nameOfPerson = $_REQUEST["nameOfPerson"];
	$scores       = $_REQUEST["scores"];
	if ($nameOfPerson != null && $scores != 0) {
		$query = $mysqli->prepare("INSERT INTO ranklist (username,scores) VALUES(?,?)");
		$query->bind_param("si", $nameOfPerson, $scores);
		$query->execute();
		if ($query->affected_rows == 1) {
			DisplayResults();
		} else {
			die("Failed process the query");
		}
	} else {
		if ($nameOfPerson == null) {
			echo '<div class="alert alert-danger fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Invalid name!</div>';
		}
		if ($scores == 0) {
			echo '<div class="alert alert-warning fade in">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						Sorry you have 0 points! </div>';
		}
		DisplayResults();
	}
	function DisplayResults()
	{
		$hostname = 'localhost';
		$username = 'root';
		$password = '';
		$dbname   = 'snake';
		$mysqli   = new mysqli($hostname, $username, $password, $dbname);
		if ($mysqli->connect_errno) {
			die("Error! Failed to connect to MySQL");
		}
		$i      = 0;
		$query  = "SELECT * FROM ranklist ORDER BY scores DESC LIMIT 10";
		$result = $mysqli->query($query);
		if (!$result) {
			die("Failed to process query!");
		}
		if ($result->num_rows > 0) {
			echo "<span>TOP 10</span>";
			echo "<table class='table table-hover '><tr>";
			echo "<th> </th><th> Name </th> <th> Scores </th>";
			while ($row = $result->fetch_assoc()) {
				$i++;
				echo "<tr><td>" . $i . "<td>" . $row['username'] . "</td>" . "<td> " . $row['scores'] . " </td></tr>";
			}
			echo "</table><br>";
			echo "<button type='button' class='btn btn-primary btn-md ' onclick='Reload()' id='button'>Play Again</button>";
		}
	}
?>
