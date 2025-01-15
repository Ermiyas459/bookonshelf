<?php
session_start();
include "../../Private/db_connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['users_id'])) {
        echo 'Error: Missing users_id in the session.';
        exit();
    }

    $users_id = $_SESSION['users_id'];
    $books_id = $_POST['books_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $isbn = $_POST['isbn'];
    $language = $_POST['language'];
    $page_count = $_POST['page_count'];
    $copies_available = $_POST['copies_available'];

    if (!$books_id || !$title || !$author || !$genre || !$isbn || !$language || !$page_count || $copies_available === null) {
        echo 'Error: Missing required book information.';
        exit();
    }




    $sql = "SELECT COUNT(*) FROM lenen WHERE books_id = :books_id AND users_id = :users_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':books_id', $books_id, PDO::PARAM_INT);
    $stmt->bindParam(':users_id', $users_id, PDO::PARAM_INT);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        $error = "Je hebt dit boek al geleend";
        header('Location: ../index.php?page=usersmenu&error=' . urlencode($error));
        exit();
    }




    $sql = "SELECT COUNT(*) FROM reserveren WHERE books_id = :books_id AND users_id = :users_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':books_id', $books_id, PDO::PARAM_INT);
    $stmt->bindParam(':users_id', $users_id, PDO::PARAM_INT);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        $error = "Je hebt dit boek al gereserveerd";
        header('Location: ../index.php?page=usersmenu&error=' . urlencode($error));
        exit();
    }




    $sql = "SELECT COUNT(*) FROM books WHERE books_id = :books_id AND copies_available = :copies_available";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':books_id', $books_id, PDO::PARAM_INT);
    $stmt->bindParam(':copies_available', $copies_available);
    $stmt->execute();
    $count = $stmt->fetchColumn();






    if ($copies_available == 0 ) {
        $sql = "INSERT INTO reserveren (books_id, users_id, title, author, genre, isbn, language, page_count, copies_available)
                VALUES (:books_id, :users_id, :title, :author, :genre, :isbn, :language, :page_count, :copies_available)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':books_id', $books_id, PDO::PARAM_INT);
        $stmt->bindParam(':users_id', $users_id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':isbn', $isbn);
        $stmt->bindParam(':language', $language);
        $stmt->bindParam(':page_count', $page_count, PDO::PARAM_INT);
        $stmt->bindParam(':copies_available', $copies_available, PDO::PARAM_INT);
        $stmt->execute();



        header('Location: ../index.php?page=gereserveerde_boeken');
        exit();
    } else {
        echo "Je hebt dit boek al gereserveerd.";
        header('Location: ../index.php?page=usersmenu');
        exit();
    }



}
?>
