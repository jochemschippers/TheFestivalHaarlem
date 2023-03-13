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
    <title>Ticket Table</title>
    <!-- Include Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Ticket Table</h1>
    
     <!-- Use Bootstrap grid system to create two columns -->
     <div class="row">
     
        <!-- Create a column for the original table -->
        <div class="col-md-6">
            <!-- Create a table with Bootstrap classes -->
            <table class="table table-striped table-bordered">
                <!-- Create table header -->
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <!-- Create table body -->
                <tbody>
                    <?php foreach ($tickets as $ticket) { ?>
                    <!-- Loop through each ticket and display its data in a row -->
                    <tr>
                    <td><?php echo $ticket["id"]; ?></td>
                <td><?php echo $ticket["date"]; ?></td>
                <td><?php echo $ticket["name"]; ?></td>
                <td>$<?php echo number_format($ticket["price"],2); ?></td> 
                <!-- Format price with two decimal places -->
                <td><input type="number" value=<?php echo $ticket["amount"]; ?> min="0"></td> 
                    </tr> 
                    <?php } ?>
                </tbody> 
            </table> 
        </div> 
        
        <!-- Create a column for the calculation table -->
        <div class="col-md-6">
            <!-- Create a table with Bootstrap classes -->
            <table class="table table-striped table-bordered">
                <!-- Create table header -->
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <!-- Create table body -->
                <tbody>
                    <?php foreach ($tickets as $ticket) { ?>
                    <!-- Loop through each ticket and calculate its total price -->
                    <?php $total_price = $ticket["price"] * $ticket["amount"]; ?>
                    <!-- Add the total price to the grand total -->
                    <?php $grand_total += $total_price; ?>
                    <!-- Display the ticket ID and its total price in a row -->
                    <tr>
                    <td><?php echo $ticket["id"]; ?></td>
                    <td>$<?php echo number_format($total_price,2); ?></td>
                </tr>
<?php } ?>
<!-- Display a row for the grand total -->
<tr>
    <th>Grand Total</th>
    <th>$<?php echo number_format($grand_total,2); ?></th>
</tr>
</tbody> 
</table> 
</div> 

</div> 
<!-- End of row -->
</div> 
<!-- End of container -->
</body> 
</html>