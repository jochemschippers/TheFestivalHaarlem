<footer class="site-footer">

  <div class="container">
    <div class="row width:1720px">
      <div class="col-sm-12 col-md-2">
        <h6>Contact Us:</h6>
        <p class="text-justify">Kooimanstraat 6<br>1578 PC / Haarlem<br>023-12345678</p>
        <p class="text-justify">info@thefestival.nl</p>
      </div>

      <div class="col-xs-6 col-md-2">
        <h6>Navigation:</h6>
        <ul class="footer-links">
          <li><a href="/">Home</a></li>
          <?php try { ?>
            <?php foreach ($events as $event) { ?>
              <li><a href="/<?= str_replace(' ', '-', $event->getEventName()) ?>"><?= $event->getEventName() ?></a></li>
            <?php } ?>
          <?php } catch (error $e) { ?>
            something went wrong while loading the navigation! Please try again later
          <?php } ?>
        </ul>
      </div>

      <div class="col-sm-12 col-md-5 legal-nav text-center">
        <img src="https://i.ibb.co/XLh16FT/Logo-small.png" alt="the festival logo" class="festival-logo-small" width=160 height=130>
        <ul class="footer-links">
          <li><a href="#">Terms and Conditions</a></li>
          <li><a href="#">Privacy</a></li>
          <li><a href="#">Cookies</a></li>
      </div>
      <div class="col-sm-12 col-md-3">
        <h6>Our Sponsor:</h6>
        <ul class="footer-links">
          <li><a href="#">Visit Haarlem</a></li>
        </ul>
        <p class="text-justify"> </p>
        <p class="text-justify"> Follow us on our socials! </p>
        <ul class="social-icons">
          <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
          <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
          <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
          <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
          <li><a class="youtube" href="#"><i class="fa fa-youtube"></i></a></li>
      </div>
      </ul>
    </div>
  </div>
  </div>

  <script>
    const navbar = document.getElementById("navbar");
    const links = navbar.getElementsByTagName("span");
    document.title = "The Festival";
    console.log(links);
    console.log(params[1]);
    if (params[1] === "" || params[1] === null) {
      links[0].classList.add("selected");
    } else {
      for (let i = 0; i < links.length; i++) {
        if (links[i].textContent.toLowerCase() === params[1].toLowerCase()) {
          console.log(links[i].textContent)
          links[i].classList.add("selected");
          document.title += " - " + links[i].textContent;
        }
      }
    }
  </script>
  <script src="/js/dynamicNavBarLoader.js"></script>
  <script src="/js/dynamicResourceLoader.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</footer>

</html>