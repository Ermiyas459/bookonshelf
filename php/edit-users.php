<?php
include(__DIR__ . '/../../private/db_connect.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $city = $_POST['city'];
    $street = $_POST['street'];
    $house_number = $_POST['house_number'];
    $postal_code = $_POST['postal_code'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $birth_date = $_POST['birth_date'];
    $users_id = $_POST['users_id'];
//
//    try {
//        $sql = "SELECT COUNT(*) FROM users_table WHERE email = :email AND users_id = :users_id";
//        $stmt = $pdo->prepare($sql);
//        $stmt->bindParam(':email', $email);
//        $stmt->bindParam(':users_id', $users_id, PDO::PARAM_INT);
//        $stmt->execute();
//        $email_exists = $stmt->fetchColumn();
//
//        if ($email_exists) {
//            $_SESSION['error'] = "E-mail is al in gebruik!";
//            header('Location: ../index.php?page=edit-users');
//            exit();
//        }

        $sql = "UPDATE users_table 
                SET name = :name, middle_name = :middle_name, last_name = :last_name, 
                    city = :city, street = :street, house_number = :house_number, 
                    postal_code = :postal_code, email = :email, birth_date = :birth_date, 
                    role = :role 
                WHERE users_id = :users_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':middle_name', $middle_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':house_number', $house_number);
        $stmt->bindParam(':postal_code', $postal_code);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':birth_date', $birth_date);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':users_id', $users_id);

        if ($stmt->execute()) {
            header("Location: ../index.php?page=usersoverview");
            exit();
        } else {
            $_SESSION['error'] = "Fout bij het bijwerken, probeer het opnieuw.";
            header("Location: ../index.php?page=edit-users");
            exit();
        }
//    } catch (PDOException $e) {
//        $_SESSION['error'] = "Databasefout: " . $e->getMessage();
//        header("Location: ../index.php?page=edit-users");
//        exit();
//    }
}
?>
