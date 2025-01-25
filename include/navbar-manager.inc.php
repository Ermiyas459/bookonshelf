
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/styles.css">



</head>
<header>

    <div class="user-logo">

            <img src="images/book-on-shelf.png" alt="Logo">



    </div>

    <div class="title">BookOnShelf</div>
    <div class="managers-buttons">
        <button class="home" onclick="window.location.href='index.php?page=manager_menu'">boeken</button>
        <button class="toevegen" onclick="window.location.href='index.php?page=usersoverview'">gebruikers</button>
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
<!--        <div class="user-logo">-->
<!---->
<!--            <a href="index.php?page=beheren" class="add-new-link"> <img src="images/dropdown.png"></a>-->
<!--            -->
<!---->
<!---->
<!---->
<!--        </div>-->

        <button class="uitloggen" onclick="window.location.href='index.php?page=Logout'">Uitloggen</button>


    </div>
</header>


</html>

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
