<?php
include(__DIR__ . '/../../private/db_connect.php');

try {
    $sql = "SELECT * FROM schrijvers";
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
            <button class="back" onclick="history.back(-1)">back</button>
         <tr>
                <th>Taal</th>
                <th>aanpassen</th>
                <th>verwijderen</th>
                <th>   <button class="toevoegen" onclick="window.location.href='index.php?page=add-schrijvers'">toevoegen</button>
                </th>


            </tr>

            </thead>
            <tbody>

            <?php foreach ($books as $result): ?>
                <tr>

                    <td><?= htmlspecialchars($result['name']); ?></td>
                    <td><button class="aanpassen"  onclick="window.location.href='index.php?page=schrijvers-aanpassen&author_id=<?= $result['author_id'] ?>'">aanpassen</button> </td>

                    <td>  <form method="post" action="php/schrijvers.php" style="...">
                            <input type="hidden" name="author_id" value="<?php echo $result['author_id']; ?>">
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




