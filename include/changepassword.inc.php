<?php
include(__DIR__ . '/../../private/db_connect.php');

$users_id=$_SESSION["users_id"];

$sql = "SELECT * FROM users_table WHERE users_id=:users_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':users_id', $users_id);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<div class="add-page">
    <main class="add">
        <h2>Wachtwoord aanpassen</h2>


        <form method="POST" action="php/changepasswrd.php" enctype="multipart/form-data">
            <input type="hidden" name="users_id" value="<?php echo $result['users_id'] ?>">
            <div class="form-group">
                <label for="password">password</label>
                <input type="text" id="password" name="password" value="" >
            </div>
            <div class="form-group">
                <label for="confirm_password">confirm password</label>
                <input type="text" id="confirm_password" name="confirm_password" value=" " >
            </div>
            <?php
            if (isset($_SESSION['error'])) {
                echo '<p class="error">' . $_SESSION['error'] . '</p>';
                unset($_SESSION['error']);
            }
            ?>
            <button type="submit" class="aanpassen">Aanpassen</button>
        </form>
    </main>
</div>