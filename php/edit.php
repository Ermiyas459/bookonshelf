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
        header('Location: index.php?page=add');
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

    try {
        // Step 1: Update the book details (title, author, etc.)
        $sql = "UPDATE books SET title = :title, author = :author,
                genre = :genre, isbn = :isbn, language = :language,
                page_count = :page_count, copies_available = :copies_available, image_path = :image_path WHERE books_id = :books_id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':isbn', $isbn);
        $stmt->bindParam(':language', $language);
        $stmt->bindParam(':page_count', $page_count);
        $stmt->bindParam(':copies_available', $copies_available);
        $stmt->bindParam(':image_path', $image_path);
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
                $stmt->bindParam(':page_count', $page_count);
                $stmt->bindParam(':copies_available', $copies_available, PDO::PARAM_INT);
                $stmt->bindParam(':image_path', $image_path);
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
