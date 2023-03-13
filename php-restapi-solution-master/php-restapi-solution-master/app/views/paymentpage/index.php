<?php 
include __DIR__ . '/../navbar.php';
//$items = array();
//$item = new Item('Ticket', 10, 1);
?>

<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link href="../css/paymentpage.css" rel="stylesheet">
</head>
<body>
	<div class="container" id="container"></div>
    <div class="col">
        <div class="table" id="itemsTable">
            <?php
            
            // $items = $_SESSION['items'];
            // foreach ($items as $item) {
            //     echo '<div class="row">';
            //     echo '<div class="col-6">';
            //     echo '<p>' . $item['name'] . '</p>';
            //     echo '</div>';
            //     echo '<div class="col-6">';
            //     echo '<p>' . $item['price'] . '</p>';
            //     echo '</div>';
            //     echo '</div>';
            // }
            ?>
        </div>
    </div>
    <div class="col">

    </div>


</body>
</html>
<?php 
include __DIR__ . '/../footer.php';
?>