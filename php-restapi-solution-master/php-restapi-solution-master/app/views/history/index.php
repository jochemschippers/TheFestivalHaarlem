<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>A stroll Through History</title>
        <script src="ckeditor/ckeditor.js"></script>
    </head>

    <body>
        <div class="container">
            
        </div>
        <form action="historycontroller.php" method="post"></form>
            <textarea name="historyeditor" id="historyeditor" cols="80" rows="10"></textarea>
            <script>
                CKEDITOR.replace('historyeditor');
            </script>
            <p>
                <input type="submit" name="submit_data" value="submit">
            </p>
        </form>
        
        
    </body>
</html>