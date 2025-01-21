<?php
include(__DIR__ . '/../../private/db_connect.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $city = $_POST['city'];
    $street = $_POST['street'];
    $house_number = $_POST['house_number'];
    $postal_code = $_POST['postal_code'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $dob = $_POST['dob'];
    $role = $_POST['role'];

    // Validate if the passwords match
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Wachtwoorden komen niet overeen!";
        header('Location: ../index.php?page=usersoverview');
        exit();
    }

    // Validate the date of birth to make sure it's not in the future
    $input_date = new DateTime($dob);
    $current_date = new DateTime();
    if ($input_date > $current_date) {
        $_SESSION['error'] = "De geboortedatum kan niet in de toekomst liggen!";
        header('Location: ../index.php?page=usersoverview');
        exit();
    }

    try {
        // Check if the email already exists
        $sql = "SELECT COUNT(*) FROM users_table WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $email_exists = $stmt->fetchColumn();

        if ($email_exists) {
            $_SESSION['error'] = "E-mail is al in gebruik!";
            header('Location: ../index.php?page=usersoverview');
            exit();
        }

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL statement to insert new user
        $sql = "INSERT INTO users_table (name, middle_name, last_name, city, street, house_number, postal_code, email, password, confirm_password, date_of_birth, role) 
                VALUES (:name, :middle_name, :last_name, :city, :street, :house_number, :postal_code, :email, :password, :confirm_password, :dob, :role)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':middle_name', $middle_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':house_number', $house_number);
        $stmt->bindParam(':postal_code', $postal_code);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':confirm_password', $hashed_password);
        $stmt->bindParam(':dob', $dob);
        $stmt->bindParam(':role', $role);

        if ($stmt->execute()) {
            $_SESSION['success'] = "U heeft een nieuwe gebruiker!";
            header("Location: ../index.php?page=usersoverview");
            exit();
        } else {
            echo "Er is een fout opgetreden bij het registreren van de gebruiker, probeer opnieuw.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
