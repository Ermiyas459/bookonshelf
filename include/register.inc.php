
<?php //include 'navbar.inc.php'; ?>


<div class="register-page">
    <main class="register">

        <form action="php/register.php" method="POST"  enctype="multipart/form-data">


            <?php
            if (isset($_SESSION['error'])) {
                echo '<p class="error">' . $_SESSION['error'] . '</p>';
                unset($_SESSION['error']);
            }
            ?>
            <div class="form-group">
                <label for="name">Voornaam*</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="middle_name">Tussenvoegsel</label>
                <input type="text" id="middle_name" name="middle_name">
            </div>

            <div class="form-group">
                <label for="last_name">Achternaam*</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>

            <div class="form-group">
                <label for="city">Woonplaats*</label>
                <input type="text" id="city" name="city" required>
            </div>
            <div class="form-group">
                <label for="street">Straat*</label>
                <input type="text" id="street" name="street" required>
            </div>
            <div class="form-group">
                <label for="house_number">Huisnummer*</label>
                <input type="text" id="house_number" name="house_number" required>
            </div>
            <div class="form-group">
                <label for="postal_code">Postcode*</label>
                <input type="text" id="postal_code" name="postal_code" required>
            </div>
            <div class="form-group">
                <label for="email">Email*</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Wachtwoord*</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Bevestig Wachtwoord*</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <div  class="form-group"  >
                <label for="dob">Date of Birth*</label>
                <input type="date" id="dob" name="dob" required>
            </div>

            <div class="form-group">
                <label for="images_path">Profielafbeelding</label>
                <input type="file" name="profile_pic" id="images_path" accept="image/*" >
            </div>


            <button type="submit" class="register-button">Registreren</button>
        </form>
    </main>
</div>



