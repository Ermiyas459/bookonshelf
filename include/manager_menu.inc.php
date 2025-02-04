<?php
include(__DIR__ . '/../../private/db_connect.php');
//include 'include/navbar-manager.inc.php';


try {

    $query = "SELECT b.books_id, b.title, b.isbn, b.page_count, b.copies_available, b.image_path,
                     COALESCE(s.name, 'Onbekend') AS author_name, 
                     COALESCE(g.genre, 'Onbekend') AS genre_name, 
                     COALESCE(t.taal, 'Onbekend') AS language_name
              FROM books b
              LEFT JOIN schrijvers s ON b.author = s.author_id
              LEFT JOIN genre g ON b.genre = g.genre_id
              LEFT JOIN taal t ON b.language = t.taal_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Fout bij ophalen van gegevens: " . $e->getMessage();
}
?>
<!--<link rel="stylesheet" type="text/css" href="css/styles.css">-->


<main>
    <?php if (!empty($books)): ?>
        <table>
            <thead>
            <tr>
                <th>Afbeelding</th>
                <th>Titel</th>
                <th>Schrijver</th>
                <th>Genre</th>
                <th>ISBN</th>
                <th>Taal</th>
                <th>Aantal Pagina's</th>
                <th>Beschikbare Exemplaren</th>
                <th>Aanpassen</th>
                <th>Verwijderen</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td>
                        <img class="boek-afbeelding" src="<?= htmlspecialchars($book['image_path']); ?>" alt="Boekafbeelding">
                    </td>

                    <td><?= htmlspecialchars($book['title']); ?></td>
                    <td><?= htmlspecialchars($book['author_name']); ?></td>
                    <td><?= htmlspecialchars($book['genre_name']); ?></td>
                    <td><?= htmlspecialchars($book['isbn']); ?></td>
                    <td><?= htmlspecialchars($book['language_name']); ?></td>
                    <td><?= htmlspecialchars($book['page_count']); ?></td>
                    <td><?= htmlspecialchars($book['copies_available']); ?></td>
                    <td>
                        <button class="aanpassen" onclick="window.location.href='index.php?page=edit&books_id=<?= $book['books_id'] ?>'">Aanpassen</button>
                    </td>
                    <td>
                        <form method="post" action="php/manager_menu.php" style="display:inline;">
                            <input type="hidden" name="books_id" value="<?= $book['books_id']; ?>">
                            <button class="verwijderen" type="submit"  ">Verwijderen </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>
            Geen boeken gevonden.
        </p>
    <?php endif; ?>
</main>
