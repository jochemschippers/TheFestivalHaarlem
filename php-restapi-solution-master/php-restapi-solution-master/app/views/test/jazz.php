<link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
<script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>
<main role="main">
    <div class="card mb-3 panel important">
        <div class="card-header">
            <i class="fa fa-table"></i> Jazz Artist Edit
        </div>

        <div class="card-body">
            <button class="btn btn-primary" id="add-user-button">add artists</button>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableArtists">
                    <thead>
                        <tr>
                            <th>ArtistID</th>
                            <th>name</th>
                            <th>Description</th>
                            <th>image</th>
                            <th>image small</th>
                            <th>edit/ delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ArtistID</th>
                            <th>name</th>
                            <th>Description</th>
                            <th>image</th>
                            <th>image small</th>
                            <th>edit/ delete</th>
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
                                    <button class="btn btn-primary" style="margin-right:15px;" onclick="openEditModalArtists(this)">edit</button>
                                    <button class="btn btn-danger" onclick="deleteArtist(this)">delete</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="updateButton">Update</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Artist</h5>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this artist?
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

</main>