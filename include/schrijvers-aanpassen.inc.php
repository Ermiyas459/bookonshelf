<?php
include(__DIR__ . '/../../private/db_connect.php');

$author_id=$_GET["author_id"];

$sql = "SELECT * FROM schrijvers WHERE author_id=:author_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':author_id', $author_id);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<div class="edit-page">
    <main class="edit">
        <h2>aanpassen</h2>


        <form method="POST" action="php/edit-schrijvers.php" enctype="multipart/form-data">
            <input type="hidden" name="author_id" value="<?php echo $result['author_id'] ?>">
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" id="" name="name" value="<?php echo $result['name']?> " >
            </div>

            <button type="submit" class="toevegen-knop">aanpassen</button>
        </form>
    </main>
</div>