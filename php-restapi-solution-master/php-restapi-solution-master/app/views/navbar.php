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
  <nav class="navbar" id="navbar">
    <span class="nav-item"><a href="/">Home</a></span>
    <?php
    try {
      foreach ($events as $event) {
        echo '<span class="nav-item"><a href="/' . str_replace(' ', '-', $event->getEventName()) . '">' . $event->getEventName()  . '</a></span>';
      }
    } catch (error $e) {
      echo "something went wrong while loading the navigation! Please try again later";
      echo "<script>console.log('Debug Objects: " . $e->getMessage() . "' );</script>";
    }

    ?>

    <script>
      const params = window.location.pathname.split("/");
      const navbar = document.getElementById("navbar");
      const links = navbar.getElementsByTagName("span");
      console.log(links);
      console.log(params[1]);
      if(params[1] === "" || params[1] === null){
        links[0].classList.add("selected");
      }
      else{
        for (let i = 0; i < links.length; i++) {
        if (links[i].textContent === params[1]) {
          links[i].classList.add("selected");
        }
      }
      }
     
    </script>
  </nav>
  <div class="user-options">
    <div class="option"><i class="fa fa-user fa-2x"></i></div>
    <div class="option"><i class="fa fa-shopping-cart fa-2x"></i></div>
  </div>
</header>

</html>