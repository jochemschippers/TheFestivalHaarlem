<main role="main">
    <div class="card mb-3 panel important">
        <div class="card-header">
            <i class="fa fa-table"></i> Jazz Artist Edit
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ArtistID</th>
                            <th>name</th>
                            <th>Description</th>
                            <th>image</th>
                            <th>edit/ delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ArtistID</th>
                            <th>name</th>
                            <th>Description</th>
                            <th>image</th>
                            <th>edit/ delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($artists as $artist) { ?>
                            <tr>
                                <td><?= $artist->getArtistID() ?></td>
                                <td><?= $artist->getName() ?></td>
                                <td><?= substr($artist->getDescription(), 0, 80) ?>...</td>
                                <td><?= $artist->getImage() ?></td>
                                <td>
                                    <button class="btn btn-primary" style="margin-right:15px;" data-toggle="modal" data-target="#editModal" onclick="openEditModalArtists('<?= $artist->getArtistID() ?>', '<?= $artist->getName() ?>', 
                                    '<?= $artist->getDescription() ?>', '<?= $artist->getImage() ?>')">edit</button>
                                    <button class="btn btn-danger">delete</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
            </div>
        </div>

    </div>
    </div>
    <div id="paginationControls"></div>

</main>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>