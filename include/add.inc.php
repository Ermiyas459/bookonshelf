<div class="add-page">
    <main class="add">
        <h2>Toevoegen</h2>

        <form method="POST" action="php/add.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="author">Auteur</label>
                <div class="select-with-link">
                    <select id="author" name="author" required>
                        <option value="" <?php echo isset($_POST['author']) && $_POST['author'] == '' ? 'selected' : ''; ?>>kies een author
                        </option>
                        <?php
                        include(__DIR__ . '/../../private/db_connect.php');

                        try {
                            $query = "SELECT * FROM `schrijvers`";
                            $stmt = $pdo->query($query);

                            while ($t = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $selected = (isset($_POST['author']) && $_POST['author'] == $t['author_id']) ? 'selected' : '';
                                echo '<option value="' . htmlspecialchars($t['author_id']) . '" ' . $selected . '>' . htmlspecialchars($t['name']) . '</option>';
                            }
                        } catch (PDOException $error) {
                            echo '<option value="">Fout bij ophalen van auteurs</option>';
                        }
                        ?>
                    </select>
                    <a href="index.php?page=add-schrijvers" class="add-new-link">Nieuwe auteur toevoegen</a>
                </div>
            </div>

            <!-- Genre Section -->
            <div class="form-group">
                <label for="genre">Genre</label>
                <div class="select-with-link">
                    <select id="genre" name="genre" required>
                        <option value="" <?php echo isset($_POST['genre']) && $_POST['genre'] == '' ? 'selected' : ''; ?>>kies een genre</option>
                        <?php
                        try {
                            $query = "SELECT * FROM `genre`";
                            $stmt = $pdo->query($query);

                            while ($g = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $selected = (isset($_POST['genre']) && $_POST['genre'] == $g['genre_id']) ? 'selected' : '';
                                echo '<option value="' . htmlspecialchars($g['genre_id']) . '" ' . $selected . '>' . htmlspecialchars($g['genre']) . '</option>';
                            }
                        } catch (PDOException $error) {
                            echo '<option value="">Fout bij ophalen van genres</option>';
                        }
                        ?>
                    </select>
                    <a href="index.php?page=add-genre" class="add-new-link">Nieuw genre toevoegen</a>
                </div>
            </div>

            <!-- Language Section -->
            <div class="form-group">
                <label for="language">Taal</label>
                <div class="select-with-link">
                    <select id="language" name="language" required>
                        <option value="" <?php echo isset($_POST['language']) && $_POST['language'] == '' ? 'selected' : ''; ?>>kies een taal</option>
                        <?php
                        try {
                            $query = "SELECT * FROM `taal`";
                            $stmt = $pdo->query($query);

                            while ($l = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $selected = (isset($_POST['language']) && $_POST['language'] == $l['taal_id']) ? 'selected' : '';
                                echo '<option value="' . htmlspecialchars($l['taal_id']) . '" ' . $selected . '>' . htmlspecialchars($l['taal']) . '</option>';
                            }
                        } catch (PDOException $error) {
                            echo '<option value="">Fout bij ophalen van talen</option>';
                        }
                        ?>
                    </select>
                    <a href="index.php?page=add-taal" class="add-new-link">Nieuwe taal toevoegen</a>
                </div>
            </div>

            <div class="form-group">
                <label for="isbn">ISBN-nummer</label>
                <input type="text" id="isbn" name="isbn" required value="<?php echo isset($_POST['isbn']) ? htmlspecialchars($_POST['isbn']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="page_count">Aantal pagina's</label>
                <input type="number" id="page_count" name="page_count" required value="<?php echo isset($_POST['page_count']) ? htmlspecialchars($_POST['page_count']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="copies_available">Aantal beschikbare exemplaren</label>
                <input type="number" id="copies_available" name="copies_available" required value="<?php echo isset($_POST['copies_available']) ? htmlspecialchars($_POST['copies_available']) : ''; ?>">

            </div>
            <?php
            if (isset($_SESSION['error'])) {
                echo '<p class="error">' . $_SESSION['error'] . '</p>';
                unset($_SESSION['error']);
            }
            ?>
            <label for="images_path">Afbeelding:</label>
            <input type="file" name="images_path" id="images_path" accept="image/*" required><br><br>


            <button type="submit" class="aanpassen">Toevoegen</button>
        </form>
    </main>
</div>
