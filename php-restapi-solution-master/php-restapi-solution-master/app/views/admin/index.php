<?php
include __DIR__ . '/../navbar.php';

?>
 
<body>
    <h1>Landmarks</h1>

    <div id="landmarks-table">
        <?php
        if (!is_null($landmarks) && count($landmarks) > 0) {
            echo '<table>';
            echo '<tr><th>ID</th><th>Title</th><th>Description</th><th>Image</th><th>Actions</th></tr>';
            foreach ($landmarks as $landmark) {
                echo '<tr>';
                echo '<td>' . $landmark->getLandmarkID() . '</td>';
                echo '<td>' . $landmark->getTitle() . '</td>';
                echo '<td>' . $landmark->getDescription() . '</td>';
                echo '<td>' . $landmark->getImage() . '</td>';
                echo '<td><a href="index.php?action=edit&id=' . $landmark->getLandmarkID() . '">Edit</a> | <a href="index.php?action=delete&id=' . $landmark->getLandmarkID() . '">Delete</a></td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>No landmarks found.</p>';
        }
        // foreach ($models as $landmark)
        // {
        //     echo "<h2>$landmark->title</h2>";
        //     echo "<p>$landmark->description</p>";
        //     echo "<p>$landmark->image</p>";
        //     // echo "<img src='images/" . $landmark->getImage() . "' alt='Landmark image'>";
        // }
        ?>

    </div>

    <h2>Add Landmark</h2>

    <div id="landmark-form">
        <form action="index.php?controller=admin&action=createLandmark" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="landmark-title" name="title">
            </div>
            <div class="mb-3">
                <label for="description">Description</label>
                <input type="text" id="landmark-description" name="description">
            </div>
            <div class="mb-3">
                <label for="image">Image</label>
                <input type="text" id="landmark-image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
    </div>

    <h2>Edit Landmark</h2>

    <div id="edit-landmark-form">
        <form action="index.php?controller=admin&action=editLandmark" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="landmarkID">Landmark ID</label>
                <input type="text" class="form-control" id="landmarkID" name="landmarkID">
            </div>
            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="landmark-title" name="title">
            </div>
            <div class="mb-3">
                <label for="description">Description</label>
                <input type="text" id="landmark-description" name="description">
            </div>
            <div class="mb-3">
                <label for="image">Image</label>
                <input type="text" id="landmark-image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Edit</button>    
        </form>
    </div>
    
    <h2>Delete Landmark</h2>

    <div id="delete-landmark-form">
        <form action="index.php?controller=admin&action=deleteLandmark" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="landmarkID">Landmark ID</label>
                <input type="text" class="form-control" id="landmarkID" name="landmarkID">
            </div>
            <button type="submit" class="btn btn-primary">Delete</button>    
        </form>
    </div>
    <!-- <form action="historycontroller.php" method="post"></form>
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
    </script> -->
</body>
