<?php
include(__DIR__ . '/../../private/db_connect.php');
$users_id = $_SESSION['users_id'];

try {
    $sql = "SELECT * FROM users_table WHERE users_id = :users_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':users_id', $users_id);
    $stmt->execute();
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>





<main-profile>

    <?php if (!empty($books)): ?>
        <?php foreach ($books as $result): ?>

               <div class="profile-item">
               <span <img src="<?php echo htmlspecialchars($result['image_path']); ?>" alt="image"></span>
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
                <span class="value"><?= htmlspecialchars($result['city']); ?></span>
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
                <span class="label">email:</span>
                <span class="value"><?= htmlspecialchars($result['email']); ?></span>
            </div>
            <div class="profile-item">
                <span class="label">password:</span>
                <span  <button class="aanpassen" onclick="window.location.href='index.php?page=changepassword&users_id=<?= $result['users_id'] ?>'">*******wijzig</button>  </span>
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

</body1>

