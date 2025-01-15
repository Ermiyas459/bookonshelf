
<?php
include(__DIR__ . '/../../private/db_connect.php');



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['taal_id'])) {
    $taal_id = $_POST['taal_id'];

    try {
        $sql = 'DELETE FROM taal WHERE taal_id = :taal_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':taal_id', $taal_id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Fout: " . $e->getMessage();
    }
}



header('Location: ../index.php?page=taal');

?>