<?php
include __DIR__ . '/../navbar.php';

?>
 
<body>
    <h1>Landmarks</h1>

    <div id="landmarks-table">
        <?php

        foreach ($models as $landmark)
        {
            echo "<h2>$landmark->title</h2>";
            echo "<p>$landmark->description</p>";
            echo "<p>$landmark->image</p>";
            // echo "<img src='images/" . $landmark->getImage() . "' alt='Landmark image'>";
        }
        ?>

    </div>

    <h2>Add Landmark</h2>

    <div id="landmark-form">
        <form action="index.php?controller=landmark&action=create" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="mb-3">
                <label for="description">Description</label>
                <input type="text" id="description" name="description">
            </div>
            <div class="mb-3">
                <label for="image">Image</label>
                <input type="text" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
    </div>

    <h2>Edit Landmark</h2>

    <div id="edit-landmark-form">
        <?php
            // edit landmark form

            

        ?>
    </div>
    <form action="historycontroller.php" method="post"></form>
        <textarea name="historyeditor" id="historyeditor">
            <p>This is some sample content.</p>
        </textarea>
        <p>
            <input type="submit" name="submit_data" value="submit">
        </p>
    </form>
    <script>
        ClassicEditor
        .create( document.querySelector( '#historyeditor' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
</body>
