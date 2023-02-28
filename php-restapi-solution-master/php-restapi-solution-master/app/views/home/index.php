<?php 
if (function_exists('apcu_enabled')) {
    echo 'APCu is installed and enabled!';
} else {
    echo 'APCu is NOT installed or enabled!';
}

?>
<!-- <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link href="../css/home.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class="border-box" style="height: 600px; border: 2px solid #000; padding: 10px; background-image: url('/image/home/homegif.gif'); background-size: cover; ">
            <img src="final_639b013b960dc300259d655b_372637.gif" class="img-fluid" alt="...">
            <div class="container" style="background: rgba(0, 0, 0, 0.5);">
                <H1 style="color: #FFFFFF; text-align: center;">Explore The Festival</H1>
                <p style="color: #FFFFFF; text-align: center;">
                    Learn more about the amazing Haarlem Festival experience Dutch cuisine, take a stroll around the rich historic center and experience some amazing jazz artists! 
                </p>
            </div>
        </div>
        <div class="container text-left" style="width:1200px margin=left">
            <div class="row">
                <div class="col" style="font-size: 50px; color: #000; font-weight: bold;">
                    It’s Time To Celebrate Culture And Community
                </div>
                <div class="col" style="font-size: 25px;">
                    The Festival is an annual celebration of arts and culture is an inclusive festival meant for all, regardless of age or budget.
                    From music to dance and the best food Haarlem has to offer. End your week amazingly with these events!
                </div>
            </div>                 
        </div>
        <div class="container" style="background-color: #E5E5E5; width: 100%; font-size: 48px; font-weight: bold; color: #000;">  
            Check out the following events:
        </div>       

        <div class="card" style="background: rgba(0, 0, 0, 0.5); background-image: url('/image/home/Jazz-picture.jpg');">            
            <div class="container" style="background: rgba(0, 0, 0, 0.5); width: 60%;">
                <h1 style="font-weight: bold; font-family: martel; font-size: 37; color: #FFFFFF;">The Haarlem Jazz Event</h1>
                <p style="font-family: open+sans; font-size: 22; width: 1000px; color: #FFFFFF;">Haarlem Jazz is a premier annual event for all jazz lovers. With more than 10 years of experience in showcasing the best in local and international jazz talent, you’d be certain to experience a vibrant and lively atmosphere for music fans!</p>
                <a class="btn btn-primary" style="width: 200px;" href="#" role="button">Link</a>
             </div>  
        </div>
        </div>
        <div class="card text-end" style="background-image: url('/image/home/history-picture.jpg');">
            <div class="container" style="background: rgba(0, 0, 0, 0.5); width: 60%;">
                <h1 style="font-weight: bold; font-family: martel; font-size: 37; color: #FFFFFF;">A Stroll Through History</h1>
                <p style="font-family: open+sans; font-size: 22; width: 1000px;  color: #FFFFFF;">See what cultural monuments the city of Haarlem has to offer and walk with one of our guides to get to know the stories behind them during our guided tour through the streets of Haarlem.</p>
                <a class="btn btn-primary" style="width: 200px; " href="#" role="button">Link</a>
            </div>               
        </div>
        <div class="card" style="background-image: url('/image/home/foodStyles.jpg');">   
             <div class="container" style="background: rgba(0, 0, 0, 0.5); width: 60%;">
                <h1 style="font-weight: bold; font-family: martel; font-size: 37; color: #FFFFFF;">Explore the TASTE of Haarlem</h1>
                <p style="font-family: open+sans; font-size: 22; width: 1000px; color: #FFFFFF;">Explore every Food and Drink in this years Haarlem Yummy! event. Here its Eat first Talk later. Come and enjoy all culinary options Haarlem has to offer in this cities most versitile Food and Drink Festival.</p>
                <a class="btn btn-primary" style="width: 200px;" href="#" role="button">Link</a>
             </div>            
        </div> -->

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

    <div class="card" style="background-image: url('/image/home/Jazz-picture.jpg');">            
        <div class="container">
            <h2>The Haarlem Jazz Event</h2>
            <p>Haarlem Jazz is a premier annual event for all jazz lovers. With more than 10 years of experience in showcasing the best in local and international jazz talent, you’d be certain to experience a vibrant and lively atmosphere for music fans!</p>
            <a class="btn btn-primary" href="/template" role="button">Link</a>
         </div>  
    </div>

    <div class="card text-end" style="background-image: url('/image/home/history-picture.jpg');">            
        <div class="container">
            <h2>A Stroll Through History</h2>
            <p>See what cultural monuments the city of Haarlem has to offer and walk with one of our guides to get to know the stories behind them during our guided tour through the streets of Haarlem.</p>
            <a class="btn btn-primary" href="#" role="button">Link</a>
        </div>               
    </div>

    <div class="card" style="background-image: url('/image/home/yummy-picture.jpg');">            
        <div class="container">
            <h2>Explore the Taste of Haarlem</h2>
            <p>Explore every Food and Drink in this years Haarlem Yummy! event. Here its Eat first Talk later. Come and enjoy all culinary options Haarlem has to offer in this cities most versitile Food and Drink Festival.</p>
            <a class="btn btn-primary" href="#" role="button">Link</a>
        </div>  
    </div>

</body>
</html>

        <!-- <h1>Index view!</h1>
        <a href="/article">View the articles page</a><br>
        <a href="/api/article">View the articles API endpoint</a> -->



    </body>
</html>

<?php 
include __DIR__ . '/../footer.php';
?>