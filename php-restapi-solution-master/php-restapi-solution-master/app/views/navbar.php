<?php
require_once __DIR__ . '../../controllers/eventcontroller.php';
$eventcontroller = new EventController();
$events = $eventcontroller->getEvents();
?>

<html lang="en">
<head>
  <link href="/css/navbar.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  
  <header class="header-container">
    <div class="logo">
        <img class="logoImage" src="https://i.ibb.co/9TR3YTC/Logo-small2.png" alt="logo festival"> </img>
    </div>
    <nav class="navbar">
      <div class="nav-item"><a href="/">Home</a></div>
      <?php 
              try{
                foreach ($events as $event) {
                    echo '<div class="nav-item"><a href="/' . str_replace(' ', '-', $event->getEventTitle()) . '">' . $event->getEventTitle()  . '</a></div>';
                  }
              }
              catch(error $e)
              {
                echo "something went wrong while loading the navigation! Please try again later";
                echo "<script>console.log('Debug Objects: " . $e->getMessage() . "' );</script>";
              }
              
              ?>
    </nav>
    <div class="user-options">
      <div class="option"><i class="fa fa-user fa-2x"></i></div>
      <div class="option"><i class="fa fa-shopping-cart fa-2x"></i></div>
    </div>
  </header>
</html>