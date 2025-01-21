<?php
include(__DIR__ . '/../../private/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $genre = $_POST['genre'];
    $genre_id = $_POST['genre_id'];


    $sql = "INSERT INTO genre (genre) 
                    VALUES ( :genre )";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':genre', $genre);



        if ($stmt->execute()) {
            header("Location: ../index.php?page=add");
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