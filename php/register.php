<?php
include(__DIR__ . '/../../private/db_connect.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $woonplaats = $_POST['woonplaats'];
    $street = $_POST['street'];
    $house_number = $_POST['house_number'];
    $postal_code = $_POST['postal_code'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $dob = $_POST['dob'];

    // Validate if the passwords match
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Wachtwoorden komen niet overeen!";
        header('Location: ../index.php?page=register');
        exit();
    }

    if ($woonplaats === null) {
        $_SESSION['error'] = "Selecteer een woonplaats.";
        header("Location: register.php");
        exit();
    }

    // Validate the date of birth to make sure it's not in the future
    $input_date = new DateTime($dob);
    $current_date = new DateTime();
    if ($input_date > $current_date) {
        $_SESSION['error'] = "De geboortedatum kan niet in de toekomst liggen!";
        header('Location: ../index.php?page=register');
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
            header('Location: ../index.php?page=register');
            exit();
        }


        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $image_path = NULL;

        if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
            // Check file type and size
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            $max_file_size = 2 * 1024 * 1024; // 2MB

            if (!in_array($_FILES['profile_pic']['type'], $allowed_types)) {
                $_SESSION['error'] = 'Alleen JPEG-, PNG- en GIF-bestanden zijn toegestaan.';
                header('Location: ../index.php?page=register');
                exit;
            }

            if ($_FILES['profile_pic']['size'] > $max_file_size) {
                $_SESSION['error'] = 'Bestandsgrootte mag niet groter zijn dan 2MB.';
                header('Location: ../index.php?page=register');
                exit;
            }

            // Process the image
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

            // Set the image path
            $image_path = '/uploads/' . $file_name;
        }

        // Prepare SQL statement to insert new user
        $sql = "INSERT INTO users_table (name, middle_name, last_name, woonplaats, street, house_number, postal_code, email, password, confirm_password, date_of_birth, profile_pic, role) 
                VALUES (:name, :middle_name, :last_name, :woonplaats, :street, :house_number, :postal_code, :email, :password, :confirm_password, :dob, :profile_pic, 'user')";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':middle_name', $middle_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':woonplaats', $woonplaats);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':house_number', $house_number);
        $stmt->bindParam(':postal_code', $postal_code);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':confirm_password', $hashed_password);
        $stmt->bindParam(':dob', $dob);
        $stmt->bindParam(':profile_pic', $image_path, PDO::PARAM_STR);  // Set the image path, or NULL if no image

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
