<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/css/navbar.css" rel="stylesheet">
  <link href="/css/footer.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link href="../css/main.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/384ef59d1a.js" crossorigin="anonymous"></script>
  <script src="/js/dynamicResourceLoader.js"></script>
</head>

<header class="header-container">
  <div class="logo">
    <img class="logoImage" src="https://i.ibb.co/9TR3YTC/Logo-small2.png" alt="logo festival"> </img>
  </div>
  <nav class="navbar" id="navbar">
    <span class="nav-item"><a href="/">Home</a></span>
    <?php if (isset($events) && (is_array($events) || is_object($events))) { ?>
      <?php foreach ($events as $event) { ?>
        <span class="nav-item"><a href="/<?= str_replace(' ', '-', $event->getEventName()) ?>"><?= $event->getEventName() ?></a></span>
      <?php } ?>
    <?php } else { ?>
      <span class="nav-item"><a href="#">It seems our server is down. Please visit the website again later.</a></span>
    <?php } ?>
  </nav>
  <div class="user-options">
    <div class="option"><a href="/admin"><i class="fa fa-sharp fa-solid fa-screwdriver-wrench fa-2x"></i></a></div>
    <div class="option"><a href="/paymentpage"><i class="fa fa-shopping-cart fa-2x"></i></a></div>
    <?php
    $uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
    if (!isset($_SESSION['userID'])) { ?><div class="option"><a href="/account"><i class="fa fa-user fa-2x"></i></a></div><?php } else if (isset($_SESSION['userID']) && $uri[0] != "test") { ?>
      <div class="option"><a href="/account/logout"><i class="fa fa-right-from-bracket fa-2x"></i></a></div><?php }  ?>
  </div>
</header>