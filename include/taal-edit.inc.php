<?php
include(__DIR__ . '/../../private/db_connect.php');

$taal_id=$_GET["taal_id"];

$sql = "SELECT * FROM taal WHERE taal_id=:taal_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':taal_id', $taal_id);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<div class="edit-page">
    <main class="edit">
        <h2>aanpassen</h2>


        <form method="POST" action="php/edit-taal.php" enctype="multipart/form-data">
            <input type="hidden" name="taal_id" value="<?php echo $result['taal_id'] ?>">
            <div class="form-group">
                <label for="taal">taal</label>
                <input type="text" id="taal" name="taal" value="<?php echo $result['taal']?> " >
            </div>
            <button type="submit" class="toevegen-knop">aanpassen</button>
        </form>
    </main>
</div>