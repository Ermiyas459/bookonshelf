<?php
include(__DIR__ . '/../../private/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$taal = $_POST['taal'];
$taal_id = $_POST['taal_id'];


    $sql = "INSERT INTO taal ( taal) 
                    VALUES ( :taal)";

    try {
        $stmt = $pdo->prepare($sql);
        //$stmt->bindParam(':image', $image_path);
        $stmt->bindParam(':taal', $taal);


        if ($stmt->execute()) {
            header("Location: ../index.php?page=add");
            exit;
        } else {
            echo "Er is iets fout gegaan, probeer opnieuw";
            header("Location: ../index.php?page=add-taal");
            exit;
        }
    } catch (PDOException $e) {
        echo "Fout: " . $e->getMessage();
    }

}
?>