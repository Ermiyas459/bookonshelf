
<?php //include 'navbar.inc.php'; ?>


<div class="register-page">
    <main class="register">
        <!--        <h2>Registreren</h2>-->
        <?php if (isset($error)): ?>
            <p style="color:#000333;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="php/add-users.php" method="POST">


            <div class="form-group">
                <label for="name">Voornaam</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="middle_name">Tussenvoegsel</label>
                <input type="text" id="middle_name" name="middle_name">
            </div>

            <div class="form-group">
                <label for="last_name">Achternaam</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>

            <div class="form-group">
                <label for="woonplaats">Woonplaats</label>
                <div class="select-with-link">
                    <select id="woonplaats" name="woonplaats" required>
                        <option value="" <?php echo isset($_POST['woonplaats']) && $_POST['woonplaats'] == '' ? 'selected' : ''; ?>>Kies een Woonplaats</option>
                        <?php
                        include(__DIR__ . '/../../private/db_connect.php');

                        try {
                            $query = "SELECT * FROM `woonplaats`";
                            $stmt = $pdo->query($query);

                            while ($w = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $selected = (isset($_POST['woonplaats']) && $_POST['woonplaats'] == $w['woonplaats_id']) ? 'selected' : '';
                                echo '<option value="' . htmlspecialchars($w['woonplaats_id']) . '" ' . $selected . '>' . htmlspecialchars($w['woonplaats']) . '</option>';
                            }
                        } catch (PDOException $error) {
                            echo '<option value="">Fout bij ophalen van woonplaatsen</option>';
                        }
                        ?>
                    </select>
                    <!--                    <a href="index.php?page=add-woonplaats" class="add-new-link">Nieuwe woonplaats toevoegen</a>-->
                </div>
            </div>

            <div class="form-group">
                <label for="street">Straat</label>
                <input type="text" id="street" name="street" required>
            </div>
            <div class="form-group">
                <label for="house_number">Huisnummer</label>
                <input type="text" id="house_number" name="house_number" required>
            </div>
            <div class="form-group">
                <label for="postal_code">Postcode</label>
                <input type="text" id="postal_code" name="postal_code" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Wachtwoord</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Bevestig Wachtwoord</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required>
            </div>

            <div class="form-group">
                <label for="woonplaats">Role</label>
                <div class="select-with-link">
                    <select id="woonplaats" name="woonplaats" required>
                        <option value="" <?php echo isset($_POST['role']) && $_POST['role'] == '' ? 'selected' : ''; ?>>kies een role</option>
                <?php
                include(__DIR__ . '/../../private/db_connect.php');
                try {
                    $query = "SELECT * FROM `role`";
                    $stmt = $pdo->query($query);

                    while ($t = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $selected = (isset($_POST['role']) && $_POST['role'] == $t['role_id']) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($t['role_id']) . '" ' . $selected . '>' . htmlspecialchars($t["role" ]) . '</option>';
                    }
                } catch (PDOException $error) {
                    echo '<option value="">Fout bij ophalen van auteurs</option>';
                }
                ?>
                    </select>
                </div>
            </div>



            <?php
            if (isset($_SESSION['error'])) {
                echo '<p class="error">' . $_SESSION['error'] . '</p>';
                unset($_SESSION['error']);
            }
            ?>

            <?php
            if (isset($_SESSION['success'])) {
                echo '<p class="succes">' . $_SESSION['success'] . '</p>';
                unset($_SESSION['success']);
            }
            ?>

            <button type="submit" class="register-button">Registreren</button>
        </form>
    </main>
</div>



