<?php
include(__DIR__ . '/../../private/db_connect.php');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $isbn = $_POST['isbn'];
    $language = $_POST['language'];
    $page_count = $_POST['page_count'];
    $copies_available = $_POST['copies_available'];
    $books_id = $_POST['books_id'];

    try {
        $sql=" UPDATE books SET title = :title, author = :author,
     genre = :genre, isbn = :isbn, language = :language,
    page_count = :page_count, copies_available = :copies_available  WHERE books_id = :books_id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':isbn', $isbn);
        $stmt->bindParam(':language', $language);
        $stmt->bindParam(':page_count', $page_count);
        $stmt->bindParam(':copies_available', $copies_available);
        $stmt->bindParam(':books_id', $books_id);

        if ($stmt->execute()) {
            header("Location: ../index.php?page=manager_menu");
            exit;
        } else {
            echo 'Er is iets fout gegaan.';
        }
    } catch (PDOException $e) {
        echo "Fout " . $e->getMessage();
    }

}
?>