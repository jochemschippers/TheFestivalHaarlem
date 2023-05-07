<link href="../css/test/yummy.css" rel="stylesheet">
<main role="main">
    <div class="card mb-3 panel important">
        <div class="card-header">
            <i class="fa fa-table"></i> YummyRestaurant Edit
        </div>
        <div class="card-body">
            <div class="table-responsive">
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
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($restaurants as $restaurant) { ?>
                                    <tr>
                                        <td title="<?= $restaurant->getRestaurantID() ?>"><?= $restaurant->getRestaurantID() ?></td>
                                        <td title="<?= $restaurant->getRestaurantName() ?>"><?= $restaurant->getRestaurantName() ?></td>
                                        <td title="<?= $restaurant->getAddress() ?>"><?= $restaurant->getAddress() ?></td>
                                        <td title="<?= $restaurant->getContact() ?>"><?= $restaurant->getContact() ?></td>
                                        <td title="<?= $restaurant->getCardDescription() ?>"><?= $restaurant->getCardDescription() ?></td>
                                        <td title="<?= $restaurant->getDescription() ?>"><?= $restaurant->getDescription() ?></td>
                                        <td title="<?= $restaurant->getAmountOfStars() ?>"><?= $restaurant->getAmountOfStars() ?></td>
                                        <td title="<?= $restaurant->getBannerImage() ?>"><?= $restaurant->getBannerImage() ?></td>
                                        <td title="<?= $restaurant->getHeadChef() ?>"><?= $restaurant->getHeadChef() ?></td>
                                        <td title="<?= $restaurant->getAmountSessions() ?>"><?= $restaurant->getAmountSessions() ?></td>
                                        <td title="<?= $restaurant->getAdultPrice() ?>"><?= $restaurant->getAdultPrice() ?></td>
                                        <td title="<?= $restaurant->getChildPrice() ?>"><?= $restaurant->getChildPrice() ?></td>
                                        <td>
                                            <button class="btn btn-primary edit-btn" data-id="<?= $restaurant->getRestaurantID() ?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop-<?= $restaurant->getRestaurantID() ?>">
                                                Edit
                                            </button>
                                        </td>
                                        <td>
                                            <form method="post" id="delete-<?= $restaurant->getRestaurantID() ?>" onsubmit="return confirm('Are you sure you want to delete restaurant: <?= $restaurant->getRestaurantID() ?>?')">
                                                <input type="hidden" id="deleteRestaurantID" name="deleteRestaurantID" value="<?= $restaurant->getRestaurantID() ?>">
                                                <button type="submit" class="btn btn-danger delete-btn" form="delete-<?= $restaurant->getRestaurantID() ?>">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <div class="modal fade" tabindex="-1" id="staticBackdrop-<?= $restaurant->getRestaurantID() ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Restaurant</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" role="form" id="editRestaurant-<?= $restaurant->getRestaurantID() ?>" onsubmit="return checkEditRestaurantForm()">

                                                        <div class="form-group">
                                                            <label for="editRestaurantName">Name</label>
                                                            <input type="text" class="form-control" id="editRestaurantName" name="editRestaurantName" form="editRestaurant-<?= $restaurant->getRestaurantID() ?>" value="<?= $restaurant->getRestaurantName() ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editRestaurantAddress">Address</label>
                                                            <input type="text" class="form-control" id="editRestaurantAddress" name="editRestaurantAddress" form="editRestaurant-<?= $restaurant->getRestaurantID() ?>" value="<?= $restaurant->getAddress() ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editRestaurantContact">Contact</label>
                                                            <input type="text" class="form-control" id="editRestaurantContact" name="editRestaurantContact" form="editRestaurant-<?= $restaurant->getRestaurantID() ?>" value="<?= $restaurant->getContact() ?>" required>
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
                                                            <label for="editRestaurantAmountOfStars">Amount of stars</label>
                                                            <input type="number" class="form-control" id="editRestaurantAmountOfStars" name="editRestaurantAmountOfStars" form="editRestaurant-<?= $restaurant->getRestaurantID() ?>" value="<?= $restaurant->getAmountOfStars() ?>" required>
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

                                                        <input type="hidden" name="editRestaurantId" form="editRestaurant-<?= $restaurant->getRestaurantID() ?>" value="<?= $restaurant->getRestaurantID() ?>">
                                                        <button type="submit" class="btn btn-primary" id="confirmEditbutton" form="editRestaurant-<?= $restaurant->getRestaurantID() ?>">Edit restaurant</button>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php
                    } else { ?>
                        <p>No restaurants found. Please try again later or add more restaurants.</p>
                    <?php }
                    ?>
                    <div class="row">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addRestaurantModal">Add Restaurant</button>
                        <div class="modal fade" tabindex="-1" id="addRestaurantModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Restaurant</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" method="post" id="addRestaurantForm" enctype="multipart/form-data" onsubmit="return checkAddRestaurantForm()">
                                            <div class="mb-3">
                                                <label for="createRestaurantName">Restaurant Name</label>
                                                <input type="text" class="form-control" form="addRestaurantForm" id="createRestaurant-name" name="createRestaurantName" placeholder="Name">
                                            </div>
                                            <div class="mb-3">
                                                <label for="createRestaurantAddress">Restaurant Address</label>
                                                <input type="text" class="form-control" form="addRestaurantForm" id="createRestaurant-address" name="createRestaurantAddress" placeholder="Address">
                                            </div>
                                            <div class="mb-3">
                                                <label for="createRestaurantContact">Restaurant Contact</label>
                                                <input type="text" class="form-control" form="addRestaurantForm" id="createRestaurant-contact" name="createRestaurantContact" placeholder="contact">
                                            </div>
                                            <div class="mb-3">
                                                <label for="createRestaurantCardDescription">Restaurant Card
                                                    Description</label>
                                                <input type="text" class="form-control" form="addRestaurantForm" id="createRestaurant-cardDescription" name="createRestaurantCardDescription" placeholder="card description">
                                            </div>
                                            <div class="mb-3">
                                                <label for="createRestaurantDescription">Description</label>
                                                <input type="text" class="form-control" form="addRestaurantForm" id="createRestaurant-description" name="createRestaurantDescription" placeholder="description">
                                            </div>
                                            <div class="mb-3">
                                                <label for="createRestaurantAmountOfStars">Restaurant Amount Of
                                                    Stars</label>
                                                <input type="text" class="form-control" form="addRestaurantForm" id="createRestaurant-amountOfStars" name="createRestaurantAmountOfStars" placeholder="amount of stars">
                                            </div>
                                            <div class="mb-3">
                                                <label for="createRestaurantBannerImage">Banner/Image/Link</label>
                                                <input type="text" class="form-control" form="addRestaurantForm" id="createRestaurant-bannerImage" name="createRestaurantBannerImage" placeholder="banner/image/link">
                                            </div>
                                            <div class="mb-3">
                                                <label for="createRestaurantHeadChef">Head chef</label>
                                                <input type="text" class="form-control" form="addRestaurantForm" id="createRestaurant-headChef" name="createRestaurantHeadChef" placeholder="head chef">
                                            </div>
                                            <div class="mb-3">
                                                <label for="createRestaurantAmountSessions">Amount of
                                                    Sessions</label>
                                                <input type="text" class="form-control" form="addRestaurantForm" id="createRestaurant-amountSessions" name="createRestaurantAmountSessions" placeholder="amount sessions">
                                            </div>
                                            <div class="mb-3">
                                                <label for="createRestaurantAdultPrice">Adult Price</label>
                                                <input type="text" class="form-control" form="addRestaurantForm" id="createRestaurant-adultPrice" name="createRestaurantAdultPrice" placeholder="adult price">
                                            </div>
                                            <div class="mb-3">
                                                <label for="createRestaurantChildPrice">Child Price</label>
                                                <input type="text" class="form-control" form="addRestaurantForm" id="createRestaurant-childPrice" name="createRestaurantChildPrice" placeholder="child price">
                                            </div>

                                            <div class="d-grid gap-2" id="createButtons">
                                                <button type="submit" class="btn btn-primary btn-lg" form="addRestaurantForm">Create</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- HIER CRUD RESERVATIONS -->
    <div class="card mb-3 panel important">
        <div class="card-header">
            <i class="fa fa-table"></i> Reservation Edit
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="reservations-table">
                    <?php if (!is_null($restaurantReservations) && count($restaurantReservations) > 0) { ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>TicketID</th>
                                    <th>TimeSlotID</th>
                                    <th>RestaurantID</th>
                                    <th>ReservationName</th>
                                    <th>PhoneNumber</th>
                                    <th>NumberAdults</th>
                                    <th>NumberChildren</th>
                                    <th>Remark</th>
                                    <th>IsActive</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($restaurantReservations as $reservation) { ?>
                                    <tr>
                                        <td title="<?= $reservation->getTicketID() ?>"><?= $reservation->getTicketID() ?></td>
                                        <td title="<?= $reservation->getTimeSlotID() ?>"><?= $reservation->getTimeSlotID() ?></td>
                                        <td title="<?= $reservation->getRestaurantID() ?>"><?= $reservation->getRestaurantID() ?></td>
                                        <td title="<?= $reservation->getReservationName() ?>"><?= $reservation->getReservationName() ?></td>
                                        <td title="<?= $reservation->getPhoneNumber() ?>"><?= $reservation->getPhoneNumber() ?></td>
                                        <td title="<?= $reservation->getNumberAdults() ?>"><?= $reservation->getNumberAdults() ?></td>
                                        <td title="<?= $reservation->getNumberChildren() ?>"><?= $reservation->getNumberChildren() ?></td>
                                        <td title="<?= $reservation->getRemark() ?>"><?= $reservation->getRemark() ?></td>
                                        <?php if ($reservation->getIsActive()) { ?>
                                            <td title="Yes">Yes</td>
                                        <?php } else { ?>
                                            <td title="No">No</td>
                                        <?php } ?>

                                        <td>
                                            <button class="btn btn-primary edit-btn" data-id="<?= $reservation->getTicketID() ?>" data-bs-toggle="modal" data-bs-target="#editReservation-<?= $reservation->getTicketID() ?>">
                                                Edit
                                            </button>
                                        </td>
                                        <td>
                                            <!-- ----------------------- DIT NOG BIJWERKEN. VEEL NAMEN MOETEN WORDEN VERANDERD ------------------------- -->

                                            <?php if ($reservation->getIsActive()) { ?>
                                                <form method="post" id="deactivateReservation-<?= $reservation->getTicketID() ?>" onsubmit="return confirm('Are you sure you want to deactivate reservation: <?= $reservation->getTicketID() ?>?')">
                                                    <input type="hidden" id="deactivateReservationTicketID" name="deactivateReservationTicketID" value="<?= $reservation->getTicketID() ?>">
                                                    <button type="submit" class="btn btn-danger deactivate-btn" form="deactivateReservation-<?= $reservation->getTicketID() ?>">Deactivate</button>
                                                </form>
                                            <?php } else { ?>
                                                <form method="post" id="activateReservation-<?= $reservation->getTicketID() ?>" onsubmit="return confirm('Are you sure you want to activate reservation: <?= $reservation->getTicketID() ?>?')">
                                                    <input type="hidden" id="activateReservationTicketID" name="activateReservationTicketID" value="<?= $reservation->getTicketID() ?>">
                                                    <button type="submit" class="btn btn-success activate-btn" form="activateReservation-<?= $reservation->getTicketID() ?>">Activate</button>
                                                </form>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <div class="modal fade" tabindex="-1" id="editReservation-<?= $reservation->getTicketID() ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit reservation</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" role="form" id="editReservationForm-<?= $reservation->getTicketID() ?>" onsubmit="return checkEditReservationForm(<?=$reservation->getTicketID()?>)">

                                                        <div class="form-group">
                                                            <label for="editReservationTimeSlotID">TimeSlotId</label>
                                                            <input type="text" class="form-control" id="editReservationTimeSlotID" name="editReservationTimeSlotID" form="editReservationForm-<?= $reservation->getTicketID() ?>" value="<?= $reservation->getTimeSlotID() ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editReservationRestaurantID">RestaurantID</label>
                                                            <input type="text" class="form-control" id="editReservationRestaurantID" name="editReservationRestaurantID" form="editReservationForm-<?= $reservation->getTicketID() ?>" value="<?= $reservation->getRestaurantID() ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editReservationName">ReservationName</label>
                                                            <input type="text" class="form-control" id="editReservationName" name="editReservationName" form="editReservationForm-<?= $reservation->getTicketID() ?>" value="<?= $reservation->getReservationName() ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editReservationPhoneNumber">PhoneNumber</label>
                                                            <input type="text" class="form-control" id="editReservationPhoneNumber" name="editReservationPhoneNumber" form="editReservationForm-<?= $reservation->getTicketID() ?>" value="<?= $reservation->getPhoneNumber() ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editReservationNumberAdults">NumberAdults</label>
                                                            <input type="text" class="form-control" id="editReservationNumberAdults" name="editReservationNumberAdults" form="editReservationForm-<?= $reservation->getTicketID() ?>" value="<?= $reservation->getNumberAdults() ?>" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="editReservationNumberChildren">NumberChildren</label>
                                                            <input type="text" class="form-control" id="editReservationNumberChildren" name="editReservationNumberChildren" form="editReservationForm-<?= $reservation->getTicketID() ?>" value="<?= $reservation->getNumberChildren() ?>" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="editReservationRemark">Remark</label>
                                                            <input type="text" class="form-control" id="editReservationRemark" name="editReservationRemark" form="editReservationForm-<?= $reservation->getTicketID() ?>" value="<?= $reservation->getRemark() ?>" required>
                                                        </div>

                                                        <input type="hidden" name="editReservationTicketID" form="editReservationForm-<?= $reservation->getTicketID() ?>" value="<?= $reservation->getTicketID() ?>">
                                                        <button type="submit" class="btn btn-primary" id="confirmEditbutton" form="editReservationForm-<?= $reservation->getTicketID() ?>">reservation aanpassen</button>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php
                    } else { ?>
                        <p>No reservations found. Please try again later or add more reservations.</p>
                    <?php }
                    ?>
                    <div class="row">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addReservationModal">Add reservation</button>
                        <div class="modal fade" tabindex="-1" id="addReservationModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Reservation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" method="post" id="addReservationForm" enctype="multipart/form-data" onsubmit="return checkAddReservationForm()">

                                            <div class="mb-3">
                                                <label for="createReservationTimeSlotID">TimeSlotID</label>
                                                <input type="text" class="form-control" form="addReservationForm" id="createReservationTimeSlotID" name="createReservationTimeSlotID" placeholder="TimeSlotID">
                                            </div>
                                            <div class="mb-3">
                                                <label for="createReservationRestaurantID">RestaurantID</label>
                                                <input type="text" class="form-control" form="addReservationForm" id="createReservationRestaurantID" name="createReservationRestaurantID" placeholder="RestaurantID">
                                            </div>
                                            <div class="mb-3">
                                                <label for="createReservationName">ReservationName</label>
                                                <input type="text" class="form-control" form="addReservationForm" id="createReservationName" name="createReservationName" placeholder="Name of reservation">
                                            </div>
                                            <div class="mb-3">
                                                <label for="createReservationPhoneNumber">PhoneNumber</label>
                                                <input type="text" class="form-control" form="addReservationForm" id="createReservationPhoneNumber" name="createReservationPhoneNumber" placeholder="PhoneNumber">
                                            </div>
                                            <div class="mb-3">
                                                <label for="createReservationNumberAdults">NumberAdults</label>
                                                <input type="text" class="form-control" form="addReservationForm" id="createReservationNumberAdults" name="createReservationNumberAdults" placeholder="Number adults">
                                            </div>
                                            <div class="mb-3">
                                                <label for="createReservationNumberChildren">NumberChildren</label>
                                                <input type="text" class="form-control" form="addReservationForm" id="createReservationNumberChildren" name="createReservationNumberChildren" placeholder="Number of children">
                                            </div>
                                            <div class="mb-3">
                                                <label for="createReservationRemark">Remark</label>
                                                <input type="text" class="form-control" form="addReservationForm" id="createReservationRemark" name="createReservationRemark" placeholder="Remark">
                                            </div>

                                            <div class="d-grid gap-2" id="createButtons">
                                                <button type="submit" class="btn btn-primary btn-lg" form="addReservationForm">Create</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- HIER CRUD TIMESLOTSYUMMY -->
    <div class="card mb-3 panel important">
        <div class="card-header">
            <i class="fa fa-table"></i> TimeSlotsYummy Edit
        </div>
        <div class="card">
            <div class="card-body">
                <div id="timeSlotsYummy-table">
                    <?php if (!is_null($timeSlotsYummy) && count($timeSlotsYummy) > 0) { ?>
                        <form>
                            <label>Show
                                <select id="rows-per-page">
                                    <option value="5">5</option>
                                    <option value="10" selected>10</option>
                                    <option value="25">25</option>
                                </select>
                                rows per page
                            </label>
                        </form>
                        <table id="timeSlotsTable">
                            <thead>
                                <tr>
                                    <th>TimeSlotID</th>
                                    <th>RestaurantID</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($timeSlotsYummy as $timeSlotYummy) { ?>
                                    <tr>
                                        <td title="<?= $timeSlotYummy->getTimeSlotID() ?>"><?= $timeSlotYummy->getTimeSlotID() ?></td>
                                        <td title="<?= $timeSlotYummy->getRestaurantID() ?>"><?= $timeSlotYummy->getRestaurantID() ?></td>
                                        <td>
                                            <button class="btn btn-primary edit-btn" data-id="<?= $timeSlotYummy->getTimeSlotID() ?>" data-bs-toggle="modal" data-bs-target="#editTimeSlotYummy-<?= $timeSlotYummy->getTimeSlotID() ?>">
                                                Edit
                                            </button>
                                        </td>
                                        <td>
                                            <form method="post" id="deleteTimeSlotYummy-<?= $timeSlotYummy->getTimeSlotID() ?>" onsubmit="return confirm('Are you sure you want to delete timeslot: <?= $timeSlotYummy->getTimeSlotID() ?>?')">
                                                <input type="hidden" id="deleteTimeSlotYummyID" name="deleteTimeSlotYummyID" value="<?= $timeSlotYummy->getTimeSlotID() ?>">
                                                <button type="submit" class="btn btn-danger delete-btn" form="deleteTimeSlotYummy-<?= $timeSlotYummy->getTimeSlotID() ?>">Delete</button>
                                            </form>
                                        </td>

                                        <!-- HIER KOMEN MODALS VOOR ADD EN EDIT TIMESLOTSYUMMY -->
                                        <div class="modal fade" tabindex="-1" id="editTimeSlotYummy-<?= $timeSlotYummy->getTimeSlotID() ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit TimeSlotYummy</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form role="form" method="post" id="editTimeSlotsYummyForm-<?= $timeSlotYummy->getTimeSlotID() ?>" enctype="multipart/form-data">
                                                            <div class="mb-3">
                                                                <label for="editTimeSlotsYummyID">TimeSlotYummyID</label>
                                                                <input type="text" class="form-control" form="editTimeSlotsYummyForm-<?= $timeSlotYummy->getTimeSlotID() ?>" id="editTimeSlotsYummyID" name="editTimeSlotsYummyID" value="<?= $timeSlotYummy->getTimeSlotID() ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="editTimeSlotsYummyID">RestaurantID</label>
                                                                <input type="text" class="form-control" form="editTimeSlotsYummyForm-<?= $timeSlotYummy->getTimeSlotID() ?>" id="editTimeSlotsYummyID" name="editTimeSlotsYummyID" value="<?= $timeSlotYummy->getRestaurantID() ?>">
                                                            </div>

                                                            <div class="d-grid gap-2" id="createButtons">
                                                                <button type="submit" class="btn btn-primary btn-lg" form="editTimeSlotsYummyForm-<?= $timeSlotYummy->getTimeSlotID() ?>">Create</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- HIER EINDE MODALS VOOR ADD EN EDIT TIMESLOTSYUMMY -->
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <p>No timeslots for yummy found.</p>
                    <?php } ?>
                    <!-- add -->
                    <div class="row">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createTimeSlotYummy">Add TimeSlotsYummy</button>
                        <div class="modal fade" tabindex="-1" id="createTimeSlotYummy" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add TimeSlotYummy</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" method="post" id="addTimeSlotsYummyForm" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label for="createTimeSLotsYummyID">TimeSlotsYummyID</label>
                                                <input type="text" class="form-control" form="addTimeSlotsYummyForm" id="createTimeSLotsYummyID" name="createTimeSLotsYummyID" placeholder="TimeSlotID">
                                            </div>
                                            <div class="mb-3">
                                                <label for="createRestaurantAddress">RestaurantID</label>
                                                <input type="text" class="form-control" form="addTimeSlotsYummyForm" id="createTimeSLotsYummyID" name="createTimeSLotsYummyID" placeholder="RestaurantID">
                                            </div>
                                            <div class="d-grid gap-2" id="createButtons">
                                                <button type="submit" class="btn btn-primary btn-lg" form="addTimeSlotsYummyForm">Create</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="paginationControls"></div> <!-- houden -->
    
    <script src="../js/test/yummy.js"></script>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>