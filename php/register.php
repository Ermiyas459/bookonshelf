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
//    $profile_pic = $_POST['profile_pic'];
    $dob = $_POST['dob'];

    // Validate if the passwords match
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Wachtwoorden komen niet overeen!";
        header('Location: ../index.php?page=register');
        exit();
    }

    // Validate the date of birth to make sure it's not in the future
    $input_date = new DateTime($dob);
    $current_date = new DateTime();
    $too_old = -100;
    if ($input_date > $current_date) {
        $_SESSION['error'] = "De geboortedatum kan niet in de toekomst liggen!";
        header('Location: ../index.php?page=register');
        exit();
    }/*elseif ($input_date <= $too_old) {
        $_SESSION['error'] = " full u echte geboorte datum in!";
        header('Location: ../index.php?page=register');
    }*/


/*

    // Verwerk afbeelding
    $upload_dir = __DIR__ . '/../../uploads/';
    $file_name = basename($_FILES['profile_pic']['name']);
    $target_file = $upload_dir . $file_name;

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if (!move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target_file)) {
        $_SESSION['error'] = 'Fout bij het uploaden van de afbeelding.';
        header('Location: ../index.php?page=register');
        exit;
    }

    $profile_pic = '/uploads/' . $file_name;
*/

    try {
        // Check if the email already exists
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

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL statement to insert new user
        $sql = "INSERT INTO users_table (name, middle_name, last_name, city, street, house_number, postal_code, email, password, confirm_password, date_of_birth, /*profile_pic,*/ role) 
                VALUES (:name, :middle_name, :last_name, :city, :street, :house_number, :postal_code, :email, :password, :confirm_password, :dob, /*:profile_pic,*/ 'user')";

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
//        $stmt->bindParam(':profile_pic', $profile_pic);
        $stmt->bindParam(':dob', $dob);

        if ($stmt->execute()) {
            header("Location: ../index.php?page=login");
            exit();
        } else {
            echo "Er is een fout opgetreden bij het registreren van de gebruiker, probeer opnieuw.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
