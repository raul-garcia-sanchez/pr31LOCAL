<html>

<head>
	<title>Exercici SQL COUNTRIES</title>
	<style>
		body {}

		table,
		td {
			border: 1px solid black;
			border-spacing: 0px;
		}
	</style>
</head>

<body>
	<h1>Filtre de ciutats per país</h1>

	<?php

    try {
	    $hostname = "127.0.0.1";
	    $dbname = "world";
	    $username = "admin";
	    $pw = "admin123";
	    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
    } catch (PDOException $e) {
	    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
	    exit;
    }

    $query = $pdo->prepare('SELECT * FROM country;');
    $query->execute();
	
    ?>

	<form action="results.php" method="POST">
		<label for="codi_pais">Choose a country:</label>
		<select name="codi_pais" id="codi_pais">

			<?php

            $row = $query->fetch();

            while ($row) {
	            echo "<option value=" . $row["Code"] . ">" . $row["Name"] . "</option>";
	            $row = $query->fetch();
            }

            unset($pdo);
            unset($query);
            ?>

		</select>
		<input type="submit" name="" id="">
	</form>
</body>

</html>