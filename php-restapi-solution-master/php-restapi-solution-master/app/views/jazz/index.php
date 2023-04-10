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
            <button class="buttonJazz" id="seeScheduleButton"> See Schedule <strong>↓</strong> </button>
          </div>
          <h2 class="underlined textCenter">Featuring:</h2>
        </div>
      </div>
    </div>
    <div id="myCarousel" class="carousel slide jazzContainer" data-bs-ride="carousel">
      <ol class="carousel-indicators">
        <li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#myCarousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#myCarousel" data-bs-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <?php for ($i = 0; $i < count($artists); $i++) { ?>
          <?php if ($i == 0) { ?>
            <div class="carousel-item active">
            <?php } else { ?>
              <div class="carousel-item">
              <?php } ?>
              <img src="<?= $artists[$i]->getImage() ?>">
              <div class="container carouselContainer">
                <h3><?= $artists[$i]->getName() ?></h3>
                <p><?= $artists[$i]->getDescription() ?></p>
                <hr><span class="textSmall">Plays the <?= $artists[$i]->getTimeSlots()[0]->getStartTime()->format('dS') ?>!</span>
                <button class="buttonJazz"> Learn More About artist</button>
              </div>
              </div>
            <?php } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
      </div>

      <h2 class="margin-bottom underlined textCenter">Schedule:</h2>

      <div class="margin-top jazzContainer schedule">
        <div class="row m-2 mt-5">
          <div class="col-md-3  mt-4" id="location-information">
            <h4 class="location-text ">Location: <br>
              <span>The Patronaat </span>
            </h4>
            <p class="long-term-ticket-text">
              Would you rather have <strong>access</strong> to the <strong>whole day?</strong> Get your day ticket for only <strong>€35</strong>!
            </p>
            <button class="line-height longTermTicketButton buttonJazz"><strong>get a day ticket</strong><br> €35</button>
            <p class="long-term-ticket-text">
              Can’t choose? You can purchase a week ticket and get <strong>access</strong> to the <strong>whole week</strong>! Get a week ticket for only <strong>€80</strong>!
            </p>
            <button class="line-height longTermTicketButton buttonJazz"><strong>get a week ticket</strong><br> €85</button>
          </div>

          <div class="col-md-9 mt-4">
            <table class="jazz-schedule">
              <tr>
                <?php
                $targetDate = new DateTime('2023-07-27');
                $halls = [];

                foreach ($timeSlots as $timeSlot) {
                  $startTime = $timeSlot->getStartTime();
                  $hallName = $timeSlot->getHall()->getHallName();

                  if ($startTime->format('Y-m-d') == $targetDate->format('Y-m-d')) {
                    if (!isset($halls[$hallName])) {
                      $halls[$hallName] = $hallName;
                    }
                  }
                }
                ?>
                <?php var_dump($halls) ?>
                <?php for ($i = 0; $i < count($halls); $i++) {
                ?>
                  <th class="text-center <?php if($i == 0) {?>first-th <?php } ?>">
                    <?= $hall ?>
                  </th>
                  <?php if($i == 0) {?><td style="width: 65px;"></td> <?php } ?>
                <?php } ?>
              </tr>
              <tr>
                <td style="height: 25px;"></td>
              </tr>
              <tr>
                <td class="schedule-button first-schedule-button ">
                  <img src="image/jazz/artist3.png"> </img>
                  <div class="container add-ticket">
                    <div class='row'>
                      <p>Gumbo Kings</p>
                    </div>
                    <div class='row'>
                      <p class="time-text">18:00 - 19:00</p>
                      <p class="time-text price text-end">€15</p>
                    </div>
                  </div>
                  <div class="container add-button">
                    <p> add </p>
                  </div>
                </td>
                <td style="width: 65px;"></td>
                <td class="schedule-button">
                  <img src="image/jazz/artist3.png"> </img>
                  <div class="container add-ticket">
                    <div class='row'>
                      <p>Gumbo Kings</p>
                    </div>
                    <div class='row'>
                      <p class="time-text">18:00 - 19:00</p>
                      <p class="time-text price text-end">€15</p>
                    </div>
                  </div>
                  <div class="container add-button">
                    <p> add </p>
                  </div>
                </td>
              </tr>
              <tr>
                <td style="height: 25px;"></td>
              </tr>
              <tr>
                <td class="schedule-button">
                  <img src="image/jazz/artist3.png"> </img>
                  <div class="container">
                    <div class='row'>
                      <p>Gumbo Kings</p>
                    </div>
                    <div class='row'>
                      <p class="time-text">18:00 - 19:00</p>
                      <p class="time-text price text-end">€15</p>
                    </div>
                  </div>
                  <div class="container add-button">
                    <p> add </p>
                  </div>
                </td>

                <td style="width: 65px;"></td>

                <td class="schedule-button">
                  <img src="image/jazz/artist3.png"> </img>
                  <div class="container">
                    <div class='row'>
                      <p>Gumbo Kings</p>
                    </div>
                    <div class='row'>
                      <p class="time-text">18:00 - 19:00</p>
                      <p class="time-text price text-end">€15</p>
                    </div>
                  </div>
                  <div class="container add-button">
                    <p> add </p>
                  </div>
                </td>
              </tr>
            </table>

          </div>

        </div>
      </div>


      <h2 class="margin-bottom underlined textCenter">locations:</h2>

      <div class="center">
        <div class="margin-top center" id="locations">
          <?php
          echo '<div class="grid-Locations" style ="grid-template-columns: repeat(' . count($locations) . ', 1fr)">';
          for ($i = 1; $i <= count($locations); $i++) {
            echo '<div class="grid-item" style="grid-row: 1; grid-column: ' . $i . '">' .
              '<img src="' . $locations[$i - 1]->getLocationImage() . '" class="locationImage" alt="patronaat">' .
              '<h3><span><strong>' . $locations[$i - 1]->getLocationName() . '</strong></span></h3>' .
              '<img src="/image/jazz/ToAndFrom.png" alt="to and from illustration">' .
              '<p>' .
              '<strong>To & from</strong><br>' .
              $locations[$i - 1]->getToAndFromText() .
              '</p>' .
              '<img src="/image/jazz/Accessibility.png" alt="Accessibility illustration">' .
              '<p>' .
              '<strong>Accessibility</strong><br>' .
              $locations[$i - 1]->getAccesibillityText() .
              '</p>' .
              '</div>';
          }
          echo '</div>';
          ?>
        </div>
      </div>


    </div>