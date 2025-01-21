<?php
include(__DIR__ . '/../../private/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $genre = $_POST['genre'];
    $genre_id = $_POST['genre_id'];


    $sql=" UPDATE genre SET genre = :genre  WHERE genre_id = :genre_id";


    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':genre_id', $genre_id);



        if ($stmt->execute()) {
            header("Location: ../index.php?page=genre");
            exit;
        } else {
            echo "Er is iets fout gegaan, probeer opnieuw";
            header("Location: ../index.php?page=add-genre");
            exit;
        }
    } catch (PDOException $e) {
        echo "Fout: " . $e->getMessage();
    }

}
?>