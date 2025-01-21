<?php
include(__DIR__ . '/../../private/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $author_id = $_POST['author_id'];


    $sql = "INSERT INTO schrijvers ( name, middleName, lastName) 
                    VALUES ( :name , :middleName, :lastName )";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':middleName', $middleName);
        $stmt->bindParam(':lastName', $lastName);


        if ($stmt->execute()) {
            header("Location: ../index.php?page=add");
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