<?php
include(__DIR__ . '/../../private/db_connect.php');

try {
    $sql = "SELECT * FROM users_table ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>



<main>

    <?php if (!empty($users)): ?>

        <table>
            <thead>
            <tr>
                <th>Profile foto</th>
                <th>Naam</th>
                <th>email</th>

            </tr>
            </thead>
            <tbody>

            <?php foreach ($users as $result): ?>
                <tr>
                    <td>
                        <img class="boek-afbeelding" src="<?= !empty($result['profile_pic']) ? htmlspecialchars($result['profile_pic']) : 'images/login.webp'; ?>" >

                    </td>
                    <td><?= htmlspecialchars($result['name']); ?></td>
                    <td><?= htmlspecialchars($result['email']); ?></td>



                    <td><button class="aanpassen"  onclick="window.location.href='index.php?page=edit-users&users_id=<?= $result['users_id'] ?>'">aanpassen</button> </td>


                    <td>  <form method="post" action="php/usersoverview.php" style="display:inline;">
                            <input type="hidden" name="users_id" value="<?php echo $result['users_id']; ?>">
                            <button class="verwijderen" type="submit" onclick="return confirm('Weet je zeker dat je dit boek wilt verwijderen?')">Verwijderen</button>
                        </form> </td>
                </tr>

                <?php
                if (isset($_SESSION['error'])) {
                    echo '<p class="error">' . $_SESSION['error'] . '</p>';
                    unset($_SESSION['error']);
                }
                ?>



            <?php endforeach; ?>
            </tbody>
            <?php
            if (isset($_SESSION['success'])) {
                echo '<p class="succes">' . $_SESSION['success'] . '</p>';
                unset($_SESSION['success']);
            }
            ?>
        </table>
    <?php else: ?>
        <p>Geen gebruikers gevonden.</p>
    <?php endif; ?>
</main>





