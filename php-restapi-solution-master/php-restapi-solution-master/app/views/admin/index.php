<body>

    <link href="../css/admin.css" rel="stylesheet">

    <div class="title">
        <h1>Administrator Pannel</h1>
    </div>
    <div class="card">
        <div class="row">
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button" class="btn btn-secondary" id="users-btn">Users</button>
                <button type="button" class="btn btn-info" id="festival-btn">Festival</button>
                <button type="button" class="btn btn-warning" id="jazz-btn">Jazz</button>
                <button type="button" class="btn btn-primary" id="history-btn">History</button>
                <button type="button" class="btn btn-danger" id="yummy-btn">Yummy</button>
            </div>

            <div id="content-container"></div>
        </div>
    </div>

    <script>
        // Get references to the buttons and the content container
        const usersBtn = document.getElementById("users-btn");
        const festivalBtn = document.getElementById("festival-btn");
        const jazzBtn = document.getElementById("jazz-btn");
        const historyBtn = document.getElementById("history-btn");
        const yummyBtn = document.getElementById("yummy-btn");
        const contentContainer = document.getElementById("content-container");

        // Add click event listeners to the buttons
        usersBtn.addEventListener("click", () => {
            if (usersBtn === event.target) {
                // Set the HTML content for usersBtn
                const htmlContent = `
                                    <h2>Users</h2>
                                    <p>This is HTML content for Users button.</p>
                                    `;
                // Update the content container
                contentContainer.innerHTML = htmlContent;
            }
        });

        festivalBtn.addEventListener("click", () => {
            if (festivalBtn === event.target) {
                const htmlContent = `
                                    <h2>Festival</h2>
                                    <p>This is HTML content for Festival button.</p>
                                    `;
                contentContainer.innerHTML = htmlContent;
            }
        });

        jazzBtn.addEventListener("click", () => {
            if (jazzBtn === event.target) {
                const htmlContent = `
                                    <h2>Jazz</h2>
                                    <p>This is HTML content for Jazz button.</p>
                                    `;
                contentContainer.innerHTML = htmlContent;
            }
        });

        // Histroy CRUD
        historyBtn.addEventListener("click", () => {
            if (historyBtn === event.target) {
                const htmlContent = `
                                <div class="history">
                                <h2>History</h2>

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
                                                    echo '<td>' ?> <a class="btn btn-primary"
                                                    onclick="showEditRestaurant(<?php echo $landmark->getLandmarkID(); ?>)">Edit</a>
                                                <?php
                                                    echo '<td>' ?> <a class="btn btn-danger"
                                                    onclick="showDeleteButton(<?php echo $landmark->getLandmarkID(); ?>)">Delete</a>
                                                <?php
                                                    echo '</tr>';
                                                }
                                                echo '</table>';
                                            } else {
                                                echo '<p>No landmarks found.</p>';
                                            }
                                                ?>

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
                                                                    value="<?php echo $landmark->getTitle(); ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="description">Description</label>
                                                                <input type="text" id="landmark-description" name="setDescription"
                                                                    value="<?php echo $landmark->getDescription(); ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="image">Image</label>
                                                                <input type="text" id="landmark-image" name="setImage"
                                                                    value="<?php echo $landmark->getImage(); ?>">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Create</button>
                                                    </div>

                                                    <div class="card">
                                                        <div class="card-body" id="cardBody">

                                                            <div id="edit-landmark-form">
                                                                <form action="/admin/editLandmark" method="post" enctype="multipart/form-data">
                                                                    <div class="mb-3">
                                                                        <label for="landmarkID">Landmark ID</label>
                                                                        <input type="text" class="form-control" id="landmarkID"
                                                                            name="landmarkID">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="title">Title</label>
                                                                        <input type="text" class="form-control" id="landmark-title"
                                                                            name="title">
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

                                                            <h3>Delete Landmark</h3>

                                                            <div id="delete-landmark-form">
                                                                <form action="/admin/deleteLandmark" method="post"
                                                                    enctype="multipart/form-data">
                                                                    <div class="mb-3">
                                                                        <label for="landmarkID">Landmark ID</label>
                                                                        <input type="text" class="form-control" id="landmarkID"
                                                                            name="landmarkID">
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                    `;
                contentContainer.innerHTML = htmlContent;
            }
        });

        yummyBtn.addEventListener("click", () => {
            if (yummyBtn === event.target) {
                const htmlContent = `
                                    <h2>Yummy</h2>
                                    <p>This is HTML content for Yummy button.</p>
                                    `;
                contentContainer.innerHTML = htmlContent;
            }
        });
    </script>

    <!-- <button type="button" class="btn btn-danger">Danger</button>
    <button type="button" class="btn btn-info">Info</button> -->

    PAS DEZE NOG AAN EN IMPLEMENTEER BIJ DE NODIGE GROEP




    <!-- ----------------  YUMMY RESTAURANTS ----------------- -->

    <div class="restaurants">

    </div>

    <div class="card">
        <div class="card-body">
            <h2>Restaurants</h2>
            <div id="restaurants-table">
                <?php if (!is_null($restaurants) && count($restaurants) > 0) { ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Card Description</th>
                                <th>Description</th>
                                <th>Amount of Stars</th>
                                <th>Banner Image</th>
                                <th>Head Chef</th>
                                <th>Amount of Sessions</th>
                                <th>Adult Price</th>
                                <th>Child Price</th>
                                <th>Start Time</th>
                                <th>Duration</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($restaurants as $restaurant) { ?>
                                <tr>
                                    <td><?= $restaurant->getRestaurantID() ?></td>
                                    <td><?= $restaurant->getRestaurantName() ?></td>
                                    <td><?= $restaurant->getAddress() ?></td>
                                    <td><?= $restaurant->getContact() ?></td>
                                    <td><?= $restaurant->getCardDescription() ?></td>
                                    <td><?= $restaurant->getDescription() ?></td>
                                    <td><?= $restaurant->getAmountOfStars() ?></td>
                                    <td><?= $restaurant->getBannerImage() ?></td>
                                    <td><?= $restaurant->getHeadChef() ?></td>
                                    <td><?= $restaurant->getAmountSessions() ?></td>
                                    <td><?= $restaurant->getAdultPrice() ?></td>
                                    <td><?= $restaurant->getChildPrice() ?></td>
                                    <td><?= $restaurant->getStartTime()->format('Y-m-d H:i') ?></td>
                                    <td><?= $restaurant->getDuration()->format('H:i') ?></td>
                                    <td>
                                        <button class="btn btn-primary edit-btn" data-id="<?= $restaurant->getRestaurantID() ?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop-<?= $restaurant->getRestaurantID() ?>">
                                            Edit
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger delete-btn" data-id="<?= $restaurant->getRestaurantId() ?>">
                                            Delete
                                        </button>
                                    </td>
                                        <div class="modal fade" tabindex="-1" id="staticBackdrop-<?= $restaurant->getRestaurantID() ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" role="form" id="editRestaurant-<?= $restaurant->getRestaurantID() ?>">

                                                        <div class="form-group">
                                                            <label for="editRestaurantName">Name</label>
                                                            <input type="text" class="form-control" id="editRestaurantName" name="editRestaurantName" form="editRestaurant-<?= $restaurant->getRestaurantID() ?>" value="<?= $restaurant->getRestaurantName() ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editRestaurantPhoneNumber">Address</label>
                                                            <input type="text" class="form-control" id="editRestaurantPhoneNumber" name="editRestaurantPhoneNumber" form="editRestaurant-<?= $restaurant->getRestaurantID() ?>" value="<?= $restaurant->getAddress() ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editRestaurantEmail">Contact</label>
                                                            <input type="text" class="form-control" id="editRestaurantEmail" name="editRestaurantEmail" form="editRestaurant-<?= $restaurant->getRestaurantID() ?>" value="<?= $restaurant->getContact() ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editRestaurantCardDescription">CardDescription</label>
                                                            <input type="text" class="form-control" id="editRestaurantCardDescription" name="editRestaurantCardDescription" form="editRestaurant-<?= $restaurant->getRestaurantID() ?>" value="<?= $restaurant->getCardDescription() ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editRestaurantDescription">Description</label>
                                                            <input type="text" class="form-control" id="editRestaurantDescription" name="editRestaurantDescription" form="editRestaurant-<?= $restaurant->getRestaurantID() ?>" value="<?= $restaurant->getDescription() ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editRestaurantAmountStars">Amount of stars</label>
                                                            <input type="number" class="form-control" id="editRestaurantAmountStars" name="editRestaurantAmountStars" form="editRestaurant-<?= $restaurant->getRestaurantID() ?>" value="<?= $restaurant->getAmountOfStars() ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editRestaurantBannerImage">Banner Image (/)</label>
                                                            <input type="text" class="form-control" id="editRestaurantBannerImage" name="editRestaurantBannerImage" form="editRestaurant-<?= $restaurant->getRestaurantID() ?>" value="<?= $restaurant->getBannerImage() ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editRestaurantHeadChef">Head chef</label>
                                                            <input type="text" class="form-control" id="editRestaurantHeadChef" name="editRestaurantHeadChef" form="editRestaurant-<?= $restaurant->getRestaurantID() ?>" value="<?= $restaurant->getHeadChef() ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editRestaurantAmountSessions">Amount of sessions</label>
                                                            <input type="number" class="form-control" id="editRestaurantAmountSessions" name="editRestaurantAmountSessions" form="editRestaurant-<?= $restaurant->getRestaurantID() ?>" value="<?= $restaurant->getAmountSessions() ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editRestaurantAdultPrice">Price Adults</label>
                                                            <input type="number" class="form-control" id="editRestaurantAdultPrice" name="editRestaurantAdultPrice" form="editRestaurant-<?= $restaurant->getRestaurantID() ?>" value="<?= $restaurant->getAdultPrice() ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editRestaurantChildPrice">Price Children</label>
                                                            <input type="number" class="form-control" id="editRestaurantChildPrice" name="editRestaurantChildPrice" form="editRestaurant-<?= $restaurant->getRestaurantID() ?>" value="<?= $restaurant->getChildPrice() ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editRestaurantStartTime">Starttime sessions:</label>
                                                            <input type="datetime-local" id="editRestaurantStartTime" name="editRestaurantStartTime" form="editRestaurant-<?= $restaurant->getRestaurantID() ?>" min="<?= date('Y-m-d H:i'); ?>" value="<?= $restaurant->getStartTime()->format('Y-m-d H:i') ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editRestaurantDuration">Session duration:</label>
                                                            <input type="datetime-local" id="editRestaurantDuration" name="editRestaurantDuration" form="editRestaurant-<?= $restaurant->getRestaurantID() ?>" min="<?= date('H:i'); ?>" value="<?= $restaurant->getDuration()->format('H:i') ?>" required>
                                                        </div>

                                                        <input type="hidden" name="editRestaurantId" value="<?= $restaurant->getRestaurantID() ?>">
                                                        <button type="submit" class="btn btn-primary" id="confirmEditbutton" form="editRestaurant-<?= $restaurant->getRestaurantID() ?>">Restaurant aanpassen</button>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                
                            <?php } ?>
                        </tbody>
                    </table>
                <?php
                } else { ?>
                    <p>No restaurants found. Please try again later or add more restaurants.</p>
                <?php }
                ?>
                <div class="row">
                    <button type="button" class="btn btn-success" onclick="showAddRestaurant()" id="addRestaurantBtn">Add
                        Restaurant</button>
                </div>
            </div>
        </div>
        <div id="restaurant-options"></div>

        <script>
            const editRestaurantBtns = document.querySelectorAll('.edit-btn');
            const deleteRestaurantBtns = document.querySelectorAll('.delete-btn');
            const restaurantOptions = document.getElementById("restaurant-options");

            editRestaurantBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const restaurantId = btn.dataset.id;
                    const htmlContent = `<h2>Edit restaurant ${restaurantId}</h2>`;
                    restaurantOptions.innerHTML = htmlContent;
                });
            });
            deleteRestaurantBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const restaurantId = btn.dataset.id;
                    const htmlContent = `<div class="center-del" id="center-del">
                <h4> Delete restaurant ${restaurantId}</h4>
                <p>Are you sure you want to delete ${restaurantId}?</p>
                <p>You won't be able to recover it afterwards.</p>
                <form action="/admin/deleteRestaurant" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="deleteRestaurantID" name="deleteRestaurantID" value="${restaurantId}">
                    <button type="submit" class="btn btn-danger btn-lg">Delete</button>
                </form>
            </div>`;

                    restaurantOptions.innerHTML = htmlContent;
                });
            });
            addRestaurantBtn.addEventListener("click", () => {
                if (addRestaurantBtn === event.target) {
                    const htmlContent = `
                                    <h2>add</h2>
                                    `;
                    restaurantOptions.innerHTML = htmlContent;
                }
            });
        </script>




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

        <div class="card-group">
            <div class="card">
                <div class="card-body" id="cardBody">
                    <h4>Add Restaurant</h4>

                    <div id="restaurant-form">
                        <form action="/admin/createRestaurant" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="createRestaurantName">Restaurant Name</label>
                                <input type="text" class="form-control" id="createRestaurant-name" name="createRestaurantName" placeholder="Name">
                            </div>
                            <div class="mb-3">
                                <label for="createRestaurantAddress">Restaurant Address</label>
                                <input type="text" class="form-control" id="createRestaurant-address" name="createRestaurantAddress" placeholder="Address">
                            </div>
                            <div class="mb-3">
                                <label for="createRestaurantContact">Restaurant Contact</label>
                                <input type="text" class="form-control" id="createRestaurant-contact" name="createRestaurantContact" placeholder="contact">
                            </div>
                            <div class="mb-3">
                                <label for="createRestaurantCardDescription">Restaurant Card
                                    Description</label>
                                <input type="text" class="form-control" id="createRestaurant-cardDescription" name="createRestaurantCardDescription" placeholder="card description">
                            </div>
                            <div class="mb-3">
                                <label for="createRestaurantDescription">Description</label>
                                <input type="text" class="form-control" id="createRestaurant-description" name="createRestaurantDescription" placeholder="description">
                            </div>
                            <div class="mb-3">
                                <label for="createRestaurantAmountOfStars">Restaurant Amount Of
                                    Stars</label>
                                <input type="text" class="form-control" id="createRestaurant-amountOfStars" name="createRestaurantAmountOfStars" placeholder="amount of stars">
                            </div>
                            <div class="mb-3">
                                <label for="createRestaurantBannerImage">Banner/Image/Link</label>
                                <input type="text" class="form-control" id="createRestaurant-bannerImage" name="createRestaurantBannerImage" placeholder="banner/image/link">
                            </div>
                            <div class="mb-3">
                                <label for="createRestaurantHeadChef">Head chef</label>
                                <input type="text" class="form-control" id="createRestaurant-headChef" name="createRestaurantHeadChef" placeholder="head chef">
                            </div>
                            <div class="mb-3">
                                <label for="createRestaurantAmountSessions">Amount of
                                    Sessions</label>
                                <input type="text" class="form-control" id="createRestaurant-amountSessions" name="createRestaurantAmountSessions" placeholder="amount sessions">
                            </div>
                            <div class="mb-3">
                                <label for="createRestaurantAdultPrice">Adult Price</label>
                                <input type="text" class="form-control" id="createRestaurant-adultPrice" name="createRestaurantAdultPrice" placeholder="adult price">
                            </div>
                            <div class="mb-3">
                                <label for="createRestaurantChildPrice">Child Price</label>
                                <input type="text" class="form-control" id="createRestaurant-childPrice" name="createRestaurantChildPrice" placeholder="child price">
                            </div>
                            <div class="mb-3">
                                <label for="createRestaurantStartTime">Start Time</label>
                                <input type="datetime-local" class="form-control" id="createRestaurant-startTime" name="createRestaurantStartTime" placeholder="start time">
                            </div>
                            <div class="mb-3">
                                <label for="createRestaurantDuration">Duration</label>
                                <input type="time" class="form-control" id="createRestaurant-duration" name="createRestaurantDuration" placeholder="duration">
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
                                <input type="text" class="form-control" id="editRestaurant-address" name="editRestaurantAddress">
                            </div>
                            <div class="mb-3">
                                <label for="editRestaurantContact">Restaurant Contact</label>
                                <input type="text" class="form-control" id="editRestaurant-contact" name="editRestaurantContact">
                            </div>
                            <div class="mb-3">
                                <label for="editRestaurantCardDescription">Restaurant Card
                                    Description</label>
                                <input type="text" class="form-control" id="editRestaurant-description" name="editRestaurantCardDescription">
                            </div>
                            <div class="mb-3">
                                <label for="editRestaurantDescription">Description</label>
                                <input type="text" class="form-control" id="editRestaurant-description" name="editRestaurantDescription">
                            </div>
                            <div class="mb-3">
                                <label for="editRestaurantAmountOfStars">Restaurant Amount Of
                                    Stars</label>
                                <input type="text" class="form-control" id="editRestaurant-amountOfStars" name="editRestaurantAmountOfStars">
                            </div>
                            <div class="mb-3">
                                <label for="editRestaurantBannerImage">Banner/Image/Link</label>
                                <input type="text" class="form-control" id="editRestaurant-bannerImage" name="editRestaurantBannerImage">
                            </div>
                            <div class="mb-3">
                                <label for="editRestaurantHeadChef">Head chef</label>
                                <input type="text" class="form-control" id="editRestaurant-headChef" name="editRestaurantHeadChef">
                            </div>
                            <div class="mb-3">
                                <label for="editRestaurantAmountSessions">Amount of
                                    Sessions</label>
                                <input type="text" class="form-control" id="editRestaurant-amountSessions" name="editRestaurantAmountSessions">
                            </div>
                            <div class="mb-3">
                                <label for="editRestaurantAdultPrice">Adult Price</label>
                                <input type="text" class="form-control" id="editRestaurant-adultPrice" name="editRestaurantAdultPrice">
                            </div>
                            <div class=" mb-3">
                                <label for="editRestaurantChildPrice">Child Price</label>
                                <input type="text" class="form-control" id="editRestaurant-childPrice" name="editRestaurantChildPrice">
                            </div>
                            <div class="mb-3">
                                <label for="editRestaurantStartTime">Start Time</label>
                                <input type="datetime-local" class="form-control" id="editRestaurant-startTime" name="editRestaurantStartTime">
                            </div>
                            <div class="mb-3">
                                <label for="editRestaurantDuration">Session Duration</label>
                                <input type="time" class="form-control" id="editRestaurant-duration" name="editRestaurantDuration">
                            </div>

                            <div class="d-grid gap-2" id="editRestaurantButtons">
                                <button type="submit" class="btn btn-primary btn-lg">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                var restaurants = <?= json_encode($restaurants); ?>;
                console.log(restaurants);

                const editRestaurantId = document.getElementById("editRestaurantID");

                editRestaurantId.addEventListener("change", function(event) {
                    var enteredId = document.getElementById('editRestaurantID').value;

                    var restaurantFound = false;

                    restaurants.forEach(function(restaurant) {
                        console.log(restaurant);
                        if (restaurant.getRestaurantID() == enteredId) {
                            document.getElementById('editRestaurantName').value = restaurant.getRestaurantName();
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
            </script>

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
                    <!-- <div class="card-body" id="cardBody"> -->
                    <!-- <h4>Add Artist</h4>

                    <div id="artist-form">
                        <form action="/admin/createArtist" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="artist-title" name="setTitle" placeholder="title">
                            </div>
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="artist-description" name="setDescription" placeholder="description">
                            </div>
                            <div class="mb-3">
                                <label for="image">Image</label>
                                <input type="text" class="form-control" id="artist-image" name="setImage" placeholder="image/link">
                            </div>
                            <div class="d-grid gap-2" id="buttons">
                                <button type="submit" class="btn btn-primary btn-lg">Create</button>
                            </div>
                        </form>
                    </div>
                </div> -->
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
                                    placeholder="<?php // $artist->getTitle(); 
                                                    ?>">
                            </div>
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="artist-description" name="description"
                                    placeholder="<?php // $artist->getDescription(); 
                                                    ?>">
                            </div>
                            <div class="mb-3">
                                <label for="image">Image</label>
                                <input type="text" class="form-control" id="artist-image" name="image"
                                    placeholder="<?php // $artist->getImage(); 
                                                    ?>">
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

        <script src="/js/admin.js"></script>

</body>