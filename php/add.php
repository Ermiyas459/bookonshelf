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

//    $_SESSION['add-gegevens'] = [
//        'title' => $title,
//        'author' => $author,
//        'genre' => $genre,
//        'isbn' => $isbn,
//        'language' => $language,
//        'page_count' => $page_count,
//        'copies_available' => $copies_available,
//
//    ];


            $sql = "INSERT INTO books ( title, author, genre, isbn, language, page_count, copies_available) 
                    VALUES ( :title, :author, :genre, :isbn, :language, :page_count, :copies_available)";

            try {
                $stmt = $pdo->prepare($sql);
                //$stmt->bindParam(':image', $image_path);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':author', $author);
                $stmt->bindParam(':genre', $genre);
                $stmt->bindParam(':isbn', $isbn);
                $stmt->bindParam(':language', $language);
                $stmt->bindParam(':page_count', $page_count);
                $stmt->bindParam(':copies_available', $copies_available);


                if ($stmt->execute()) {
                    header("Location: ../index.php?page=manager_menu");
                    exit;
                } else {
                    echo "Er is iets fout gegaan, probeer opnieuw";
                        header("Location: ../index.php?page=add");
                    exit;
                }
            } catch (PDOException $e) {
                echo "Fout: " . $e->getMessage();
            }

}
?>