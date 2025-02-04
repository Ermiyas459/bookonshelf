
<?php
include(__DIR__ . '/../../private/db_connect.php');

try {
    $query = "
        SELECT b.books_id, b.title, b.isbn, b.page_count, b.copies_available, b.image_path,
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
    die("Fout bij ophalen van gegevens: " . $e->getMessage());
}
?>





    <main-group>


        <?php if (!empty($books)): ?>
        <?php
        if (isset($_SESSION['error'])) {
            echo '<p class="error">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);
        }
        ?>
        <div class="book-grid">
            <?php foreach ($books as $book): ?>

            <div class="book-card">

                <img src="<?= htmlspecialchars($book['image_path']); ?>" alt="Boekafbeelding">
                <h3><?= htmlspecialchars($book['title']); ?></h3>
                <p><strong>Auteur:</strong> <?= htmlspecialchars($book['author_name']); ?></p>
                <p><strong>Genre:</strong> <?= htmlspecialchars($book['genre_name']); ?></p>
                <p><strong>ISBN:</strong> <?= htmlspecialchars($book['isbn']); ?></p>
                <p><strong>Taal:</strong> <?= htmlspecialchars($book['language_name']); ?></p>
                <p><strong>Pagina's:</strong> <?= htmlspecialchars($book['page_count']); ?></p>
                <p><strong>Beschikbare exemplaren:</strong> <?= htmlspecialchars($book['copies_available']); ?></p>


                        <td> <form method="post" action="php/gereserveerde_boeken.php" style="display:inline;">
                            <input type="hidden" name="books_id" value="<?= $book['books_id'] ?>">
                            <input type="hidden" name="users_id" value="...">
                            <input type="hidden" name="title" value="<?= $book['title'] ?>">
                            <input type="hidden" name="author" value="<?= $book['author_name'] ?>">
                            <input type="hidden" name="genre" value="<?= $book['genre_name'] ?>">
                            <input type="hidden" name="isbn" value="<?= $book['isbn'] ?>">
                            <input type="hidden" name="language" value="<?= $book['language_name'] ?>">
                            <input type="hidden" name="page_count" value="<?= $book['page_count'] ?>">
                                <input type="hidden" name="copies_available" value="<?= $book['copies_available'] ?>">
                            <input type="hidden" name="image_path" value="<?= $book['image_path'] ?>">
                            <button class="button_reserveren" type="submit" ">Reserveren</button>
                            </form>



                        </td>

                        <td>  <form method="post" action="php/geleende_boeken.php" style="display:inline;">
                                <input type="hidden" name="books_id" value="<?= $book['books_id'] ?>">
                                <input type="hidden" name="users_id" value="...">
                                <input type="hidden" name="title" value="<?= $book['title'] ?>">
                                <input type="hidden" name="author" value="<?= $book['author_name'] ?>">
                                <input type="hidden" name="genre" value="<?= $book['genre_name'] ?>">
                                <input type="hidden" name="isbn" value="<?= $book['isbn'] ?>">
                                <input type="hidden" name="language" value="<?= $book['language_name'] ?>">
                                <input type="hidden" name="page_count" value="<?= $book['page_count'] ?>">
                                <input type="hidden" name="image_path" value="<?= $book['image_path'] ?>">
                                <input type="hidden" name="copies_available" value="<?= $book['copies_available'] ?>">
                                <button class="button_lenen" type="submit">Lenen</button>
                            </form> </td>

            </div>
                <?php endforeach; ?>

        </div>

    </main-group>

        <?php else: ?>
            <p>Geen boeken gevonden.</p>
        <?php endif; ?>

</body-users>


