<?php

// Create an array of test data for tickets
$tickets = array(
    array(
      "id" => 1234,
      "date" => "2023-03-15",
      "name" => "John Smith",
      "price" => 50,
      "amount" => 2
    ),
    array(
      "id" => 2345,
      "date" => "2023-03-16",
      "name" => "Jane Doe",
      "price" => 40,
      "amount" => 1
    ),
    // Add more tickets as you wish
  );
  
  // Initialize a variable to store the grand total
  $grand_total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tickets</title>
    <!-- Include Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="../css/paymentpage/recieve.css" rel="stylesheet">
</head>
<body>
<img id="background" src="\image\Payment\overview\backgroundpayment.png"  >


<div class="container" id="progressContainer">
    <div class="card">
        <div class="row d-flex justify-content-between px-3 top">
            <div class="d-flex">
            </div>
            <div class="d-flex flex-column text-sm-right">
            </div>
        </div>
        <!-- Add class 'active' to progress -->
        <div class="row d-flex justify-content-center">
            <div class="col-12">
            <ul id="progressbar" class="text-center">
                <li class="active step0"></li>
                <li class="active step0"></li>
                <li class="active step0"></li>
                <li class="active step0"></li>
            </ul>
            </div>
        </div>
        <div class="row justify-content-between top" id="row-width">
            <div class="row d-flex icon-content"  id="flex">
                <img class="icon" src="https://i.imgur.com/9nnc9Et.png">
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Review<br>Tickets</p>
                </div>
            </div>
            <div class="row d-flex icon-content"  id="flex">
                <img class="icon" src="http://cdn.onlinewebfonts.com/svg/img_230731.png">
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Login</p>
                </div>
            </div>
            <div class="row d-flex icon-content"  id="flex">
                <img class="icon" src="https://cdn3.iconfinder.com/data/icons/online-shopping-line-flash-deals/512/Cash_on_delivery-512.png">
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Payment<br>Information</p>
                </div>
            </div>
            <div class="row d-flex icon-content"  id="flex">
                <img class="icon" src="https://th.bing.com/th/id/R.c4f226e94861c395866a9b2c3bacb482?rik=aIhV%2fV8GkQcsFw&riu=http%3a%2f%2fcdn.onlinewebfonts.com%2fsvg%2fimg_432058.png&ehk=1NipJCsVQFhbh12bsO25ElaQQJYGZRsglyiHmv4%2bXjE%3d&risl=&pid=ImgRaw&r=0">
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Recieve<br>Tickets</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" id="recieveContainer">
<div class="row" id="row1">
<div class="col" id="leftcol">
    <h3>Thank you for finishing your personal program <br>
    and have fun at the Festival</h3>
    <p id="programInfo">Your personal program ID is ‘0000000001’ <br>
    The personal program has been sent to ‘johndoe@gmail.com’, with all the necessary information for a great day in Haarlem. <br>
    For questions, changes or support mail ‘thefestival@haarlem.com </p>
    <p id="qrText">You can also find your tickets here</p>

<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/QR_Code_Example.svg/1024px-QR_Code_Example.svg.png" id="qrcodeimage">
<br>
<a href="/home" class="btn btn-primary" id="returnButton">Return home</a>
</div>


<div class="col" id="rightcol">
    <h3>Your program</h3>
    <table>
  <thead>
    <tr id="tableRow">
      <th id="eventCol">Event</th>
      <th id="dateCol">Date</th>
      <th id="timeCol">Time</th>
      <th id="amountCol">Amount</th>
      <th id="priceCol">Total Price</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $events = array(
        array("Concert", "2023-03-20", "19:00", 2, "$200"),
        array("Movie", "2023-03-22", "20:00", 3, "$150"),
        array("Play", "2023-03-25", "14:00", 4, "$400")
      );
      $total_cost = 0;

      foreach ($events as $event) {
        $amount = $event[3];
        $price = substr($event[4], 1);
        $total = $amount * $price;
        $total_cost += $total;

        echo "<tr>";
        echo "<td>" . $event[0] . "</td>";
        echo "<td>" . $event[1] . "</td>";
        echo "<td>" . $event[2] . "</td>";
        echo "<td>" . $event[3] . "</td>";
        echo "<td>$" . $total . "</td>";
        echo "</tr>";
      }
      echo "<tr>";
      echo "<td colspan='4'>Total Cost:</td>";
      echo "<td>$" . $total_cost . "</td>";
      echo "</tr>";
    ?>
  </tbody>
</table>

</div>
</div>
</div>

</body> 
</html>

<?php
include __DIR__ . '/../footer.php';
?>
