<?php
include(__DIR__ . '/../../private/db_connect.php');

try {
    $query = "
        SELECT u.users_id, u.name, u.middle_name, u.last_name, u.email, u.city, u.street, u.house_number, 
               u.postal_code, u.date_of_birth, 
               COALESCE(r.role, 'Onbekend') AS role_name
        FROM users_table u
        LEFT JOIN role r ON u.role = r.role_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Fout bij ophalen van gegevens: " . $e->getMessage());
}


?>

<main1>


    <?php if (!empty($users)): ?>

        <table1>
            <thead1>
            <tr1>
                <th1>

                <th1>Profile foto</th1>
                <th1>Naam</th1>
                <th1>Tussenvoegsel</th1>
                <th>Achternaam</th>
                <th1>stad</th1>
                <th1>straat</th1>
                <th1>huis nummer</th1>
                <th1>post code</th1>
                <th1>email</th1>
                    <th1>geboorte datum</th1>
                <th1>role</th1>

                    <toevoegen1>
                        <button class="aanpassen1" onclick="window.location.href='index.php?page=add-users'">toevoegen</button>
                    </toevoegen1>
            </tr1>
            </thead1>

            <tbody1>

            <?php foreach ($users as $result): ?>
                <tr1>

                    <?php
                    if (isset($_SESSION['success'])) {
                        echo '<p class="succes">' . $_SESSION['success'] . '</p>';
                        unset($_SESSION['success']);
                    }
                    ?>
                    <img src="<?= !empty($result['profile_pic']) ? htmlspecialchars($result['profile_pic']) : 'images/login.webp'; ?>" alt="Profile photo">

                    <td1><?= htmlspecialchars($result['name']); ?></td1>
                    <td1><?= htmlspecialchars($result['middle_name']); ?></td1>
                    <td1><?= htmlspecialchars($result['last_name']); ?></td1>
                    <td1><?= htmlspecialchars($result['city']); ?></td1>
                    <td1><?= htmlspecialchars($result['street']); ?></td1>
                    <td1><?= htmlspecialchars($result['house_number']); ?></td1>
                    <td1><?= htmlspecialchars($result['postal_code']); ?></td1>
                    <td1><?= htmlspecialchars($result['email']); ?></td1>
                    <td1><?= htmlspecialchars($result['date_of_birth']); ?></td1>
                    <td1><?= htmlspecialchars($result['role_name']); ?></td1>



                    <tb1><button class="aanpassen"  onclick="window.location.href='index.php?page=edit-users&users_id=<?= $result['users_id'] ?>'">aanpassen</button> </tb1>


                    <tb1>  <form method="post" action="php/usersoverview.php" style="display:inline;">
                            <input type="hidden" name="users_id" value="<?php echo $result['users_id']; ?>">
                            <button class="verwijderen" type="submit" onclick="return confirm('Weet je zeker dat je dit boek wilt verwijderen?')">Verwijderen</button>
                        </form> </tb1>
                </tr1>

                <?php
                if (isset($_SESSION['error'])) {
                    echo '<p class="error">' . $_SESSION['error'] . '</p>';
                    unset($_SESSION['error']);
                }
                ?>



            <?php endforeach; ?>
            </tbody1>
        </table1>
    <?php else: ?>
        <p>Geen gebruikers gevonden.</p>
    <?php endif; ?>
</main1>





