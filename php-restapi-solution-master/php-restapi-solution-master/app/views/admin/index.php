
 
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
                echo '<td><a href="index.php?action=editLandmark&id=' . $landmark->getLandmarkID() . '">Edit</a> | <a href="index.php?action=deleteLandmark&id=' . $landmark->getLandmarkID() . '">Delete</a></td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>No landmarks found.</p>';
        }
        ?>

    </div>

    <h3>Add Landmark</h3>

    <div id="landmark-form">
        <form action="/admin/createLandmark" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="landmark-title" name="setTitle">
        </div>
        <div class="mb-3">
            <label for="description">Description</label>
            <input type="text" id="landmark-description" name="setDescription">
        </div>
        <div class="mb-3">
            <label for="image">Image</label>
            <input type="text" id="landmark-image" name="setImage">
        </div>
            <button type="submit" class="btn btn-primary">Create</button>
    </div>

    <h3>Edit Landmark</h3>

    <div id="edit-landmark-form">
        <form action="/admin/editLandmark" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="landmarkID">Landmark ID</label>
                <input type="text" class="form-control" id="landmarkID" name="setLandmarkID" value="<?php echo $landmarkID->getLandmarkID(); ?>">
            </div>
            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="landmark-title" name="setTitle" value="<?php echo $landmark->getTitle(); ?>">
            </div>
            <div class="mb-3">
                <label for="description">Description</label>
                <input type="text" id="landmark-description" name="setDescription" value="<?php echo $landmark->getDescription(); ?>">
            </div>
            <div class="mb-3">
                <label for="image">Image</label>
                <input type="text" id="landmark-image" name="setImage" value="<?php echo $landmark->getImage(); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Edit</button>    
        </form>
    </div>
    
    <h3>Delete Landmark</h3>

    <div id="delete-landmark-form">
        <form action="/admin/deleteLandmark" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="landmarkID">Landmark ID</label>
                <input type="text" class="form-control" id="landmarkID" name="setLandmarkID" value="<?php echo $landmarkID->getLandmarkID(); ?>">
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
