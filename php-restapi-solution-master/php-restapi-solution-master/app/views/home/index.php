<?php 
include __DIR__ . '/../navbar.php';
$eventcontroller = new EventController();
$events = $eventcontroller->getEvents();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>The Festival</title>
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
            <a class="btn btn-primary" href="/yummy" role="button">Link</a>
        </div>
    </div>
</body>
</html>

<?php
include __DIR__ . '/../footer.php';
?>
