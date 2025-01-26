
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
        <button class="home" onclick="window.location.href='index.php?page=manager_menu'">boeken</button>
<!--        <div class="dropdown">-->
<!--            <button class="dropbtn">Profiel</button>-->
<!--            <div class="dropdown-content">-->
<!--                <a href="index.php?page=profile">Ik</a>-->
<!--                <a href="index.php?page=usersoverview">Alle Gebruikers</a>-->
<!--            </div>-->
<!--        </div>-->
        <div class="dropdown">
            <button class="dropbtn">toevoegen</button>
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

<!--        <button class="uitloggen" onclick="window.location.href='index.php?page=Logout'">Uitloggen</button>-->


    </div>
</header>


</html>
<?php endforeach; ?>

<!---->
<!--<!-- Footer Section -->-->
<!--<footer class="footer">-->
<!--    <div class="footer-container">-->
<!--        <div class="logo">-->
<!--            <img src="../images/book-on-shelf.png" alt="Logo">-->
<!--        </div>-->
<!--        <div class="contact-info">-->
<!--            <p>Contact Us: bookon@shelf</p>-->
<!--            <p>Phone: +123 456 7890</p>-->
<!--            <p>Address: 123 Book Street, Library City, 4567</p>-->
<!--        </div>-->
<!--        <div class="quick-links">-->
<!--            <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a> | <a href="#">About Us</a> | <a href="#">Contact</a></p>-->
<!--        </div>-->
<!--        <div class="social-media">-->
<!--            <a href="#"><img src="../images/download%20(1).jpeg" alt="Facebook"></a>-->
<!--            <a href="#"><img src="../images/download.png" alt="Twitter"></a>-->
<!--            <a href="#"><img src="../images/download%20(2).jpeg" alt="Instagram"></a>-->
<!--        </div>-->
<!--    </div>-->
<!--</footer>-->
