wat nu?hallo?wat dan?wat nu?toppie

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