<?php //include 'navbar.inc.php'; ?>
<div class="login">
    <div class="login_box">
        <h2>Login</h2>
        <?php if (isset($error)): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>
<!--        <img class="loginpfp" src="images/login.webp" alt="login/img">-->
        <form action="php/login.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <?php
            if (isset($_SESSION['error'])) {
                echo '<p class="error">' . $_SESSION['error'] . '</p>';
                unset($_SESSION['error']);
            }
            ?>
            <input class="btn" type="submit" value="Login">
        </form>
    </div>
</div>




