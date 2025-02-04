<?php
session_start();
include(__DIR__ . '/../../private/db_connect.php');

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
    $image_path=$_POST['image_path'];

    try {

        $sql = 'DELETE FROM lenen WHERE books_id = :books_id AND users_id = :users_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':books_id', $books_id);
        $stmt->bindParam(':users_id', $users_id);
        $stmt->execute();

        $sql = "SELECT users_id FROM reserveren WHERE books_id = :books_id AND users_id != :users_id LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':books_id', $books_id, PDO::PARAM_INT);
        $stmt->bindParam(':users_id', $users_id, PDO::PARAM_INT);
        $stmt->execute();
        $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($reservation) {
            $reserved_user_id = $reservation['users_id'];


            $sql = "INSERT INTO lenen (books_id, users_id, title, author, genre, isbn, language, page_count, copies_available, image_path)
                    VALUES (:books_id, :users_id, :title, :author, :genre, :isbn, :language, :page_count, :copies_available, :image_path)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':books_id', $books_id, PDO::PARAM_INT);
            $stmt->bindParam(':users_id', $reserved_user_id, PDO::PARAM_INT);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':author', $author);
            $stmt->bindParam(':genre', $genre);
            $stmt->bindParam(':isbn', $isbn);
            $stmt->bindParam(':language', $language);
            $stmt->bindParam(':page_count', $page_count, PDO::PARAM_INT);
            $stmt->bindParam(':copies_available', $copies_available, PDO::PARAM_INT);
            $stmt->bindParam(':image_path', $image_path);
            $stmt->execute();

            $sql = 'DELETE FROM reserveren WHERE books_id = :books_id AND users_id = :users_id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':books_id', $books_id, PDO::PARAM_INT);
            $stmt->bindParam(':users_id', $reserved_user_id, PDO::PARAM_INT);
            $stmt->execute();

            header('Location: ../index.php?page=usersmenu');
        } else {

            $sql = "UPDATE books SET copies_available = copies_available + 1 WHERE books_id = :books_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':books_id', $books_id, PDO::PARAM_INT);
            $stmt->execute();

            header('Location: ../index.php?page=usersmenu');
        }
    } catch (PDOException $e) {
        echo "Fout: " . $e->getMessage();
    }
}
?>
