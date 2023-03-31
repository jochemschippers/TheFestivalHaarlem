    const navbar = document.getElementById("navbar");
    const links = navbar.getElementsByTagName("span");
    document.title = "The Festival";
    if (params[1] === "" || params[1] === null) {
      links[0].classList.add("selected");
    } else {
      for (let i = 0; i < links.length; i++) {
        if (links[i].textContent.toLowerCase() === params[1].toLowerCase()) {
          links[i].classList.add("selected");
          document.title += " - " + links[i].textContent;
        }
      }
    }