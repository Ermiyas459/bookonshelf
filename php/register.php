

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

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "wachtwoorden komen niet overeen!";
        header('Location: ../index.php?page=register');
        exit();
    }

try {

    $sql = "SELECT COUNT(*) FROM users_table WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $email_exists = $stmt->fetchColumn();

    if ($email_exists) {
        $_SESSION['error'] = "E-mail is al in gebruik!";
        header('Location: ../index.php?page=register');
        exit();
    }


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement to insert new user
    $sql = "INSERT INTO users_table (name, middle_name, last_name, city, street, house_number, postal_code, email, password, confirm_password, birth_date, role) 
            VALUES (:name, :middle_name, :last_name, :city, :street, :house_number, :postal_code, :email, :password, :confirm_password, :dob, 'user')";

    try {
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


        if ($stmt->execute()) {
            header("Location: ../index.php?page=login");
            exit();
        } else {
            echo "Er is een fout opgetreden bij het registreren van de gebruiker, probeer opnieuw.";
            header("Location: ../index.php?page=login");
            exit();
        }
    } catch (PDOException $e) {
        echo "error" . $e->getMessage();
    }
}catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();}
}
?>

