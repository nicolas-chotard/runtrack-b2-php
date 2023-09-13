<?php

function insert_student($email, $fullname, $gender, $birthdate, $grade_id) {

    $host = 'localhost';
    $dbname = 'ip_official';
    $username = 'root';
    $password = '1234';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "INSERT INTO student (email, fullname, gender, birthdate, grade_id) VALUES (:email, :fullname, :gender, :birthdate, :grade_id)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
        $stmt->bindParam(':birthdate', $birthdate, PDO::PARAM_STR);
        $stmt->bindParam(':grade_id', $grade_id, PDO::PARAM_INT);

        $stmt->execute();

        return true; 
    } catch (PDOException $e) {
    
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST['input-email'];
    $fullname = $_POST['input-fullname'];
    $gender = $_POST['input-gender'];
    $birthdate = $_POST['input-birthdate'];
    $grade_id = $_POST['input-grade_id'];

    
    if (insert_student($email, $fullname, $gender, $birthdate, $grade_id)) {
        $message = "L'étudiant a été inséré avec succès.";
    } else {
        $message = "Erreur lors de l'insertion de l'étudiant.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire d'insertion d'étudiant</title>
</head>
<body>
    <h1>Formulaire d'insertion d'étudiant</h1>
    <?php
    
    if (isset($message)) {
        echo "<p>$message</p>";
    }
    ?>
    <form method="POST">
        <label for="input-email">E-mail :</label>
        <input type="email" id="input-email" name="input-email" required><br>

        <label for="input-fullname">Nom complet :</label>
        <input type="text" id="input-fullname" name="input-fullname" required><br>

        <label for="input-gender">Genre :</label>
        <select id="input-gender" name="input-gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select><br>

        <label for="input-birthdate">Date de naissance :</label>
        <input type="date" id="input-birthdate" name="input-birthdate" required><br>

        <label for="input-grade_id">Grade ID :</label>
        <input type="number" id="input-grade_id" name="input-grade_id" required><br>

        <button type="submit">Insérer l'étudiant</button>
    </form>
</body>
</html>
