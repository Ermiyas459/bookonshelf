<?php
include(__DIR__ . '/../../private/db_connect.php');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];

    $author_id = $_POST['author_id'];



    try {
        $sql=" UPDATE schrijvers SET name = :name  WHERE author_id = :author_id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':author_id', $author_id);


        if ($stmt->execute()) {
            header("Location: ../index.php?page=schrijvers");
            exit;

        } else {
            echo 'Er is iets fout gegaan.';
        }
    } catch (PDOException $e) {
        echo "Fout " . $e->getMessage();
    }

}
?>