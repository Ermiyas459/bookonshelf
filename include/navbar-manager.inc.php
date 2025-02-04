
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <?php
    include(__DIR__ . '/../../private/db_connect.php');
    $users_id = $_SESSION['users_id'];

    try {
        $sql = "SELECT * FROM users_table WHERE users_id = :users_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':users_id', $users_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
    <?php foreach ($result as $result): ?>



</head>
<header>

    <div class="user-logo">

            <img src="images/book-on-shelf.png" alt="Logo">



    </div>

    <div class="title">BookOnShelf</div>
    <div class="managers-buttons">
        <button class="home" onclick="window.location.href='index.php?page=manager_menu'">Boeken</button>
        <div class="dropdown">
            <button class="dropbtn">Toevoegen</button>
            <div class="dropdown-content">
                <a href="index.php?page=add">Boeken</a>
                <a href="index.php?page=add-users">Gebruikers</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">Meer</button>
            <div class="dropdown-content">
                <a href="index.php?page=genre">Genre Beheren</a>
                <a href="index.php?page=taal">Taal Beheren</a>
                <a href="index.php?page=schrijvers">Schrijvers Beheren</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn"><?= htmlspecialchars($result['name']); ?>'s Profiel ↕ </button>
            <div class="dropdown-content">
                <a href="index.php?page=profile">Ik</a>
                <a href="index.php?page=usersoverview">Alle Gebruikers</a>
                <a href="index.php?page=Logout">Uitloggen</a>
            </div>
        </div>



    </div>
</header>


</html>
<?php endforeach; ?>
