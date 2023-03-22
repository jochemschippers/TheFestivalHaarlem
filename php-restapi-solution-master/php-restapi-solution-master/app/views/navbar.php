
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="/css/navbar.css" rel="stylesheet">
  <link href="/css/footer.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link href="../css/template.css" rel="stylesheet">

  <script src="https://kit.fontawesome.com/384ef59d1a.js" crossorigin="anonymous"></script>
  <script>
    const params = window.location.pathname.split("/");

    function setStyle(foldername, styleName) {
      var style = document.createElement('link');
      style.setAttribute("rel", "stylesheet");
      style.setAttribute("type", "text/css");
      if (params[1] != "") {
        style.setAttribute("href", "../css/" + foldername + "/" + styleName + ".css");
      } else {
        style.setAttribute("href", "../css/home.css");
      }
      document.head.appendChild(style);
    }
    var parameter = params[1].replace("-", "");  
    setStyle(parameter, parameter);
    if (params[2] != "") {
      setStyle(params[1], "detailPage")
    }
  </script>



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

  </nav>
  <div class="user-options">
    <div class="option"><i class="fa fa-user fa-2x"></i></div>
    <div class="option"><a href="/paymentpage"><i class="fa fa-shopping-cart fa-2x"></i></a></div>
    <div class="option"><i class="fa fa-sharp fa-solid fa-screwdriver-wrench fa-2x"></i></div>
  </div>
</header>