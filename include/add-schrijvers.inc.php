

<div class="add-page">
    <main class="add">
        <h2>Toevoegen</h2>

        <form method="POST" action="php/add-schrijvers.php" enctype="multipart/form-data">

            <div class="form-group">
                <label for="name">name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="middleName">tussenvoegsel</label>
                <input type="text" id="middleName" name="middleName" required>
            </div>
            <div class="form-group">
                <label for="lastName">achternaam</label>
                <input type="text" id="lastName" name="lastName" required>
            </div>


            <button type="submit" class="toevegen-knop">Toevoegen</button>
        </form>
    </main>
</div>