<?php
    $host = 'database';
    $username = 'root';
    $password = 'tiger';
    $database = 'loggin';

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Erreur de connexion : " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hachage du mot de passe

        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password);
        

        if ($stmt->execute()) {
            echo "Inscription réussie !";
        } else {
            echo "Erreur : " . $conn->error;
        }

        $stmt->close();
    }

    $conn->close();
?>
