
<?php
include(__DIR__ . '/../../private/db_connect.php');



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['author_id'])) {
    $author_id = $_POST['author_id'];

    try {
        $sql = 'DELETE FROM schrijvers WHERE author_id = :author_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':author_id', $author_id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Fout: " . $e->getMessage();
    }
}



header('Location: ../index.php?page=schrijvers');

?>