<?php
include(__DIR__ . '/../../private/db_connect.php');

$author_id=$_GET["author_id"];

$sql = "SELECT * FROM genre WHERE genre_id=:genre_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':genre_id', $genre_id);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<div class="edit-page">
    <main class="edit">
        <h2>aanpassen</h2>


        <form method="POST" action="php/edit-genre.php" enctype="multipart/form-data">
            <input type="hidden" name="genre_id" value="<?php echo $result['genre_id'] ?>">
            <div class="form-group">
                <label for="name">gerne</label>
                <input type="text" id="gerne" name="genre" value="<?php echo $result['gerne']?> " >
            </div>

            <button type="submit" class="toevegen-knop">aanpassen</button>
        </form>
    </main>
</div>