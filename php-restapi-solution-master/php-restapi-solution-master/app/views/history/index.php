<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>A stroll Through History</title>
        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    </head>

    <body>
        <div class="container">
            
        </div>
        <form action="historycontroller.php" method="post"></form>
            <textarea name="historyeditor" id="historyeditor">test</textarea>
            
            <p>
                <input type="submit" name="submit_data" value="submit">
            </p>
        </form>
        <script>
        ClassicEditor
        .create( document.querySelector( '#historyeditor' ) )
        .catch( error => {
            console.error( error );
        } );
        </script>
        <!-- <script>
                CKEDITOR.replace('historyeditor');
        </script> -->
    </body>
</html>