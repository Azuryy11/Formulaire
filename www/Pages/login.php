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
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ? AND statut = NULL";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($user["statut"] != NULL) {
            echo "votre compte a été bannis";
            }
        elseif (password_verify($password, $user['password'])) {
            echo "Connexion réussie ! Bienvenue, " . $user['username'];
        } else {
            echo "Mot de passe incorrect.";
            }
        } else {
            echo "Utilisateur non trouvé.";
        }

    $stmt->close();
}

$conn->close();
?>
