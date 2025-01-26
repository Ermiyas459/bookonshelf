<?php
include(__DIR__ . '/../../private/db_connect.php');



// Verwijder logica
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['books_id'])) {
    $books_id = $_POST['books_id'];

    try {
        // Verwijder boek uit de database
        $sql = 'DELETE FROM reserveren WHERE books_id = :books_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':books_id', $books_id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Fout: " . $e->getMessage();
    }
}
header('Location: ../index.php?page=gereserveerde_boeken');
