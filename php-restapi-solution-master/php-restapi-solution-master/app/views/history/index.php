<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Articles</title>
    </head>

    <body>
        <div class="container">
            <!-- <form action="homecontroller.php" method="post"></form> homecontroller could be the wrong file here -->
            <textarea name="editor" id="editor" cols="30" rows="10"></textarea>
            <input type="submit" class="save-btn" name="submit_data" value="publish">
        </div>
        
        <script src="ckeditor/ckeditor.js"></script>
        <script>
            CKEDITOR.replace("editor");
        </script>
    </body>
</html>