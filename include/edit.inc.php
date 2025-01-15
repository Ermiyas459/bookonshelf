<?php
include(__DIR__ . '/../../private/db_connect.php');
$books_id=$_GET["books_id"];

$sql = "SELECT * FROM books WHERE books_id=:books_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':books_id', $books_id);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<div class="edit-page">
    <main class="edit">
        <h2>aanpassen</h2>

        <form method="POST" action="php/edit.php" enctype="multipart/form-data">
            <input type="hidden" name="books_id" value="<?php echo $result['books_id'] ?>">

            <div class="form-group">
                <label for="title">Titel</label>
                <input type="text" id="title" name="title" value="<?php echo $result['title']?> " required>
            </div>
            <div class="form-group">
                <label for="author">Schrijver</label>
                <input type="text" id="author" name="author" value="<?php echo $result['author']?> " >
            </div>
            <div class="form-group">
                <label for="genre">Genre</label>
                <input type="text" id="genre" name="genre"  value="<?php echo $result['genre']?> "  required>
            </div>
            <div class="form-group">
                <label for="isbn">ISBN-nummer</label>
                <input type="text" id="isbn" name="isbn"  value="<?php echo $result['isbn']?> " required>
            </div>
            <div class="form-group">
                <label for="language">Taal</label>
                <input type="text" id="language" name="language"  value="<?php echo $result['language']?> " required>
            </div>
            <div class="form-group">
                <label for="page_count">Aantal pagina's</label>
                <input type="number" id="page_count" name="page_count" value="<?php echo (trim($result['page_count'])); ?>"  required>

            </div>
            <div class="form-group">
                <label for="copies_available">Aantal beschikbare exemplaren</label>
                <input type="number" id="copies_available" name="copies_available" value="<?php echo (trim($result['copies_available'])); ?>"  required>

            </div>

            <button type="submit" class="toevegen-knop">aanpassen</button>
        </form>
    </main>
</div>