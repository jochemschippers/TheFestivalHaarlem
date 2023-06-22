<main role="main">
    <div class="card mb-3 panel important">
        <div class="card-header">
            <i class="fa fa-table"></i> Users Edit
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <!-- <div id="user-table"> -->
                    <?php if (!is_null($users) && count($users) > 0) { ?>
                        <table class="table table-bordered" id="dataTableUsers"> 
                            <thead>
                                <tr>
                                    <th>User-ID</th>
                                    <th>User-Email</th>
                                    <th>User-Role</th>
                                    <th>User-Fullname</th>
                                    <th>User-Phone number</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user) { ?>
                                    <tr>
                                        <td title="<?= $user->getUserID() ?>"><?= $user->getUserID() ?></td>
                                        <td title="<?= $user->getEmail() ?>"><?= $user->getEmail() ?></td>
                                        <td title="<?= $user->getUserRole() ?>"><?= $user->getUserRole() ?></td>
                                        <td title="<?= $user->getFullName() ?>"><?= $user->getFullName() ?></td>
                                        <td title="<?= $user->getPhoneNumber() ?>"><?= $user->getPhoneNumber() ?></td>
                                        <td>
                                            <button class="btn btn-primary edit-btn" data-id="<?= $user->getUserID() ?>" data-bs-toggle="modal" data-bs-target="#editUser-<?= $user->getUserID() ?>">
                                                Edit
                                            </button>
                                        </td>
                                        <td>
                                        <form method="post" enctype="multipart/form-data" id="delete-<?= $user->getUserID() ?>" 
                                            onsubmit="event.preventDefault(); if (confirm('Are you sure you want to delete user: <?= $user->getEmail() ?>?')) deleteSelectedUser(<?= $user->getUserID() ?>);">
                                            <input type="hidden" id="deleteUserID-<?= $user->getUserID() ?>" name="deleteUserID" value="<?= $user->getUserID() ?>">
                                            <button type="submit" class="btn btn-danger delete-btn" form="delete-<?= $user->getUserID() ?>">Delete</button>
                                        </form>
                                        </td>
                                    </tr>
                                    <div class="modal fade" tabindex="-1" id="editUser-<?= $user->getUserID() ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit user</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" role="form" enctype="multipart/form-data" id="editUserForm-<?= $user->getUserID() ?>" onsubmit="event.preventDefault(); editSelectedUser(<?= $user->getUserID() ?>);">

                                                        <p>user-ID: <?= $user->getUserID() ?></p>

                                                        <div class="form-group">
                                                            <label for="editUserEmail-<?= $user->getUserID() ?>">user-Email</label>
                                                            <input type="text" class="form-control" id="editUserEmail-<?= $user->getUserID() ?>" name="editUserEmail" value="<?= $user->getEmail() ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editUserRole-<?= $user->getUserID() ?>">user-Role</label>
                                                            <input type="text" class="form-control" id="editUserRole-<?= $user->getUserID() ?>" name="editUserRole" value="<?= $user->getUserRole() ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editUserFullName-<?= $user->getUserID() ?>">user-FullName</label>
                                                            <input type="text" class="form-control" id="editUserFullName-<?= $user->getUserID() ?>" name="editUserFullName" value="<?= $user->getFullName() ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editUserPhoneNumber-<?= $user->getUserID() ?>">user-PhoneNumber</label>
                                                            <input type="number" class="form-control" id="editUserPhoneNumber-<?= $user->getUserID() ?>" name="editUserPhoneNumber" value="<?= $user->getPhoneNumber() ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editUserPassword-<?= $user->getUserID() ?>">user-Password</label>
                                                            <input type="password" class="form-control" id="editUserPassword-<?= $user->getUserID() ?>" name="editUserPassword" required>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary" id="confirmEditUserbutton-<?= $user->getUserID() ?>">Edit user</button>

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
                        <p>No user's found. Please try again later or add more user's.</p>
                    <?php }
                    ?>
                    <div class="row">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#adduserModal">Add user</button>
                        <div class="modal fade" tabindex="-1" id="adduserModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add user</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" method="POST" id="addUserForm" enctype="multipart/form-data" onsubmit="event.preventDefault(); createNewUser();">

                                            <div class="mb-3">
                                                <label for="addUserEmail">user-Email</label>
                                                <input type="text" class="form-control" form="addUserForm" id="addUserEmail" name="addUserEmail" placeholder="example@gmail.com">
                                            </div>
                                            <div class="mb-3">
                                                <label for="addUserRole">user-Role</label>
                                                <input type="text" class="form-control" form="addUserForm" id="addUserRole" name="addUserRole" placeholder="0 or 1">
                                            </div>
                                            <div class="mb-3">
                                                <label for="addUserFullName">user-FullName</label>
                                                <input type="text" class="form-control" form="addUserForm" id="addUserFullName" name="addUserFullName" placeholder="Name">
                                            </div>
                                            <div class="mb-3">
                                                <label for="addUserPhoneNumber">user-PhoneNumber</label>
                                                <input type="number" class="form-control" form="addUserForm" id="addUserPhoneNumber" name="addUserPhoneNumber" placeholder="0123456789">
                                            </div>
                                            <div class="mb-3">
                                                <label for="addUserPassword">user-Password</label>
                                                <input type="text" class="form-control" form="addUserForm" id="addUserPassword" name="addUserPassword" value="">
                                            </div>

                                            <div class="d-grid gap-2" id="createButtons">
                                                <button type="submit" class="btn btn-primary btn-lg" form="addUserForm">Create</button>
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
                <!-- </div> -->
            </div>
        </div>
    </div>

</main>