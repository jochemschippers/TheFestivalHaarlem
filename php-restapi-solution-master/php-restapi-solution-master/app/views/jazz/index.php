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
            <h2 class="underlined">Learn about our <strong>artists</strong></h2>
            <p>The Festival Jazz is a premier event. Showcasing the best in local and international jazz talent, in partnership with Haarlem Jazz, the festival’s jazz events provide a vibrant and lively atmosphere for music fans to come together and enjoy the sounds of the genre.
              <br> <br>
              Read below more about the artists, schedule and locations!
            </p>
          </div>
          <div class="col-md-7">
            <button id="seeScheduleButton"> See Schedule <strong>↓</strong> </button>
          </div>
          <h2 class="underlined textCenter">Featuring:</h2>
        </div>
      </div>
    </div>
    <div id="myCarousel" class="carousel slide jazzContainer" data-ride="carousel">
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

    <h2 class="margin-bottom underlined textCenter">Schedule:</h2>

    <div class="margin-top jazzContainer ">
      <div class="row">
      <h3 class="textCenter">Schedule:</h3>

      <div class="col-md-2 margin-left" id="location-information">
        <h4>Location: <br>
          <span>The Patronaat </span>
        </h4>
        <p>
          Would you rather have <strong>access</strong> to the <strong>whole day?</strong> Get your day ticket for only <strong>€35</strong>!
        </p>
        <button class="line-height longTermTicketButton"><strong>get a day ticket</strong> €35</button>
        <p>
          Can’t choose? You can purchase a week ticket and get <strong>access</strong> to the <strong>whole week</strong>! Get a week ticket for only <strong>€80</strong>!
        </p>
        <button class="line-height longTermTicketButton"><strong>get a day ticket</strong> €35</button>

      </div>

      <div class="col-md-7">
        <table>
          <tr>
            <th>
              Time
            </th>
            <th>
              Main Hall
            </th>
            <th>
              Second Hall
            </th>
          </tr>
          <tr>

          </tr>
          <tr>

          </tr>

        </table>

      </div>

      </div>
    </div>



  </div>