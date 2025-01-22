<?php
include(__DIR__ . '/../../private/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $author_id = $_POST['author_id'];


    $sql = "INSERT INTO schrijvers ( name) 
                    VALUES ( :name )";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);


        if ($stmt->execute()) {
            header("Location: ../index.php?page=schrijvers");
            exit;
        } else {
            echo "Er is iets fout gegaan, probeer opnieuw";
            header("Location: ../index.php?page=add-schrijvers");
            exit;
        }
    } catch (PDOException $e) {
        echo "Fout: " . $e->getMessage();
    }

}
?>