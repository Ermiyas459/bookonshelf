
<?php
include(__DIR__ . '/../../private/db_connect.php');



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['users_id'])) {
    $users_id = $_POST['users_id'];

    try {
        $sql = 'DELETE FROM users_table WHERE users_id = :users_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':users_id', $users_id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Fout: " . $e->getMessage();
    }
}




header('Location: ../index.php?page=usersoverview');

?>