
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
    <div class="users-buttons">
        <button class="home" onclick="window.location.href='index.php?page=usersmenu'">boeken</button>
        <button class="gereserveerde" onclick="window.location.href='index.php?page=gereserveerde_boeken'">gereserveerde boeken</button>
        <button class="geleende" onclick="window.location.href='index.php?page=geleende_boeken'">geleende boeken</button>
        <div class="dropdown">
            <button class="dropbtn"><?= htmlspecialchars($result['name']); ?></button>
            <div class="dropdown-content">
                <a href="index.php?page=profile">Mijn Profiel bekijken</a>
                <a href="index.php?page=Logout">Uitloggen</a>
            </div>
        </div>
<!--        <button class="geleende" onclick="window.location.href='index.php?page=profile'">profiel</button>-->
<!--        <button class="geleende" onclick="window.location.href='index.php?page=Logout'">uitloggen</button>-->

<!--        <div <button class="user-profile" onclick="toggleDropdown()">profile</button>-->
<!--            <img src="images/book-on-shelf.png" alt="User Logo">-->
<!---->
<!--            <div class="dropdown-menu" id="dropdown-menu">-->
<!--                <a href="index.php?page=profile">Profiel bekijken</a>-->
<!--                <a href="index.php?page=Logout">Uitloggen</a>-->
<!--            </div>-->
<!--        </div>-->


<!--        <button class="uitloggen" onclick="window.location.href='index.php?page=profile'">profiel bekijken</button>-->
<!--        <button class="uitloggen" onclick="window.location.href='index.php?page=Logout'">Uitloggen</button>-->

        <?php endforeach; ?>

    </div>

</header>

<!-- Footer Section -->
<!--<footer class="footer">-->
<!--    <div class="footer-container">-->
<!--        <div class="logo">-->
<!--            <img src="images/book-on-shelf.png" alt="Logo">-->
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
<!--            <a href="#"><img src="images/download%20(1).jpeg" alt="Facebook"></a>-->
<!--            <a href="#"><img src="images/download.png" alt="Twitter"></a>-->
<!--            <a href="#"><img src="images/download%20(2).jpeg" alt="Instagram"></a>-->
<!--        </div>-->
<!--    </div>-->
<!--</footer>-->
<!--</html>-->
