<main role="main">
    <div class="alert alert-success d-none margin-top" id="successMessage" role="alert">
    </div>
    <div class="card mb-3 panel important">
        <div class="card-header">
            <i class="fa fa-table"></i> Jazz Artist data
        </div>
        <div class="card-body">
            <button class="btn btn-primary" id="add-user-button" onclick="openModal(this, 'addArtist')">add artists</button>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableArtists">
                    <thead>
                        <tr>
                            <th>ArtistID</th>
                            <th>name</th>
                            <th>Description</th>
                            <th>image</th>
                            <th>image small</th>
                            <th>edit</th>
                            <th>delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ArtistID</th>
                            <th>name</th>
                            <th>Description</th>
                            <th>image</th>
                            <th>image small</th>
                            <th>edit</th>
                            <th>delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($artists as $artist) { ?>
                            <tr data-artist-id="<?= htmlspecialchars($artist->getArtistID()) ?>" data-name="<?= htmlspecialchars($artist->getName()) ?>" data-description="<?= htmlspecialchars($artist->getDescription()) ?>" data-image="<?= htmlspecialchars($artist->getImage()) ?>" data-image-small="<?= htmlspecialchars($artist->getImageSmall()) ?>">
                                <td><?= htmlspecialchars($artist->getArtistID()) ?></td>
                                <td><?= htmlspecialchars($artist->getName()) ?></td>
                                <td><?= htmlspecialchars(substr($artist->getDescription(), 0, 80)) ?>...</td>
                                <td><?= htmlspecialchars($artist->getImage()) ?></td>
                                <td><?= htmlspecialchars($artist->getImageSmall()) ?></td>
                                <td>
                                    <button class="btn btn-primary" style="margin-right:15px;" onclick="openModal(this, 'editArtist')">edit</button>
                                </td>
                                <td>
                                    <button class="btn btn-danger" onclick="openModal(this, 'deleteArtist')">delete</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>






    <div class="card mb-3 panel important">
        <div class="card-header">
            <i class="fa fa-table"></i> Jazz Location data
        </div>
        <div class="card-body">
            <button class="btn btn-primary" onclick="openModal(this,'addLocation')" id="add-user-button">add locations</button>
            <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTableLocations">
                        <thead>
                            <tr>
                                <th>LocationID</th>
                                <th>Location Name</th>
                                <th>Address</th>
                                <th>Image</th>
                                <th>To and From Text</th>
                                <th>Accessibility Text</th>
                                <th>edit</th>
                                <th>delete</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>LocationID</th>
                                <th>Location Name</th>
                                <th>Address</th>
                                <th>Image</th>
                                <th>To and From Text</th>
                                <th>Accessibility Text</th>
                                <th>delete</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($locations as $location) { ?>
                                <tr data-location-id="<?= htmlspecialchars($location->getLocationID()) ?>" data-location-name="<?= htmlspecialchars($location->getLocationName()) ?>" data-address="<?= htmlspecialchars($location->getAddress()) ?>" data-image="<?= htmlspecialchars($location->getLocationImage()) ?>" data-to-and-from-text="<?= htmlspecialchars($location->getToAndFromText()) ?>" data-accessibility-text="<?= htmlspecialchars($location->getAccesibillityText()) ?>">
                                    <td><?= htmlspecialchars($location->getLocationID()) ?></td>
                                    <td><?= htmlspecialchars($location->getLocationName()) ?></td>
                                    <td><?= htmlspecialchars($location->getAddress()) ?></td>
                                    <td><?= htmlspecialchars($location->getLocationImage()) ?></td>
                                    <td><?= htmlspecialchars(substr($location->getToAndFromText(), 0, 80)) ?>...</td>
                                    <td><?= htmlspecialchars(substr($location->getAccesibillityText(), 0, 80)) ?>...</td>
                                    <td>
                                        <button class="btn btn-primary" style="margin-right:15px;" onclick="openModal(this,'editLocation')">edit</button>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger" onclick="openModal(this,'deleteLocation')">delete</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3 panel important">
        <div class="card-header">
            <i class="fa fa-table"></i> Jazz Halls data
        </div>
        <div class="card-body">
            <button class="btn btn-primary" onclick="openModal(this,'addHall')" id="add-hall-button">add halls</button>
            <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTableHalls">
                        <thead>
                            <tr>
                                <th>HallID</th>
                                <th>Hall Name</th>
                                <th>LocationID</th>
                                <th>edit</th>
                                <th>delete</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>HallID</th>
                                <th>Hall Name</th>
                                <th>LocationID</th>
                                <th>edit</th>
                                <th>delete</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($halls as $hall) { ?>
                                <tr data-hall-id="<?= htmlspecialchars($hall->getHallID()) ?>" data-hall-name="<?= htmlspecialchars($hall->getHallName()) ?>" data-location-id="<?= htmlspecialchars($hall->getLocationID()) ?>" >
                                    <td><?= htmlspecialchars($hall->getHallID()) ?></td>
                                    <td><?= htmlspecialchars($hall->getHallName()) ?></td>
                                    <td><?= htmlspecialchars($hall->getLocationID()) ?></td>
                                    <td>
                                        <button class="btn btn-primary" style="margin-right:15px;" onclick="openModal(this,'editHall')">edit</button>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger" onclick="openModal(this,'deleteHall')">delete</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3 panel important">
        <div class="card-header">
            <i class="fa fa-table"></i> Jazz TimeSlots data
        </div>
        <div class="card-body">
            <button class="btn btn-primary" onclick="openModal(this, 'addTimeslot')" id="add-timeslot-button">Add Timeslot</button>
            <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTableTimeslots">
                        <thead>
                            <tr>
                                <th>Timeslot ID</th>
                                <th>Artist Name</th>
                                <th>Location Name</th>
                                <th>Hall Name</th>
                                <th>Price</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Maximum Tickets</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Timeslot ID</th>
                                <th>Artist Name</th>
                                <th>Location Name</th>
                                <th>Hall Name</th>
                                <th>Price</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Maximum Tickets</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($timeSlotsJazz as $timeslot) { ?>
                                <tr data-timeslot-id="<?= htmlspecialchars($timeslot->getTimeSlotID()) ?>" 
                                data-artist-id="<?= htmlspecialchars($timeslot->getArtist()->getArtistID()) ?>" 
                                data-location-id="<?= htmlspecialchars($timeslot->getJazzLocation()->getLocationID()) ?>" 
                                data-hall-id="<?= htmlspecialchars($timeslot->getHall()->getHallID()) ?>" 
                                data-price="<?= htmlspecialchars($timeslot->getPrice()) ?>" 
                                data-start-time="<?= htmlspecialchars($timeslot->getStartTime()->format('Y-m-d H:i:s')) ?>" 
                                data-end-time="<?= htmlspecialchars($timeslot->getEndTime()->format('Y-m-d H:i:s')) ?>" 
                                data-max-tickets="<?= htmlspecialchars($timeslot->getMaximumAmountTickets()) ?>">
                                    <td><?= htmlspecialchars($timeslot->getTimeSlotID()) ?></td>
                                    <td><?= htmlspecialchars($timeslot->getArtist()->getName()) ?></td>
                                    <td><?= htmlspecialchars($timeslot->getJazzLocation()->getLocationName()) ?></td>
                                    <td><?= htmlspecialchars($timeslot->getHall()->getHallName()) ?></td>
                                    <td><?= htmlspecialchars($timeslot->getPrice()) ?></td>
                                    <td><?= htmlspecialchars($timeslot->getStartTime()->format('Y-m-d H:i:s')) ?></td>
                                    <td><?= htmlspecialchars($timeslot->getEndTime()->format('Y-m-d H:i:s')) ?></td>
                                    <td><?= htmlspecialchars($timeslot->getMaximumAmountTickets()) ?></td>
                                    <td>
                                        <button class="btn btn-primary" style="margin-right:15px;" onclick="openModal(this, 'editTimeslot')">Edit</button>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger" onclick="openModal(this, 'deleteTimeslot')">Delete</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="paginationControls"></div>

    <div class="modal fade" id="universalModal" tabindex="-1" role="dialog" aria-labelledby="universalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="universalModalLabel"></h5>
                </div>
                <div class="alert alert-danger d-none margin-top" id="alert" role="alert">
                </div>
                <div class="modal-body" id="dynamicFormModal">
                    <!-- modal will be dynamically filled with js -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmButton"></button>
                </div>
            </div>
        </div>
    </div>
</main>
