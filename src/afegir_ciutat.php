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

    $query = $pdo->prepare("SELECT * FROM country;");
    $query->execute();

    ?>

	<form action="" method="POST">
		<label for="codi_pais">Choose a country:</label>
		<select name="codi_pais" id="codi_pais">

			<?php

            $row = $query->fetch();
            while ($row) {
	            echo "<option value=" . $row["Code"] . ">" . $row["Name"] . "</option>";
	            $row = $query->fetch();
            }
            ?>

		</select><br><br>
		<label for="nom_ciutat">Nom ciutat:</label>
		<input id="nom_ciutat" type="text" name="nom_ciutat"><br><br>
		<label for="poblacio">Població:</label>
		<input type="number" name="poblacio" id="poblacio"><br><br>
		<input type="submit" name="submit" id="submit">
	</form>

	<?php

    if (isset($_POST["submit"])) {
	    $comprovacio = $pdo->prepare("select * from city where name= '" . $_POST["nom_ciutat"] . "' and CountryCode= '" . $_POST["codi_pais"] . "';");
	    $comprovacio->execute();
	    $resultatComprovacio = $comprovacio->fetch();
	    $fileresComprovacio = $pdo->query("select count(*) from city where name= '" . $_POST["nom_ciutat"] . "' and CountryCode= '" . $_POST["codi_pais"] . "';")->fetchColumn();
	    if ($fileresComprovacio > 0) {
		    echo "<div class='missatge'>Aquesta ciutat ja existeix en aquest país</div>";
	    } else {
		    $insert = $pdo->prepare("INSERT INTO city (Name,CountryCode,Population) values('" . $_POST["nom_ciutat"] . "','" . $_POST["codi_pais"] . "'," . $_POST["poblacio"] . ");");
		    $insert->execute();
		    echo "<div class='missatge'>Ciutat afegida correctament</div>";
	    }
    }

    unset($pdo);
    unset($query);
    unset($comprovacio);
    unset($insert);
    ?>

	<a href="index.php">Tornar a l'inici</a>

</body>

</html>