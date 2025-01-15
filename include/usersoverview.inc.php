<?php
include(__DIR__ . '/../../private/db_connect.php');

try {
    $sql = "SELECT * FROM users_table";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "error!!" . $e->getMessage();
}
?>

<main>

    <?php if (!empty($users)): ?>
        <table>
            <thead>
            <tr>

                <th>Title</th>
                <th>Schrijver</th>
                <th>Genre</th>
                <th>ISBN</th>
                <th>Taal</th>
                <th>Aantal Pagina's</th>
                <th>Beschikbare Exemplaren</th>
                <th>aanpassen</th>
                <th>verwijderen</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($users as $result): ?>
                <tr>

                    <td><?= htmlspecialchars($result['name']); ?></td>
                    <td><?= htmlspecialchars($result['middle_name']); ?></td>
                    <td><?= htmlspecialchars($result['last_name']); ?></td>
                    <td><?= htmlspecialchars($result['city']); ?></td>
                    <td><?= htmlspecialchars($result['street']); ?></td>
                    <td><?= htmlspecialchars($result['house_number']); ?></td>
                    <td><?= htmlspecialchars($result['postal_code']); ?></td>
                    <td><?= htmlspecialchars($result['email']); ?></td>
                    <td><?= htmlspecialchars($result['birth_date']); ?></td>


                    <td><button class="aanpassen"  onclick="window.location.href='index.php?page=edit-users&users_id=<?= $result['users_id'] ?>'">aanpassen</button> </td>

                    <td>  <form method="post" action="php/usersoverview.php" style="display:inline;">
                            <input type="hidden" name="users_id" value="<?php echo $result['users_id']; ?>">
                            <button class="verwijderen" type="submit" onclick="return confirm('Weet je zeker dat je dit boek wilt verwijderen?')">Verwijderen</button>
                        </form> </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Geen gebruikers gevonden.</p>
    <?php endif; ?>
</main>





