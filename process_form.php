<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt İşlemi Sonucu</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <?php
        // Formdan gelen verileri al
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];

        // Temel validasyonlar
        if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($dob) || empty($gender)) {
            echo "<p class='error'>Tüm alanlar doldurulmalıdır.</p>";
            echo '<br><br><a href="index.php"><button>Geri Dön</button></a>';
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p class='error'>Geçerli bir e-posta adresi girin.</p>";
            echo '<br><br><a href="index.php"><button>Geri Dön</button></a>';
            exit();
        }

        if (strlen($password) < 6) {
            echo "<p class='error'>Şifre en az 6 karakter uzunluğunda olmalıdır.</p>";
            echo '<br><br><a href="index.php"><button>Geri Dön</button></a>';
            exit();
        }

        // Veritabanı bağlantısı
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "webodev";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // E-posta benzersiz mi kontrol et
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "<p class='error'>Bu e-posta adresi zaten kayıtlı.</p>";
                echo '<br><br><a href="index.php"><button>Geri Dön</button></a>';
                exit();
            }

            // Veritabanına ekle
            $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password, dob, gender) 
                                    VALUES (:firstname, :lastname, :email, :password, :dob, :gender)");
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':dob', $dob);
            $stmt->bindParam(':gender', $gender);
            $stmt->execute();

            echo "<p class='success'>Kayıt başarılı!</p>";
            echo '<br><br><a href="list_users.php"><button>Kayıtlı Kullanıcılar</button></a>';
        } catch(PDOException $e) {
            echo "<p class='error'>Hata: " . $e->getMessage() . "</p>";
            echo '<br><br><a href="index.php"><button>Geri Dön</button></a>';
        }

        $conn = null;
        ?>
    </div>
</body>
</html>
