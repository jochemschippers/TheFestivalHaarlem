<head>
    <meta charset="UTF-8">
    <!-- <title>WYSIWYG Editor</title> -->
    <script src="https://cdn.tiny.cloud/1/tjqkzl6s4reor4qdjvrixh7dpkm5c69gws3yr3alew7ysmxl/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ]
        });
    </script>
</head>

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
    foreach ($events as $event) {

        $alignment = ($event->getEventID() % 2 == 0) ? 'text-start' : 'text-end';
        $position = ($event->getEventID() % 2 == 0) ? 'margin-left: 0px;' : 'margin-right: 0px;';
        $background_image = $event->getBannerImage();
        $title = $event->getEventTitle();
        $description = $event->getBannerDescription();
        $button_link = "/" . $event->getEventName();
    ?>

        <div class="card <?= $alignment ?>" style="background-image: url('<?= $background_image ?>'">
            <div class="container" style="<?= $position ?>">
                <h2><ins><?= $title ?></ins></h2>
                <p><?= $description ?></p>
                <a class="btn btn-primary" href="<?= $button_link ?>" role="button">Learn More</a>
            </div>
        </div>

    <?php
    }
    ?>
</body>