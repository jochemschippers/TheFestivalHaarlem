<main role="main">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
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
                                <td><?= substr($artist->getDescription(), 0, 100) ?>...</td>
                                <td><?= $artist->getImage() ?></td>
                                <td><button>edit</button><button>delete</button></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
    </div>
    <div id="paginationControls"></div>

</main>