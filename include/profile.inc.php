<?php
include(__DIR__ . '/../../private/db_connect.php');
$users_id = $_SESSION['users_id'];


try {
    $query = "SELECT b.users_id, b.profile_pic, b.name, b.middle_name, b.last_name, 
                     b.street, b.house_number, b.postal_code, b.email, b.date_of_birth,  
                     COALESCE(c.woonplaats, 'Onbekend') AS woonplaats_name  
              FROM users_table b
              LEFT JOIN woonplaats c ON b.woonplaats = c.woonplaats_id
              WHERE b.users_id = :users_id";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':users_id', $users_id, PDO::PARAM_INT);
    $stmt->execute();
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Fout bij ophalen van gegevens: " . $e->getMessage();
}
?>


<main-profile>
    <?php if (!empty($books)): ?>
        <?php foreach ($books as $result): ?>
            <div class="profile-pic">
              <img src="<?= !empty($result['profile_pic']) ? htmlspecialchars($result['profile_pic']) : 'images/login.webp'; ?>" alt="Profile picture">
            </div>

            <div class="profile-item">
                <span class="label">Naam:</span>
                <span class="value"><?= htmlspecialchars($result['name']); ?></span>
            </div>
            <div class="profile-item">
                <span class="label">Tussenvoegsel:</span>
                <span class="value"><?= htmlspecialchars($result['middle_name']); ?></span>
            </div>
            <div class="profile-item">
                <span class="label">Achternaam:</span>
                <span class="value"><?= htmlspecialchars($result['last_name']); ?></span>
            </div>
            <div class="profile-item">
                <span class="label">Stad:</span>
                <span class="value"><?= htmlspecialchars($result['woonplaats_name']); ?></span>
            </div>
            <div class="profile-item">
                <span class="label">Straat:</span>
                <span class="value"><?= htmlspecialchars($result['street']); ?></span>
            </div>
            <div class="profile-item">
                <span class="label">Huisnummer:</span>
                <span class="value"><?= htmlspecialchars($result['house_number']); ?></span>
            </div>
            <div class="profile-item">
                <span class="label">Postcode:</span>
                <span class="value"><?= htmlspecialchars($result['postal_code']); ?></span>
            </div>
            <div class="profile-item">
                <span class="label">Email:</span>
                <span class="value"><?= htmlspecialchars($result['email']); ?></span>
            </div>
            <div class="profile-item">
                <span class="label">Wachtwoord:</span>
                <span>
                    <button class="aanpassen" onclick="window.location.href='index.php?page=changepassword&users_id=<?= $result['users_id'] ?>'">
                        ******* Wijzig
                    </button>
                </span>
            </div>
            <div class="profile-item">
                <span class="label">Geboortedatum:</span>
                <span class="value"><?= htmlspecialchars($result['date_of_birth']); ?></span>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no-data">Geen gegevens gevonden.</p>
    <?php endif; ?>
</main-profile>
