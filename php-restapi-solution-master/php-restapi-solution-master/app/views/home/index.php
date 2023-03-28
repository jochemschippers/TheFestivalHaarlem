

<body>
    <div class="border-box">
        <div class="image" id="titleImage"></div>
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
                <p>The Festival is an annual celebration of arts and culture is an inclusive festival meant for all, regardless of age or budget. <br> From music to dance and the best food Haarlem has to offer. End your week amazingly with these events!</p>
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
            $position = ($event->getEventID() % 2 == 0) ? 'margin-left: 0px;' : 'margin-right: 0px;';
            $background_image = $event->getBannerImage();
            $title = $event->getEventTitle();
            $description = $event->getBannerDescription();
            $button_link = "/" . $event->getEventName();
        ?>

        <div class="card <?php echo $alignment ?>" style="background-image: url('<?php echo $background_image ?>'">
            <div class="container" style="<?php echo $position ?>">
                <h2><ins><?php echo $title ?></ins></h2>
                <p><?php echo $description ?></p>
                <a class="btn btn-primary" href="<?php echo $button_link ?>" role="button">Learn More</a>
            </div>
        </div>

    <?php
    }
    ?>

</body>
