<?php
session_start();
include(__DIR__ . '/../../private/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['users_id']) && isset($_SESSION['users_id'])) {
    $users_id = intval ($_POST['users_id']);
    $current_user_id = intval ($_SESSION['users_id']);

    if ($users_id === $current_user_id) {
        $_SESSION['error'] = "Je kunt jezelf niet verwijderen!";
        header('Location: ../index.php?page=usersoverview');
        exit;
    }

    try {
        $sql = 'DELETE FROM users_table WHERE users_id = :users_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':users_id', $users_id, PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['success'] = "De gebruiker is succesvol verwijderd.";


    } catch (PDOException $e) {
        $_SESSION['error'] = "Fout bij het verwijderen: " . $e->getMessage();
    }
} else {
    $_SESSION['error'] = "Ongeldige actie of ontbrekende gegevens.";
}

header('Location: ../index.php?page=usersoverview');
exit;
?>
