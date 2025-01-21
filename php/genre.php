
<?php
include(__DIR__ . '/../../private/db_connect.php');



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['genre_id'])) {
    $genre_id = $_POST['genre_id'];

    try {
        $sql = 'DELETE FROM genre WHERE genre_id = :genre_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':genre_id', $genre_id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Fout: " . $e->getMessage();
    }
}



header('Location: ../index.php?page=genre');

?>