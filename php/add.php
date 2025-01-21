<?php
session_start(); // Start session for error handling
include(__DIR__ . '/../../private/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $language = $_POST['language'];
    $isbn = $_POST['isbn'];
    $page_count = $_POST['page_count'];
    $copies_available = $_POST['copies_available'];

    // Validatie
    if (empty($title) || empty($author) || empty($genre) || empty($language) ||
        empty($isbn) || empty($page_count) || empty($copies_available)) {
        $_SESSION['error'] = 'Alle velden zijn verplicht.';
        header('Location: ../index.php?page=add');
        exit;
    }

    // Verwerk afbeelding
    $image_path = null;
    if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = __DIR__ . '/../../uploads/';
        $file_name = basename($_FILES['image_path']['name']);
        $target_file = $upload_dir . $file_name;

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        if (move_uploaded_file($_FILES['image_path']['tmp_name'], $target_file)) {
            $image_path = '/uploads/' . $file_name;
        } else {
            $_SESSION['error'] = 'Fout bij het uploaden van de afbeelding.';
            header('Location: ../index.php?page=add');
            exit;
        }
    }

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
            header("Location: ../index.php?page=manager_menu");
            exit;
        } else {
            $_SESSION['error'] = "Er is iets fout gegaan bij het opslaan.";
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Fout: " . $e->getMessage();
    }
}
?>
