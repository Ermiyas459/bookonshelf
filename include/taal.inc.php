<?php
include(__DIR__ . '/../../private/db_connect.php');

try {
    $sql = "SELECT * FROM taal";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "error!!" . $e->getMessage();
}

?>

<main>

    <?php if (!empty($books)): ?>
        <table>
            <thead>
            <tr>
                <th>Taal</th>
                <th>Aanpassen</th>
                <th>Verwijderen</th>
                <th>   <button class="aanpassen" onclick="window.location.href='index.php?page=add-taal'">Toevoegen</button>
                </th>


            </tr>

            </thead>
            <tbody>

            <?php foreach ($books as $result): ?>
                <tr>

                    <td><?= htmlspecialchars($result['taal']); ?></td>
                    <td><button class="aanpassen"  onclick="window.location.href='index.php?page=taal-edit&taal_id=<?= $result['taal_id'] ?>'">Aanpassen</button> </td>

                    <td>  <form method="post" action="php/taal.php" style="...">
                            <input type="hidden" name="taal_id" value="<?php echo $result['taal_id']; ?>">
                            <button class="verwijderen" type="submit">Verwijderen</button>
                        </form> </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Geen boeken gevonden.</p>
    <?php endif; ?>
</main>




