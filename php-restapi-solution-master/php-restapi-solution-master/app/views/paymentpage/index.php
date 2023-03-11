<?php 
include __DIR__ . '/../navbar.php';
?>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link href="../css/paymentpage.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1 class="text-center mb-4">Shopping Basket Overview</h1>
		<table class="table">
			<thead>
				<tr>
					<th>Item Name</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Total</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<!-- example data -->
				<tr>
					<td>Item 1</td>
					<td><input type="number" class="form-control" value="1"></td>
					<td>$10.00</td>
					<td>$10.00</td>
					<td><button class="btn btn-danger">Remove</button></td>
				</tr>
				<tr>
					<td>Item 2</td>
					<td><input type="number" class="form-control" value="2"></td>
					<td>$5.00</td>
					<td>$10.00</td>
					<td><button class="btn btn-danger">Remove</button></td>
				</tr>
				<tr>
					<td>Item 3</td>
					<td><input type="number" class="form-control" value="3"></td>
					<td>$2.50</td>
					<td>$7.50</td>
					<td><button class="btn btn-danger">Remove</button></td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3"><strong>Total:</strong></td>
					<td><strong>$27.50</strong></td>
					<td></td>
				</tr>
			</tfoot>
		</table>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
<?php 
include __DIR__ . '/../footer.php';
?>