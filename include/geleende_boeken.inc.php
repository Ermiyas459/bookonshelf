
<main>

    <?php

    include(__DIR__ . '/../../private/db_connect.php');
    $users_id = $_SESSION['users_id'];

    try {

        $sql = "SELECT * FROM lenen where users_id = $users_id";
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


                    <th> title</th>
                    <th>exemplaren</th>
                    <th>datum geleend</th>
                    <th>terugbrengen</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>

                        <td><?php echo htmlspecialchars($book['title']); ?></td>
                        <td><?php echo htmlspecialchars($book['copies_available']); ?></td>
                        <td><?php echo htmlspecialchars($book['date-borrowed']); ?></td>


                        <td>  <form method="post" action="php/terug-brengen.php" style="display:inline;">
                                <input type="hidden" name="books_id" value="<?php echo $book['books_id']; ?>">
                                <input type="hidden" name="users_id" value="...">
                                <input type="hidden" name="title" value="<?php echo $book['title']; ?>">
                                <input type="hidden" name="author" value="<?php echo $book['author']; ?>">
                                <input type="hidden" name="genre" value="<?php echo $book['genre']; ?>">
                                <input type="hidden" name="isbn" value="<?php echo $book['isbn']; ?>">
                                <input type="hidden" name="language" value="<?php echo $book['language']; ?>">
                                <input type="hidden" name="page_count" value="<?php echo $book['page_count']; ?>">
                                <input type="hidden" name="copies_available" value="<?php echo $book['copies_available']; ?>">

                                <button class="button_lenen" type="submit">terug brengen</button>
                            </form> </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Geen boeken gevonden.</p>
        <?php endif; ?>
    </main>


</main>