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
            <button class="btn btn-primary" id="add-user-button">add artists</button>
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
                                        <button class="btn btn-danger" onclick="deleteLocation(this)">delete</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal fade" id="editModalLocation" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Artist</h5>
                            </div>
                            <div class="alert alert-danger d-none margin-top" id="alert" role="alert">
                            </div>
                            <div class="modal-body" id="dynamicForm">
                                <!-- modal will be dynamically filled with js -->
                            </div>
                            <div class="modal-footer">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Delete Location</h5>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this location?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                            </div>
                        </div>
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