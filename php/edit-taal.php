<?php
include(__DIR__ . '/../../private/db_connect.php');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $taal = $_POST['taal'];
    $taal_id = $_POST['taal_id'];



    try {
        $sql=" UPDATE taal SET taal = :taal  WHERE taal_id = :taal_id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':taal', $taal);
        $stmt->bindParam(':taal_id', $taal_id);

        if ($stmt->execute()) {
            header("Location: ../index.php?page=taal");
            exit;

        } else {
            echo 'Er is iets fout gegaan.';
        }
    } catch (PDOException $e) {
        echo "Fout " . $e->getMessage();
    }

}
?>