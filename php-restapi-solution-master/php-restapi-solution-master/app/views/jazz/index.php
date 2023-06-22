<body>
  <div class="layered">
    <div class="background-Image jazz-background-image">
      <div class="border-box">
      </div>
      <div class="container landingPageContainer jazz-container-landing ">
        <div class="row">
          <div class="col-md-7" id="titleText">
            <h2 class="underlined">Feel the <strong>Rhythm</strong> of Haarlem:</h2>
            <p class="jazz-landing-page-p">Ready for an unforgettable festival experience? Join us in Haarlem for the amazing Haarlem Jazz Festival from July 26th to 29th, 2023! This one-of-a-kind event invites everyone to groove along to a fantastic mix of jazz, blues, and soul in a relaxed, yet lively atmosphere.
              <br> <br>
              So, what are you waiting for? Grab your tickets and come join us for a fantastic musical experience at the Haarlem Jazz Festival 2023. See you there!
            </p>
          </div>
          <div class="col-md-5">

          </div>
          <div class="col-md-7">
            <button class="buttonJazz d-flex justify-content-center align-items-center" id="seeLocationsButton"> See locations </button>
          </div>
          <h2 class="underlined textCenter">Featuring:</h2>
        </div>
      </div>
    </div>
    <div id="artistCarousel" class="carousel slide jazzContainer pointer-event" data-bs-ride="carousel">
      <ol class="carousel-indicators">
        <?php for ($i = 0; $i < count($artists); $i++) { ?>
          <li data-bs-target="#artistCarousel" data-bs-slide-to="<?= $i ?>" class="<?= $i === 0 ? 'active' : '' ?>"></li>
        <?php } ?>
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
                <?php //check if artist plays at any point of time during the festival 
                if (isset($artists[$i]->getTimeSlots()[0])) { ?>
                  <hr><span class="textSmall">Plays the <?= //gets first time this artist will show up
                                                        $artists[$i]->getTimeSlots()[0]->getStartTime()->format('dS') ?>!</span>
                <?php } ?>
                <button class="buttonJazz"> Learn More About artist</button>
              </div>
              </div>
            <?php } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#artistCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#artistCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
      </div>




      <h2 class="margin-bottom underlined textCenter">Schedule:</h2>
      <div id="scheduleCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="30000">
        <div class="carousel-inner">
          <?php
          $dateList = ['2023-07-27', '2023-07-28', '2023-07-29', '2023-07-30'];
          for ($dateIndex = 0; $dateIndex < count($dateList); $dateIndex++) {
            $targetDate = new DateTime($dateList[$dateIndex]);
            $uniqueHalls = [];
            $timeSlotByHall = [];


            for ($i = 0; $i < count($timeSlots); $i++) {
              $timeSlot = $timeSlots[$i];
              $startTime = $timeSlot->getStartTime();
              $hall = $timeSlot->getHall();
              $hallID = $hall->getHallID();

              if ($startTime->format('Y-m-d') == $targetDate->format('Y-m-d')) {
                if (!in_array($hall, $uniqueHalls)) {
                  $uniqueHalls[] = $hall;
                }
                if (!isset($timeSlotByHall[$hallID])) {
                  $timeSlotByHall[$hallID] = [];
                }
                $timeSlotByHall[$hallID][] = $timeSlot;
              }
            }

          ?>
            <div class="carousel-item <?php if ($dateIndex == 0) { ?>active <?php } ?>">
              <div class="margin-top jazzContainer schedule">
                <div class="d-flex justify-content-center align-items-center">
                  <button class="carousel-control-prev" type="button" data-bs-target="#scheduleCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <h3 class="mx-3"><?= $targetDate->format('l, jS \of F') ?></h3>
                  <button class="carousel-control-next" type="button" data-bs-target="#scheduleCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>
                <div class="row m-2 mt-5">
                  <div class="col-md-3  mt-4" id="location-information">
                    <h4 class="location-text ">Location: <br>
                      <span><?= $timeSlotByHall[0][0]->getJazzLocation()->getLocationName() ?> </span>
                    </h4>
                    <p class="long-term-ticket-text">
                      Would you rather have <strong>access</strong> to the <strong>whole day?</strong> Get your day ticket for only <strong>€35</strong>!
                    </p>
                    <button id="day-ticket" class="line-height longTermTicketButton buttonJazz" data-ticket-info='{
                        "timeSlotID": "<?= $dayTickets[$dateIndex]->getTimeSlotID(); ?>",
                        "date": "<?= $dayTickets[$dateIndex]->getStartTime()->format('j F l'); ?>",
                        "timeRange": "<?= $dayTickets[$dateIndex]->getStartTime()->format('G:i'); ?> - <?= $dayTickets[$dateIndex]->getEndTime()->format('G:i'); ?>", 
                        "artistName": "Day ticket",
                        "colorID": "-1",
                        "ticketsLeft": "<?= $dayTickets[$dateIndex]->getMaximumAmountTickets() - $dayTickets[$dateIndex]->getCurrentlyBoughtTickets() ?>",
                        "location": "Day pass", 
                        "price": "<?= $dayTickets[$dateIndex]->getPrice() ?>"
                        }'>
                      <strong>get a day ticket</strong><br> €35
                    </button>
                    <p class="long-term-ticket-text">
                      Can’t choose? You can purchase a week ticket and get <strong>access</strong> to the <strong>whole week</strong>! Get a week ticket for only <strong>€80</strong>!
                    </p>
                    <button id="week-ticket" class="line-height longTermTicketButton buttonJazz"data-ticket-info='{
                        "timeSlotID": "<?= $dayTickets[3]->getTimeSlotID(); ?>",
                        "date": "multiple days",
                        "timeRange": "Any time you want!", 
                        "artistName": "Week ticket",
                        "colorID": "-1",
                        "ticketsLeft": "<?= $dayTickets[3]->getMaximumAmountTickets() - $dayTickets[3]->getCurrentlyBoughtTickets() ?>",
                        "location": "Week pass", 
                        "price": "<?= $dayTickets[3]->getPrice() ?>"
                        }'><strong>get a week ticket</strong><br> €80</button>
                  </div>

                  <div class="col-md-9 mt-4">
                    <table class="jazz-schedule">
                      <tr>
                        <?php //dynamically loads table headers
                        for ($i = 0; $i < count($uniqueHalls); $i++) { ?>
                          <th class="text-center <?php if ($i == 0) { ?>first-th <?php } ?>">
                            <?= $uniqueHalls[$i]->getHallName() ?>
                          </th>
                          <?php if ($i < count($uniqueHalls)) { ?><td style="width: 65px;"></td> <?php } ?>
                        <?php } ?>
                      </tr>
                      <?php
                      $totalArtists = 0;
                      foreach ($timeSlotByHall as $hallID => $artists) {
                        $totalArtists += count($artists);
                      }
                      for ($i = 0; $i < ceil($totalArtists / count($uniqueHalls)); $i++) { ?>
                        <tr>
                          <td style="height: 25px;"></td>
                        </tr>
                        <tr>
                          <?php //dynamically loads clickable buttons
                          for ($j = 0; $j < count($uniqueHalls); $j++) {
                            $currentHallID = $uniqueHalls[$j]->getHallID();
                            //checks if there is an artist assigned to one of the halls on the location
                            if (isset($timeSlotByHall[$currentHallID][$i])) {
                          ?>

                              <td class="schedule-button 
                              
                              <?php //checks if it is first and location isn't groteMarkt
                              $isGroteMarkt = $timeSlotByHall[$currentHallID][$i]->getJazzLocation()->getLocationID() == 2;
                              if ($j == 0 && !$isGroteMarkt) { ?>first-schedule-button <?php } ?> 
                              <?php //checks if location is GroteMarkt, if so, change style
                              if ($isGroteMarkt) { ?>
                              <?php //give each even number a first-schedule-button style
                                if ($i % 2 == 0) { ?>first-schedule-button<?php } ?> 
                              grote-Markt-Item<?php } ?>">
                                <img src="<?= $timeSlotByHall[$currentHallID][$i]->getArtist()->getImage() ?>"> </img>
                                <div class="container add-ticket">
                                  <div class='row'>
                                    <p> <?= $timeSlotByHall[$currentHallID][$i]->getArtist()->getName() ?> </p>
                                  </div>
                                  <div class='row'>
                                    <p class="time-text"><?= DATE_FORMAT($timeSlotByHall[$currentHallID][$i]->getStartTime(), 'H:i') ?> - <?= DATE_FORMAT($timeSlotByHall[$currentHallID][$i]->getEndTime(), 'H:i') ?></p>
                                    <p class="time-text price text-end">
                                      €<?= $timeSlotByHall[$currentHallID][$i]->getPrice() ?></p>
                                  </div>
                                </div>
                                <?php
                                $buttonClass = ($isGroteMarkt || $timeSlotByHall[$currentHallID][$i]->getCurrentlyBoughtTickets() < $timeSlotByHall[$currentHallID][$i]->getMaximumAmountTickets()) ? 'add-button' : 'disabled';
                                //grote markt is always a free event, so, make it free. otherwise check if still available
                                $buttonText = $isGroteMarkt ? 'FREE' : ($timeSlotByHall[$currentHallID][$i]->getCurrentlyBoughtTickets() >= $timeSlotByHall[$currentHallID][$i]->getMaximumAmountTickets() ? 'SOLD<br>OUT' : 'add');                                ?>
                                <div class="container <?= $buttonClass; ?>" data-ticket-info='{
                                  "timeSlotID": "<?= $timeSlotByHall[$currentHallID][$i]->getTimeSlotID(); ?>",
                                  "date": "<?= $timeSlotByHall[$currentHallID][$i]->getStartTime()->format('j F l'); ?>",
                                  "timeRange": "<?= $timeSlotByHall[$currentHallID][$i]->getStartTime()->format('G:i'); ?> - <?= $timeSlotByHall[$currentHallID][$i]->getEndTime()->format('G:i'); ?>", 
                                  "artistName": "<?= $timeSlotByHall[$currentHallID][$i]->getArtist()->getName(); ?>",
                                  "colorID": "<?=
                                              //logic for this line: Based on the color ID the javascript chooses which color to make the first column of a row. 0 = primary (red) 1 or more = secondary (yellow) -1 = day or week tickets (gradient)
                                              $currentHallID ?>",
                                  "ticketsLeft": "<?= $timeSlotByHall[$currentHallID][$i]->getMaximumAmountTickets() - $timeSlotByHall[$currentHallID][$i]->getCurrentlyBoughtTickets() ?>",
                                  "location": "<?= $timeSlotByHall[$currentHallID][$i]->getJazzLocation()->getLocationName() ?>, <?= $timeSlotByHall[$currentHallID][$i]->getHall()->getHallName() ?>", 
                                  "price": "<?= $timeSlotByHall[$currentHallID][$i]->getPrice() ?>"}'>
                                  <p><?= $buttonText; ?></p>
                                </div>
                              </td>
                              <?php if ($j == 0) { ?><td style="width: 65px;"></td> <?php } ?>
                          <?php }
                          } ?>
                        </tr>
                      <?php };
                      ?>
                      <tr style="height: 25px;"></tr>
                    </table>

                  </div>

                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>

      <h2 class="margin-bottom underlined textCenter">locations:</h2>

      <div class="center">
        <div class="margin-top center" id="locations">
          <?php
          $gridStyle = 'grid-template-columns: repeat(' . count($locations) . ', 1fr)';
          ?>
          <div class="grid-Locations" style="<?= $gridStyle ?>">
            <?php for ($i = 1; $i <= count($locations); $i++) : ?>
              <?php
              $gridItemStyle = 'grid-row: 1; grid-column: ' . $i;
              $location = $locations[$i - 1];
              $locationImage = $location->getLocationImage();
              $locationName = $location->getLocationName();
              $toAndFromText = $location->getToAndFromText();
              $accessibilityText = $location->getAccesibillityText();
              ?>
              <div class="grid-item" style="<?= $gridItemStyle ?>">
                <img src="<?= $locationImage ?>" class="locationImage" alt="patronaat">
                <h3><span><strong><?= $locationName ?></strong></span></h3>
                <img src="/image/jazz/ToAndFrom.png" alt="to and from illustration">
                <p>
                  <strong>To &amp; from</strong><br>
                  <?= $toAndFromText ?>
                </p>
                <img src="/image/jazz/Accessibility.png" alt="Accessibility illustration">
                <p>
                  <strong>Accessibility</strong><br>
                  <?= $accessibilityText ?>
                </p>
              </div>
            <?php endfor; ?>
          </div>
        </div>
      </div>


    </div>
    <div class="modal" tabindex="-1" id="ticketModal">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ticketTitle"> Jazz Event Ticket</h5>
            <button type="button" class="btn-close" style="margin-bottom: 1;" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="d-flex justify-content-between table-ticket">
              <div class="text-center" id="date-location">
                <p id="ticketDate"></p>
                <p id="ticketLocation"></p>
              </div>
              <div class="artist-time-range mr-auto">
                <p id="ticketArtist"></p>
                <p id="ticketTimeRange"></p>
              </div>
              <div class="d-flex flex-column align-items-center price">
                <p>Price:</p>
                <p id="ticketPrice"></p>
              </div>
              <div class="d-flex flex-column align-items-center justify-content-center quantityTickets mr-auto ml-4">
                <div class="btn-group justify-content-center align-items-center" role="group">
                  <button type="button" class="btn btn-outline-secondary modal-input text-center justify-content-center" id="minusButton">-</button>
                  <input type="number" class="text-center" id="ticketQuantity" value="1" max="10">
                  <button type="button" class="btn btn-outline-secondary modal-input text-center justify-content-center" id="plusButton">+</button>
                </div>
                <p id="tickets-left">tickets left: </p>
              </div>
              <div class="d-flex flex-column align-items-center price">
                <p>Subtotal:</p>
                <p id="ticketTotal"></p>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="line-height longTermTicketButton buttonJazz mr-auto" id="addToProgram">Add to personal program</button>
            <button type="button" class="line-height longTermTicketButton buttonJazz ml-auto" id="cancel">Cancel</button>

          </div>
        </div>
      </div>
    </div>