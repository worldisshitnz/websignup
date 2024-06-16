<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Kayıt Formu</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script>
        function validateForm() {
            let name = document.forms["userForm"]["firstname"].value;
            let surname = document.forms["userForm"]["lastname"].value;
            let email = document.forms["userForm"]["email"].value;
            let password = document.forms["userForm"]["password"].value;
            let dob = document.forms["userForm"]["dob"].value;
            let gender = document.forms["userForm"]["gender"].value;

            if (name == "" || surname == "" || email == "" || password == "" || dob == "" || gender == "") {
                alert("Tüm alanlar doldurulmalıdır.");
                return false;
            }

            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email.match(emailPattern)) {
                alert("Geçerli bir e-posta adresi girin.");
                return false;
            }

            if (password.length < 6) {
                alert("Şifre en az 6 karakter uzunluğunda olmalıdır.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
<div class="kalp"></div>
    <div class="kalp"></div>
    <div class="kalp"></div>
    
    <h2>Kullanıcı Kayıt Formu</h2>
    <form name="userForm" action="process_form.php" method="post" onsubmit="return validateForm()">
        <label for="firstname">İsim:</label>
        <input type="text" id="firstname" name="firstname">

        <label for="lastname">Soyisim:</label>
        <input type="text" id="lastname" name="lastname">

        <label for="email">E-posta:</label>
        <input type="email" id="email" name="email">

        <label for="password">Şifre:</label>
        <input type="password" id="password" name="password">

        <label for="dob">Doğum Tarihi:</label>
        <input type="date" id="dob" name="dob">

        <label for="gender">Cinsiyet:</label>
        <input type="radio" id="male" name="gender" value="male"> Erkek
        <input type="radio" id="female" name="gender" value="female"> Kadın
        <input type="radio" id="other" name="gender" value="other"> Diğer

        <input type="submit" value="Kayıt Ol">
    </form>
</body>
</html>
