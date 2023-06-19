<main role="main">
    <div class="card mb-3 panel important">
        <div class="card-header">
            <i class="fa fa-table"></i> API-KEY Edit
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="restaurants-table">
                    <?php if (!is_null($apis) && count($apis) > 0) { ?>
                        <table class="table table-bordered" id="dataTableApis"> 
                                <tr>
                                    <th>API-ID</th>
                                    <th>API-Name</th>
                                    <th>API-Key</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($apis as $api) { ?>
                                    <tr>
                                        <td title="<?= $api->getApiID() ?>"><?= $api->getApiID() ?></td>
                                        <td title="<?= $api->getApiName() ?>"><?= $api->getApiName() ?></td>
                                        <td title="<?= $api->getApiKey() ?>"><?= $api->getApiKey() ?></td>
                                        <td>
                                            <button class="btn btn-primary edit-btn" data-id="<?= $api->getApiID() ?>" data-bs-toggle="modal" data-bs-target="#editAPI-<?= $api->getApiID() ?>">
                                                Edit
                                            </button>
                                        </td>
                                        <td>
                                        <form method="post" id="delete-<?= $api->getApiID() ?>" 
                                            onsubmit="event.preventDefault(); if (confirm('Are you sure you want to delete API: <?= $api->getApiName() ?>?')) deleteApi(<?= $api->getApiID() ?>);">
                                            <input type="hidden" id="deleteAPIID" name="deleteAPIID" value="<?= $api->getApiID() ?>">
                                            <button type="submit" class="btn btn-danger delete-btn" form="delete-<?= $api->getApiID() ?>">Delete</button>
                                        </form>
                                        </td>
                                    </tr>
                                    <div class="modal fade" tabindex="-1" id="editAPI-<?= $api->getApiID() ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit API</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" role="form" enctype="multipart/form-data" id="editAPIForm-<?= $api->getApiID() ?>" onsubmit="event.preventDefault(); editApi(<?= $api->getApiID() ?>);">

                                                        <p>API-ID: <?= $api->getApiID() ?></p>

                                                        <div class="form-group">
                                                            <label for="editAPIName-<?= $api->getApiID() ?>">API-Name</label>
                                                            <input type="text" class="form-control" id="editAPIName-<?= $api->getApiID() ?>" name="editAPIName" value="<?= $api->getApiName() ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editAPIKey-<?= $api->getApiID() ?>">API-Key</label>
                                                            <input type="text" class="form-control" id="editAPIKey-<?= $api->getApiID() ?>" name="editAPIKey" value="<?= $api->getApiKey() ?>" required>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary" id="confirmEditbutton">Edit API</button>

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
                        <p>No api's found. Please try again later or add more api's.</p>
                    <?php }
                    ?>
                    <div class="row">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addAPIModal">Add API</button>
                        <div class="modal fade" tabindex="-1" id="addAPIModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add API</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" method="post" id="addAPIForm" enctype="multipart/form-data" onsubmit="event.preventDefault(); createApi();">

                                            <div class="mb-3">
                                                <label for="createAPIName">API-Name</label>
                                                <input type="text" class="form-control" form="addAPIForm" id="createAPIName" name="createAPIName" placeholder="Name">
                                            </div>
                                            <div class="mb-3">
                                                <label for="createAPIKey">API-Key</label>
                                                <input type="text" class="form-control" form="addAPIForm" id="createAPIKey" name="createAPIKey" placeholder="Name">
                                            </div>

                                            <div class="d-grid gap-2" id="createButtons">
                                                <button type="submit" class="btn btn-primary btn-lg" form="addAPIForm">Create</button>
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

</main>