<?php
include(__DIR__ . '/../../private/db_connect.php');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $users_id = $_POST['users_id'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "wachtwoorden komen niet overeen!";
        header('Location: ../index.php?page=changepassword');
        exit();
    }



    try {
        $sql = " UPDATE users_table  SET password = :password, confirm_password = :confirm_password  WHERE users_id = :users_id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':users_id', $users_id);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':confirm_password', $confirm_password);

        if ($stmt->execute()) {
            header("Location: ../index.php?page=profile");
            exit;

        } else {
            echo 'Er is iets fout gegaan.';
        }
    } catch (PDOException $e) {
        echo "Fout " . $e->getMessage();
    }

}