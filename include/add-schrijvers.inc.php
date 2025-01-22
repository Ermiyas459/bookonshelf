

<div class="add-page">
    <main class="add">
        <h2>Toevoegen</h2>

        <form method="POST" action="php/add-schrijvers.php" enctype="multipart/form-data">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <button onclick="history.back()" class="aanpassen">Terug</button>
            <button type="submit" class="aanpassen">Toevoegen</button>
        </form>
    </main>
</div>