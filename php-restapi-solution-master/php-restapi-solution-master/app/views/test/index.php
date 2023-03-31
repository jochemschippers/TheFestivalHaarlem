

<main role="main">
  <div class="row panel important vh15">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-music"></i>
              </div>
              <div class="mr-5 text-black explainationText">Manage the Artists, jazz location details, halls of the patronaat and timeslots jazz</div>
            </div>
            <a class="card-footer text-black explainationText clearfix small z-1" href="#">
              <span class="float-left">Edit Jazz</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-hamburger"></i>
              </div>
              <div class="mr-5 text-black explainationText">Manage the restaurants, timeslots, restaurantFoodTypes, restaurant images, RestaurantMenuItems and time Slots</div>
            </div>
            <a class="card-footer text-black explainationText clearfix small z-1" href="#">
              <span class="float-left">Edit Yummy</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-landmark"></i>
              </div>
              <div class="mr-5 text-black explainationText">Manage History, timeslots, Guides, HistoryDetailPages</div>
            </div>
            <a class="card-footer text-black explainationText clearfix small z-1" href="#">
              <span class="float-left">Edit a stroll through History</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-key"></i>
              </div>
              <div class="mr-5 text-black explainationText">Manage API Keys</div>
            </div>
            <a class="card-footer text-black explainationText clearfix small z-1" href="#">
              <span class="float-left">Edit API Keys</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div> 
      <?php

//here could be possible php code, where if the count of $this->events is higher than 3, make dynamically new cards
?>
  <section class="panel important">
    <h2>Write Some News</h2>
    <ul>
      <li>Information Panel</li>
    </ul>
  </section>
  
  <section class="panel important">
    <h2>Write a post</h2>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="twothirds">
          Blog title:<br/>
          <input type="text" name="title" size="40"/><br/><br/>
          Content:<br/>    
          <textarea name="newstext" rows="15" cols="67"></textarea><br/>  
        </div>
        <div>
          <input type="submit" name="submit" value="Save" />
        </div>
        </div>
      </form>
  </section>

</main>