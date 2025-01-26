

    <?php

    include(__DIR__ . '/../../private/db_connect.php');
    $users_id = $_SESSION['users_id'];

    try {

        $sql = "SELECT * FROM reserveren where users_id = $users_id";
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


                    <th> afbeelding</th>
                    <th> title</th>
                    <th>datum gereserveerd</th>
                    <th>onreserveren</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td>
                            <img src="<?php echo htmlspecialchars($book['image_path']); ?>" alt="Boekafbeelding" style="width: 100px; height: auto;">
                        </td>
                        <td><?php echo htmlspecialchars($book['title']); ?></td>
                        <td><?php echo htmlspecialchars($book['reserved_at']); ?></td>
                        <td>
                            <form method="post" action="php/onreserveren.php" style="display:inline;">
                                <input type="hidden" name="books_id" value="<?= $book['books_id']; ?>">
                                <button class="verwijderen" type="submit"  ">Delete </button>
                            </form>
                        </td>


<!--                        <td>  <form method="post" action="php/terug-brengen.php" style="display:inline;">-->
<!--                                <input type="hidden" name="books_id" value="--><?php //echo $book['books_id']; ?><!--">-->
<!--                                <input type="hidden" name="users_id" value="...">-->
<!--                                <button class="button_lenen" type="submit">terug brengen</button>-->
<!--                            </form> </td>-->
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Geen boeken gevonden.</p>
        <?php endif; ?>
    </main>


</main>