<?php
require_once __DIR__ . '/../../controllers/jazzinformationcontroller.php';

include __DIR__ . '/../navbar.php';
$jazzcontroller = new JazzInformationController();
$artists = $jazzcontroller->getAllArtists();
?>

<body>
  <div class="layered">
    <div class="background-Image">
      <div class="border-box">
        <div class="container" id="titleContainer">
          <h1>Haarlem Jazz</h1>
        </div>
      </div>

      <div class="container landingPageContainer">
        <div class="row">
          <div class="col-md-7" id="titleText">
            <h2>Learn about our <strong>artists</strong></h2>
            <p>The Festival Jazz is a premier event. Showcasing the best in local and international jazz talent, in partnership with Haarlem Jazz, the festival’s jazz events provide a vibrant and lively atmosphere for music fans to come together and enjoy the sounds of the genre.
              <br> <br>
              Read below more about the artists, schedule and locations!
            </p>
          </div>
          <div class="col-md-7">
            <button> See Schedule <strong>↓</strong> </button>
          </div>
        </div>
      </div>
    </div>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <?php
        echo ' 
          <div class="carousel-item active">
          <img src="' . $artists[0]->getImage() . '">
          <div class="container carouselContainer">
            <h3>' . $artists[0]->getName() . '</h3>
            <p> ' . $artists[0]->getDescription() . '</p>
            <hr><span class="textSmall">Plays the ' . $artists[0]->getTimeSlots()[0]->getStartTime()->format('dS') . '!</span>
            <button> Learn More About artist</button>
            </div> 
            </div>';
        for ($i = 1; $i < count($artists); $i++) {
          echo '
          <div class="carousel-item">
          <img src="' . $artists[$i]->getImage() . '">
          <div class="container carouselContainer">
            <h3>' . $artists[$i]->getName() . '</h3>
            <p> ' . $artists[$i]->getDescription() . '</p>
            <hr><span class="textSmall">Plays the ' . $artists[$i]->getTimeSlots()[0]->getStartTime()->format('dS') . '!</span>

            <button> Learn More About artist</button>
            </div>
            </div>';
        };
        ?>
        <!-- <div class="carousel-item active">
          <img src="/image/jazz/candyAndHansDulfer.png">
          <div class="container carouselContainer">
            <h3><?php echo $artists[0]->getName() ?></h3>
            <p> Hans and Candy Dulfer are as a father-daughter duo both inseparable from their saxophones. Hans is a renowned saxophonist, known for his soulful and energetic performances, while Candy is a skilled saxophonist and flautist in her own right. Together, they have had multiple successful albums and have performed at some of the most prestigious jazz festivals around the world. <hr><span class="textSmall">Plays the 27th of July!</span></p>
          <button> Learn More About artist</button>
          </div>
        </div>
        <div class="carousel-item ">
          <img src="/image/jazz/candyAndHansDulfer.png">
          <div class="container carouselContainer">
            <h3>wwwwwr</h3>
            <p> Hans and Candy Dulfer are as a father-daughter duo both inseparable from their saxophones. Hans is a renowned saxophonist, known for his soulful and energetic performances, while Candy is a skilled saxophonist and flautist in her own right. Together, they have had multiple successful albums and have performed at some of the most prestigious jazz festivals around the world. <hr><span class="textSmall">Plays the 27th of July!</span></p>
          <button> Learn More About artist</button>
          </div>
        </div>
        <div class="carousel-item ">
          <img src="/image/jazz/candyAndHansDulfer.png">
          <div class="container carouselContainer">
            <h3>rrrr and Hans rrrr</h3>
            <p> Hans and Candy Dulfer are as a father-daughter duo both inseparable from their saxophones. Hans is a renowned saxophonist, known for his soulful and energetic performances, while Candy is a skilled saxophonist and flautist in her own right. Together, they have had multiple successful albums and have performed at some of the most prestigious jazz festivals around the world. <hr><span class="textSmall">Plays the 27th of July!</span></p>
          <button> Learn More About artist</button>
          </div>
        </div> -->

      </div>
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


  </div>


  <?php
  include __DIR__ . '/../footer.php';
  ?>