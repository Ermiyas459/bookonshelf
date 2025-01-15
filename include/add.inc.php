<div class="add-page">
    <main class="add">
        <h2>Toevoegen</h2>


        <form method="POST" action="php/add.php" enctype="multipart/form-data" >

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title"  required>
            </div>

            <div class="form-group">
                <label for="author">Auteur</label>
                <div class="select-with-link">
                    <select id="author" name="author" required>
                        <?php
                        include(__DIR__ . '/../../private/db_connect.php');

                        try {
                            $query = "SELECT * FROM `schrijvers`";
                            $stmt = $pdo->query($query);

                            while ($t = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . htmlspecialchars($t['author_id']) . '">' . htmlspecialchars($t['name']) . '</option>';
                            }
                        } catch (PDOException $error) {
                            echo '<option value="">Fout bij ophalen van auteurs</option>';
                        }
                        ?>
                    </select>
                    <a href="index.php?page=schrijvers" class="add-new-link">Nieuwe auteur toevoegen</a>
                </div>
            </div>

            <!-- Genre Section -->
            <div class="form-group">
                <label for="genre">Genre</label>
                <div class="select-with-link">
                    <select id="genre" name="genre" required>
                        <?php
                        include(__DIR__ . '/../../private/db_connect.php');

                        try {
                            $query = "SELECT * FROM `genre`";
                            $stmt = $pdo->query($query);

                            while ($g = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . htmlspecialchars($g['genre_id']) . '">' . htmlspecialchars($g['name']) . '</option>';
                            }
                        } catch (PDOException $error) {
                            echo '<option value="">Fout bij ophalen van genres</option>';
                        }
                        ?>
                    </select>
                    <a href="index.php?page=add_genre" class="add-new-link">Nieuw genre toevoegen</a>
                </div>
            </div>

            <!-- Language Section -->
            <div class="form-group">
                <label for="language">Taal</label>
                <div class="select-with-link">
                    <select id="language" name="language" required>
                        <?php
                        include(__DIR__ . '/../../private/db_connect.php');

                        try {
                            $query = "SELECT * FROM `taal`";
                            $stmt = $pdo->query($query);

                            while ($l = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . htmlspecialchars($l['taal_id']) . '">' . htmlspecialchars($l['taal']) . '</option>';
                            }
                        } catch (PDOException $error) {
                            echo '<option value="">Fout bij ophalen van talen</option>';
                        }
                        ?>
                    </select>
                    <a href="index.php?page=taal" class="add-new-link">Nieuwe taal toevoegen</a>
                </div>
            </div>

            <div class="form-group">
                <label for="isbn">ISBN-nummer</label>
                <input type="text" id="isbn" name="isbn" required>
            </div>
            <div class="form-group">
                <label for="page_count">Aantal pagina's</label>
                <input type="number" id="page_count" name="page_count" required>
            </div>
            <div class="form-group">
                <label for="copies_available">Aantal beschikbare exemplaren</label>
                <input type="number" id="copies_available" name="copies_available" required>
            </div>

            <button type="submit" class="toevegen-knop">Toevoegen</button>
        </form>
    </main>
</div>
