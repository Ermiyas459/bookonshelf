<?php
include(__DIR__ . '/../../private/db_connect.php');
$users_id=$_GET["users_id"];

$sql = "SELECT * FROM users_table WHERE users_id=:users_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':users_id', $users_id);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<div class="edit-page">
    <main class="edit">
        <h2>aanpassen</h2>
        <?php if (isset($error)): ?>
            <p style="color:#c31e1e;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="php/edit-users.php" enctype="multipart/form-data">
            <input type="hidden" name="users_id" value="<?php echo $result['users_id'] ?>">

            <style>
                .error {
                    color: red;
                }
            </style>
            <div class="form-group">
                <label for="name">Voornaam</label>
                <input type="text" id="name" name="name" value="<?php echo $result['name'] ?>"required>
            </div>

            <div class="form-group">
                <label for="middle_name">Tussenvoegsel</label>
                <input type="text" id="middle_name" name="middle_name" value="<?php echo $result['middle_name'] ?>">
            </div>

            <div class="form-group">
                <label for="last_name">Achternaam</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo $result['last_name'] ?>"required>
            </div>

            <div class="form-group">
                <label for="city">Woonplaats</label>
                <input type="text" id="city" name="city"value="<?php echo $result['city'] ?>" required>
            </div>
            <div class="form-group">
                <label for="street">Straat</label>
                <input type="text" id="street" name="street" value="<?php echo $result['street'] ?>"required>
            </div>
            <div class="form-group">
                <label for="house_number">Huisnummer</label>
                <input type="text" id="house_number" name="house_number" value="<?php echo $result['house_number'] ?>" required>
            </div>
            <div class="form-group">
                <label for="postal_code">Postcode</label>
                <input type="text" id="postal_code" name="postal_code" value="<?php echo $result['postal_code'] ?>"required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $result['email'] ?>" required>
            </div>

            <div class="form-group">
                <label for="role">role</label>
                <input type="role" id="role" name="role"value="<?php echo $result['role'] ?>" required>
            </div>

            <div class="form-group">
                <label for="dob">Geboortedatum</label>
                <input type="date" id="dob" name="dob" value="<?php echo $result['birth_date'] ?>"required>
            </div>
            <?php
            if (isset($_SESSION['error'])) {
                echo '<p class="error">' . $_SESSION['error'] . '</p>';
                unset($_SESSION['error']);
            }
            ?>
            <button type="submit" class="register-button">aanpassen</button>
        </form>
    </main>
</div>