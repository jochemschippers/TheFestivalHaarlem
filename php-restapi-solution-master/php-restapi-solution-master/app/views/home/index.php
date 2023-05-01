<head>
    <meta charset="UTF-8">
    <!-- <title>WYSIWYG Editor</title> -->
    <script src="https://cdn.tiny.cloud/1/tjqkzl6s4reor4qdjvrixh7dpkm5c69gws3yr3alew7ysmxl/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'autoresize',
            autoresize_bottom_margin: 16,
            toolbar_mode: 'floating',
            height: 400,
            branding: false,
            menubar: false,
            mobile: {
                toolbar_mode: 'sliding',
                theme: 'mobile',
                plugins: 'autosave',
                autosave_restore_when_empty: true,
                autosave_ask_before_unload: true,
                autosave_interval: '30s',
                autosave_retention: '30m'
            }
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


    <!-- START WYSIWYG CODE -->
    <?php
    $filename = "/app/views/Home/wysiwyg.php";

    // Save the edited content to file if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $content = $_POST['content'];
        file_put_contents($filename, $content, FILE_APPEND | LOCK_EX);
        echo "<h3>Your content has been saved:</h3>";
        echo "<div>" . $content . "</div>";
    }

    // Display the saved content
    $savedContent = file_get_contents($filename);
    echo "<h3>Current content:</h3>";
    echo "<div>" . $savedContent . "</div>";
    ?>

    <form method="post">
        <textarea id="mytextarea" name="content"><?php echo $savedContent; ?></textarea>
        <button type="submit">Submit</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the content from the form submission
        $content = $_POST['content'];

        // Save the content to a file
        $filename = '/app/views/Home/wysiwyg.php';
        $file_contents = file_get_contents($filename);
        $file_contents = preg_replace('/(<\?php\s+\/\/\s+START_WYSIWYG_CONTENT\s+).*?(\/\/\s+END_WYSIWYG_CONTENT\s+\?>)/s', "$1$content$2", $file_contents);
        file_put_contents($filename, $file_contents);

        // Display success message
        echo "<p>Content saved successfully.</p>";
    }
    ?>

    <!-- Display the saved content -->
    <?php
    $filename = '/app/views/Home/wysiwyg.php';
    $file_contents = file_get_contents($filename);
    $start_pos = strpos($file_contents, '// START_WYSIWYG_CONTENT');
    if ($start_pos !== false) {
        $end_pos = strpos($file_contents, '// END_WYSIWYG_CONTENT', $start_pos);
        if ($end_pos !== false) {
            $start_pos += strlen('// START_WYSIWYG_CONTENT');
            $saved_content = substr($file_contents, $start_pos, $end_pos - $start_pos);
            echo "<h3>Your saved content:</h3>";
            echo "<div>" . $saved_content . "</div>";
        }
    }
    ?>

    <!-- <textarea>
     Welcome to TinyMCE!
  </textarea> -->
    <script>
        tinymce.init({
            selector: 'textarea',
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
    <!-- // END WYSIWYG CODE -->

    <!-- BASE HOMEPAGE CODE -->
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

        <div class="card <?= $alignment ?>" style="background-image: url('<?= $background_image ?>'">
            <div class="container" style="<?= $position ?>">
                <h2><ins><?= $title ?></ins></h2>
                <p><?= $description ?></p>
                <a class="btn btn-primary" href="<?= $button_link ?>" role="button">Learn More</a>
            </div>
        </div>

    <?php
    }


    // <!-- INSTAGRAM FEED CODE --> SHOULD HAVE

    // set Instagram API endpoint
    // $apiEndpoint = 'https://api.instagram.com/v1/users/self/media/recent/?access_token=ACCESS_TOKEN';

    // // fetch Instagram feed data
    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, $apiEndpoint);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // $response = curl_exec($ch);
    // curl_close($ch);

    // // decode the JSON response
    // $data = json_decode($response);

    // // display the Instagram feed
    // foreach ($data->data as $post) {
    //   echo '<img src="' . $post->images->standard_resolution->url . '" alt="' . $post->caption->text . '">';
    // }
    ?>
    <!-- INSTAGRAM FEED COMPLETED -->

</body>