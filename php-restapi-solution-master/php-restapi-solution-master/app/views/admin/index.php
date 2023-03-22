<?php
//include __DIR__ . '/../navbar.php';

?>

<body>

    <link href="../css/admin.css" rel="stylesheet">

    <div class="title">
        <h1>Administrator Pannel</h1>
    </div>

    <!-- ------------------ HIER LANDMARKS MENU ----------------------------- -->
    <div class="landmarks"></div>
    <div class="card">
        <div class="card-body">
            <h2>Landmarks</h2>

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
                // foreach ($models as $landmark)
                // {
                //     echo "<h2>$landmark->title</h2>";
                //     echo "<p>$landmark->description</p>";
                //     echo "<p>$landmark->image</p>";
                //     // echo "<img src='images/" . $landmark->getImage() . "' alt='Landmark image'>";
                // }
                ?>
            </div>
        </div>
    </div>

    <div class="card-group">
        <div class="card">
            <div class="card-body" id="cardBody">
                <h4>Add Landmark</h4>

                <div id="landmark-form">
                    <form action="/admin/createLandmark" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="landmark-title" name="setTitle"
                                placeholder="title">
                        </div>
                        <div class="mb-3">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="landmark-description" name="setDescription"
                                placeholder="description">
                        </div>
                        <div class="mb-3">
                            <label for="image">Image</label>
                            <input type="text" class="form-control" id="landmark-image" name="setImage"
                                placeholder="image/link">
                        </div>
                        <div class="d-grid gap-2" id="buttons">
                            <button type="submit" class="btn btn-primary btn-lg">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body" id="cardBody">

                <h4>Edit Landmark</h4>
                <div id="edit-landmark-form">
                    <form action="/admin/editLandmark" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="landmarkID">Landmark ID</label>
                            <input type="text" class="form-control" id="landmarkID" name="landmarkID">
                        </div>
                        <div class="mb-3">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="landmark-title" name="title"
                                placeholder="<?php echo $landmark->getTitle(); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="landmark-description" name="description"
                                placeholder="<?php echo $landmark->getDescription(); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="image">Image</label>
                            <input type="text" class="form-control" id="landmark-image" name="image"
                                placeholder="<?php echo $landmark->getImage(); ?>">
                        </div>
                        <div class="d-grid gap-2" id="buttons">
                            <button type="submit" class="btn btn-primary btn-lg">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body" id="cardBody">

                <h4>Delete Landmark</h4>

                <div id="delete-landmark-form">
                    <form action="/admin/deleteLandmark" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="landmarkID">Landmark ID</label>
                            <input type="text" class="form-control" id="landmarkID" name="landmarkID">
                        </div>
                        <div class="d-grid gap-2" id="buttons">
                            <button type="submit" class="btn btn-primary btn-lg">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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

    <div id="artist">

        <div class="card">
            <div class="card-body">
                <h2>Jazz</h2>

                <div id="artist-table">
                    <?php
                    // if (!is_null($artist) && count($artist) > 0) {
                    //     echo '<table>';
                    //     echo '<tr><th>ID</th><th>Title</th><th>Description</th><th>Image</th><th>Actions</th></tr>';
                    //     foreach ($artists as $artist) {
                    //         echo '<tr>';
                    //         echo '<td>' . $artist->getLandmarkID() . '</td>';
                    //         echo '<td>' . $artist->getTitle() . '</td>';
                    //         echo '<td>' . $artist->getDescription() . '</td>';
                    //         echo '<td>' . $artist->getImage() . '</td>';
                    //         echo '<td><a href="index.php?action=editLandmark&id=' . $artist->getLandmarkID() . '">Edit</a> | <a href="index.php?action=deleteLandmark&id=' . $artist->getLandmarkID() . '">Delete</a></td>';
                    //         echo '</tr>';
                    //     }
                    //     echo '</table>';
                    // } else {
                    //     echo '<p>No landmarks found.</p>';
                    // }
                    // foreach ($models as $landmark)
                    // {
                    //     echo "<h2>$landmark->title</h2>";
                    //     echo "<p>$landmark->description</p>";
                    //     echo "<p>$landmark->image</p>";
                    //     // echo "<img src='images/" . $landmark->getImage() . "' alt='Landmark image'>";
                    // }
                    ?>
                </div>
            </div>
        </div>

        <div class="card-group">
            <div class="card">
                <div class="card-body" id="cardBody">
                    <h4>Add Artist</h4>

                    <!-- <div id="artist-form">
                        <form action="/admin/createArtist" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="artist-title" name="setTitle"
                                    placeholder="title">
                            </div>
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="artist-description" name="setDescription"
                                    placeholder="description">
                            </div>
                            <div class="mb-3">
                                <label for="image">Image</label>
                                <input type="text" class="form-control" id="artist-image" name="setImage"
                                    placeholder="image/link">
                            </div>
                            <div class="d-grid gap-2" id="buttons">
                                <button type="submit" class="btn btn-primary btn-lg">Create</button>
                            </div>
                        </form>
                    </div> -->
                </div>
            </div>

            <div class="card">
                <div class="card-body" id="cardBody">

                    <h4>Edit Artist</h4>
                    <!-- <div id="edit-artist-form">
                        <form action="/admin/editArtist" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="landmarkID">Artist ID</label>
                                <input type="text" class="form-control" id="artistID" name="artistID">
                            </div>
                            <div class="mb-3">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="artist-title" name="title"
                                    placeholder="<?php // $artist->getTitle(); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="artist-description" name="description"
                                    placeholder="<?php // $artist->getDescription(); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="image">Image</label>
                                <input type="text" class="form-control" id="artist-image" name="image"
                                    placeholder="<?php // $artist->getImage(); ?>">
                            </div>
                            <div class="d-grid gap-2" id="buttons">
                                <button type="submit" class="btn btn-primary btn-lg">Edit</button>
                            </div>
                        </form>
                    </div> -->
                </div>
            </div>

            <div class="card">
                <div class="card-body" id="cardBody">

                    <h4>Delete Artist</h4>

                    <!-- <div id="delete-artist-form">
                        <form action="/admin/deleteArtist" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="artistID">Artist ID</label>
                                <input type="text" class="form-control" id="artistID" name="artistID">
                            </div>
                            <div class="d-grid gap-2" id="buttons">
                                <button type="submit" class="btn btn-primary btn-lg">Delete</button>
                            </div>
                        </form>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <div class="restaurants"></div>
    <div class="card">
        <div class="card-body">
            <h2>restaurants</h2>

            <div id="restaurants-table">
                <?php
                if (!is_null($restaurants) && count($restaurants) > 0) {
                    echo '<table>';
                    echo '<tr><th>ID</th><th>Name</th><th>Address</th><th>Contact</th>
                    <th>Card Description</th><th>Description</th><th>Amount Of Stars</th>
                    <th>Banner Image</th><th>Head Chef</th><th>Amount Sessions</th>
                    <th>Adult Price</th><th>Child Price</th><th>Start Time</th>
                    <th>Duration</th></tr>';
                    foreach ($restaurants as $restaurant) {

                        echo '<tr>';
                        echo '<td>' . $restaurant->getRestaurantID() . '</td>';
                        echo '<td>' . $restaurant->getRestaurantName() . '</td>';
                        echo '<td>' . $restaurant->getAddress() . '</td>';
                        echo '<td>' . $restaurant->getContact() . '</td>';
                        echo '<td>' . $restaurant->getCardDescription() . '</td>';
                        echo '<td>' . $restaurant->getDescription() . '</td>';
                        echo '<td>' . $restaurant->getAmountOfStars() . '</td>';
                        echo '<td>' . $restaurant->getBannerImage() . '</td>';
                        echo '<td>' . $restaurant->getHeadChef() . '</td>';
                        echo '<td>' . $restaurant->getAmountSessions() . '</td>';
                        echo '<td>' . $restaurant->getAdultPrice() . '</td>';
                        echo '<td>' . $restaurant->getChildPrice() . '</td>';
                        echo '<td>' . $restaurant->getStartTime()->format('Y-m-d H:i') . '</td>';
                        echo '<td>' . $restaurant->getDuration()->format('H:i') . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo '<p>No restaurants found.</p>';
                }
                ?>
            </div>
        </div>
    </div>

    <div class="card-group">
        <div class="card">
            <div class="card-body" id="cardBody">
                <h4>Add Restaurant</h4>

                <div id="restaurant-form">
                    <form action="/admin/createRestaurant" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="createRestaurantName">Restaurant Name</label>
                            <input type="text" class="form-control" id="createRestaurant-name"
                                name="createRestaurantName" placeholder="Name">
                        </div>
                        <div class="mb-3">
                            <label for="createRestaurantAddress">Restaurant Address</label>
                            <input type="text" class="form-control" id="createRestaurant-address"
                                name="createRestaurantAddress" placeholder="Address">
                        </div>
                        <div class="mb-3">
                            <label for="createRestaurantContact">Restaurant Contact</label>
                            <input type="text" class="form-control" id="createRestaurant-contact"
                                name="createRestaurantContact" placeholder="contact">
                        </div>
                        <div class="mb-3">
                            <label for="createRestaurantCardDescription">Restaurant Card Description</label>
                            <input type="text" class="form-control" id="createRestaurant-cardDescription"
                                name="createRestaurantCardDescription" placeholder="card description">
                        </div>
                        <div class="mb-3">
                            <label for="createRestaurantDescription">Description</label>
                            <input type="text" class="form-control" id="createRestaurant-description"
                                name="createRestaurantDescription" placeholder="description">
                        </div>
                        <div class="mb-3">
                            <label for="createRestaurantAmountOfStars">Restaurant Amount Of Stars</label>
                            <input type="text" class="form-control" id="createRestaurant-amountOfStars"
                                name="createRestaurantAmountOfStars" placeholder="amount of stars">
                        </div>
                        <div class="mb-3">
                            <label for="createRestaurantBannerImage">Banner/Image/Link</label>
                            <input type="text" class="form-control" id="createRestaurant-bannerImage"
                                name="createRestaurantBannerImage" placeholder="banner/image/link">
                        </div>
                        <div class="mb-3">
                            <label for="createRestaurantHeadChef">Head chef</label>
                            <input type="text" class="form-control" id="createRestaurant-headChef"
                                name="createRestaurantHeadChef" placeholder="head chef">
                        </div>
                        <div class="mb-3">
                            <label for="createRestaurantAmountSessions">Amount of Sessions</label>
                            <input type="text" class="form-control" id="createRestaurant-amountSessions"
                                name="createRestaurantAmountSessions" placeholder="amount sessions">
                        </div>
                        <div class="mb-3">
                            <label for="createRestaurantAdultPrice">Adult Price</label>
                            <input type="text" class="form-control" id="createRestaurant-adultPrice"
                                name="createRestaurantAdultPrice" placeholder="adult price">
                        </div>
                        <div class="mb-3">
                            <label for="createRestaurantChildPrice">Child Price</label>
                            <input type="text" class="form-control" id="createRestaurant-childPrice"
                                name="createRestaurantChildPrice" placeholder="child price">
                        </div>
                        <div class="mb-3">
                            <label for="createRestaurantStartTime">Start Time</label>
                            <input type="datetime-local" class="form-control" id="createRestaurant-startTime"
                                name="createRestaurantStartTime" placeholder="start time">
                        </div>
                        <div class="mb-3">
                            <label for="createRestaurantDuration">Duration</label>
                            <input type="time" class="form-control" id="createRestaurant-duration"
                                name="createRestaurantDuration" placeholder="duration">
                        </div>

                        <div class="d-grid gap-2" id="createButtons">
                            <button type="submit" class="btn btn-primary btn-lg">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body" id="cardBody">

                <h4>Edit Restaurant</h4>
                <div id="edit-restaurant-form">
                    <form action="/admin/editRestaurant" method="post" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="editRestaurantID">Restaurant ID</label>
                            <input type="text" class="form-control" id="editRestaurantID" name="editRestaurantID">
                        </div>
                        <div class="mb-3">
                            <label for="editRestaurantName">Restaurant Name</label>
                            <input type="text" class="form-control" id="editRestaurant-name" name="editRestaurantName">
                        </div>
                        <div class="mb-3">
                            <label for="editRestaurantAddress">Restaurant Address</label>
                            <input type="text" class="form-control" id="editRestaurant-address"
                                name="editRestaurantAddress">
                        </div>
                        <div class="mb-3">
                            <label for="editRestaurantContact">Restaurant Contact</label>
                            <input type="text" class="form-control" id="editRestaurant-contact"
                                name="editRestaurantContact">
                        </div>
                        <div class="mb-3">
                            <label for="editRestaurantCardDescription">Restaurant Card Description</label>
                            <input type="text" class="form-control" id="editRestaurant-description"
                                name="editRestaurantCardDescription">
                        </div>
                        <div class="mb-3">
                            <label for="editRestaurantDescription">Description</label>
                            <input type="text" class="form-control" id="editRestaurant-description"
                                name="editRestaurantDescription">
                        </div>
                        <div class="mb-3">
                            <label for="editRestaurantAmountOfStars">Restaurant Amount Of Stars</label>
                            <input type="text" class="form-control" id="editRestaurant-amountOfStars"
                                name="editRestaurantAmountOfStars">
                        </div>
                        <div class="mb-3">
                            <label for="editRestaurantBannerImage">Banner/Image/Link</label>
                            <input type="text" class="form-control" id="editRestaurant-bannerImage"
                                name="editRestaurantBannerImage">
                        </div>
                        <div class="mb-3">
                            <label for="editRestaurantHeadChef">Head chef</label>
                            <input type="text" class="form-control" id="editRestaurant-headChef"
                                name="editRestaurantHeadChef">
                        </div>
                        <div class="mb-3">
                            <label for="editRestaurantAmountSessions">Amount of Sessions</label>
                            <input type="text" class="form-control" id="editRestaurant-amountSessions"
                                name="editRestaurantAmountSessions">
                        </div>
                        <div class="mb-3">
                            <label for="editRestaurantAdultPrice">Adult Price</label>
                            <input type="text" class="form-control" id="editRestaurant-adultPrice"
                                name="editRestaurantAdultPrice""
                                >
                        </div>
                        <div class=" mb-3">
                            <label for="editRestaurantChildPrice">Child Price</label>
                            <input type="text" class="form-control" id="editRestaurant-childPrice"
                                name="editRestaurantChildPrice">
                        </div>
                        <div class="mb-3">
                            <label for="editRestaurantStartTime">Start Time</label>
                            <input type="datetime-local" class="form-control" id="editRestaurant-startTime"
                                name="editRestaurantStartTime">
                        </div>
                        <div class="mb-3">
                            <label for="editRestaurantDuration">Session Duration</label>
                            <input type="time" class="form-control" id="editRestaurant-duration"
                                name="editRestaurantDuration">
                        </div>

                        <div class="d-grid gap-2" id="editRestaurantButtons">
                            <button type="submit" class="btn btn-primary btn-lg">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <script>
            const editRestaurantId = document.getElementById("editRestaurantID");

            editRestaurantId.addEventListener("change", function (event) {
                var enteredId = document.getElementById('editRestaurantID').value;
                var restaurants = <?php echo json_encode($restaurants); ?>;
                var restaurantFound = false;

                restaurants.forEach(function (restaurant) {
                    if (restaurant.getRestaurantID() === enteredId) {
                        document.getElementById('editRestaurantName').value = restaurant.getName();
                        document.getElementById('editRestaurantAddress').value = restaurant.getAddress();
                        document.getElementById('editRestaurantContact').value = restaurant.getContact();
                        document.getElementById('editRestaurantDescription').value = restaurant.getDescription();
                        document.getElementById('editRestaurantAmountOfStars').value = restaurant.getAmountOfStars();
                        document.getElementById('editRestaurantBannerImage').value = restaurant.getBannerImage();
                        document.getElementById('editRestaurantHeadChef').value = restaurant.getHeadChef();
                        document.getElementById('editRestaurantAmountSessions').value = restaurant.getAmountSessions();
                        document.getElementById('editRestaurantAdultPrice').value = restaurant.getAdultPrice();
                        document.getElementById('editRestaurantChildPrice').value = restaurant.getChildPrice();
                        // document.getElementById('editRestaurant-startTime').value = restaurant.getStartTime().format('Y-m-d\\TH:i');
                        // document.getElementById('editRestaurant-duration').value = restaurant.getDuration().format('H:i:s');
                        restaurantFound = true;
                    }
                });
                if (!restaurantFound) {
                    document.getElementById('editRestaurantName').value = '';
                    document.getElementById('editRestaurantAddress').value = '';
                    document.getElementById('editRestaurantContact').value = '';
                    document.getElementById('editRestaurantDescription').value = '';
                    document.getElementById('editRestaurantAmountOfStars').value = '';
                    document.getElementById('editRestaurantBannerImage').value = '';
                    document.getElementById('editRestaurantHeadChef').value = '';
                    document.getElementById('editRestaurantAmountSessions').value = '';
                    document.getElementById('editRestaurantAdultPrice').value = '';
                    document.getElementById('editRestaurantChildPrice').value = '';
                    // document.getElementById('editRestaurant-startTime').value = '';
                    // document.getElementById('editRestaurant-duration').value = '';
                }
            });

                // const editRestaurantId = document.getElementById("editRestaurantID");

                //         editRestaurantId.addEventListener("change", function (event) {
                //             var enteredId = document.getElementById('editRestaurantID').value;
                //             var restaurants = [/* array of restaurant objects */];
                //             var restaurantFound = false;

                //             restaurants.forEach(function (restaurant) {
                //                 if (restaurant.getRestaurantID() === enteredId) {
                //                     document.getElementById('editRestaurantName').value = restaurant.getName();
                //                     document.getElementById('editRestaurantAddress').value = restaurant.getAddress();
                //                     document.getElementById('editRestaurantContact').value = restaurant.getContact();
                //                     document.getElementById('editRestaurantDescription').value = restaurant.getDescription();
                //                     document.getElementById('editRestaurantAmountOfStars').value = restaurant.getAmountOfStars();
                //                     document.getElementById('editRestaurantBannerImage').value = restaurant.getBannerImage();
                //                     document.getElementById('editRestaurantHeadChef').value = restaurant.getHeadChef();
                //                     document.getElementById('editRestaurantAmountSessions').value = restaurant.getAmountSessions();
                //                     document.getElementById('editRestaurantAdultPrice').value = restaurant.getAdultPrice();
                //                     document.getElementById('editRestaurantChildPrice').value = restaurant.getChildPrice();
                //                     // document.getElementById('editRestaurant-startTime').value = restaurant.getStartTime().format('Y-m-d\\TH:i');
                //                     // document.getElementById('editRestaurant-duration').value = restaurant.getDuration().format('H:i:s');
                //                     restaurantFound = true;
                //                 }
                //             });

                //             if (!restaurantFound) {
                //                 document.getElementById('editRestaurantName').value = '';
                //                 document.getElementById('editRestaurantAddress').value = '';
                //                 document.getElementById('editRestaurantContact').value = '';
                //                 document.getElementById('editRestaurantDescription').value = '';
                //                 document.getElementById('editRestaurantAmountOfStars').value = '';
                //                 document.getElementById('editRestaurantBannerImage').value = '';
                //                 document.getElementById('editRestaurantHeadChef').value = '';
                //                 document.getElementById('editRestaurantAmountSessions').value = '';
                //                 document.getElementById('editRestaurantAdultPrice').value = '';
                //                 document.getElementById('editRestaurantChildPrice').value = '';
                //                 // document.getElementById('editRestaurant-startTime').value = '';
                //                 // document.getElementById('editRestaurant-duration').value = '';
                //             }
                //         });

            // const editRestaurantId = document.getElementById("editRestaurantID");

            // editRestaurantId.addEventListener("change", function (event) {
            //     var enteredId = document.getElementById('editRestaurantID').value;
            //     array.forEach(function (restaurant) {
            //         if (restaurant.getRestaurantID() === enteredId) {
            //             document.getElementById('editRestaurantName').value = restaurant['name'];
            //             document.getElementById('editRestaurantAddress').value = restaurant['address'];
            //             document.getElementById('editRestaurantContact').value = restaurant['contact'];
            //             document.getElementById('editRestaurantDescription').value = restaurant['description'];
            //             document.getElementById('editRestaurantAmountOfStars').value = restaurant['amountOfStars'];
            //             document.getElementById('editRestaurantBannerImage').value = restaurant['banner_image'];
            //             document.getElementById('editRestaurantHeadChef').value = restaurant['headChef'];
            //             document.getElementById('editRestaurantAmountSessions').value = restaurant['amountSessions'];
            //             document.getElementById('editRestaurantAdultPrice').value = restaurant['adultPrice'];
            //             document.getElementById('editRestaurantChildPrice').value = restaurant['childPrice'];
            //             document.getElementById('editRestaurantStartTime').value = restaurant['startTime'];
            //             document.getElementById('editRestaurantDuration').value = restaurant['duration'];
            //             break;
            //         } else {
            //             document.getElementById('editRestaurant-name').value = '';
            //             document.getElementById('editRestaurant-address').value = '';
            //             document.getElementById('editRestaurant-contact').value = '';
            //             document.getElementById('editRestaurant-description').value = '';
            //             document.getElementById('editRestaurant-amountOfStars').value = '';
            //             document.getElementById('editRestaurant-bannerImage').value = '';
            //             document.getElementById('editRestaurant-headChef').value = '';
            //             document.getElementById('editRestaurant-amountSessions').value = '';
            //             document.getElementById('editRestaurant-adultPrice').value = '';
            //             document.getElementById('editRestaurant-childPrice').value = '';
            //             document.getElementById('editRestaurant-startTime').value = '';
            //             document.getElementById('editRestaurant-duration').value = '';
            //         }
            //     });

            // });
        </script>

        <?php
        // assuming the database connection is already established
        // if (isset($_POST['editRestaurantID'])) {
        //     $restaurantID = $_POST['editRestaurantID'];
        //     $stmt = $pdo->prepare("SELECT * FROM restaurants WHERE id = :id");
        //     $stmt->execute(['id' => $restaurantID]);
        //     $restaurant = $stmt->fetch();
        
        //     // fill the form fields with the data from the database
        //     if ($restaurant) {
        //         echo '<script>';
        //         echo "document.getElementById('editRestaurant-name').value = '{$restaurant['name']}';";
        //         echo "document.getElementById('editRestaurant-address').value = '{$restaurant['address']}';";
        //         echo "document.getElementById('editRestaurant-contact').value = '{$restaurant['contact']}';";
        //         echo "document.getElementById('editRestaurant-description').value = '{$restaurant['description']}';";
        //         echo "document.getElementById('editRestaurant-amountOfStars').value = '{$restaurant['amount_of_stars']}';";
        //         echo "document.getElementById('editRestaurant-bannerImage').value = '{$restaurant['banner_image']}';";
        //         echo "document.getElementById('editRestaurant-headChef').value = '{$restaurant['head_chef']}';";
        //         echo "document.getElementById('editRestaurant-amountSessions').value = '{$restaurant['amount_sessions']}';";
        //         echo "document.getElementById('editRestaurant-adultPrice').value = '{$restaurant['adult_price']}';";
        //         echo "document.getElementById('editRestaurant-childPrice').value = '{$restaurant['child_price']}';";
        //         echo "document.getElementById('editRestaurant-startTime').value = '{$restaurant['start_time']}';";
        //         echo "document.getElementById('editRestaurant-duration').value = '{$restaurant['duration']}';";
        //         echo '</script>';
        //     } else {
        //         echo '<script>';
        //         echo 'alert("Restaurant not found!");';
        //         echo '</script>';
        //     }
        // }
        ?>

        <div class="card">
            <div class="card-body" id="cardBody">

                <h4>Delete Restaurant</h4>

                <div id="delete-restaurant-form">
                    <form action="/admin/deleteRestaurant" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="deleteRestaurantID">Restaurant ID</label>
                            <input type="text" class="form-control" id="deleteRestaurantID" name="deleteRestaurantID">
                        </div>
                        <div class="d-grid gap-2" id="deleteRestaurantButtons">
                            <button type="submit" class="btn btn-primary btn-lg">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>