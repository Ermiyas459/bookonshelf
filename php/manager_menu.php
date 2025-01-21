
<?php
include(__DIR__ . '/../../private/db_connect.php');



// Verwijder logica
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['books_id'])) {
    $books_id = $_POST['books_id'];

    try {
        // Verwijder boek uit de database
        $sql = 'DELETE FROM books WHERE books_id = :books_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':books_id', $books_id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Fout: " . $e->getMessage();
    }
}




header('Location: ../index.php?page=manager_menu');



try {
    $query = "SELECT b.books_id, b.title, b.isbn, b.page_count, b.copies_available, 
                     s.name AS author_name, g.genre AS genre_name, t.taal AS language_name
              FROM books b
              JOIN schrijvers s ON b.author = s.author_id
              JOIN genre g ON b.genre = g.genre_id
              JOIN taal t ON b.language = t.taal_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Fout bij ophalen van gegevens: " . $e->getMessage();
}


?>

