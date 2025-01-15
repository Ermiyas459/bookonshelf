
<?php
include(__DIR__ . '/../../private/db_connect.php');
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users_table WHERE email = :email";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':email', $email);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);



    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['users_id'] = $user['users_id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];


        if ($user['role'] === 'admin') {
            header('Location: ../index.php?page=manager_menu');
            exit;
        } else {
            header('Location:../index.php?page=usersmenu');
            exit;
        }

    } else {
        $error = 'This user does not exist.';
        header('Location: ../index.php?page=login&error=' . urlencode($error));
        exit();

    }
}
?>


