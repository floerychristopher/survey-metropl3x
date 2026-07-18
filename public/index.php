<?php

session_start();

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
        
        <!-- Daten an sich selbst schicken -->
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