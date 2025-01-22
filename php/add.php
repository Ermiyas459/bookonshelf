<?php
session_start();
include(__DIR__ . '/../../private/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $language = $_POST['language'];
    $isbn = $_POST['isbn'];
    $page_count = $_POST['page_count'];
    $copies_available = $_POST['copies_available'];

    // Validatie van de afbeelding
    if (!isset($_FILES['images_path']) || $_FILES['images_path']['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['error'] = 'Het uploaden van een afbeelding is verplicht.';
        header('Location: ../index.php?page=add');
        exit;
    }

    // Controleren op bestandstype en grootte
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $max_file_size = 2 * 1024 * 1024; // 2MB

    if (!in_array($_FILES['images_path']['type'], $allowed_types)) {
        $_SESSION['error'] = 'Alleen JPEG-, PNG- en GIF-bestanden zijn toegestaan.';
        header('Location: ../index.php?page=add');
        exit;
    }

    if ($_FILES['images_path']['size'] > $max_file_size) {
        $_SESSION['error'] = 'Bestandsgrootte mag niet groter zijn dan 2MB.';
        header('Location: ../index.php?page=add');
        exit;
    }

    // Verwerk afbeelding
    $upload_dir = __DIR__ . '/../../uploads/';
    $file_name = basename($_FILES['images_path']['name']);
    $target_file = $upload_dir . $file_name;

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if (!move_uploaded_file($_FILES['images_path']['tmp_name'], $target_file)) {
        $_SESSION['error'] = 'Fout bij het uploaden van de afbeelding.';
        header('Location: ../index.php?page=add');
        exit;
    }

    $image_path = '/uploads/' . $file_name;

    // SQL-query
    $sql = "INSERT INTO books (title, author, genre, language, isbn, page_count, copies_available, image_path) 
            VALUES (:title, :author, :genre, :language, :isbn, :page_count, :copies_available, :image_path)";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':language', $language);
        $stmt->bindParam(':isbn', $isbn);
        $stmt->bindParam(':page_count', $page_count, PDO::PARAM_INT);
        $stmt->bindParam(':copies_available', $copies_available, PDO::PARAM_INT);
        $stmt->bindParam(':image_path', $image_path);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Boek succesvol toegevoegd.";
            header("Location:../index.php?page=manager_menu");
            exit;
        } else {
            $_SESSION['error'] = "Er is iets fout gegaan bij het opslaan.";
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Fout: " . $e->getMessage();
    }
}
?>
