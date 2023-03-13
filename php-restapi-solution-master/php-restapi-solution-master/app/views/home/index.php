<?php
include __DIR__ . '/../navbar.php';

$eventcontroller = new EventController();
$events = $eventcontroller->getEvents();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Festival</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="../css/home.css" rel="stylesheet">
</head>
<body>
    <div class="border-box">
        <div class="container" id="titleContainer">
            <h1>Explore The Festival</h1>
            <p>Learn more about the amazing Haarlem Festival experience Dutch cuisine, take a stroll around the rich historic center and experience some amazing jazz artists!</p>
        </div>
    </div>

    <div class="container" id="intro" style="color: #000;">
        <div class="row">
            <div class="col-6">
                <h1>It’s Time To Celebrate Culture And Community</h1>
            </div>
            <div class="col-6">
                <p>The Festival is an annual celebration of arts and culture is an inclusive festival meant for all, regardless of age or budget. From music to dance and the best food Haarlem has to offer. End your week amazingly with these events!</p>
            </div>
        </div>
    </div>

    <div class="container banner" id="banner">
        <h2>Check out the following events:</h2>
    </div>

    <?php
    
        // Assume $data is an array of objects containing information for each card
        foreach ($events as $event) {

            $alignment = ($event->getEventID() % 2 == 0) ? 'text-start' : 'text-end';
            $background_image = $event->getBannerImage();
            $title = $event->getEventTitle();
            $description = $event->getBannerDescription();
            $button_link = "/" . $event->getEventName();
        ?>

        <div class="card <?php echo $alignment ?>" style="background-image: url('<?php echo $background_image ?>');">
            <div class="container">
                <h2><?php echo $title ?></h2>
                <p><?php echo $description ?></p>
                <a class="btn btn-primary" href="<?php echo $button_link ?>" role="button">Link</a>
            </div>
        </div>

    <?php
    }
    ?>

</body>
</html>

<?php
include __DIR__ . '/../footer.php';
?>
