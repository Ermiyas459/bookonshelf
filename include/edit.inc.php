<?php
include(__DIR__ . '/../../private/db_connect.php');
$books_id = $_GET["books_id"];

try {
    // Fetch book data
    $sql = "SELECT * FROM books WHERE books_id = :books_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':books_id', $books_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        throw new Exception("Book not found.");
    }

    $authorsQuery = "SELECT * FROM schrijvers";
    $authorsStmt = $pdo->query($authorsQuery);
    $authors = $authorsStmt->fetchAll(PDO::FETCH_ASSOC);

    $genresQuery = "SELECT * FROM genre";
    $genresStmt = $pdo->query($genresQuery);
    $genres = $genresStmt->fetchAll(PDO::FETCH_ASSOC);

    $languagesQuery = "SELECT * FROM taal";
    $languagesStmt = $pdo->query($languagesQuery);
    $languages = $languagesStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>
<div class="add-page">
    <main class="add">
        <h2>aanpassen</h2>


        <form method="POST" action="php/edit.php" enctype="multipart/form-data">
            <input type="hidden" name="books_id" value="<?php echo htmlspecialchars($result['books_id']); ?>">

            <!-- Title -->
            <div class="form-group">
                <label for="title">Titel</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($result['title']); ?>" required>
            </div>

            <!-- Author -->
            <div class="form-group">
                <label for="author">Auteur</label>
                <div class="select-with-link">
                    <select id="author" name="author" required>
                        <?php foreach ($authors as $author): ?>
                            <option value="<?php echo htmlspecialchars($author['author_id']); ?>"
                                <?php echo ($author['author_id'] == $result['author']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($author['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
<!--                    <a href="index.php?page=schrijvers" class="add-new-link">Nieuwe auteur toevoegen</a>-->
                </div>
            </div>

            <!-- Genre -->
            <div class="form-group">
                <label for="genre">Genre</label>
                <div class="select-with-link">
                    <select id="genre" name="genre" required>
                        <?php foreach ($genres as $genre): ?>
                            <option value="<?php echo htmlspecialchars($genre['genre_id']); ?>"
                                <?php echo ($genre['genre_id'] == $result['genre']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($genre['genre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
<!--                    <a href="index.php?page=genre" class="add-new-link">Nieuw genre toevoegen</a>-->
                </div>
            </div>

            <!-- Language -->
            <div class="form-group">
                <label for="language">Taal</label>
                <div class="select-with-link">
                    <select id="language" name="language" required>
                        <?php foreach ($languages as $language): ?>
                            <option value="<?php echo htmlspecialchars($language['taal_id']); ?>"
                                <?php echo ($language['taal_id'] == $result['language']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($language['taal']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
<!--                    <a href="index.php?page=taal" class="add-new-link">Nieuwe taal toevoegen</a>-->
                </div>
            </div>

            <!-- ISBN -->
            <div class="form-group">
                <label for="isbn">ISBN-nummer</label>
                <input type="text" id="isbn" name="isbn" value="<?php echo htmlspecialchars($result['isbn']); ?>" required>
            </div>

            <!-- Page Count -->
            <div class="form-group">
                <label for="page_count">Aantal pagina's</label>
                <input type="number" id="page_count" name="page_count" value="<?php echo htmlspecialchars(trim($result['page_count'])); ?>" required>
            </div>

            <!-- Copies Available -->
            <div class="form-group">
                <label for="copies_available">Aantal beschikbare exemplaren</label>
                <input type="number" id="copies_available" name="copies_available" value="<?php echo htmlspecialchars(trim($result['copies_available'])); ?>" required>
            </div>
            <label for="images_path">Afbeelding:</label>
            <input type="file" name="images_path" id="images_path" value="<?php echo htmlspecialchars(trim($result['image_path'])); ?>" accept="image/*" required><br><br>

            <!-- Submit Button -->
            <button type="submit" class="aanpassen">Aanpassen</button>
        </form>
    </main>
</div>
