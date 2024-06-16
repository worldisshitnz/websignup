<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıtlı Kullanıcılar</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h2>Kayıtlı Kullanıcılar</h2>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webodev";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT firstname, lastname, email, dob, gender FROM users");
        $stmt->execute();

        echo "<table>
                <tr>
                    <th>İsim</th>
                    <th>Soyisim</th>
                    <th>E-posta</th>
                    <th>Doğum Tarihi</th>
                    <th>Cinsiyet</th>
                </tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['firstname']) . "</td>
                    <td>" . htmlspecialchars($row['lastname']) . "</td>
                    <td>" . htmlspecialchars($row['email']) . "</td>
                    <td>" . htmlspecialchars($row['dob']) . "</td>
                    <td>" . htmlspecialchars($row['gender']) . "</td>
                  </tr>";
        }
        echo "</table>";
    } catch(PDOException $e) {
        echo "Hata: " . $e->getMessage();
    }

    $conn = null;
    ?>
</body>
</html>
