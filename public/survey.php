<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metropl3x Nutzerumfrage</title>
    <link rel="stylesheet" href="css/style.css"> 
</head>
<body>

<div class="survey-wrapper">
    
    <div class="progress-container">
        <div class="progress-bar" id="progressBar"></div>
    </div>

    <form id="surveyForm" action="save_survey.php" method="POST">

        <!-- Intro Card (Index 0) -->
        <div class="survey-card active">
            <h2>Metropl3x Nutzerumfrage</h2>
            <p>Willkommen, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>!</p>
            <p>Danke, dass du dir Zeit für diese 12 Fragen nimmst. Dein Feedback hilft, den Server zu verbessern.</p>
        </div>

        <!-- Frage 1 -->
        <div class="survey-card">
            <p class="question-title">1. Wie oft nutzt du Metropl3x im Durchschnitt?</p>
            <div class="form-group">
                <label><input type="radio" name="q1" value="Täglich" required> Täglich</label>
                <label><input type="radio" name="q1" value="Mehrmals pro Woche"> Mehrmals pro Woche</label>
                <label><input type="radio" name="q1" value="Etwa einmal pro Woche"> Etwa einmal pro Woche</label>
                <label><input type="radio" name="q1" value="Seltener"> Seltener</label>
            </div>
        </div>

        <!-- Frage 2 -->
        <div class="survey-card">
            <p class="question-title">2. Welche Geräte verwendest du hauptsächlich für die Plex-App? (Mehrfachauswahl)</p>
            <div class="form-group">
                <label><input type="checkbox" name="q2[]" value="Smart TV"> Smart TV (z. B. Samsung, LG, Sony)</label>
                <label><input type="checkbox" name="q2[]" value="Streaming-Stick / Box"> Streaming-Stick / Box</label>
                <label><input type="checkbox" name="q2[]" value="Smartphone / Tablet"> Smartphone / Tablet</label>
                <label><input type="checkbox" name="q2[]" value="PC / Laptop"> PC / Laptop</label>
                <label><input type="checkbox" name="q2[]" value="Spielekonsole"> Spielekonsole</label>
            </div>
        </div>

        <!-- Frage 3 -->
        <div class="survey-card">
            <p class="question-title">3. Welche anderen Streaming-Dienste nutzt du parallel zu Metropl3x? (Mehrfachauswahl)</p>
            <div class="form-group">
                <label><input type="checkbox" name="q3[]" value="Netflix"> Netflix</label>
                <label><input type="checkbox" name="q3[]" value="Amazon Prime Video"> Amazon Prime Video</label>
                <label><input type="checkbox" name="q3[]" value="Disney+"> Disney+</label>
                <label><input type="checkbox" name="q3[]" value="Wow / Sky"> Wow / Sky</label>
                <label><input type="checkbox" name="q3[]" value="Andere"> Andere</label>
                <label><input type="checkbox" name="q3[]" value="Keine"> Keine, nur Metropl3x</label>
            </div>
        </div>

        <!-- Frage 4 -->
        <div class="survey-card">
            <p class="question-title">4. Wie zufrieden bist du mit der Auswahl an NEUEN Filmen und Serien?</p>
            <div class="form-group">
                <label><input type="radio" name="q4" value="Sehr zufrieden" required> Sehr zufrieden</label>
                <label><input type="radio" name="q4" value="Zufrieden"> Zufrieden</label>
                <label><input type="radio" name="q4" value="Es geht so"> Es geht so</label>
                <label><input type="radio" name="q4" value="Unzufrieden"> Unzufrieden</label>
            </div>
        </div>

        <!-- Frage 5 -->
        <div class="survey-card">
            <p class="question-title">5. Wie zufrieden bist du mit der Auswahl an ÄLTEREN Filmen und Serien (Klassikern)?</p>
            <div class="form-group">
                <label><input type="radio" name="q5" value="Sehr zufrieden" required> Sehr zufrieden</label>
                <label><input type="radio" name="q5" value="Zufrieden"> Zufrieden</label>
                <label><input type="radio" name="q5" value="Es geht so"> Es geht so</label>
                <label><input type="radio" name="q5" value="Unzufrieden"> Unzufrieden</label>
            </div>
        </div>

        <!-- Frage 6 -->
        <div class="survey-card">
            <p class="question-title">6. Wie bewertest du die Aktualität (wie schnell neue Inhalte da sind)?</p>
            <div class="form-group">
                <label><input type="radio" name="q6" value="Sehr schnell" required> Sehr schnell</label>
                <label><input type="radio" name="q6" value="Angemessen"> Angemessen</label>
                <label><input type="radio" name="q6" value="Oft zu langsam"> Oft zu langsam</label>
                <label><input type="radio" name="q6" value="Kann ich nicht beurteilen"> Kann ich nicht beurteilen</label>
            </div>
        </div>

        <!-- Frage 7 -->
        <div class="survey-card">
            <p class="question-title">7. Wie suchst oder entdeckst du meistens neuen Content? (Mehrfachauswahl)</p>
            <div class="form-group">
                <label><input type="checkbox" name="q7[]" value="Startseite"> Startseite / "Kürzlich hinzugefügt"</label>
                <label><input type="checkbox" name="q7[]" value="Suchfunktion"> Suchfunktion</label>
                <label><input type="checkbox" name="q7[]" value="Wunschlisten"> Externe Wunschlisten (Overseerr etc.)</label>
                <label><input type="checkbox" name="q7[]" value="Empfehlungen"> Empfehlungen von Freunden</label>
            </div>
        </div>

        <!-- Frage 8 -->
        <div class="survey-card">
            <p class="question-title">8. Wie bewertest du die allgemeine Verfügbarkeit und Stabilität (Buffering)?</p>
            <div class="form-group">
                <label><input type="radio" name="q8" value="Läuft immer flüssig" required> Läuft immer flüssig und stabil</label>
                <label><input type="radio" name="q8" value="Gelegentliche Ladezeiten"> Gelegentliche Ladezeiten / Ruckler</label>
                <label><input type="radio" name="q8" value="Häufige Pufferprobleme"> Häufige Pufferprobleme (Buffering)</label>
                <label><input type="radio" name="q8" value="Oft gar nicht erreichbar"> Oft gar nicht erreichbar</label>
            </div>
        </div>

        <!-- Frage 9 -->
        <div class="survey-card">
            <p class="question-title">9. Gibt es Probleme mit der Plex-App auf deinen Geräten?</p>
            <div class="form-group">
                <label><input type="radio" name="q9" value="Keine Probleme" required> Nein, läuft absolut problemlos</label>
                <label><input type="radio" name="q9" value="App-Abstürze"> Ja, gelegentliche App-Abstürze</label>
                <label><input type="radio" name="q9" value="Untertitel/Tonspuren"> Ja, Probleme mit Untertiteln/Tonspuren</label>
                <label><input type="radio" name="q9" value="Logins/Bibliotheken"> Ja, App loggt mich aus / lädt nicht</label>
            </div>
        </div>

        <!-- Frage 10 -->
        <div class="survey-card">
            <p class="question-title">10. Wie gut findest du dich in der Benutzeroberfläche zurecht?</p>
            <div class="form-group">
                <label><input type="radio" name="q10" value="Sehr gut" required> Sehr gut, alles ist logisch sortiert</label>
                <label><input type="radio" name="q10" value="Gut"> Gut, man gewöhnt sich daran</label>
                <label><input type="radio" name="q10" value="Teilweise unübersichtlich"> Teilweise unübersichtlich</label>
                <label><input type="radio" name="q10" value="Sehr unübersichtlich"> Sehr unübersichtlich</label>
            </div>
        </div>

        <!-- Frage 11 -->
        <div class="survey-card">
            <p class="question-title">11. Fehlen dir bestimmte Genres, Sprachen oder Content-Kategorien?</p>
            <div class="form-group">
                <label><input type="radio" name="q11" value="Alles da" required> Nein, es ist alles da</label>
                <label><input type="radio" name="q11" value="Mehr deutsche Synchros"> Ja, mehr deutsche Tonspuren / Synchros</label>
                <label><input type="radio" name="q11" value="Mehr 4K/HDR"> Ja, mehr 4K / HDR Inhalte</label>
                <label><input type="radio" name="q11" value="Bestimmte Nischen"> Ja, bestimmte Nischen (Anime, Dokus...)</label>
                <br>
                <input type="text" name="q11_details" placeholder="Optionale Details (Welche Nische/Sprache?)" style="width: 100%; padding: 10px; background: #2a2a2a; border: 1px solid #444; color: white; border-radius: 4px;">
            </div>
        </div>

        <!-- Frage 12 -->
        <div class="survey-card">
            <p class="question-title">12. Was ist dein wichtigster Verbesserungswunsch für Metropl3x?</p>
            <div class="form-group">
                <textarea name="q12" rows="5" style="width: 100%; padding: 10px; background: #2a2a2a; border: 1px solid #444; color: white; border-radius: 4px;" placeholder="Dein offenes Feedback, Lob oder Kritik..."></textarea>
            </div>
        </div>

        <!-- Navigation Buttons (Pfeile) -->
        <div class="nav-buttons">
            <button type="button" id="prevBtn" class="btn btn-secondary" onclick="nextPrev(-1)">&#8592; Zurück</button>
            <button type="button" id="nextBtn" class="btn" onclick="nextPrev(1)">Weiter &#8594;</button>
            <button type="submit" id="submitBtn" class="btn" style="display:none;">Umfrage abschließen &#10003;</button>
        </div>

    </form>
</div>

<!-- JS für step by step logic -->
<script>
    let currentCard = 0;
    const cards = document.querySelectorAll(".survey-card");
    const progressBar = document.getElementById("progressBar");

    showCard(currentCard);

    function showCard(n) {
        // Alle Cards verstecken
        cards.forEach(card => card.classList.remove("active"));
        // Aktuelle Card zeigen
        cards[n].classList.add("active");

        // Buttons anpassen
        document.getElementById("prevBtn").style.display = (n === 0) ? "none" : "inline-flex";
        
        if (n === (cards.length - 1)) {
            document.getElementById("nextBtn").style.display = "none";
            document.getElementById("submitBtn").style.display = "inline-flex";
        } else {
            document.getElementById("nextBtn").style.display = "inline-flex";
            document.getElementById("submitBtn").style.display = "none";
        }

        // Fortschrittsbalken aktualisieren
        const progress = ((n + 1) / cards.length) * 100;
        progressBar.style.width = progress + "%";
    }

    function nextPrev(n) {
        // Form validation bevor es weitergeht (verhindert Überspringen von Pflichtfeldern)
        if (n === 1 && !validateCurrentCard()) return false;

        currentCard = currentCard + n;
        showCard(currentCard);
    }

    function validateCurrentCard() {
        const card = cards[currentCard];
        const requiredInputs = card.querySelectorAll('[required]');
        
        for (let input of requiredInputs) {
            if (input.type === 'radio') {
                const checked = card.querySelector(`input[name="${input.name}"]:checked`);
                if (!checked) {
                    alert("Bitte wähle eine Antwort aus, bevor du fortfährst.");
                    return false;
                }
            }
        }
        return true;
    }
</script>

</body>
</html>