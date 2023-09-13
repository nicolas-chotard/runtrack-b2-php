<?php
function find_one_student($email) {

    $host = 'localhost';
    $dbname = 'ip_official';
    $username = 'root';
    $password = '1234';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM student WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        return $student;
    } catch (PDOException $e) {
        
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}

if (isset($_GET['input-email-student'])) {

    $email = $_GET['input-email-student'];

    $student = find_one_student($email);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Recherche d'étudiant par e-mail</title>
</head>
<body>
    <h1>Recherche d'étudiant par e-mail</h1>
    <form method="GET">
        <label for="input-email-student">Entrez l'e-mail de l'étudiant :</label>
        <input type="text" id="input-email-student" name="input-email-student" required>
        <button type="submit">Rechercher</button>
    </form>

    <?php
    if (isset($student)) {
        echo "<h2>Informations de l'étudiant</h2>";
        echo "<pre>";
        print_r($student);
        echo "</pre>";
    }
    ?>
</body>
</html>
