


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

                        <td> <form method="post" action="php/gereserveerde_boeken.php" style="display:inline;">
                            <input type="hidden" name="books_id" value="<?= $book['books_id'] ?>">
                            <input type="hidden" name="users_id" value="...">
                            <input type="hidden" name="title" value="<?= $book['title'] ?>">
                            <input type="hidden" name="author" value="<?= $book['author'] ?>">
                            <input type="hidden" name="genre" value="<?= $book['genre'] ?>">
                            <input type="hidden" name="isbn" value="<?= $book['isbn'] ?>">
                            <input type="hidden" name="language" value="<?= $book['language'] ?>">
                            <input type="hidden" name="page_count" value="<?= $book['page_count'] ?>">
                            <input type="hidden" name="copies_available" value="<?= $book['copies_available'] ?>">
                            <button class="button_reserveren" type="submit" ">reserveren</button>
                            </form>

                        </td>
                        <td>  <form method="post" action="php/geleende_boeken.php" style="display:inline;">
                                <input type="hidden" name="books_id" value="<?= $book['books_id'] ?>">
                                <input type="hidden" name="users_id" value="...">
                                <input type="hidden" name="title" value="<?= $book['title'] ?>">
                                <input type="hidden" name="author" value="<?= $book['author'] ?>">
                                <input type="hidden" name="genre" value="<?= $book['genre'] ?>">
                                <input type="hidden" name="isbn" value="<?= $book['isbn'] ?>">
                                <input type="hidden" name="language" value="<?= $book['language'] ?>">
                                <input type="hidden" name="page_count" value="<?= $book['page_count'] ?>">
                                <input type="hidden" name="copies_available" value="<?= $book['copies_available'] ?>">
                                <button class="button_lenen" type="submit">lenen</button>
                            </form> </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Geen boeken gevonden.</p>
        <?php endif; ?>
    </main>


<!--Footer Section -->
<!--    <footer class="footer">-->
<!--        <div class="footer-container">-->
<!--            <div class="logo">-->
<!--                <img src="../images/book-on-shelf.png" alt="Logo">-->
<!--            </div>-->
<!--            <div class="contact-info">-->
<!--                <p>Contact Us: bookon@shelf</p>-->
<!--                <p>Phone: +123 456 7890</p>-->
<!--                <p>Address: 123 Book Street, Library City, 4567</p>-->
<!--            </div>-->
<!--            <div class="quick-links">-->
<!--                <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a> | <a href="#">About Us</a> | <a href="#">Contact</a></p>-->
<!--            </div>-->
<!--            <div class="social-media">-->
<!--                <a href="#"><img src="../images/download%20(1).jpeg" alt="Facebook"></a>-->
<!--                <a href="#"><img src="../images/download.png" alt="Twitter"></a>-->
<!--                <a href="#"><img src="../images/download%20(2).jpeg" alt="Instagram"></a>-->
<!--            </div>-->
<!--        </div>-->
<!--    </footer>-->
</main>