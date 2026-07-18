<?php

session_start();

// Für mögliche Fehlermeldungen
$error_msg = "";

// Check, ob Formular abgeschickt wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // DB-Verbindung einbinden
    require_once __DIR__ . '/../private/db_connect.php';
    
    // Eingaben aus Formular auslesen
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (!empty($username) && !empty($password)) {
        // Benutzer in Datenbank suchen
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();
        
        // Benutzer und Passwort überprüfen
        if ($user && password_verify($password, $user['password_hash'])) {
            
            // Check ob Umfrage gemacht worden ist
            if ($user['hat_teilgenommen'] == 1 || $user['hat_teilgenommen'] === true) {
                $error_msg = "Du hast die Umfrage bereits abgeschlossen. Eine erneute Teilnahme ist nicht möglich.";
            } else {
                // Alles korrekt: Nutzer als eingeloggt markieren
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $user['username'];
                
                // Weiterleitung zur Umfrage
                header("Location: umfrage.php");
                exit;
            }
        } else {
            $error_msg = "Benutzername oder Passwort ist falsch.";
        }
    } else {
        $error_msg = "Bitte fülle beide Felder aus.";
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sichere Umfrage - Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="login-box">
        <h2>Metropl3x Umfrage - Login</h2>
        
        <!-- Fehlermeldung anzeigen -->
        <?php if (!empty($error_msg)): ?>
            <div style="background-color: rgba(247, 198, 0, 0.1); border-left: 4px solid var(--accent-color); padding: 10px 15px; margin-bottom: 20px; border-radius: 4px; font-size: 14px; line-height: 1.4;">
                <?= htmlspecialchars($error_msg) ?>
            </div>
        <?php endif; ?>
        
        <form action="index.php" method="POST">
            <div class="form-group">
                <label for="username">Benutzername:</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Passwort:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit">Einloggen</button>
        </form>
    </div>

</body>
</html>