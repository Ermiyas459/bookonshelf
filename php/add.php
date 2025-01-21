<?php
include(__DIR__ . '/../../private/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $language = $_POST['language'];
    $isbn = $_POST['isbn'];
    $page_count = $_POST['page_count'];
    $copies_available = $_POST['copies_available'];

    $sql = "INSERT INTO books (title, author, genre, language, isbn, page_count, copies_available) 
            VALUES (:title, :author, :genre, :language, :isbn, :page_count, :copies_available)";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':language', $language);
        $stmt->bindParam(':isbn', $isbn);
        $stmt->bindParam(':page_count', $page_count);
        $stmt->bindParam(':copies_available', $copies_available);

        if ($stmt->execute()) {
            header("Location: ../index.php?page=manager_menu");
            exit;
        } else {
            echo "Er is iets fout gegaan bij het opslaan.";
        }
    } catch (PDOException $e) {
        echo "Fout: " . $e->getMessage();
    }
}
?>



