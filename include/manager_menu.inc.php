<?php
include(__DIR__ . '/../../private/db_connect.php');

try {
    $sql = "SELECT * FROM books";
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

            <?php foreach ($books as $result): ?>
                <tr>

                    <td><?= htmlspecialchars($result['title']); ?></td>
                    <td><?= htmlspecialchars($result['author']); ?></td>
                    <td><?= htmlspecialchars($result['genre']); ?></td>
                    <td><?= htmlspecialchars($result['isbn']); ?></td>
                    <td><?= htmlspecialchars($result['language']); ?></td>
                    <td><?= htmlspecialchars($result['page_count']); ?></td>
                    <td><?= htmlspecialchars($result['copies_available']); ?></td>

                    <td><button class="aanpassen"  onclick="window.location.href='index.php?page=edit&books_id=<?= $result['books_id'] ?>'">aanpassen</button> </td>

                    <td>  <form method="post" action="php/manager_menu.php" style="display:inline;">
                            <input type="hidden" name="books_id" value="<?php echo $result['books_id']; ?>">
                            <button class="verwijderen" type="submit" onclick="return confirm('Weet je zeker dat je dit boek wilt verwijderen?')">Verwijderen</button>
                        </form> </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Geen boeken gevonden.</p>
    <?php endif; ?>
</main>





