<html>

<head>
    <h1>Filtre de ciutats per país</h1>
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
    <h1>Exemple de lectura de dades a MySQL</h1>

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

    $query = $pdo->prepare("SELECT c.Name as NameCity, co.Name as NamePais FROM city c inner join country co on c.CountryCode = co.Code where co.Code ='" . $_POST["codi_pais"] . "';");
    $query->execute();

    ?>

    <table>

        <thead>
            <td colspan="4" align="center" bgcolor="cyan">Llistat de ciutats</td>
        </thead>
        <?php

        $row = $query->fetch();

        while ($row) {
            echo "\t<tr>\n";
            echo "\t\t<td>" . $row["NameCity"] . "</td>\n";
            echo "\t\t<td>" . $row['NamePais'] . "</td>\n";
            echo "\t</tr>\n";
            $row = $query->fetch();
        }

        unset($pdo);
        unset($query);
        ?>

    </table>
</body>

</html>