<?php
include(__DIR__ . '/../../private/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $isbn = $_POST['isbn'];
    $language = $_POST['language'];
    $page_count = $_POST['page_count'];
    $copies_available = $_POST['copies_available']; // Not needed for the reserved process
    $books_id = $_POST['books_id'];

    try {
        // Step 1: Update the book details (title, author, etc.)
        $sql = "UPDATE books SET title = :title, author = :author,
                genre = :genre, isbn = :isbn, language = :language,
                page_count = :page_count, copies_available = :copies_available WHERE books_id = :books_id";

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

            // Step 2: Check if the book is reserved
            $sql = "SELECT users_id FROM reserveren WHERE books_id = :books_id LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':books_id', $books_id, PDO::PARAM_INT);
            $stmt->execute();
            $reserved_user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($reserved_user) {
                // Step 3: If the book is reserved, move it to the 'lenen' table
                $reserved_user_id = $reserved_user['users_id'];

                // Insert into 'lenen' table
                $sql = "INSERT INTO lenen (books_id, users_id, title, author, genre, isbn, language, page_count, copies_available)
                        VALUES (:books_id, :users_id, :title, :author, :genre, :isbn, :language, :page_count, :copies_available)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':books_id', $books_id, PDO::PARAM_INT);
                $stmt->bindParam(':users_id', $reserved_user_id, PDO::PARAM_INT);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':author', $author);
                $stmt->bindParam(':genre', $genre);
                $stmt->bindParam(':isbn', $isbn);
                $stmt->bindParam(':language', $language);
                $stmt->bindParam(':page_count', $page_count);
                $stmt->bindParam(':copies_available', $copies_available, PDO::PARAM_INT); // Copies for the 'lenen' record
                $stmt->execute();

                // Step 4: Delete the reservation from the 'reserveren' table
                $sql = "DELETE FROM reserveren WHERE books_id = :books_id AND users_id = :users_id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':books_id', $books_id, PDO::PARAM_INT);
                $stmt->bindParam(':users_id', $reserved_user_id, PDO::PARAM_INT);
                $stmt->execute();

                $sql = "UPDATE books SET copies_available = copies_available - 1 WHERE books_id = :books_id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':books_id', $books_id, PDO::PARAM_INT);
                $stmt->execute();

            }

            // Step 5: If no one reserved the book, do nothing special and just update it in 'books'
            // Already done above (no extra steps needed here for unreserved books)

            // Redirect to the manager menu
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
